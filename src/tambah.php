<?php
require_once __DIR__ . '/../../config/koneksi.php';

// Ambil data pelanggan dan produk
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<h2>Tambah Transaksi</h2>

<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Transaksi Penjualan</h5>
        </div>
        <div class="card-body">

            <form action="index.php?page=simpan_transaksi" method="post">

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pelanggan</label>
                    <select name="pelanggan_id" class="form-select" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while ($row = mysqli_fetch_assoc($pelanggan)) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Produk & Kuantitas</label>
                    <div id="produk-wrapper">
                        <div class="row g-2 produk-row mb-2">
                            <div class="col-md-6">
                                <select name="produk_id[]" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php
                                    mysqli_data_seek($produk, 0);
                                    while ($row = mysqli_fetch_assoc($produk)) : ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="qty[]" class="form-control" placeholder="Qty" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger w-100" onclick="hapusRow(this)">Hapus</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="tambahRow()">+ Tambah Produk</button>
                </div>

                <button type="submit" class="btn btn-success">Simpan Transaksi</button>
            </form>

        </div>
    </div>
</div>

