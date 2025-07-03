# Aplikasi Dashboard Penjualan

## Deskripsi

Aplikasi ini merupakan dashboard untuk memantau dan mengelola penjualan.  Aplikasi ini menyediakan antarmuka yang sederhana dan mudah digunakan untuk menampilkan data penjualan, menambahkan produk baru, dan melihat riwayat transaksi.

## Alur Aplikasi

Berikut alur aplikasi secara umum:

**1. Login:**

* User memasukkan email dan password yang valid.
* Sistem memverifikasi kredensial.
* Jika berhasil, user diarahkan ke *dashboard*.  Jika gagal, pesan error ditampilkan.

**2. Dashboard Utama:**

* Menampilkan ringkasan data penjualan, termasuk total produk, total pelanggan, dan total transaksi.
* Menampilkan grafik transaksi dan pendapatan per bulan.
* Menampilkan grafik 5 produk terlaris.

**3. Modul Produk:**

* **Lihat Produk:** Menampilkan daftar produk yang ada, termasuk detail seperti nama, kategori, merek, harga, stok, dan opsi untuk mengedit atau menghapus produk.
* **Tambah Produk:**  Memungkinkan user untuk menambahkan produk baru dengan mengisi formulir yang disediakan.

**4. Modul Transaksi:**

* **Lihat Transaksi:** Menampilkan daftar transaksi yang telah dilakukan, termasuk ID transaksi, tanggal, pelanggan, total harga, dan opsi untuk melihat detail transaksi.
* **Tambah Transaksi:** Memungkinkan user untuk menambahkan transaksi baru. (Mungkin perlu input detail transaksi seperti produk yang terjual, jumlah, dan pelanggan).

**5. Logout:**

* User dapat keluar dari aplikasi dengan menekan tombol "Logout".


## Diagram Alur (Simplified)

```mermaid
graph TD
    A[Login] --> B{Verifikasi};
    B -- Sukses --> C[Dashboard Utama];
    B -- Gagal --> D[Pesan Error];
    C --> E[Modul Produk];
    C --> F[Modul Transaksi];
    E --> G[Lihat Produk];
    E --> H[Tambah Produk];
    F --> I[Lihat Transaksi];
    F --> J[Tambah Transaksi];
    C --> K[Logout];