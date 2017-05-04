<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('Student', ['path' => '/student'], function (RouteBuilder $routes) {
    $routes->connect('/', [
        'plugin' => 'Student',
        'controller' => 'Dashboard',
        'action' => 'index',
    ]);

    $routes->resources('Dashboard');

    $routes->fallbacks(DashedRoute::class);
});
