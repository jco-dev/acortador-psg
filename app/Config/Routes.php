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
$routes->get('/r/(:any)', 'Home::index/$1');
$routes->get('/', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);

$routes->get('/auth/login', 'Auth::index', ['as' => 'login']);
$routes->get('/recuperar-contraseña', 'Auth::recoverPassword');
$routes->post('autentificar', 'Auth::signin', ['as' => 'autentificar']);
$routes->get('logout', 'Auth::signout', ['as' => 'signout']);

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index', ['as' => 'dashboard']);
    $routes->get('link/get_data', 'Link::datatable', ['as' => 'datatatable']);
    $routes->get('link/get_reports/(:num)', 'Link::reports/$1', ['as' => 'link']);
    $routes->resource('link', ['controller' => 'Link']);
});

$routes->group('superadmin', ['namespace' => 'App\Controllers\SuperAdmin', 'filter' => 'auth'], function ($routes) {
    $routes->get('usuario/active', 'Usuario::active');
    $routes->get('usuario/get_data', 'Usuario::datatable', ['as' => 'datatatable_usuario']);
    $routes->resource('usuario', ['controller' => 'Usuario']);

    $routes->get('grupo/get_data', 'Grupo::datatable');
    $routes->resource('grupo', ['controller' => 'Grupo']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
