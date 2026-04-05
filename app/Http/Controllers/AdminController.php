<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        $sessionStatus = 'active'; // Contoh status sesi, bisa diambil dari database
        return view('admin.attendance.detail', ['attendanceId' => $id, 'sessionStatus' => $sessionStatus]);
    }

    public function attendanceIndex()
    {
        return view('admin.attendance.index');
    }

    public function showCreateAttendance()
    {
        return view('admin.attendance.create');
    }
}
