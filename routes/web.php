<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

// Protected Routes
// User Routes
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard-user')->middleware('auth');
Route::get('/scanqr', [UserController::class, 'showScanQR'])->name('attendance.scan')->middleware('auth');

// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/admin/attendance/{id}', [AdminController::class, 'showAttendanceDetail'])->name('admin.attendance.detail')->middleware('auth');
