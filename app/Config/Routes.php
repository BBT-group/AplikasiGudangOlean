<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/barang_masuk', 'Barang_Masuk::index');
$routes->get('/barang_keluar', 'Barang_Keluar::index');
$routes->get('/stok', 'Stok::index');
$routes->get('/laporan_stok', 'Laporan_Stok::index');
$routes->get('/laporan_masuk', 'Laporan_Masuk::index');
$routes->get('/laporan_keluar', 'Laporan_Keluar::index');
