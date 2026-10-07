<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('/tasks', 'MainController::tasks');
$routes->get('/profile', 'MainController::profile');
$routes->get('/about', 'MainController::about');