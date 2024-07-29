<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/peminjaman', 'Peminjaman::index');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->post('/barang/search', 'Barang::search');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->add('/stok/indexdetail', 'Stok::indexDetail');
$routes->add('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/indextambah', 'Stok::indexTambah');
$routes->add('/barang_tambah/index', 'Barang_Tambah::index');

$routes->post('/barang_masuk/savedata', 'Barang_Masuk::saveData');
$routes->add('/barang_masuk/cari', 'Barang_Masuk::index2');
$routes->add('/barang_masuk/index', 'Barang_Masuk::index');
$routes->add('/barang_masuk/clearsession', 'Barang_Masuk::clearSession');
$routes->add('/barang_masuk/update', 'Barang_Masuk::updateStok');
$routes->add('/barang_masuk/update2', 'Barang_Masuk::update');
$routes->add('/barang_masuk/carii', 'Barang_Masuk::cariStok');
$routes->add('/barang_masuk/hapusitem', 'Barang_Masuk::hapusBarangDatalistMasuk');

$routes->add('/barang_keluar/index', 'Barang_keluar::index');
$routes->post('/barang_keluar/savedata', 'Barang_Keluar::saveData');
$routes->add('/barang_keluar/cari', 'Barang_Keluar::index2');
$routes->add('/barang_keluar/clearsession', 'Barang_Keluar::clearSession');
$routes->add('/barang_keluar/update', 'Barang_Keluar::updateStok');
$routes->add('/barang_keluar/update2', 'Barang_Keluar::update');
$routes->add('/barang_keluar/carii', 'Barang_Keluar::cariStok');
$routes->add('/barang_keluar/hapusitem', 'Barang_Keluar::hapusBarangDatalistMasuk');

$routes->get('/beranda', 'Beranda::index');
$routes->get('/barang_masuk', 'Barang_Masuk::beranda');
$routes->get('/barang_keluar', 'Barang_Keluar::beranda');
$routes->get('/laporan_stok', 'Laporan_Stok::index');
$routes->get('/laporan_stok/exports', 'Laporan_Stok::exports');
$routes->get('/laporan_masuk', 'Laporan_Masuk::index');
$routes->get('/laporan_masuk/exportm', 'Laporan_Masuk::exportm');
$routes->get('/laporan_keluar', 'Laporan_Keluar::index');
$routes->get('/laporan_keluar/exportk', 'Laporan_Keluar::exportk');

$routes->get('/stok', 'Stok::index');
$routes->get('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->get('/stok/updatebarang', 'Stok::updateBarang');
$routes->get('/stok/deletebarang/(:num)', 'Stok::deletebarang/$1');

$routes->get('/satuan/deletesatuan/(:num)', 'Satuan::deletesatuan/$1');
$routes->get('/satuan', 'Satuan::index');
$routes->add('/satuan/indextambah', 'Satuan::indexTambah');
$routes->add('/satuan/tambahsatuan', 'Satuan::tambahSatuan');

$routes->get('/kategori/deletekategori/(:num)', 'Kategori::deleteKategori/$1');
$routes->get('/kategori', 'Kategori::index');
$routes->add('/kategori/indextambah', 'Kategori::indexTambah');
$routes->add('/kategori/tambahkategori', 'Kategori::tambahKategori');



