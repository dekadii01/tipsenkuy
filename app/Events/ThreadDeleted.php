<?php

namespace App\Events;

use App\Models\DiscussionThread;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $threadId,
        public int $sessionId
    ) {}

    public function broadcastOn(): array
    {
        return [new PresenceChannel('session.' . $this->sessionId)];
    }

    public function broadcastAs(): string
    {
        return 'thread.deleted';
    }

    public function broadcastWith(): array
    {
        return ['thread_id' => $this->threadId];
    }
}
