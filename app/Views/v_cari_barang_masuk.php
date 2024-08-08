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
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                                    <td><?= $item['id_kategori'] ?></td>


                                                    <td>
                                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_barang'] ?>" hidden>
                                                            <input type="text" name="nama" id="nama" value="<?= $item['nama'] ?>" hidden>
                                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                                            <input type="text" name="jenis" id="jenis" value="barang" hidden>
                                                            <input type="text" name="satuan" id="satuan" value="<?= $item['nama_satuan'] ?>" hidden>
                                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                                            <button type="submit" class="btn btn-primary" style="display: flexbox; text-align: center;">Submit</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php
                                        if (!empty($inventaris)) : ?>
                                            <?php foreach ($inventaris as $item) : ?>
                                                <tr>

                                                    <td><?= $item['id_inventaris'] ?></td>
                                                    <td><?= $item['nama_inventaris'] ?></td>
                                                    <?php if ($item['foto'] != null) : ?>
                                                        <td><img src="<?= base_url($item['foto']) ?>" alt="<?= $item['nama_inventaris'] ?>" width="50"></td>
                                                    <?php else :  ?>
                                                        <td></td>
                                                    <?php endif; ?>

                                                    <td><?= $item['stok'] ?></td>
                                                    <td><?= $item['harga_beli'] ?></td>
                                                    <td>alat</td>

                                                    <td>
                                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_inventaris'] ?>" hidden>
                                                            <input type="text" name="nama" id="nama" value="<?= $item['nama_inventaris'] ?>" hidden>
                                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                                            <input type="text" name="jenis" id="jenis" value="alat" hidden>
                                                            <input type="text" name="satuan" id="satuan" value="alat" hidden>
                                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                                            <button type="submit" class="btn btn-primary" style="display: flexbox; text-align: center;">Submit</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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

</body>

</html>