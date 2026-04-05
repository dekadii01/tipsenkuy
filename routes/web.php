<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard-user');
Route::get('/scanqr', [UserController::class, 'showScanQR'])->name('attendance.scan');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/attendance/{id}', [AdminController::class, 'showAttendanceDetail'])->name('admin.attendance.detail');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::post('/logout', [UserController::class, 'logout'])
    ->name('logout');
Route::post('/login', [UserController::class, 'login'])
    ->name('login');
