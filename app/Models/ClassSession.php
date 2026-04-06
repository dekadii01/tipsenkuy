<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ClassSession extends Model
{
    protected $fillable = [
        'nama_sesi',
        'deskripsi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function getStatusAttribute()
    {
        $now = now();

        $start = Carbon::parse($this->tanggal . ' ' . $this->jam_mulai);
        $end = Carbon::parse($this->tanggal . ' ' . $this->jam_selesai);

        if ($now->lt($start)) return 'pending';
        if ($now->between($start, $end)) return 'active';
        return 'ended';
    }

    public function qrs()
    {
        return $this->hasMany(QrsSession::class, 'session_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }
}
