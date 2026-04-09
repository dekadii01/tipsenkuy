<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use App\Models\QrsSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function dashboard()
    {
        $allStudent = User::where('role', 'user')->count();
        $sessions = ClassSession::all();
        $active = true;
        $present = 0;
        $recentScans = Attendance::with('user', 'session')
            ->latest()
            ->take(5)
            ->get();

        return view('admin/index', ['allStudent' => $allStudent, 'sessions' => $sessions, 'active' => $active, 'present' => $present, 'recentScans' => $recentScans]);
    }

    public function endSession(ClassSession $session)
    {
        if ($session->status === 'ended') {
            return back()->withErrors(['message' => 'Sesi sudah berakhir.']);
        }

        // Nonaktifkan semua QR aktif
        QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $session->update(['status' => 'ended']);

        return back()->with('success', 'Sesi berhasil diakhiri.');
    }

    public function startSession(ClassSession $session)
    {
        if ($session->status === 'active') {
            return back()->withErrors(['message' => 'Sesi sudah aktif.']);
        }

        $session->update(['status' => 'active']);

        // update qr session yang sudah tidak aktif menjadi aktif
        QrsSession::where('session_id', $session->id)
            ->where('is_active', false)
            ->update(['is_active' => true]);

        $session->update(['started_at' => now()]);

        return back()->with('success', 'Sesi berhasil dimulai.');
    }

    public function showAttendanceDetail($id)
    {
        $session = ClassSession::findOrFail($id);
        // dd($session->status, Carbon::now(), Carbon::parse("{$session->tanggal->format('Y-m-d')} {$session->jam_mulai}"));
        $activeQr = QrsSession::where('session_id', $session->id)
            ->where('is_active', true)
            ->where('expired_at', '>', now())
            ->latest()
            ->first();

        $qrSvg = null;

        if ($activeQr) {
            $qrUrl = url('/scan?token=' . $activeQr->token);
            $qrSvg = QrCode::size(220)->generate($qrUrl);
        }

        $allStudent = User::where('role', 'user')->count();
        $attendances = $session->attendances()->with('user')->latest()->get();
        $presentCount = $attendances->count();

        return view('admin.attendance.detail', compact(
            'session',
            'allStudent',
            'presentCount',
            'attendances',
            'qrSvg',
            'activeQr'
        ));
    }

    public function attendanceIndex()
    {
        $sessions = ClassSession::all();

        return view('admin.attendance.index', compact('sessions'));
    }

    public function showCreateAttendance()
    {
        return view('admin.attendance.create');
    }

    public function createAttendance(Request $request)
    {
        $validated = $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        ClassSession::create($validated);

        return redirect()->route('admin.attendance.index')->with('success', 'Sesi berhasil dibuat!');
    }
}
