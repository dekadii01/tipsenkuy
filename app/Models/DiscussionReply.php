<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionReply extends Model
{
    protected $fillable = [
        'thread_id',
        'user_id',
        'quote_reply_id',
        'body',
        'is_answer',
        'is_reported',
        'likes',
    ];

    protected $casts = [
        'is_answer'   => 'boolean',
        'is_reported' => 'boolean',
    ];

    public function thread()
    {
        return $this->belongsTo(DiscussionThread::class, 'thread_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotedReply()
    {
        return $this->belongsTo(DiscussionReply::class, 'quote_reply_id');
    }
}
