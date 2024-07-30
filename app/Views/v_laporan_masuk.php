<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <!-- Tambahkan link ke CSS Bootstrap untuk styling -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="container mt-5">
        <section class="dash-content">
            <h1>Ini Tampilan Laporan Barang Masuk</h1>
            <form action="<?= base_url('/laporan_masuk') ?>" method="get" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="text" id="start_date" name="start_date" class="form-control" autocomplete="off" value="<?= isset($start_date) ? $start_date : '' ?>">
                </div>
                <div class="form-group mr-2">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="text" id="end_date" name="end_date" class="form-control" autocomplete="off" value="<?= isset($end_date) ? $end_date : '' ?>">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                <a href="<?= base_url('/laporan_masuk') ?>" class="btn btn-warning mr-2">Reset</a>
                <a href="<?= base_url('/laporan_masuk/exportm?start_date=' . (isset($start_date) ? $start_date : '') . '&end_date=' . (isset($end_date) ? $end_date : '')) ?>" class="btn btn-secondary">Export to Excel</a>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga Masuk</th>
                        <th>Stok Awal</th>
                        <th>Stok Masuk</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($barangmasuk as $item) : ?>
                        <?php $stok_awal = $item['stok'] - $item['jumlah']; ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['id_barang'] ?></td>
                            <td><?= $item['waktu'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['nama_satuan'] ?></td>
                            <td><?= $item['harga_beli'] ?></td>
                            <td><?= $stok_awal ?></td> <!-- Mengisi stok awal -->
                            <td><?= $item['jumlah'] ?></td>
                            <td><?= $item['stok'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
    <!-- Tambahkan link ke jQuery dan JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>
