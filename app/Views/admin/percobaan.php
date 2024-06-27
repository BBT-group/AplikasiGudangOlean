<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Inventory Management</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
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

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="true">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- Search Tab -->
                        <div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
                            <form id="modalForm">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search...">
                                    <button type="button" name="submit" class="btn btn-primary" id="submitForm">search</button>
                                </div>
                            </form>
                            <div id="searchResults">

                            </div>
                        </div>
                        <!-- Add Tab -->
                        <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                            <form id="addItemForm" action=<?= base_url('barang/savedata') ?> method="post" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="id_barang">ID Barang</label>
                                    <input type="text" class="form-control" id="id_barang" name="id_barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="merk" name="merk" required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok" hidden value=0>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">ID Kategori</label>
                                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" required list="item-list">
                                    <datalist id="item-list">
                                        <?php foreach ($kategori as $item) : ?>
                                            <option value="<?= $item['nama_kategori'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href=<?= base_url('barang/savedata') ?>>simpan</a>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>