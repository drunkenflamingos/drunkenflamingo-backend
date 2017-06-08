<?php
declare(strict_types=1);

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('Admin', ['path' => '/admin'], function (RouteBuilder $routes) {
    $routes->connect('/', [
        'prefix' => null,
        'plugin' => 'Admin',
        'controller' => 'Organizations',
        'action' => 'index',
    ]);

    $routes->resources('Currencies');
    $routes->resources('Dashboard');
    $routes->resources('Languages');
    $routes->resources('Organizations');
    $routes->resources('Roles');

    $routes->fallbacks(DashedRoute::class);
}
);
