<div class="dash-content">

    <div class="container mt-5">
        <h2>barang keluar Management</h2>
        <a href="<?= base_url('barang_keluar/cari') ?>" class="btn btn-primary">cari Barang</a>
        <form id="addItemForm" action=<?= base_url('/barang_keluar/update') ?> method="post" enctype="multipart/form-data">
            <div class="container mt-5">
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

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <button id="clear-session-btn">Clear Session</button>
        <table class="table table-bordered mt-3">

            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <!-- <th>Merk</th> -->
                    <th>jumlah</th>

                    <!-- <th>ID Kategori</th> -->
                </tr>
            </thead>
            <tbody id="inventoryTable">
                <?php if (isset($error)) {
                    echo d($error);
                }; ?>
                <?php
                foreach ($barang ?? [] as $index => $s) : ?>
                    <tr>
                        <td><?= $s['id_barang'] ?></td>
                        <td><?= $s['nama'] ?></td>
                        <td><?= $s['satuan'] ?></td>
                        <td><input type="number" class="update-field" data-index="<?= $index ?>" data-column="stok" value="<?= esc($s['stok']) ?>"></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>


    </div>
</div>
<div class="print"></div>
</section>
<script src="/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</body>

</html>