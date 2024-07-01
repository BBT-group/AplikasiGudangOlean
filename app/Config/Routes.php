<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->post('/barang/search', 'Barang::search');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->post('/barang/savedata', 'Barang::saveData');
$routes->get('/barangtambah/index', 'Barang_Tambah::index');
$routes->add('/barangtambah/simpan', 'Barang_Tambah::simpan');

// Routes yang bisa diakses oleh admin
$routes->group('', ['filter' => 'AdminFilter'], function($routes) {
    $routes->get('/beranda', 'Beranda::index');
    $routes->get('/barang_masuk', 'Barang_Masuk::index');
    $routes->get('/stok', 'Stok::index');
    $routes->get('/laporan_stok', 'Laporan_Stok::index');
    $routes->get('/laporan_masuk', 'Laporan_Masuk::index');
});

// Routes yang bisa diakses oleh operator
$routes->group('', ['filter' => 'OperatorFilter'], function($routes) {
    $routes->get('/beranda', 'Beranda::index');
    $routes->get('/barang_keluar', 'Barang_Keluar::index');
    $routes->get('/laporan_keluar', 'Laporan_Keluar::index');
});
