<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/index');
    }

    public function showAttendanceDetail($id)
    {
        return view('admin.attendance.detail', ['attendanceId' => $id]);
    }
}
