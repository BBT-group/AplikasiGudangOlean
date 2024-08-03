                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Default Card Example
                                </div>

                                <div class="card-body">
                                    <form id="addItemForm" action="<?= base_url('stok/tambahbarang') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="id_barang">ID Barang</label>
                                                    <input type="text" class="form-control" id="id_barang" name="id_barang" autofocus value="<?php if (old('id_barang') != null) {
                                                                                                                                                    echo old('id_barang');
                                                                                                                                                } elseif (session()->get('id_barang_temp')) {
                                                                                                                                                    echo session()->get('id_barang_temp');
                                                                                                                                                } else {
                                                                                                                                                    '';
                                                                                                                                                } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" required maxlength="45" value="<?= old('nama') ?? '' ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_satuan">Satuan</label>
                                                    <select class="form-control" id="id_satuan" name="id_satuan" style="display: block;" required list="item-list" maxlength="15" value="<?= old('id_satuan') ?? '' ?>">
                                                        <option value="">Pilih Satuan</option>
                                                        <?php foreach ($satuan as $sat) : ?>
                                                            <option value="<?= $sat['nama_satuan']; ?>"><?= $sat['nama_satuan']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kategori">Kategori</label>
                                                    <select class="form-control" id="id_kategori" name="id_kategori" required list="item-list" maxlength="15" value="<?= old('id_kategori') ?? '' ?>">
                                                    <option value="">Pilih Kategori</option>
                                                    <?php foreach ($kategori as $kat) : ?>
                                                            <option value="<?= $kat['nama_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#id_satuan').select2({
                placeholder: "Pilih Satuan",
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('#id_kategori').select2({
                placeholder: "Pilih Kategori",
                allowClear: true
            });
        });
    </script>

</body>

</html>