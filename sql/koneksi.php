<?php
// config/koneksi.php

$host = "localhost";      // host database (default XAMPP)
$user = "root";           // user default XAMPP
$pass = "";               // password default (kosong)
$db   = "uas_diva";  // ganti dengan nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
