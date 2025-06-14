<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::prosesLogin');
$routes->get('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::prosesRegister');


$routes->get('produk', 'ProdukController::index');
$routes->get('keranjang', 'KeranjangController::index');
$routes->post('keranjang/tambah/(:num)', 'KeranjangController::tambah/$1');
$routes->get('bayar', 'TransaksiController::bayar');
$routes->post('proses-bayar', 'TransaksiController::prosesBayar');
$routes->get('transaksi', 'TransaksiController::index');
$routes->get('transaksi/detail/(:num)', 'TransaksiController::detail/$1');
