<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\QrsSession;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SessionQrController extends Controller
{
    public function generate(Request $request, ClassSession $session)
    {
        //  Validasi durasi dari form
        $request->validate([
            'durasi_qr' => 'required|in:5,10,15,30'
        ]);

        //  Cegah generate jika session sudah ended
        if ($session->status === 'ended') {
            return back()->withErrors([
                'message' => 'Session sudah berakhir'
            ]);
        }

        //  Nonaktifkan semua QR lama
        QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->update([
                'is_active' => false,
                'updated_at' => now()
            ]);

        //  Generate token unik
        $token = (string) Str::uuid();

        //  Hitung expired berdasarkan input user
        $duration = (int) $request->durasi_qr;
        $expiredAt = Carbon::now()->addMinutes($duration);

        //  Simpan QR baru
        $qr = QrsSession::create([
            'session_id' => $session->id,
            'token' => $token,
            'expired_at' => $expiredAt,
            'is_active' => true,
        ]);

        //  Aktifkan session (jika belum)
        if ($session->status !== 'active') {
            $session->update([
                'status' => 'active'
            ]);
        }

        //  Response (bisa JSON atau redirect)
        return back()->with([
            'success' => 'QR berhasil dibuat',
            'qr_token' => $qr->token,
            'expired_at' => $qr->expired_at
        ]);
    }
}
