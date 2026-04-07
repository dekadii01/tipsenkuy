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
        // 🔒 1. Validasi durasi dari form
        $request->validate([
            'durasi_qr' => 'required|in:5,10,15,30'
        ]);

        // ❌ 2. Cegah generate jika session sudah ended
        if ($session->status === 'ended') {
            return back()->withErrors([
                'message' => 'Session sudah berakhir'
            ]);
        }

        // 🔥 3. Nonaktifkan semua QR lama
        QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->update([
                'is_active' => false,
                'updated_at' => now()
            ]);

        // 🔐 4. Generate token unik
        $token = (string) Str::uuid();

        // ⏳ 5. Hitung expired berdasarkan input user
        $duration = (int) $request->durasi_qr;
        $expiredAt = Carbon::now()->addMinutes($duration);

        // 💾 6. Simpan QR baru
        $qr = QrsSession::create([
            'session_id' => $session->id,
            'token' => $token,
            'expired_at' => $expiredAt,
            'is_active' => true,
        ]);

        // 🚀 7. Aktifkan session (jika belum)
        if ($session->status !== 'active') {
            $session->update([
                'status' => 'active'
            ]);
        }

        // 🎯 8. Response (bisa JSON atau redirect)
        return back()->with([
            'success' => 'QR berhasil dibuat',
            'qr_token' => $qr->token,
            'expired_at' => $qr->expired_at
        ]);
    }
}
