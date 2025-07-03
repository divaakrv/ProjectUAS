<?php
require_once __DIR__ . '/../config/koneksi.php';

// Statistik jumlah total
$produkCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$pelangganCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan"))['total'];
$transaksiCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total'];

// Data grafik produk per kategori
$query = "
    SELECT k.name AS kategori, COUNT(p.id) AS jumlah 
    FROM kategori k 
    LEFT JOIN produk p ON p.kategori = k.id 
    GROUP BY k.id
";
$result = mysqli_query($conn, $query);

$kategoriLabels = [];
$kategoriJumlah = [];

while ($row = mysqli_fetch_assoc($result)) {
    $kategoriLabels[] = $row['kategori'];
    $kategoriJumlah[] = $row['jumlah'];
}

// Grafik transaksi per bulan (jumlah transaksi)
$transaksiPerBulan = [];
for ($bulan = 1; $bulan <= 12; $bulan++) {
    $sql = "SELECT COUNT(*) AS total FROM transaksi 
            WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = YEAR(CURDATE())";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $transaksiPerBulan[] = (int) $data['total'];
}

// Grafik pendapatan per bulan
$pendapatanPerBulan = [];
for ($bulan = 1; $bulan <= 12; $bulan++) {
    $sql = "SELECT SUM(total) AS pendapatan FROM transaksi 
            WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = YEAR(CURDATE())";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    $pendapatanPerBulan[] = (int) ($data['pendapatan'] ?? 0);
}

// Produk paling laku (Top 5 berdasarkan qty di detail_transaksi)
$query = "
    SELECT p.name AS produk, SUM(d.qty) AS total_terjual
    FROM detail_transaksi d
    JOIN produk p ON d.produk_id = p.id
    GROUP BY d.produk_id
    ORDER BY total_terjual DESC
    LIMIT 5
";
$result = mysqli_query($conn, $query);
$produkLabels = [];
$produkQty = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produkLabels[] = $row['produk'];
    $produkQty[] = (int) $row['total_terjual'];
}

$namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
?>

<div class="container py-4">
    <!-- Statistik Cepat -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-4"><?= $produkCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pelanggan</h5>
                    <p class="card-text fs-4"><?= $pelangganCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <p class="card-text fs-4"><?= $transaksiCount ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Transaksi dan Pendapatan per Bulan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Transaksi per Bulan (<?= date('Y'); ?>)</h5>
                    <canvas id="transaksiChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan per Bulan (<?= date('Y'); ?>)</h5>
                    <canvas id="pendapatanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Top Produk Paling Laku -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Top 5 Produk Paling Laku</h5>
            <canvas id="produkLakuChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart: Produk per Kategori
    new Chart(document.getElementById('produkChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode($kategoriLabels); ?>,
            datasets: [{
                label: 'Jumlah Produk',
                data: <?= json_encode($kategoriJumlah); ?>,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#6B7280', '#10B981', '#EF4444', '#3B82F6'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'right' } }
        }
    });

    // Line Chart: Jumlah Transaksi per Bulan
    new Chart(document.getElementById('transaksiChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($namaBulan); ?>,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: <?= json_encode($transaksiPerBulan); ?>,
                borderColor: '#3B82F6',
                backgroundColor: '#BFDBFE',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, precision: 0 }
            }
        }
    });

    // Bar Chart: Pendapatan per Bulan
    new Chart(document.getElementById('pendapatanChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($namaBulan); ?>,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: <?= json_encode($pendapatanPerBulan); ?>,
                backgroundColor: '#10B981',
                borderColor: '#059669',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Bar Chart: Top 5 Produk Paling Laku
    new Chart(document.getElementById('produkLakuChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($produkLabels); ?>,
            datasets: [{
                label: 'Jumlah Terjual',
                data: <?= json_encode($produkQty); ?>,
                backgroundColor: '#F59E0B',
                borderColor: '#D97706',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
</script>
