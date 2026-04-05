<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard-user');
Route::get('/scanqr', [UserController::class, 'showScanQR'])->name('attendance.scan');
