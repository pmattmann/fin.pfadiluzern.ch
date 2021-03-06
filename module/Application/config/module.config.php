<?php

namespace Application;

use Laminas\Mvc\Router\Http\Literal;
use Laminas\Mvc\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'spesen' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/spesen[/:action]',
                    'defaults' => [
                        'controller' => Controller\SpesenController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'js-angebot' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/js-angebot[/:action]',
                    'defaults' => [
                        'controller' => Controller\JsAngebotController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            Controller\IndexController::class => Controller\IndexController::class
        ],
        'factories' => [
            Controller\SpesenController::class => Controller\SpesenControllerFactory::class,
            Controller\JsAngebotController::class => Controller\JsAngebotControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Mail\SmtpTransport::class => Mail\SmtpTransportFactory::class,
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
