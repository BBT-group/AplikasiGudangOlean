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
                <a href="<?= base_url('/laporan_stok/exports' . ($search ? '?search=' . urlencode($search) : '')) ?>" class="btn btn-primary">Export</a>
                <a href="<?= base_url('/laporan_stok') ?>" class="btn btn-secondary ml-2">Reset</a>
            </div>

            <div class="col-md-6">
                <form action="<?= base_url('laporan_stok') ?>" method="get" class="form-inline float-right">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Search" value="<?= isset($search) ? $search : '' ?>">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barang)) : ?>
                    <?php $no = 1; foreach ($barang as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['id_barang'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['nama_kategori'] ?></td>
                            <td><?= $item['stok'] ?></td>
                            <td><?= $item['nama_satuan'] ?></td>
                            <td><?= $item['harga_beli'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data barang</td>
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
