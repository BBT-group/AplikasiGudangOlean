<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <!-- Tambahkan link ke CSS Bootstrap untuk styling -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="container mt-5">
        <section class="dash-content">
        <a href="<?= base_url('/laporan_masuk/exportm') ?>" class="btn btn-primary">Export</a>
            <!-- <form action="<?= base_url('/laporan_masuk/exportm') ?>" method="get">
                <label for="start_date">Start Date:</label>
                <input type="text" id="start_date" name="start_date">
                <label for="end_date">End Date:</label>
                <input type="text" id="end_date" name="end_date">
                
                <button type="submit" class="btn btn-primary">Export to Excel</button>
            </form> -->
        </section>
        <table class="table table-bordered">
            <thead>
                <tr>
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
                <?php if (!empty($barangmasuk)) : ?>
                    <?php foreach ($barangmasuk as $item) : ?>
                        <tr>
                            <td><?= $item['id_barang'] ?></td>
                            <td><?= $item['waktu'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['satuan'] ?></td>
                            <td><?= $item['harga_beli'] ?></td>
                            <td><?= $item['stok'] ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td><?= $item['stok'] ?></td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
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
