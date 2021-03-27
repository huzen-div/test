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
$routes->get('/', 'Home::index');
$routes->get('/finance/', 'Finance::');
$routes->get('/supplies', 'Supplies::index');
$routes->get('/notifications', 'Home::notifications');
$routes->get('/permissions', 'Home::permissions');
// $routes->get('/permissions/view_group/(:num)', 'Home::view_group', ['offset' => null]);
// $routes->get('/permissions/edit_group', 'Home::edit_group');
// $routes->get('/permissions/delete_group', 'Home::delete_group');
// $routes->get('/permissions/view_user', 'Home::view_user');
// $routes->get('/permissions/edit_user', 'Home::edit_user');
// $routes->get('/permissions/delete_user', 'Home::delete_user');
$routes->get('/setting', 'Setting::index');

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
