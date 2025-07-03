<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../models/Transaksi.php';
require_once __DIR__ . '/../models/Produk.php';
require_once __DIR__ . '/../models/Pelanggan.php';
require_once __DIR__ . '/../models/Diskon.php';

function tampilkanTransaksi()
{
    $data = getAllTransaksi();
    include __DIR__ . '/../views/transaksi/index.php';
}

function tampilkanDetailTransaksi($id)
{
    $transaksi = getTransaksiById($id);
    $detail = getDetailTransaksi($id);
    include __DIR__ . '/../views/transaksi/detail.php';
}

function simpanTransaksi($post)
{
    global $conn;

    $tanggal     = date('Y-m-d');
    $created_by  = $_SESSION['user_id'];
    $pelanggan   = $post['pelanggan'];
    $diskon_id   = $post['diskon_id'];
    $produk_id   = $post['produk_id'];
    $qty         = $post['qty'];

    $produk = getProdukById($produk_id);
    $harga_total = $produk['harga'] * $qty;

    // Ambil diskon
    $diskon = getDiskonById($diskon_id);
    $potongan = 0;
    if ($harga_total >= $diskon['min_pembelian']) {
        $potongan = min($harga_total * ($diskon['diskon'] / 100), $diskon['max_diskon']);
    }

    $total_bayar = $harga_total - $potongan;

    // Simpan transaksi
    $transaksi_id = tambahTransaksi($tanggal, $created_by, $pelanggan, $diskon_id, $total_bayar);

    // Simpan detail transaksi
    tambahDetailTransaksi($transaksi_id, $produk_id, $qty);

    header("Location: ../public/index.php?page=transaksi");
    exit;
}
