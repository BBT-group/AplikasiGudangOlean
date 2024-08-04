<!-- Content Row -->
<div class="container-fluid">
    <div class="row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="form1-tab" data-toggle="tab" href="#form1" role="tab" aria-controls="form1" aria-selected="true">Form 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="form2-tab" data-toggle="tab" href="#form2" role="tab" aria-controls="form2" aria-selected="false">Form 2</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="form1" role="tabpanel" aria-labelledby="form1-tab">
                <div class="card-body">
                    <form id="addItemForm" action="<?= base_url('inventaris/simpanalat') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_inventaris">ID Alat</label>
                                    <input type="text" class="form-control" id="id_inventaris" name="id_inventaris" autofocus value="<?php if (old('id_inventaris') != null) {
                                                                                                                                            echo old('id_inventaris');
                                                                                                                                        } elseif (session()->get('id_temp') != null) {
                                                                                                                                            echo session()->get('id_temp');
                                                                                                                                        } else {
                                                                                                                                            '';
                                                                                                                                        } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama_inventaris">Nama</label>
                                    <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris" required maxlength="45" value="<?= old('nama_inventaris') ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required maxlength="255">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="form2" role="tabpanel" aria-labelledby="form2-tab">
                <div class="card-body">
                    <form id="addItemForm" action="<?= base_url('stok/tambahbarang') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_barang">ID Barang</label>
                                    <input type="text" class="form-control" id="id_barang" name="id_barang" autofocus value="<?php if (old('id_barang') != null) {
                                                                                                                                    echo old('id_barang');
                                                                                                                                } elseif (session()->get('id_temp')) {
                                                                                                                                    echo session()->get('id_temp');
                                                                                                                                } else {
                                                                                                                                    '';
                                                                                                                                } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required maxlength="45" value="<?= old('nama') ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="id_satuan" name="id_satuan" required maxlength="15" list="satuan-list" value="<?= old('id_satuan') ?? '' ?>">
                                    <datalist id="satuan-list">
                                        <?php foreach ($satuan as $sat) : ?>
                                            <option value="<?= $sat['nama_satuan']; ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">ID Kategori</label>
                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" required list="item-list" maxlength="15" value="<?= old('id_kategori') ?? '' ?>">
                                    <datalist id="item-list">
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['nama_kategori']; ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                </div>



                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required maxlength="255">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        </div>
    </div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/vendor/jquery/jquery.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>

<!-- Core plugin JavaScript-->
<script src="/vendor/jquery-easing/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.js"></script>

<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/chart-area-demo.js"></script>
<script src="/js/demo/chart-pie-demo.js"></script>

</body>

</html>