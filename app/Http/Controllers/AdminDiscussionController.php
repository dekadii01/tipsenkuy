<?php

namespace App\Http\Controllers;

use App\Events\ReplyPosted;
use App\Events\ThreadDeleted;
use App\Events\ThreadPosted;
use App\Events\ReplyDeleted;
use App\Models\ClassSession;
use App\Models\DiscussionReply;
use App\Models\DiscussionThread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDiscussionController extends Controller
{
    // ── Daftar thread ──────────────────────────────────────────
    public function index(int $id, Request $request)
    {
        $session = ClassSession::findOrFail($id);
        $tab     = $request->get('tab', 'all');
        $search  = $request->get('search');

        $query = DiscussionThread::where('session_id', $session->id)
            ->withCount('replies')
            ->with('user')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at');

        if ($tab === 'unanswered') {
            $query->where('is_answered', false);
        } elseif ($tab === 'pinned') {
            $query->where('is_pinned', true);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body',  'like', "%{$search}%");
            });
        }

        $threads = $query->paginate(10)->withQueryString();

        // Semua peserta untuk sidebar kontributor
        $contributors = User::select('id', 'first_name', 'last_name', 'role')
            ->withCount([
                'discussionThreads as post_count' => fn($q) =>
                $q->where('session_id', $session->id)
            ])
            ->having('post_count', '>', 0)
            ->orderByDesc('post_count')
            ->limit(5)
            ->get()
            ->map(fn($u) => [
                'id'        => $u->id,
                'name'      => $u->first_name . ' ' . $u->last_name,
                'initials'  => strtoupper(substr($u->first_name, 0, 1) . substr($u->last_name ?? '', 0, 1)),
                'role'      => $u->role,
                'post_count' => $u->post_count,
            ]);

        $stats = [
            'total_threads' => DiscussionThread::where('session_id', $session->id)->count(),
            'total_replies' => DiscussionReply::whereHas(
                'thread',
                fn($q) => $q->where('session_id', $session->id)
            )->count(),
            'unanswered'    => DiscussionThread::where('session_id', $session->id)
                ->where('is_answered', false)->count(),
            'reported'      => DiscussionReply::where('is_reported', true)
                ->whereHas('thread', fn($q) => $q->where('session_id', $session->id))->count(),
        ];

        // Semua user di sesi untuk presence channel (sama seperti user side)
        $allParticipants = User::select('id', 'first_name', 'last_name', 'role')
            ->get()
            ->map(fn($u) => [
                'id'       => $u->id,
                'name'     => $u->first_name . ' ' . $u->last_name,
                'initials' => strtoupper(substr($u->first_name, 0, 1) . substr($u->last_name ?? '', 0, 1)),
                'role'     => $u->role,
            ]);

        return view('admin.discussion.index', compact(
            'session',
            'threads',
            'stats',
            'tab',
            'search',
            'contributors',
            'allParticipants'
        ));
    }

    // ── Buat thread baru (admin) ───────────────────────────────
    public function store(int $id, Request $request)
    {
        $session = ClassSession::findOrFail($id);

        $request->validate([
            'title'           => 'required|string|max:255',
            'body'            => 'required|string',
            'is_pinned'       => 'nullable|boolean',
            'is_announcement' => 'nullable|boolean',
        ]);

        $thread = DiscussionThread::create([
            'session_id'      => $session->id,
            'user_id'         => Auth::id(),
            'title'           => $request->title,
            'body'            => $request->body,
            'is_pinned'       => (bool) $request->is_pinned,
            'is_announcement' => (bool) $request->is_announcement,
        ]);

        $thread->load('user');
        broadcast(new ThreadPosted($thread))->toOthers();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'thread_id' => $thread->id]);
        }

        return back()->with('success', 'Thread berhasil dibuat.');
    }

    // ── Detail thread ──────────────────────────────────────────
    public function show(int $id, DiscussionThread $thread)
    {
        $session = ClassSession::findOrFail($id);
        abort_if($thread->session_id !== $session->id, 404);

        $thread->load(['user', 'replies.user', 'replies.quotedReply.user']);

        $otherThreads = DiscussionThread::where('session_id', $session->id)
            ->where('id', '!=', $thread->id)
            ->withCount('replies')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        return view('admin.discussion.show', compact('session', 'thread', 'otherThreads'));
    }

    // ── Toggle pin ─────────────────────────────────────────────
    public function pin(int $id, DiscussionThread $thread, Request $request)
    {
        $session = ClassSession::findOrFail($id);
        abort_if($thread->session_id !== $session->id, 404);

        $thread->update(['is_pinned' => !$thread->is_pinned]);

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'is_pinned' => $thread->is_pinned,
            ]);
        }

        return back()->with('success', $thread->is_pinned ? 'Thread disematkan.' : 'Pin dilepas.');
    }

    // ── Hapus thread ───────────────────────────────────────────
    public function destroy(int $id, DiscussionThread $thread, Request $request)
    {
        $session = ClassSession::findOrFail($id);
        abort_if($thread->session_id !== $session->id, 404);

        $threadId  = $thread->id;
        $sessionId = $session->id;

        $thread->replies()->delete();
        $thread->delete();

        broadcast(new ThreadDeleted($threadId, $sessionId))->toOthers();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Thread berhasil dihapus.');
    }

    // ── Hapus reply ────────────────────────────────────────────
    public function destroyReply(int $id, DiscussionThread $thread, DiscussionReply $reply, Request $request)
    {
        $session = ClassSession::findOrFail($id);
        abort_if($thread->session_id !== $session->id, 404);
        abort_if($reply->thread_id   !== $thread->id,  404);

        $replyId   = $reply->id;
        $threadId  = $thread->id;
        $sessionId = $session->id;

        $reply->delete();

        broadcast(new ReplyDeleted($replyId, $threadId, $sessionId))->toOthers();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Balasan dihapus.');
    }
}
