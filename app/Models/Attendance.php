<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'session_qr_id',
        'status',
        'scanned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    public function qr()
    {
        return $this->belongsTo(QrsSession::class, 'session_qr_id');
    }
}
