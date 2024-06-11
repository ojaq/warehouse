<?php

use App\Controllers\Category;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Main::index');
$routes->get('/category/delete/(:any)', 'Category::index');
$routes->delete('/category/delete/(:any)', 'Category::delete/$1');
$routes->get('/unit/delete/(:any)', 'Unit::index');
$routes->delete('/unit/delete/(:any)', 'Unit::delete/$1');
