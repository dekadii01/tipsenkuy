<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user/index');
    }

    public function showScanQR()
    {
        return view('user/scanqr');
    }
}
