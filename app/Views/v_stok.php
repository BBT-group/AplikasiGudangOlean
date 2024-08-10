                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Stok Barang</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="flex-box pb-1">
                                    <div class="col-12 mb-1 p-0">
                                        <a href="<?= base_url('stok/indextambah') ?>" method="post" class="btn btn-primary">Tambah Barang</a>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Barang</th>
                                            <th>Nama</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($barang  as $k => $item) : ?>
                                            <tr>
                                                <td><?= $k + 1 ?></td>
                                                <td><?= $item['id_barang'] ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td><?= $item['stok'] ?></td>
                                                <td><?= $item['nama_satuan'] ?></td>
                                                <td style="display: flexbox; text-align: center;">
                                                    <a href="<?= base_url('stok/indexdetail/' . $item['id_barang']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-clone"></i></a>
                                                    <a href="<?= base_url('stok/indexupdate/' . $item['id_barang']) ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Update"><i class="fas fa-pencil-alt"></i></a>
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
                            <span>Copyright &copy; Team IT PT. Olean</span>
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
                <!-- Bootstrap core JavaScript-->
                <script src="/jquery/jquery.js"></script>
                <script src="/bootstrap/js/bootstrap.bundle.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="/jquery-easing/jquery.easing.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="/js/sb-admin-2.js"></script>

                <!-- Page level plugins -->
                <script src="/datatables/jquery.dataTables.js"></script>
                <script src="/datatables/dataTables.bootstrap4.js"></script>

                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    <?php if (session()->getFlashdata('success')) { ?>
                        Swal.fire({
                            icon: "success",
                            title: "<?= session()->getFlashdata('success') ?>",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    <?php } ?>
                    <?php if (session()->getFlashdata('update')) { ?>
                        Swal.fire({
                            icon: "success",
                            title: "<?= session()->getFlashdata('update') ?>",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    <?php } ?>
                    <?php if (session()->getFlashdata('error')) { ?>
                        Swal.fire({
                            icon: "error",
                            title: "<?= session()->getFlashdata('error') ?>",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    <?php } ?>
                </script>
                <script>
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>


                </body>

                </html>