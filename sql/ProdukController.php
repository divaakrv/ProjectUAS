<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../models/Produk.php';

function tampilkanProduk()
{
    $data = getAllProduk();
    include __DIR__ . '/../views/produk/index.php';
}

function simpanProduk($post)
{
    $nama = $post['name'];
    $brand = $post['brand'];
    $kategori = $post['kategori'];
    $stock = $post['stock'];
    $deskripsi = $post['description'];
    $harga = $post['harga'];

    tambahProduk($nama, $brand, $kategori, $stock, $deskripsi, $harga);
    header("Location: ../public/index.php?page=produk");
}

function hapusProduk($id)
{
    deleteProduk($id);
    header("Location: ../public/index.php?page=produk");
}

function tampilkanFormEdit($id)
{
    $produk = getProdukById($id);
    include __DIR__ . '/../views/produk/edit.php';
}

function updateProduk($post)
{
    $id = $post['id'];
    $nama = $post['name'];
    $brand = $post['brand'];
    $kategori = $post['kategori'];
    $stock = $post['stock'];
    $deskripsi = $post['description'];
    $harga = $post['harga'];

    editProduk($id, $nama, $brand, $kategori, $stock, $deskripsi, $harga);
    header("Location: ../public/index.php?page=produk");
}
