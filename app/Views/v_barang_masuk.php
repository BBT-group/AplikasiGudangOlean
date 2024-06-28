            <div class="dash-content">

                <div class="container mt-5">
                    <h2>Inventory Management</h2>
                    <form id="addItemForm" action=<?= base_url('barang/savedata') ?> method="post" enctype="multipart/form-data">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input1">tanggal dan waktu</label>
                                        <input type="text" class="form-control" id="datetime" name="datetime" value="<?php
                                                                                                                        $currentDateTime = date("l, F j, Y H:i:s");
                                                                                                                        echo $currentDateTime;
                                                                                                                        ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input2">supplier</label>
                                        <input type="text" class="form-control" id="supplier" name="supplier">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>ID Barang</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Merk</th>
                                <th>jumlah</th>
                                <th>Harga Beli</th>
                                <th>ID Kategori</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTable">
                            <?php if (isset($error)) {
                                echo d($error);
                            }; ?>
                            <?php
                            foreach ($barang ?? [] as $s) : ?>
                                <tr>
                                    <td><?= $s['id_barang'] ?></td>
                                    <td><?= $s['nama'] ?></td>
                                    <td><?= $s['satuan'] ?></td>
                                    <td><?= $s['merk'] ?></td>
                                    <td><?= $s['stok'] ?></td>
                                    <td><?= $s['harga_beli'] ?></td>
                                    <td><?= $s['id_kategori'] ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>
            </div>

            </section>
            <script src="/js/scripts.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            </body>

            </html>