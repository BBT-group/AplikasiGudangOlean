<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="/css/styles.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="/img/logo.png" alt="">
            </div>
            <span class="logo_name">PT. Olean</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="<?php echo base_url('beranda') ?>">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
            <?php if(session()->role == 'admin') : ?>
                <div class="coba">
                    <span class="line"></span>
                  <span class="title">Master</span>
                </div>
                <li><a href="<?php echo base_url('stok') ?>">
                        <i class="uil uil-file-copy-alt"></i>
                        <span class="link-name">Stok Barang</span>
                    </a></li>
                <div class="coba">
                    <span class="line"></span>
                    <span class="title">Transaksi</span>
                </div>
                <li><a href="<?php echo base_url('barang_masuk') ?>">
                        <i class="uil uil-download-alt"></i>
                        <span class="link-name">Barang Masuk</span>
                    </a></li>
                <div class="coba">
                    <span class="line"></span>
                    <span class="title">Laporan</span>
                </div>
                <li><a href="<?php echo base_url('laporan_stok') ?>">
                        <i class="uil uil-download-alt"></i>
                        <span class="link-name">Laporan Stok</span>
                    </a></li>
                <li><a href="<?php echo base_url('laporan_masuk') ?>">
                        <i class="uil uil-envelope-download"></i>
                        <span class="link-name">Laporan Masuk</span>
                    </a></li>
                <li><a href="<?php echo base_url('laporan_keluar') ?>">
                        <i class="uil uil-envelope-upload"></i>
                        <span class="link-name">Laporan Keluar</span>
                    </a></li>
            </ul>
            <?php endif; ?>

            <?php if(session()->role == 'operator') : ?>
                <div class="coba">
                    <span class="line"></span>
                    <span class="title">Transaksi</span>
                </div>
                <li><a href="<?php echo base_url('barang_keluar') ?>">
                        <i class="uil uil-upload-alt"></i>
                        <span class="link-name">Barang Keluar</span>
                    </a></li>
                <div class="coba">
                    <span class="line"></span>
                    <span class="title">Laporan</span>
                </div>
                <li><a href="<?php echo base_url('laporan_keluar') ?>">
                        <i class="uil uil-envelope-upload"></i>
                        <span class="link-name">Laporan Keluar</span>
                    </a></li>
            </ul>
            <?php endif; ?>
                

            <ul class="logout-mode">
                <li><a href="<?php echo site_url('logout') ?>">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
            </div>
            <!-- <img src="f.png" alt=""> -->
        </div>