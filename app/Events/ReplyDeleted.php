<?php

namespace App\Events;

use App\Models\DiscussionReply;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $replyId,
        public int $threadId,
        public int $sessionId
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('session.' . $this->sessionId),
            new PresenceChannel('thread.' . $this->threadId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'reply.deleted';
    }

    public function broadcastWith(): array
    {
        return [
            'reply_id'  => $this->replyId,
            'thread_id' => $this->threadId,
        ];
    }
}
