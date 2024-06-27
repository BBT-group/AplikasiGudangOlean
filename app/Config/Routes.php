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
$routes->post('/barang/savedata', 'Barang::saveData');
