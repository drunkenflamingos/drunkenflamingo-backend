<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin('Student', ['path' => '/student'], function (RouteBuilder $routes) {
    $routes->connect('/', [
        'controller' => 'Dashboard',
        'action' => 'index',
    ]);

    $routes->resources('Dashboard');

    $routes->fallbacks(DashedRoute::class);
});
