<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index', ['filter' => 'auth']);
$routes->get('/dokumentasi', 'Home::readme', ['filter' => 'auth']);
$routes->get('/home/lihat-cuti/(:any)', 'Home::lihatCuti/$1', ['filter' => 'auth']);
$routes->get('/home/pembuatan-surat-cuti/(:any)', 'Home::buatSuratCuti/$1', ['filter' => 'auth']);
$routes->get('/home/(:any)', 'Home::link/$1', ['filter' => 'auth']);
$routes->get('/pegawai/(:any)', 'Pegawai::page/$1', ['filter' => 'auth']);
$routes->get('/pegawai', 'Pegawai::index', ['filter' => 'auth']);
$routes->get('/', 'Home::login');


// API
$routes->post('/api/save/(:any)', 'Api::save/$1', ['filter' => 'auth']);
$routes->post('/api/edit/(:any)', 'Api::edit/$1', ['filter' => 'auth']);
$routes->post('/api/delete/(:any)', 'Api::delete/$1', ['filter' => 'auth']);
$routes->post('/api/cuti', 'Api::cuti', ['filter' => 'auth']);
$routes->get('/api/notif', 'Api::notif', ['filter' => 'auth']);
$routes->post('/api/login', 'Api::login');
$routes->get('/api/logout', 'Api::logout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}