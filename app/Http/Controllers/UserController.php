<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Attendance;
use App\Models\ClassSession;
use App\Models\QrsSession;
use App\Models\User;
use Illuminate\Http\Request;
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
        $sessionTotal = Attendance::where('user_id', Auth::id())->count();
        $attendedSessions = Attendance::where('user_id', Auth::id())->pluck('session_id')->toArray();
        return view('user/index', compact('sessionTotal', 'attendedSessions'));
    }

    public function showScanQR()
    {
        return view('user/scanqr');
    }

    public function history()
    {
        return view('user/history');
    }

    public function mySessions()
    {
        $activeSessions = ClassSession::where('status', 'active')->get();
        $pendingSessions = ClassSession::where('status', 'pending')->get();
        $completedSessions = ClassSession::where('status', 'ended')->get();
        $attended = Attendance::where('user_id', Auth::id())->pluck('session_id')->toArray();

        return view('user/mysessions', compact('activeSessions', 'pendingSessions', 'completedSessions', 'attended'));
    }
}
