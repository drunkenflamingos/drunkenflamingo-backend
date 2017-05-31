<?php
declare(strict_types=1);

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
const API_RESOURCES_DEFAULT = [
    'Homeworks',
];

Router::scope('/', function ($routes) {

});
Router::plugin('StudentApi', ['path' => '/student-api'], function (RouteBuilder $routes) {
    $routes->extensions(['json', 'xml']);

    foreach (API_RESOURCES_DEFAULT as $apiResource) {
        $routes->resources($apiResource, [
            'inflect' => 'dasherize',
        ]);
    }

    $routes->fallbacks(DashedRoute::class);
}
);
