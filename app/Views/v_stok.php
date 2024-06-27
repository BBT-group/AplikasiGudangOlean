<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <!-- Tambahkan link ke CSS Bootstrap untuk styling -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary">Tambah Barang</a>
            </div>
            <div class="col-md-6">
                <form action="<?= base_url('barang') ?>" method="get" class="form-inline float-right">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Search" value="<?= isset($search) ? $search : '' ?>">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Foto</th>
                    <th>Merk</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>ID Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barang)) : ?>
                    <?php foreach ($barang as $item) : ?>
                        <tr>

                            <td><?= $item['id_barang'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['satuan'] ?></td>
                            <td><img src="<?= base_url($item['foto']) ?>" alt="<?= $item['nama'] ?>" width="50"></td>
                            <td><?= $item['merk'] ?></td>
                            <td><?= $item['stok'] ?></td>
                            <td><?= $item['harga_beli'] ?></td>
                            <td><?php foreach ($kategori as $k) {
                                    if ($k['id_kategori'] === $item['id_kategori']) {
                                        echo $k['nama_kategori'];
                                    };
                                }; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data barang</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Tambahkan link ke JS Bootstrap dan jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>