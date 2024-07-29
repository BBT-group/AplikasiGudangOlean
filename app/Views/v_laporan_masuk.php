                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Laporan Barang Masuk</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                        <?php foreach ($barangmasuk as $item) : ?>
                                            <?php $stok_awal = $item['stok'] - $item['jumlah']; ?>
                                            <tr>
                                                <td><?= $item['id_barang'] ?></td>
                                                <td><?= $item['waktu'] ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td><?= $item['satuan'] ?></td>
                                                <td><?= $item['harga_beli'] ?></td>
                                                <td><?= $stok_awal ?></td> <!-- Mengisi stok awal -->
                                                <td><?= $item['jumlah'] ?></td>
                                                <td><?= $item['stok'] ?></td>
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
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
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

</body>

</html>