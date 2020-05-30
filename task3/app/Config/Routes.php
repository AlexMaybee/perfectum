<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//$routes->get('/comment/', 'Comment::index');
//$routes->get('/comment/view', 'Comment::view');

//$routes->get('/', 'Home::index');

$routes->match(['post'], 'create', 'MainController::create');
$routes->add('delete/(:num)', 'MainController::delete/$1');
$routes->add('update/(:num)', 'MainController::update/$1');
$routes->match(['post'], 'update/', 'MainController::update');
$routes->get('/', 'MainController::index');



//$routes->get('create', 'MainController::createComment');
//$routes->get('/comment/createComment', 'MainController::createComment');

//$routes->get('/comment/create', 'comment::create');

//$routes->get('comment/(:any)', 'Comment::$1');
//$routes->get('(:any)', 'Comment::view/$1');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
