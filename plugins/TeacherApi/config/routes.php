<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

$apiRoutes = [
    'AnswerWordFeedbacks',
];

Router::plugin('TeacherApi', ['path' => '/teacher-api/v1'], function (RouteBuilder $routes) use ($apiRoutes) {
    foreach ($apiRoutes as $apiResource) {
        $routes->resources($apiResource, [
            'inflect' => 'dasherize',
        ]);
    }

    $routes->fallbacks(DashedRoute::class);
});
