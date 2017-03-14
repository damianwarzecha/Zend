<?php

namespace Signin;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
//    'controllers' => [
//        'factories' => [
//            Controller\SigninController::class => InvokableFactory::class,
//        ],
//    ],

    'router' => [
        'routes' => [
            'signin' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/signin',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'signin',
                    ],
                ],
            ],

            'index' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/index',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'logout' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/logout',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'registration' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/registration',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'registration',
                    ],
                ],
            ],
            'active' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/active',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'active',
                    ],
                ],
            ],
            'ajax' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/ajax',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'ajax',
                    ],
                ],
            ],
            'ajaxIndex' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/ajaxIndex',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'ajaxIndex',
                    ],
                ],
            ],
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'admin',
                    ],
                ],
            ],
            'thousend' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/thousend',
                    'defaults' => [
                        'controller' => Controller\ThousendController::class,
                        'action' => 'thousend'
                    ],
                ],
            ],
            'rozdaj' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/rozdaj',
                    'defaults' => [
                        'controller' => Controller\ThousendController::class,
                        'action'     => 'rozdaj',
                    ],
                ],
            ],
            'zagraj' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/zagraj',
                    'defaults' => [
                        'controller' => Controller\SigninController::class,
                        'action'     => 'zagraj',
                    ],
                ],
            ],
        ],
    ],


//    'session' => [
////        'remember_me_seconds' => 10,
//        'use_cookies' => true,
//        'cookie_httponly' => true,
//        'gc_maxlifetime' => 5,
////        'cookie_lifetime' => 100,
//    ],

    'session' => [
        'config' => [
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => [
                'name' => 'myapp',
            ],
        ],
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ],

    'view_manager' => [
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/signin/layout.phtml'
        ],
        'template_path_stack' => [
            'signin' => __DIR__ . '/../view',
        ],
        'strategies' => array (            // Add
            // this
            'ViewJsonStrategy' // line
        )
    ],
];
