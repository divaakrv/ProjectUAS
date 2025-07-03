<?php
// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi cek login
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Fungsi ambil data user yang sedang login
function getCurrentUser()
{
    return [
        'id'    => $_SESSION['user_id'] ?? null,
        'name'  => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}

// Middleware untuk proteksi halaman
function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit;
    }
}
