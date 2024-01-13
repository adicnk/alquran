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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// For Admin Route

$routes->get('/admin', 'Login::admin');
$routes->get('/admin/(:segment)', 'Admin::index/$1');


$routes->get('edit/admin/(:num)', 'Edit::admin/$1');

$routes->get('form/admin', 'Form::admin');
$routes->get('form/soal', 'Form::soal');

$routes->get('edit/user/(:num)', 'Edit::user/$1');
$routes->get('edit/soal/(:num)/(:num)', 'Edit::soal/$1/$2');

$routes->get('submit/admin', 'Submit::admin');
$routes->get('submitedit/admin/(:num)', 'Submit::admin/$1');
$routes->get('submit/soal', 'Submit::soal');
$routes->get('submitEdit/soal/(:num)/(:num)', 'Submit::soal/$1/$2');
$routes->get('/submit/review', 'Review::index');
$routes->get('submit/pesan/(:num)', 'Submit::pesan/$1');
$routes->get('submit/confirm/(:num)', 'Submit::confirm/$1');

$routes->get('delete/soal/(:num)/(:num)', 'Delete::soal/$1/$2');

$routes->get('delete/admin/(:num)', 'Delete::user/$1');

// For Exercise Route
$routes->get('/', 'Exercise::index');
$routes->get('/gmail', 'Admin::gmail');
$routes->get('/daftar', 'Admin::daftar');
$routes->get('/dashboard', 'Exercise::dashboard');
$routes->get('/latihan', 'Exercise::soal');
$routes->get('/latihanfp', 'Exercise::latihanFP');
//$routes->get('/latihan/(:segment)', 'Exercise::selesai/$1');

//For Pembelajaran Links
$routes->get('/belajar', 'Exercise::belajar');
$routes->get('/profile', 'Exercise::profile');
$routes->get('/about', 'Exercise::about');
$routes->get('/info', 'Exercise::info');
$routes->get('/review', 'Exercise::review');
$routes->get('/request', 'Exercise::beli');
$routes->get('/belipaket/(:segment)', 'Exercise::belipaket/$1');
$routes->get('/confirm', 'Exercise::confirm');
$routes->get('/bayar(:segment)', 'Bayar::index/$1');

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
