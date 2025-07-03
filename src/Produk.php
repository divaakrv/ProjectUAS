<?php

function getAllProduk()
{
    global $conn;
    $sql = "SELECT produk.*, brand.name AS brand_name, kategori.name AS kategori_name 
            FROM produk 
            LEFT JOIN brand ON produk.brand = brand.id 
            JOIN kategori ON produk.kategori = kategori.id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getProdukById($id)
{
    global $conn;
    $sql = "SELECT * FROM produk WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function tambahProduk($name, $brand, $kategori, $stock, $description, $harga)
{
    global $conn;
    $sql = "INSERT INTO produk (name, brand, kategori, stock, description, harga)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "siissi", $name, $brand, $kategori, $stock, $description, $harga);
    mysqli_stmt_execute($stmt);
}

function deleteProduk($id)
{
    global $conn;
    $sql = "DELETE FROM produk WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

function editProduk($id, $name, $brand, $kategori, $stock, $description, $harga)
{
    global $conn;
    $sql = "UPDATE produk SET name=?, brand=?, kategori=?, stock=?, description=?, harga=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "siissii", $name, $brand, $kategori, $stock, $description, $harga, $id);
    mysqli_stmt_execute($stmt);
}
