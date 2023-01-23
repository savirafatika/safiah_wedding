<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index', ['as' => 'login']);
$routes->get('register', 'Auth::register', ['as' => 'register']);
$routes->get('activation', 'Auth::activation', ['as' => 'activation']);
$routes->get('forgot_pwd', 'Auth::forgot_password', ['as' => 'forgot_password']);
$routes->get('reset_pwd', 'Auth::reset_password', ['as' => 'reset_password']);

$routes->group('superadmin', ['filter' => 'role:superadmin'], static function ($routes) {
    $routes->get('dashboard', 'Superadmin::index', ['as' => 'dashboard']);
    $routes->get('akses_pengguna', 'Superadmin::daftar_akses_pengguna', ['as' => 'daftar_pengguna']);
    $routes->get('detail_pengguna/(:num)', 'Superadmin::detail_pengguna/$1', ['as' => 'detail_pengguna']);
    $routes->get('buat_pengguna', 'Superadmin::buat_pengguna', ['as' => 'buat_pengguna']);
    $routes->post('simpan_pengguna', 'Superadmin::simpan_pengguna', ['as' => 'simpan_pengguna']);
    $routes->get('hapus_pengguna/(:num)', 'Superadmin::hapus_pengguna/$1', ['as' => 'hapus_pengguna']);
    $routes->get('resetpas_pengguna/(:num)', 'Superadmin::resetpas_pengguna/$1', ['as' => 'resetpas_pengguna']);
    $routes->presenter('kategori', ['controller' => 'Kategori']);
    $routes->presenter('tag', ['controller' => 'tag']);
    $routes->presenter('blog', ['controller' => 'blog']);
    $routes->presenter('produk', ['controller' => 'produk']);
    $routes->presenter('hadiah', ['controller' => 'hadiah']);
});

$routes->group('admin', ['filter' => 'role:admin,superadmin'], static function ($routes) {
    $routes->get('klaim_hadiah', 'Admin::index', ['as' => 'klaim_hadiah']);
    $routes->get('reservasi', 'Admin::index', ['as' => 'reservasi']);
});

$routes->group('user', static function ($routes) {
    $routes->get('profil', 'User::profil', ['as' => 'profil']);
    $routes->post('gantipas_pengguna', 'User::gantipas_pengguna', ['as' => 'gantipas_pengguna']);
    $routes->get('galeri_produk', 'User::index', ['as' => 'galeri']);
    $routes->get('reservasi_pengguna', 'User::index', ['as' => 'reservasi_pengguna']);
    $routes->get('hadiah_pengguna', 'User::index', ['as' => 'hadiah_pengguna']);
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
