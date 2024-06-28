<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->post('/barang/search', 'Barang::search');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->post('/barang_masuk/savedata', 'Barang_Masuk::saveData');
$routes->add('/barang_masuk/cari', 'Barang_Masuk::index2');
$routes->add('/barang_masuk/clearsession', 'Barang_Masuk::clearSession');
$routes->add('/barang_masuk/update', 'Barang_Masuk::updateStok');
$routes->get('/barangtambah/index', 'Barang_Tambah::index');
$routes->add('/barangtambah/simpan', 'Barang_Tambah::simpan');

$routes->get('/beranda', 'Beranda::index');
$routes->get('/barang_masuk', 'Barang_Masuk::index');
$routes->get('/barang_keluar', 'Barang_Keluar::index');
$routes->get('/stok', 'Stok::index');
$routes->get('/laporan_stok', 'Laporan_Stok::index');
$routes->get('/laporan_masuk', 'Laporan_Masuk::index');
$routes->get('/laporan_keluar', 'Laporan_Keluar::index');
