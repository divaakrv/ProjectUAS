<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../models/User.php';

// Cek apakah session sudah aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function login($email, $password)
{
    global $conn;
    $user = getUserByEmail($email);

    if ($user && $user['password'] === $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: ../public/index.php?page=dashboard");
        exit;
    } else {
        $_SESSION['error'] = "Email atau password salah.";
        header("Location: ../public/login.php");
        exit;
    }
}

function logout()
{
    // Cek session hanya jika belum dimulai
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();
    session_destroy();
    header("Location: ../public/login.php");
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}
