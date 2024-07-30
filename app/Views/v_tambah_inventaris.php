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
                                    <form id="addItemForm" action="<?= base_url('inventaris/simpanalat') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="id_inventaris">ID Alat</label>
                                                    <input type="text" class="form-control" id="id_inventaris" name="id_inventaris" autofocus value="<?php if (old('id_inventaris') != null) {
                                                                                                                                                    echo old('id_inventaris');
                                                                                                                                                } elseif (session()->get('id_inventaris_temp')) {
                                                                                                                                                    echo session()->get('id_inventaris_temp');
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

</body>

</html>