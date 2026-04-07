<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['session_id', 'token', 'expired_at', 'is_active'])]
class QrsSession extends Model
{
    protected $table = 'session_qrs';
    protected $casts = [
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }
}
