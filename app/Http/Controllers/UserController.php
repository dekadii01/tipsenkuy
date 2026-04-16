<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function profile()
    {
        return view('user/profile');
    }

    // Update profil (nama & email)
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function sessionDetail(ClassSession $session)
    {
        /** @var User $user */
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('session_id', $session->id)
            ->first();

        $totalPeserta = User::where('role', 'user')->count();

        $userAttended = $attendance !== null;

        // Map status DB ke status yang dipakai Blade
        $sessionStatus = match ($session->status) {
            'active' => 'active',
            'ended' => 'ended',
            default => 'upcoming', // pending
        };

        return view('user/sessiondetail', compact(
            'session',
            'attendance',
            'userAttended',
            'sessionStatus',
            'totalPeserta',
        ));
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

    public function history(Request $request)
    {
        // get data kehadiran user yang sudah di-scan, urutkan berdasarkan tanggal scan terbaru
        $history = Attendance::where('user_id', Auth::id())
            ->with('session')
            ->latest('scanned_at')
            ->get();

        // Grouping Berdasarkan Tanggal untuk di UI
        $groupedHistory = $history
            ->groupBy(function ($item) {
                return Carbon::parse($item->session->tanggal)->format('Y-m-d');
            })
            ->sortKeysDesc()->when($request->filter === 'hadir', function ($grouped) {
                return $grouped->map(function ($items) {
                    return $items->where('status', 'present');
                })->filter(fn ($items) => $items->isNotEmpty());
            })->when($request->filter === 'absen', function ($grouped) {
                return $grouped->map(function ($items) {
                    return $items->where('status', 'absent');
                })->filter(fn ($items) => $items->isNotEmpty());
            });

        return view('user/history', compact('history', 'groupedHistory'));
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
