<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Ujian
$routes->get('/', 'Login::index');
$routes->get('/ujian', 'Ujian::index');
$routes->get('/ujian/(:num)', 'Ujian::index/$1');
$routes->get('/score', 'Ujian::score');
$routes->get('/jawaban', 'Jawaban::index');
$routes->get('/jawaban/(:num)', 'Jawaban::index/$1');

//Admin
$routes->get('/admin', 'Admin::index');
$routes->get('/dashboard', 'Admin::dashboard');

// Download
$routes->get('/download', 'Download::index');

// Mahasiswa
$routes->get('/mahasiswa', 'Admin::mahasiswa');
$routes->get('/mahasiswa/update/(:num)', 'Form::update/$1');
$routes->get('/mahasiswa/active/(:num)', 'Active::mahasiswa/$1');
$routes->get('/mahasiswa/delete', 'Delete::mahasiswa');
$routes->get('/mahasiswa/delete/(:num)', 'Delete::mahasiswa/$1');
$routes->get('/mahasiswa/edit/(:num)', 'Edit::mahasiswa/$1');
$routes->get('/mahasiswa/(:num)', 'Admin::mahasiswa/$1');

// Administrator
$routes->get('/administrator', 'Admin::administrator');
$routes->get('/administrator/update/(:num)', 'Form::update/$1');
$routes->get('/administrator/active/(:num)', 'Active::administrator/$1');
$routes->get('/administrator/delete', 'Delete::administrator');
$routes->get('/administrator/delete/(:num)', 'Delete::administrator/$1');
$routes->get('/administrator/edit/(:num)', 'Edit::administrator/$1');

// Jadwal
$routes->get('/jadwal', 'Admin::jadwal');
$routes->get('/jadwal/update/(:num)', 'Form::update/$1');
$routes->get('/jadwal/active/(:num)', 'Active::jadwal/$1');
$routes->get('/jadwal/delete', 'Delete::jadwal');
$routes->get('/jadwal/delete/(:num)', 'Delete::jadwal/$1');
$routes->get('/jadwal/edit/(:num)', 'Edit::jadwal/$1');
$routes->get('/jadwal/user/(:num)', 'Admin::user/$1');

// Materi
$routes->get('/materi', 'Admin::materi');
$routes->get('/materi/update/(:num)', 'Form::update/$1');
$routes->get('/materi/active/(:num)', 'Active::materi/$1');
$routes->get('/materi/delete', 'Delete::materi');
$routes->get('/materi/delete/(:num)', 'Delete::materi/$1');
$routes->get('/materi/edit/(:num)', 'Edit::materi/$1');

// Schedule
$routes->get('/history', 'History::index');


/**
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
