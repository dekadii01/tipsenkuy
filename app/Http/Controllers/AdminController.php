<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        $allStudent = User::where('role', 'user')->count();
        return view('admin/index', ['allStudent' => $allStudent]);
    }

    public function showAttendanceDetail($id)
    {

        // Status badge — swap the @php variable with actual session status:
        // $sessionStatus = 'pending' | 'active' | 'ended'

        $session = ClassSession::findOrFail($id);
        return view('admin.attendance.detail', compact('session'));
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

        // Validasi input
        $validated = $request->validate([
            'nama_sesi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Simulasi penyimpanan data ke database (ganti dengan model sebenarnya)
        ClassSession::create($validated);

        // Redirect ke halaman daftar sesi dengan pesan sukses
        return redirect()->route('admin.attendance.index')->with('success', 'Sesi berhasil dibuat!');
    }
}
