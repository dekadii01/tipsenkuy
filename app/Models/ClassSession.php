<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_sesi', 'deskripsi', 'tanggal', 'jam_mulai', 'jam_selesai', 'status'])]
class ClassSession extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Dipanggil setiap kali model di-retrieve dari DB.
     * Auto-sync status jika waktunya sudah lewat.
     */
    protected static function booted(): void
    {
        static::retrieved(function (ClassSession $session) {
            $session->syncStatus();
        });
    }

    /**
     * Hitung status seharusnya berdasarkan waktu sekarang.
     */
    public function syncStatus(): void
    {
        if ($this->status === 'ended') return;

        $tz = 'Asia/Makassar';

        $tanggal = $this->tanggal instanceof \Carbon\Carbon
            ? $this->tanggal->format('Y-m-d')
            : $this->tanggal;

        $now   = Carbon::now($tz);
        $start = Carbon::parse("{$tanggal} {$this->jam_mulai}", $tz);
        $end   = Carbon::parse("{$tanggal} {$this->jam_selesai}", $tz);

        $newStatus = null;

        if ($now->greaterThan($end)) {
            $newStatus = 'ended';
        } elseif ($now->greaterThanOrEqualTo($start) && $this->status === 'pending') {
            $newStatus = 'active';
        }

        if ($newStatus && $newStatus !== $this->status) {
            static::withoutEvents(function () use ($newStatus) {
                $this->update(['status' => $newStatus]);
            });
            $this->status = $newStatus;
        }
    }

    public function resolvedStatus(): string
    {
        $tanggal = $this->tanggal instanceof \Carbon\Carbon
            ? $this->tanggal->format('Y-m-d')
            : $this->tanggal;

        $now   = Carbon::now();
        $start = Carbon::parse("{$tanggal} {$this->jam_mulai}");
        $end   = Carbon::parse("{$tanggal} {$this->jam_selesai}");

        if ($now->greaterThan($end)) return 'ended';
        if ($now->greaterThanOrEqualTo($start)) {
            return $this->status === 'pending' ? 'pending' : $this->status;
        }

        return 'pending';
    }

    // Relasi
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }

    public function qrs()
    {
        return $this->hasMany(QrsSession::class, 'session_id');
    }
}
