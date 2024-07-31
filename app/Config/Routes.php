<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->add('/login', 'Home::login');
$routes->add('/loginproses', 'Home::loginProses');
$routes->get('/logout', 'Home::logout');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/peminjaman', 'Peminjaman::index');
$routes->add('/inventaris', 'Inventaris::index');
$routes->get('/inventaris/indextambah', 'Inventaris::indexTambah');
$routes->add('/inventaris/simpanalat', 'Inventaris::simpanAlat');
$routes->add('/inventaris/indexdetail/(:num)', 'Inventaris::indexDetail/$1');
$routes->add('/inventaris/indexupdate/(:num)', 'Inventaris::indexUpdate/$1');
$routes->add('/inventaris/updatealat', 'Inventaris::updateAlat');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->add('/stok/indexdetail/(:num)', 'Stok::indexDetail/$1');
$routes->add('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/indextambah', 'Stok::indexTambah');
$routes->add('/stok/indexupdate/(:num)', 'Stok::indexUpdate/$1');
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
$routes->get('/barang_masuk/beranda', 'Barang_Masuk::beranda');
$routes->get('/barang_keluar', 'Barang_Keluar::beranda');
$routes->get('/barang_pinjam', 'Barang_Pinjam::beranda');
$routes->get('/laporan_stok', 'Laporan_Stok::index');
$routes->get('/laporan_stok/exports', 'Laporan_Stok::exports');
$routes->get('/laporan_masuk', 'Laporan_Masuk::index');
$routes->get('/laporan_masuk/exportm', 'Laporan_Masuk::exportm');
$routes->get('/laporan_keluar', 'Laporan_Keluar::index');
$routes->get('/laporan_keluar/exportk', 'Laporan_Keluar::exportk');

$routes->get('/stok', 'Stok::index');
$routes->get('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/updatebarang', 'Stok::updateBarang');
$routes->get('/stok/deletebarang/(:num)', 'Stok::deletebarang/$1');

$routes->get('/satuan/deletesatuan/(:num)', 'Satuan::deletesatuan/$1');
$routes->get('/satuan', 'Satuan::index');
$routes->add('/satuan/indextambah', 'Satuan::indexTambah');
$routes->add('/satuan/tambahsatuan', 'Satuan::tambahSatuan');

$routes->get('/kategori/deletekategori/(:num)', 'Kategori::deleteKategori/$1');
$routes->get('/kategori', 'Kategori::index');
$routes->add('/kategori/indextambah', 'Kategori::indexTambah');
$routes->add('/kategori/tambahkategori', 'Kategori::tambahKategori');


$routes->get('/laporan_stok/exports', 'Laporan_Stok::exports');

$routes->post('/barang_pinjam/savedata', 'Barang_pinjam::saveData');
$routes->add('/barang_pinjam/cari', 'Barang_pinjam::index2');
$routes->add('/barang_pinjam/index', 'Barang_pinjam::index');
$routes->add('/barang_pinjam/clearsession', 'Barang_pinjam::clearSession');
$routes->add('/barang_pinjam/update', 'Barang_pinjam::updateStok');
$routes->add('/barang_pinjam/update2', 'Barang_pinjam::update');
$routes->add('/barang_pinjam/carii', 'Barang_pinjam::cariStok');
$routes->add('/barang_pinjam/hapusitem', 'Barang_pinjam::hapusBarangDatalistPinjam');

$routes->add('/barang_masuk/doubleform', 'Barang_Masuk::doubleForm');
