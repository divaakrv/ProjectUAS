<!-- views/transaksi/detail.php -->
<h2>Detail Transaksi</h2>

<?php if (!empty($transaksi)) : ?>
    <p><strong>ID Transaksi:</strong> <?= $transaksi['id'] ?></p>
    <p><strong>Tanggal:</strong> <?= $transaksi['tanggal'] ?></p>
    <p><strong>Pelanggan:</strong> <?= $transaksi['pelanggan'] ?></p>
    <p><strong>Total:</strong> Rp <?= number_format($transaksi['total'], 0, ',', '.') ?></p>

    <h3>Item Transaksi</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?= $item['nama_produk'] ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>Transaksi tidak ditemukan.</p>
<?php endif; ?>

<br>
<a href="index.php?page=transaksi">← Kembali ke daftar transaksi</a>
