<?php

use Illuminate\Support\Facades\Broadcast;

// ✅ Tambahkan ini — untuk halaman index diskusi
Broadcast::channel('session.{sessionId}', function ($user, $sessionId) {
    return $user ? [
        'id'       => $user->id,
        'name'     => $user->first_name . ' ' . $user->last_name,
        'initials' => strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name ?? '', 0, 1)),
        'role'     => $user->role,
    ] : false;
});

// ✅ Tetap pertahankan ini — untuk halaman detail thread
Broadcast::channel('thread.{threadId}', function ($user, $threadId) {
    return $user ? [
        'id'       => $user->id,
        'name'     => $user->first_name . ' ' . $user->last_name,
        'initials' => strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name ?? '', 0, 1)),
        'role'     => $user->role,
    ] : false;
});
