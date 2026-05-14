<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadPinToggled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int  $threadId,
        public int  $sessionId,
        public bool $isPinned,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('session.' . $this->sessionId),
            new PresenceChannel('thread.'  . $this->threadId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'thread.pin.toggled';
    }

    public function broadcastWith(): array
    {
        return [
            'thread_id' => $this->threadId,
            'is_pinned' => $this->isPinned,
        ];
    }
}
