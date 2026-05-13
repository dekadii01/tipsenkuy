<?php

namespace App\Http\Controllers;

use App\Events\ReplyPosted;
use App\Events\ThreadPosted;
use App\Models\ClassSession;
use App\Models\DiscussionReply;
use App\Models\DiscussionThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    // ── Daftar thread ──────────────────────────────────────────
    public function index(ClassSession $session, Request $request)
    {
        $tab = $request->get('tab', 'all');

        $query = DiscussionThread::where('session_id', $session->id)
            ->withCount('replies')
            ->with('user')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at');

        if ($tab === 'unanswered') {
            $query->where('is_answered', false);
        } elseif ($tab === 'mine') {
            $query->where('user_id', Auth::id());
        }

        $threads = $query->paginate(10)->withQueryString();

        $stats = [
            'total_threads'   => DiscussionThread::where('session_id', $session->id)->count(),
            'total_replies'   => DiscussionReply::whereHas('thread', fn($q) => $q->where('session_id', $session->id))->count(),
            'unanswered'      => DiscussionThread::where('session_id', $session->id)->where('is_answered', false)->count(),
            'from_admin'      => DiscussionThread::where('session_id', $session->id)->whereHas('user', fn($q) => $q->where('role', 'admin'))->count(),
        ];

        $onlineCount = 0; // Akan di-update via real-time dari Echo

        return view('user.discussion.index', compact('session', 'threads', 'stats', 'tab', 'onlineCount'));
    }

    // ── Buat thread baru ───────────────────────────────────────
    public function store(ClassSession $session, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $thread = DiscussionThread::create([
            'session_id' => $session->id,
            'user_id'    => Auth::id(),
            'title'      => $request->title,
            'body'       => $request->body,
        ]);

        broadcast(new ThreadPosted($thread))->toOthers();

        // Return JSON jika AJAX, redirect jika bukan
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'thread_id' => $thread->id]);
        }

        return back()->with('success', 'Thread berhasil dibuat.');
    }

    // ── Detail thread ──────────────────────────────────────────
    public function show(ClassSession $session, DiscussionThread $thread)
    {
        abort_if($thread->session_id !== $session->id, 404);

        $thread->load(['user', 'replies.user', 'replies.quotedReply.user']);

        $otherThreads = DiscussionThread::where('session_id', $session->id)
            ->where('id', '!=', $thread->id)
            ->withCount('replies')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        return view('user.discussion.show', compact('session', 'thread', 'otherThreads'));
    }

    // ── Kirim reply (juga broadcast) ───────────────────────────
    public function storeReply(ClassSession $session, DiscussionThread $thread, Request $request)
    {
        abort_if($thread->session_id !== $session->id, 404);

        $request->validate([
            'body'           => 'required|string',
            'quote_reply_id' => 'nullable|exists:discussion_replies,id',
        ]);

        $reply = DiscussionReply::create([
            'thread_id'      => $thread->id,
            'user_id'        => Auth::id(),
            'body'           => $request->body,
            'quote_reply_id' => $request->quote_reply_id,
        ]);

        // Broadcast ke semua user yang ada di thread
        broadcast(new ReplyPosted($reply))->toOthers();

        // Kembalikan JSON untuk request AJAX, redirect untuk non-AJAX
        if ($request->expectsJson()) {
            $reply->load('user', 'quotedReply.user');
            return response()->json([
                'success' => true,
                'reply'   => [
                    'id'         => $reply->id,
                    'body'       => $reply->body,
                    'is_answer'  => $reply->is_answer,
                    'likes'      => $reply->likes,
                    'created_at' => $reply->created_at->format('H:i'),
                    'user' => [
                        'id'       => $reply->user->id,
                        'name'     => $reply->user->first_name . ' ' . $reply->user->last_name,
                        'initials' => strtoupper(substr($reply->user->first_name, 0, 1) . substr($reply->user->last_name ?? '', 0, 1)),
                        'role'     => $reply->user->role,
                    ],
                    'quoted_reply' => $reply->quotedReply ? [
                        'body'   => \Str::limit($reply->quotedReply->body, 80),
                        'author' => $reply->quotedReply->user->first_name,
                    ] : null,
                ],
            ]);
        }

        return back()->with('success', 'Balasan terkirim.');
    }
}
