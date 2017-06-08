<?php
declare(strict_types=1);

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

$apiResources = [
    'AnswerWords',
];

Router::plugin('StudentApi', ['path' => '/student-api/v1'], function (RouteBuilder $routes) use ($apiResources) {
    foreach ($apiResources as $apiResource) {
        $routes->resources($apiResource, [
            'inflect' => 'dasherize',
        ]);
    }

    $routes->fallbacks(DashedRoute::class);
});
