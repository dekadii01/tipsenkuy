<?php

namespace App\Events;

use App\Models\DiscussionReply;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyAnswerToggled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int  $replyId,
        public int  $threadId,
        public int  $sessionId,
        public bool $isAnswer,
        public bool $isAnswered  // status is_answered di thread
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
        return 'reply.answer.toggled';
    }

    public function broadcastWith(): array
    {
        return [
            'reply_id'   => $this->replyId,
            'thread_id'  => $this->threadId,
            'is_answer'  => $this->isAnswer,
            'is_answered' => $this->isAnswered,
        ];
    }
}
