<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
        return view('user/index');
    }

    public function showScanQR()
    {
        return view('user/scanqr');
    }
}
