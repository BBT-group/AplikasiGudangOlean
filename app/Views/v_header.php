<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logo.png">

    <title><?php echo session()->get('role') ?> | Gudang PT.Olean</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        .collapse-item.active {
            color: #206c1f !important;
            background-color: #fff !important; /* Hijau */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?= uri_string() == 'beranda' ? 'active' : '' ?>" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('beranda') ?>">
                <div class="sidebar-brand-icon">
                    <img src="/img/logo.png" style="height: 50px;">
                </div>
                <div class="sidebar-brand-text mx-3">PT. OLEAN</div>
            </a>
            <hr class="sidebar-divider my-0">
            <?php if (session()->role == 'admin') : ?>
                <li class="nav-item <?= uri_string() == 'beranda' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('beranda') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Master</div>
                <li class="nav-item <?= in_array(uri_string(), ['stok', 'kategori', 'satuan']) ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-layer-group"></i>
                        <span>Stok Barang</span>
                    </a>
                    <div id="collapseTwo" class="collapse <?= in_array(uri_string(), ['stok', 'kategori', 'satuan']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= uri_string() == 'stok' ? 'active' : '' ?>" href="<?php echo base_url('stok') ?>">Data Barang</a>
                            <a class="collapse-item <?= uri_string() == 'kategori' ? 'active' : '' ?>" href="<?php echo base_url('kategori') ?>">Kategori</a>
                            <a class="collapse-item <?= uri_string() == 'satuan' ? 'active' : '' ?>" href="<?php echo base_url('satuan') ?>">Satuan</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= uri_string() == 'inventaris' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('inventaris') ?>">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Inventaris Alat</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Transaksi</div>
                <li class="nav-item <?= uri_string() == 'barang_masuk' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_masuk') ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Laporan</div>
                <li class="nav-item <?= uri_string() == 'laporan_stok' ? 'active' : '' ?>">
                    <a class="nav-link" href="laporan_stok">
                        <i class="fas fa-fw fa-file-signature"></i>
                        <span>Laporan Stok</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'laporan_masuk' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('laporan_masuk') ?>">
                        <i class="fas fa-fw fa-file-import"></i>
                        <span>Laporan Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'laporan_keluar' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('laporan_keluar') ?>">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Laporan Barang Keluar</span>
                    </a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
            <?php endif; ?>
            <?php if (session()->role == 'operator') : ?>
                <li class="nav-item <?= uri_string() == 'beranda' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('beranda') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Master</div>
                <li class="nav-item <?= uri_string() == 'stok/index2' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('stok/index2') ?>">
                        <i class="fas fa-fw fa-layer-group"></i>
                        <span>Data Barang</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'inventaris/index2' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('inventaris/index2') ?>">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Inventaris Alat</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Transaksi</div>
                <li class="nav-item <?= uri_string() == 'barang_keluar' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_keluar') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'barang_pinjam' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_pinjam') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Barang Pinjam</span>
                    </a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
            <?php endif; ?>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="color: #206c1f;">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form> -->
                    <div class="text-center d-none d-md-inline" style="color: #fff;">
                        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #fff;">
                            <i class="fa fa-bars" style="color: #206c1f;"></i>
                        </button>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a> -->
                        <!-- Dropdown - Messages -->
                        <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-gray-600 small">Hallo, <?php echo session()->get('nama') ?></span>
                                <img class="img-profile rounded-circle" src="/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Keluar?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk keluar dari website gudang olean.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="<?php echo base_url('logout') ?>">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>
                <!-- End of Topbar -->