<div class="dash-content">

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="<?= base_url('barangtambah/index') ?>" class="btn btn-primary">Tambah Barang</a>
            </div>
            <div class="col-md-6">
                <form action="" method="get" class="form-inline float-right">
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
                <?php


                if (!empty($barang)) : ?>
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
                            <td>
                                <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                    <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_barang'] ?>" hidden>
                                    <input type="text" name="nama" id="nama" value="<?= $item['nama'] ?>" hidden>
                                    <input type="text" name="satuan" id="satuan" value="<?= $item['satuan'] ?>" hidden>
                                    <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                    <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                    <button type="submit">submit</button>
                                </form>
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
        <!-- <div class="baru">
            <?php #echo $pager->links(); 
            ?>
        </div> -->

    </div>

</div>
</section>
<script src="/js/scripts.js"></script>
</body>

</html>