<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('User', ['path' => '/user'], function (RouteBuilder $routes) {
    $routes->connect('/', [
        'plugin' => 'User',
        'controller' => 'Dashboard',
        'action' => 'index',
    ]);

    $routes->resources('Dashboard');
    $routes->resources('Organizations');

    $routes->fallbacks(DashedRoute::class);
});
