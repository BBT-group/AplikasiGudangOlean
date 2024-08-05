        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Inventory Management</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="addItemForm" action=<?= base_url('/barang_keluar/update') ?> method="post" enctype="multipart/form-data">
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
                                            <label for="input2">penerima</label>
                                            <input type="text" class="form-control" id="penerima" name="penerima" value="<?= old('penerima') ?>">
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
                            <a href="<?= base_url('barang_keluar/cari') ?>" class="btn btn-primary">Cari Barang</a>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTable">
                                <?php foreach ($barang ?? [] as $index => $s) : ?>
                                    <tr>
                                        <td><?= $s['id_barang'] ?></td>
                                        <td><?= $s['nama'] ?></td>
                                        <td><?= $s['satuan'] ?></td>
                                        <td><input type="number" class="update-field" data-index="<?= $index ?>" data-column="stok" value="<?= esc($s['stok']) ?>"></td>
                                        <td> <button class="remove-item btn btn-danger" data-index="<?= $index ?>" data-key="<?= $s['id_barang'] ?>">Remove Item</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
        <script src="/jquery/jquery.js"></script>
        <script src="/bootstrap/js/bootstrap.bundle.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/jquery-easing/jquery.easing.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/js/sb-admin-2.js"></script>

        <!-- Page level plugins -->
        <script src="/datatables/jquery.dataTables.js"></script>
        <script src="/datatables/dataTables.bootstrap4.js"></script>

        <!--     
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

        <!-- Page level custom scripts -->
        <script src="/js/demo/datatables-demo.js"></script>
        <script>
            window.onload = function() {
                <?php if (session()->has('error')) : ?>
                    alert("<?= addslashes(session('error')) ?>");
                <?php elseif (session()->has('message')) : ?>
                    alert("<?= addslashes(session('message')) ?>");
                <?php endif; ?>
            };
        </script>
        <script>
            $(document).ready(function() {
                $('#clear-session-btn').click(function() {
                    $.ajax({
                        url: '<?= base_url('barang_keluar/clearsession') ?>', // Adjust the URL as needed
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
                        url: '<?= base_url('barang_keluar/update2') ?>',
                        method: 'POST',
                        data: {
                            index: index,
                            column: column,
                            value: value
                        },
                        success: function(response) {

                            if (response.status === 'success') {
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

            });

            function handleBarcodeScan(id) {
                $.ajax({
                    url: '<?= base_url('barang_keluar/carii') ?>',
                    method: 'POST',
                    data: {
                        idBarang: id,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            console.log('Barcode scanned successfully');
                            location.reload(); // Reload the page to see updated data
                        } else if (response.status === 'not_found') {
                            if (alert(response.message + "\n\nhubungi admin barang belum terdaftar")) {

                            }
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