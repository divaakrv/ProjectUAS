<?php
function getAllTransaksi()
{
    global $conn;
    $sql = "SELECT transaksi.*, pelanggan.name AS pelanggan_name 
            FROM transaksi 
            JOIN pelanggan ON transaksi.pelanggan = pelanggan.id 
            ORDER BY transaksi.tanggal DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getTransaksiById($id)
{
    global $conn;
    $sql = "SELECT transaksi.*, pelanggan.name AS pelanggan_name, diskon.diskon 
            FROM transaksi 
            JOIN pelanggan ON transaksi.pelanggan = pelanggan.id 
            JOIN diskon ON transaksi.diskon_id = diskon.id 
            WHERE transaksi.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getDetailTransaksi($transaksi_id)
{
    global $conn;
    $sql = "SELECT detail_transaksi.*, produk.name AS produk_name, produk.harga 
            FROM detail_transaksi 
            JOIN produk ON detail_transaksi.produk_id = produk.id 
            WHERE detail_transaksi.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $transaksi_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function tambahTransaksi($tanggal, $created_by, $pelanggan, $diskon_id, $total)
{
    global $conn;
    $sql = "INSERT INTO transaksi (tanggal, created_by, pelanggan, diskon_id, total) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "siiii", $tanggal, $created_by, $pelanggan, $diskon_id, $total);
    mysqli_stmt_execute($stmt);
    return mysqli_insert_id($conn);
}

function tambahDetailTransaksi($transaksi_id, $produk_id, $qty)
{
    global $conn;
    $sql = "INSERT INTO detail_transaksi (id, produk_id, qty) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $transaksi_id, $produk_id, $qty);
    mysqli_stmt_execute($stmt);
}
