                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Satuan Barang</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="flex-box pb-1">
                                    <div class="col-12 mb-1 p-0">
                                        <a href="<?= base_url('satuan/indextambah/') ?>" method="post" class="btn btn-primary">Tambah Satuan</a>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-0">No</th>
                                            <th class="col-10">Satuan</th>
                                            <th class="col-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($satuan as $k => $sat) : ?>
                                            <tr>
                                                <td><?= 1 + $k ?></td>
                                                <td><?= $sat['nama_satuan'] ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?= base_url('satuan/deletesatuan/' . $sat['id_satuan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus?')"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
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
                    <a class="btn btn-primary" href="<?php echo base_url('logout') ?>">Logout</a>
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
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(session()->getFlashdata('success')) {?>
        Swal.fire({
            icon: "success",
            title: "<?= session()->getFlashdata('success')?>",
            showConfirmButton: false,
            timer: 1500
        })
        <?php } ?>
        <?php if(session()->getFlashdata('warning')) {?>
        Swal.fire({
            icon: "warning",
            title: "<?= session()->getFlashdata('warning')?>",
            showConfirmButton: false,
            timer: 1500
        })
        <?php } ?>
    </script>

</body>
</html>