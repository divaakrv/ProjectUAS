<div class="card shadow">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0">Edit Produk</h4>
    </div>
    <div class="card-body">
        <form action="index.php?page=update_produk" method="post">
            <input type="hidden" name="id" value="<?= $produk['id'] ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= $produk['name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori (ID)</label>
                <input type="number" class="form-control" name="kategori" id="kategori" value="<?= $produk['kategori'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="brand" class="form-label">Brand (ID)</label>
                <input type="number" class="form-control" name="brand" id="brand" value="<?= $produk['brand'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="text" class="form-control" name="stock" id="stock" value="<?= $produk['stock'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" id="description" rows="3"><?= $produk['description'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?= $produk['harga'] ?>" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Update Produk</button>
            </div>
        </form>
    </div>
</div>