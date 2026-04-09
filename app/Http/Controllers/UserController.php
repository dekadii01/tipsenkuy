<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        return view('index');
    }

    public function showLogin()
    {
        return view('auth/login');
    }

    public function showRegister()
    {
        return view('auth/register');
    }

    public function dashboard()
    {
        $attendances = Attendance::where('user_id', Auth::id())
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
        $sessionTotal = $attendances->count();
        $presentCount = $attendances->where('status', 'present')->count();
        $attendedSessions = $attendances->pluck('session_id')->flip();
        $attendanceRate = $sessionTotal > 0
            ? round(($presentCount / $sessionTotal) * 100)
            : 0;
        $history = Attendance::where('user_id', Auth::id())
            ->with('session')
            ->latest('scanned_at')
            ->get();

        return view('user/index', compact('sessionTotal', 'attendedSessions', 'history', 'presentCount', 'attendanceRate'));
    }

    public function showScanQR()
    {
        return view('user/scanqr');
    }

    public function history()
    {
        $history = ClassSession::all();

        return view('user/history', compact('history'));
    }

    public function mySessions()
    {
        $activeSessions = ClassSession::where('status', 'active')->get();
        $pendingSessions = ClassSession::where('status', 'pending')->get();
        $completedSessions = ClassSession::where('status', 'ended')->get();
        $attended = Attendance::where('user_id', Auth::id())
            ->pluck('session_id')
            ->flip();

        // dd($attended);

        return view('user/mysessions', compact('activeSessions', 'pendingSessions', 'completedSessions', 'attended'));
    }
}
