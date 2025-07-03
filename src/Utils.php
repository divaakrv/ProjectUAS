<?php
// Format angka ke format Rupiah
function format_rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Format tanggal ke format Indonesia
function format_tanggal($tanggal)
{
    return date('d-m-Y', strtotime($tanggal));
}

// Fungsi redirect
function redirect($url)
{
    header("Location: $url");
    exit;
}
