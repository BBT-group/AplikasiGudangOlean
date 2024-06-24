<!DOCTYPE html>
<html>

<head>
    <title>Form Barang</title>
</head>

<body>
    <h2>Form Input Barang</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="<?php echo base_url('barang/simpan'); ?>" method="post" enctype="multipart/form-data">
        <label for="id_barang">ID Barang:</label>
        <input type="text" id="id_barang" name="id_barang"><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama"><br>

        <label for="satuan">Satuan:</label>
        <input type="text" id="satuan" name="satuan"><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto"><br>

        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk"><br>

        <label for="stok">Stok:</label>
        <input type="text" id="stok" name="stok"><br>

        <label for="harga_beli">Harga Beli:</label>
        <input type="text" id="harga_beli" name="harga_beli"><br>

        <label for="id_kategori">ID Kategori:</label>
        <input type="text" id="id_kategori" name="id_kategori"><br>

        <input type="submit" value="Simpan">
    </form>
    <?php dd($semua) ?>
</body>

</html>