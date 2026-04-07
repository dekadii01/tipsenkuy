<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\QrsSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScanQrController extends Controller
{
    //  Tampilkan halaman scan QR.
    //  Jika ada ?token= di URL (dari QR), langsung proses.
    public function show(Request $request)
    {
        // QR di-scan langsung via kamera → URL mengandung ?token=
        if ($request->has('token')) {
            $result = $this->processToken($request->token, $request->user());
            return view('user.scan', $result);
        }

        // Halaman scan kosong (belum scan)
        return view('user.scan', ['state' => 'idle']);
    }


    //  Proses token yang dikirim via AJAX dari frontend.
    public function process(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $result = $this->processToken($request->token, $request->user());

        return response()->json($result);
    }


    private function processToken(string $token, $user): array
    {
        // 1. Cari QR
        $qr = QrsSession::where('token', $token)
            ->with('session')
            ->first();

        // 2. QR tidak ditemukan
        if (!$qr) {
            return [
                'state'   => 'error',
                'message' => 'QR tidak dikenali.',
            ];
        }

        // 3. QR tidak aktif
        if (!$qr->is_active) {
            return [
                'state'   => 'error',
                'message' => 'QR sudah tidak aktif.',
            ];
        }

        // 4. QR kedaluwarsa
        if ($qr->expired_at->isPast()) {
            return [
                'state'   => 'error',
                'message' => 'QR sudah kedaluwarsa.',
            ];
        }

        // 5. Sesi sudah berakhir
        $session = $qr->session;
        if ($session->status === 'ended') {
            return [
                'state'   => 'error',
                'message' => 'Sesi sudah berakhir.',
            ];
        }

        // 6. Cek double absen
        $alreadyPresent = Attendance::where('user_id', $user->id)
            ->where('session_id', $session->id)
            ->exists();

        if ($alreadyPresent) {
            return [
                'state'   => 'error',
                'message' => 'Kamu sudah tercatat hadir di sesi ini.',
            ];
        }

        // 7. Catat absensi
        $now = Carbon::now('Asia/Makassar');

        Attendance::create([
            'user_id'       => $user->id,
            'session_id'    => $session->id,
            'session_qr_id' => $qr->id,
            'status'        => 'present',
            'scanned_at'    => $now,
        ]);

        return [
            'state'      => 'success',
            'nama_sesi'  => $session->nama_sesi,
            'scanned_at' => $now->format('H:i') . ' · ' . $now->translatedFormat('l, j F Y'),
            'user_name'  => $user->first_name . ' ' . $user->last_name,
        ];
    }
}
