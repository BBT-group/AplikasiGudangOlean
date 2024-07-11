<div class="dash-content">

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="<?= base_url('barang_masuk/index') ?>" class="btn btn-primary">masukan barang</a>
            </div>
            <div class="col-md-6">
                <form action="<?= base_url('/barang_masuk/cari') ?>" method="get" class="form-inline float-right">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Search" value="<?= isset($search) ? $search : '' ?>">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Masuk</th>
                    <th>Tanggal waktu</th>
                    <th>supplier</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php


                if (!empty($masuk)) : ?>

                    <?php

                    $no = 0;
                    foreach ($masuk as $item) : ?>
                        <tr>
                            <td><?= $no += 1 ?></td>
                            <td><?= $item['id_ms_barang_masuk'] ?></td>
                            <td><?= $item['waktu'] ?></td>
                            <td><?= $item['nama'] ?></td>

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