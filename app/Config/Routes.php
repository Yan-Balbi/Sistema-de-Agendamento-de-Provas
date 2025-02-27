<?php

use CodeIgniter\Router\RouteCollection;


$routes->setDefaultNamespace('app\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setDefaultURIDashes(false);
$routes->set404Override();
$routes->setAutoroute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
