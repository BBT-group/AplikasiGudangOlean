<form id="addItemForm" action=<?= base_url('barang/savedata') ?> method="post" enctype="multipart/form-data">
    <div class="form-group mt-3">
        <label for="id_barang">ID Barang</label>
        <input type="text" class="form-control" id="id_barang" name="id_barang" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="satuan">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" required>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto">
    </div>
    <div class="form-group">
        <label for="merk">Merk</label>
        <input type="text" class="form-control" id="merk" name="merk" required>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" hidden value=0>
    </div>
    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
    </div>
    <div class="form-group">
        <label for="id_kategori">ID Kategori</label>
        <input type="text" class="form-control" id="id_kategori" name="id_kategori" required list="item-list">
        <datalist id="item-list">
            <?php foreach ($kategori as $item) : ?>
                <option value="<?= $item['nama_kategori'] ?>"></option>
            <?php endforeach; ?>
        </datalist>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>

</html>