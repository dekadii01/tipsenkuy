<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDiscussionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ScanQrController;
use App\Http\Controllers\SessionQrController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ── Public ──────────────────────────────────────────────────────
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── User (auth + role user) ──────────────────────────────────────
Route::middleware(['auth', 'user'])->group(function () {

    // Dashboard & misc
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard-user');
    Route::get('/history', [UserController::class, 'history'])->name('attendance.user.history');
    Route::get('/sessions', [UserController::class, 'mySessions'])->name('my-sessions');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::patch('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('user.profile.password');

    // Scan QR
    Route::get('/scanqr', [UserController::class, 'showScanQR'])->name('attendance.scan');
    Route::get('/scan', [ScanQrController::class, 'show'])->name('scan.show');
    Route::post('/scan', [ScanQrController::class, 'process'])->name('scan.process');

    // Session detail
    Route::get('/sessions/{session}', [UserController::class, 'sessionDetail'])->name('session.detail');

    // Diskusi — semua di bawah /sessions/{session}/discussion
    Route::prefix('/sessions/{session}/discussion')->name('session.discussion.')->group(function () {
        Route::get('/',              [DiscussionController::class, 'index'])->name('index');
        Route::post('/',             [DiscussionController::class, 'store'])->name('store');
        Route::get('/{thread}',      [DiscussionController::class, 'show'])->name('show');
        Route::post('/{thread}/reply', [DiscussionController::class, 'storeReply'])->name('reply');
        // Delete thread (user: hanya milik sendiri & belum ada reply)
        Route::delete('/{thread}', [DiscussionController::class, 'destroyThread'])
            ->name('session.discussion.destroy');
        // Delete reply (user: hanya milik sendiri)
        Route::delete('/{thread}/reply/{reply}', [DiscussionController::class, 'destroyReply'])
            ->name('session.discussion.reply.destroy');
    });
});

// ── Admin (auth + role admin) ────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function () {

    // Dashboard & misc
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password');

    // Attendance / Sessions
    Route::get('/attendance', [AdminController::class, 'attendanceIndex'])->name('attendance.index');
    Route::get('/attendance/{id}', [AdminController::class, 'showAttendanceDetail'])->name('attendance.detail');
    Route::get('/create-attendance', [AdminController::class, 'showCreateAttendance'])->name('attendance.create');
    Route::post('/create-attendance', [AdminController::class, 'createAttendance'])->name('attendance.store');

    // Discussion
    Route::prefix('/attendance/{id}/discussions')->name('attendance.discussions.')->group(function () {
        Route::get('/',    [AdminDiscussionController::class, 'index'])->name('index');
        Route::post('/',   [AdminDiscussionController::class, 'store'])->name('store');
        Route::get('/{thread}',             [AdminDiscussionController::class, 'show'])->name('show');

        // ── Thread actions ──
        Route::patch('/{thread}/pin',        [AdminDiscussionController::class, 'pin'])->name('pin');
        Route::patch('/{thread}/answered',   [AdminDiscussionController::class, 'toggleAnswered'])->name('answered');   // ← BARU
        Route::delete('/{thread}',           [AdminDiscussionController::class, 'destroy'])->name('destroy');

        // ── Reply actions ──
        Route::post('/{thread}/replies',                        [AdminDiscussionController::class, 'storeReply'])->name('reply.store');    // ← BARU
        Route::patch('/{thread}/replies/{reply}/answer',        [AdminDiscussionController::class, 'markAnswer'])->name('reply.answer');   // ← BARU
        Route::patch('/{thread}/replies/{reply}/dismiss-report', [AdminDiscussionController::class, 'dismissReport'])->name('reply.dismiss');  // ← BARU
        Route::delete('/{thread}/replies/{reply}',              [AdminDiscussionController::class, 'destroyReply'])->name('reply.destroy');
    });

    // Session controls
    Route::post('/sessions/{session}/generate-qr', [SessionQrController::class, 'generate'])->name('sessions.generate-qr');
    Route::patch('/sessions/{session}/end', [AdminController::class, 'endSession'])->name('sessions.end');
    Route::patch('/sessions/{session}/start', [AdminController::class, 'startSession'])->name('sessions.start');
});
