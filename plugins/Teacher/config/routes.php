<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin('Teacher', ['path' => '/teacher'], function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);

    $routes->resources('Homeworks', function (RouteBuilder $routes) {
        $routes->connect('/assignments/delete/*', [
            'prefix' => 'Homeworks',
            'controller' => 'Assignments',
            'action' => 'delete',
        ]);
    });

    $routes->fallbacks(DashedRoute::class);
});
