<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionThread extends Model
{
    protected $fillable = [
        'session_id',
        'user_id',
        'title',
        'body',
        'is_pinned',
        'is_answered',
        'is_announcement',
    ];

    protected $casts = [
        'is_pinned'       => 'boolean',
        'is_answered'     => 'boolean',
        'is_announcement' => 'boolean',
    ];

    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(DiscussionReply::class, 'thread_id')->orderBy('created_at');
    }
}
