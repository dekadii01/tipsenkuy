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
Route::get('/history', [UserController::class, 'history'])->name('attendance.user.history')->middleware('auth');

// Admin Routes
Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin')->middleware('auth');

// Admin Attendance Routes
Route::get('/admin/attendance', [AdminController::class, 'attendanceIndex'])->name('admin.attendance.index')->middleware('auth');
Route::get('/admin/attendance/{id}', [AdminController::class, 'showAttendanceDetail'])->name('admin.attendance.detail')->middleware('auth');
Route::get('/admin/create-attendance', [AdminController::class, 'showCreateAttendance'])->name('admin.attendance.create')->middleware('auth');
Route::post('/admin/create-attendance', [AdminController::class, 'createAttendance'])->name('admin.attendance.store')->middleware('auth');
