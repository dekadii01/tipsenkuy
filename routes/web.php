<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScanQrController;
use App\Http\Controllers\SessionQrController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth', 'user'])->group(function () {
    // User Routes
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard-user');
    Route::get('/scanqr', [UserController::class, 'showScanQR'])->name('attendance.scan')->middleware('auth');
    Route::get('/scan', [ScanQrController::class, 'show'])->name('scan.show');
    Route::post('/scan', [ScanQrController::class, 'process'])->name('scan.process');
    Route::get('/history', [UserController::class, 'history'])->name('attendance.user.history')->middleware('auth');
    Route::get('/sessions', [UserController::class, 'mySessions'])->name('my-sessions')->middleware('auth');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
});



Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Routes
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin');
    Route::get('/admin/attendance', [AdminController::class, 'attendanceIndex'])->name('admin.attendance.index')->middleware('auth');
    Route::get('/admin/attendance/{id}', [AdminController::class, 'showAttendanceDetail'])->name('admin.attendance.detail')->middleware('auth');
    Route::get('/admin/create-attendance', [AdminController::class, 'showCreateAttendance'])->name('admin.attendance.create')->middleware('auth');
    Route::post('/admin/create-attendance', [AdminController::class, 'createAttendance'])->name('admin.attendance.store')->middleware('auth');
    Route::post('/admin/sessions/{session}/generate-qr', [SessionQrController::class, 'generate'])->name('admin.sessions.generate-qr')->middleware('auth');
    Route::patch('/admin/sessions/{session}/end', [AdminController::class, 'endSession'])->name('admin.sessions.end')->middleware('auth');
    Route::patch('/admin/sessions/{session}/start', [AdminController::class, 'startSession'])->name('admin.sessions.start')->middleware('auth');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('auth');
});
