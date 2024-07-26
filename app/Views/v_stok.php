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
                    <th>Foto</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php


                if (!empty($barang)) : ?>
                    <?php foreach ($barang as $item) : ?>
                        <tr>
                            <td><?= $item['id_barang'] ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td><img src="<?= base_url($item['foto']) ?>" alt="<?= $item['nama'] ?>" width="50"></td>
                            <td><?= $item['stok'] ?></td>
                            <td><?= $item['harga_beli'] ?></td>
                            <td><?= $item['nama_kategori'] ?>
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

</div>
</section>
<script src="/js/scripts.js"></script>
</div>
</section>
<script src="/js/scripts.js"></script>
</body>

</html>