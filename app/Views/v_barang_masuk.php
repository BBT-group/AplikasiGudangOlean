                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Inventory Management</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form id="addItemForm" action=<?= base_url('/barang_masuk/update') ?> method="post" enctype="multipart/form-data">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input1">tanggal dan waktu</label>
                                                    <input type="text" class="form-control" id="datetime" name="datetime" value="<?php
                                                                                                                                    date_default_timezone_set('Asia/Jakarta');
                                                                                                                                    $currentDateTime = date("l, F j, Y H:i:s");
                                                                                                                                    echo $currentDateTime;
                                                                                                                                    ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input2">supplier</label>
                                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?= old('nama_supplier'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1 p-0" style="text-align: right;">
                                        <button id="clear-session-btn" class="btn btn-secondary">Clear Session</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <div class="col-12 mb-3 p-0">
                                    <a href="<?= base_url('barang_masuk/cari') ?>" class="btn btn-primary">Tambah Barang</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID Barang</th>
                                                <th>Nama</th>
                                                <th>Satuan</th>
                                                <th>jumlah</th>
                                                <th>Harga Beli</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="inventoryTable">

                                            <?php
                                            foreach ($barang ?? [] as $index => $s) : ?>
                                                <tr>
                                                    <td><?= $s['id_barang'] ?></td>
                                                    <td><?= $s['nama'] ?></td>
                                                    <td><?= $s['satuan'] ?></td>
                                                    <td><input type="number" class="update-field" data-index="<?= $index ?>" data-column="stok" value="<?= esc($s['stok']) ?>"></td>
                                                    <td><input type="number" class="update-field" data-index="<?= $index ?>" data-column="harga_beli" value="<?= esc($s['harga_beli']) ?>"></td>
                                                    <td> <button class="remove-item btn btn-danger" data-index="<?= $index ?>" data-key="<?= $s['id_barang'] ?>">Remove Item</button></td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
                                <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dialog-confirm" title="Barang / Alat Belum ditambahkan" style="display:none;">
                    <p>Tambahkan Barang atau Alat Baru</p>
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

                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#clear-session-btn').click(function() {
                            $.ajax({
                                url: '<?= base_url('barang_masuk/clearsession') ?>', // Adjust the URL as needed
                                method: 'POST',
                                success: function(response) {
                                    // $('.print').text('Response from server: ' + response);
                                    // console.log(response);

                                    alert('Session cleared successfully');
                                },
                                error: function(xhr, status, error) {
                                    alert('Error clearing session: ' + error);
                                }
                            });
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('.update-field').on('input', function() {
                            var index = $(this).data('index');
                            var column = $(this).data('column');
                            var value = $(this).val();

                            $.ajax({
                                url: '<?= base_url('barang_masuk/update2') ?>',
                                method: 'POST',
                                data: {
                                    index: index,
                                    column: column,
                                    value: value
                                },
                                success: function(response) {

                                    if (response.status == 'success') {
                                        console.log('Data updated successfully');
                                    } else {
                                        console.log('Data updated not');
                                    }
                                }
                            });
                        });
                        let first = true;
                        // Function to capture barcode scan
                        let barcode = ''; // Initialize an empty string to store the scanned barcode
                        let timeoutId = null; // Initialize a variable to store the timeout ID
                        let lastKeyTime = Date.now();
                        $(document).keypress(function(e) {
                            let char = String.fromCharCode(e.which); // Convert the keypress event to the corresponding character
                            let currentTime = Date.now();
                            // Clear any existing timeout
                            if (timeoutId) {
                                clearTimeout(timeoutId);
                            }


                            barcode += char;
                            if (currentTime - lastKeyTime < 10) {

                                timeoutId = setTimeout(function() {

                                    let id = barcode; // Assign the barcode string to the ID variable
                                    console.log(barcode);

                                    handleBarcodeScan(id);
                                    // Call a function to handle the barcode scan}


                                    barcode = ''; // Reset the barcode string after handling the scan
                                    timeoutId = null; // Reset the timeout ID
                                }, 200); // Reset the barcode string if more than 100ms passed since the last keypress
                            } else {
                                barcode = '';
                            }
                            if (first) {
                                barcode += char;
                                first = false;
                            }
                            lastKeyTime = currentTime;


                            // Append character to barcode string
                            // Append the current character to the barcode string

                            // Set a timeout to handle the complete barcode after 200ms of no input

                        });

                        $('.remove-item').on('click', function() {
                            var key = $(this).data('key');
                            var index = $(this).data('index');
                            console.log(key);
                            $.ajax({
                                url: '<?= base_url('/barang_masuk/hapusitem') ?>',
                                type: 'POST',
                                data: {
                                    key: key,
                                    index: index
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $('button[data-index="' + index + '"]').closest('tr').remove();
                                    }
                                }
                            });
                        });

                    });

                    function handleBarcodeScan(id) {
                        $.ajax({
                            url: '<?= base_url('barang_masuk/carii') ?>',
                            method: 'POST',
                            data: {
                                idBarang: id,
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    console.log('Barcode scanned successfully');
                                    location.reload(); // Reload the page to see updated data
                                } else if (response.status === 'not_found') {
                                    $("#dialog-confirm").dialog({
                                        resizable: false,
                                        height: "auto",
                                        width: 400,
                                        modal: true,
                                        buttons: {
                                            "Tambah Barang": function() {
                                                window.location.href = '<?= base_url('/barang_masuk/indextambahbarang') ?>';                                                 
                                                $(this).dialog("close");
                                            },
                                            "Tambah Alat": function() {
                                                window.location.href = '<?= base_url('/barang_masuk/indextambahalat') ?>';                                                 
                                                $(this).dialog("close");
                                            }
                                        }
                                    });
                                }
                            },
                            error: function(jqXHR, text, eror) {
                                console.log(eror.text);
                            }
                        });

                    }
                </script>



                </body>

                </html>