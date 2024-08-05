                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Barang Masuk</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="get" action="<?= base_url('barang_masuk/beranda') ?>">
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
                                <a href="<?= base_url('barang_masuk/beranda') ?>" class="btn btn-secondary">Reset</a>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="col-12 mb-1 p-0">
                                <a href="<?= base_url('barang_masuk/index') ?>" class="btn btn-primary">masukan barang</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Masuk</th>
                                        <th>Tanggal waktu</th>
                                        <th>supplier</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


                                    if (!empty($masuk)) : ?>

                                        <?php

                                        $no = 0;
                                        foreach ($masuk as $item) : ?>
                                            <tr>
                                                <td><?= $no += 1 ?></td>
                                                <td><?= $item['id_ms_barang_masuk'] ?></td>
                                                <td><?= $item['waktu'] ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td> <a href="<?= base_url('barang_masuk/indexdetailmaster/' . $item['id_ms_barang_masuk']) ?>" class="btn btn-sm btn-primary">Detail</a></td>
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
                    <a class="btn btn-primary" href="<?php echo base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
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

                        if (response.status === 'success') {
                            console.log('Data updated successfully');
                        } else {
                            console.log('Data updated not');
                        }
                    }
                });
            });

            // Function to capture barcode scan
            let barcode = ''; // Initialize an empty string to store the scanned barcode
            let lastKeyTime = Date.now(); // Get the current timestamp in milliseconds when the last key was pressed

            $(document).keypress(function(e) {
                let char = String.fromCharCode(e.which); // Convert the keypress event to the corresponding character
                let currentTime = Date.now(); // Get the current timestamp in milliseconds

                // Reset barcode string if more than 100ms passed between keystrokes
                if (currentTime - lastKeyTime > 100) {
                    barcode = ''; // Reset the barcode string if more than 100ms passed since the last keypress
                }

                // Append character to barcode string
                barcode += char; // Append the current character to the barcode string
                lastKeyTime = currentTime; // Update the timestamp of the last keypress

                // Assuming barcode length of 12 characters (adjust as needed)
                if (barcode.length >= 13) {
                    // Handle the complete barcode
                    let id = barcode; // Assign the barcode string to the ID variable
                    console.log(barcode);
                    handleBarcodeScan(id); // Call a function to handle the barcode scan

                    barcode = ''; // Reset the barcode string after handling the scan
                }
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
                        if (confirm(response.message + "\n\nDo you want to add this item? Click 'OK' to add or 'Cancel' to close.")) {
                            window.location.href = '<?= base_url('/barangtambah/index') ?>'; // Redirect to the input form
                        }
                    }
                },
                error: function(jqXHR, text, eror) {
                    console.log(eror.text);
                }
            });

        }
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