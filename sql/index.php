<!-- views/transaksi/index.php -->
<h2>Daftar Transaksi</h2>

<a href="index.php?page=tambah_transaksi" class="btn btn-primary">Tambah Transaksi</a>
<br><br>

<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Transaksi</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dataTransaksi)) : ?>
                            <?php foreach ($dataTransaksi as $transaksi) : ?>
                                <tr>
                                    <td><?= $transaksi['id'] ?></td>
                                    <td><?= $transaksi['tanggal'] ?></td>
                                    <td><?= $transaksi['pelanggan'] ?></td>
                                    <td><span class="badge bg-success">Rp <?= number_format($transaksi['total'], 0, ',', '.') ?></span></td>
                                    <td>
                                        <a href="index.php?page=detail_transaksi&id=<?= $transaksi['id'] ?>" class="btn btn-sm btn-info text-white">Detail</a>
                                        <a href="index.php?page=hapus_transaksi&id=<?= $transaksi['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Tidak ada transaksi.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
