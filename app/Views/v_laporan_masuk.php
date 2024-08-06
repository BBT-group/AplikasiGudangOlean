                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Laporan Barang Masuk</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
                    <?php d($barangmasuk) ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="get" action="<?= base_url('/laporan_masuk') ?>">
                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= isset($start_date) ? $start_date : '' ?>">
                                    </div>
                                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= isset($end_date) ? $end_date : '' ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <a href="<?= base_url('/laporan_masuk') ?>" class="btn btn-secondary mr-2">Reset</a>
                                        <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                                    </div>
                                    <div class="col-md-6" style="text-align: end;">
                                        <a href="<?= base_url('/laporan_masuk/exportm?start_date=' . (isset($start_date) ? $start_date : '') . '&end_date=' . (isset($end_date) ? $end_date : '')) ?>" class="btn btn-success">Export to Excel</a>
                                        <a href="<?= base_url('/laporan_masuk/printm?start_date=' . (isset($start_date) ? $start_date : '') . '&end_date=' . (isset($end_date) ? $end_date : '')) ?>" class="btn btn-info" target="_blank">Print</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk dari <?= $start_date ?> s/d <?= $end_date ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Barang Masuk</th>
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

                                        <?php $no = 1;
                                        foreach ($barangmasuk as $item) : ?>
                                            <?php $stok_awal = $item['stok'] - $item['jumlah']; ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $item['id_ms_barang_masuk'] ?></td>
                                                <td><?= date('d/m/Y H:i:s', strtotime($item['waktu'])) ?></td>
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

                <script>
                    $(function() {
                        $("#start_date").datepicker({
                            dateFormat: 'dd-mm-yy'
                        });
                        $("#end_date").datepicker({
                            dateFormat: 'dd-mm-yy'
                        });
                    });
                </script>

                </body>

                </html>