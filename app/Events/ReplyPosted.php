<?php

namespace App\Events;

use App\Models\DiscussionReply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public DiscussionReply $reply)
    {
        $this->reply->load('user', 'quotedReply.user', 'thread');
    }

    public function broadcastOn(): array
    {
        return [new PresenceChannel('session.' . $this->reply->thread->session_id)];
    }

    public function broadcastAs(): string
    {
        return 'reply.posted';
    }

    public function broadcastWith(): array
    {
        $reply = $this->reply;
        return [
            'reply' => [
                'id'         => $reply->id,
                'thread_id'  => $reply->thread_id,
                'body'       => $reply->body,
                'is_answer'  => $reply->is_answer ?? false,
                'likes'      => $reply->likes ?? 0,
                'created_at' => $reply->created_at->diffForHumans(),
                'user' => [
                    'id'       => $reply->user->id,
                    'name'     => $reply->user->first_name . ' ' . $reply->user->last_name,
                    'initials' => strtoupper(substr($reply->user->first_name, 0, 1) . substr($reply->user->last_name ?? '', 0, 1)),
                    'role'     => $reply->user->role,
                ],
                'quoted_reply' => $reply->quotedReply ? [
                    'id'     => $reply->quotedReply->id,
                    'body'   => \Str::limit($reply->quotedReply->body, 80),
                    'author' => $reply->quotedReply->user->first_name,
                ] : null,
            ],
        ];
    }
}
