<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'TeacherAdmin',
    ['path' => '/teacher-admin'],
    function (RouteBuilder $routes) {

        $routes->resources('Courses', function (RouteBuilder $routes) {
            $routes->resources('CoursesUsers', [
                'prefix' => 'Courses',
                'inflect' => 'dasherize',
            ]);

            $routes->connect(
                '/courses-users/add',
                [
                    'controller' => 'CoursesUsers',
                    'action' => 'add',
                    'prefix' => 'Courses',
                ],
                ['routeClass' => DashedRoute::class]

            );

            $routes->connect(
                '/courses-users/delete/:id',
                [
                    'controller' => 'CoursesUsers',
                    'action' => 'delete',
                    'prefix' => 'Courses',
                ],
                [
                    'routeClass' => DashedRoute::class,
                    'pass' => ['id'],
                ]
            );
        });

        $routes->resources('Dashboard');
        $routes->resources('Teachers');
        $routes->resources('Users');

        $routes->fallbacks(DashedRoute::class);
    }
);
