<?php

namespace App\Events;

use App\Models\DiscussionThread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public DiscussionThread $thread)
    {
        $this->thread->load('user');
    }

    public function broadcastOn(): array
    {
        return [new PresenceChannel('session.' . $this->thread->session_id)];
    }

    public function broadcastAs(): string
    {
        return 'thread.posted';
    }

    public function broadcastWith(): array
    {
        $thread = $this->thread;
        return [
            'thread' => [
                'id'          => $thread->id,
                'title'       => $thread->title,
                'body'        => \Str::limit($thread->body, 120),
                'is_answered' => $thread->is_answered,
                'is_pinned'   => $thread->is_pinned,
                'replies_count' => 0,
                'created_at'  => $thread->created_at->diffForHumans(),
                'user' => [
                    'id'       => $thread->user->id,
                    'name'     => $thread->user->first_name . ' ' . $thread->user->last_name,
                    'initials' => strtoupper(substr($thread->user->first_name, 0, 1) . substr($thread->user->last_name ?? '', 0, 1)),
                    'role'     => $thread->user->role,
                ],
            ],
        ];
    }
}
