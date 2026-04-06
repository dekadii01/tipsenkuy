<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrsSession extends Model
{
    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }
}
