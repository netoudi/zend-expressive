<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            CodeEmailMKT\Application\Action\HomePageAction::class => CodeEmailMKT\Application\Action\HomePageFactory::class,
            CodeEmailMKT\Application\Action\TestPageAction::class => CodeEmailMKT\Application\Action\TestPageFactory::class,
            CodeEmailMKT\Application\Action\Customer\CustomerListPageAction::class => CodeEmailMKT\Application\Action\Customer\CustomerListPageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => CodeEmailMKT\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => CodeEmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'test',
            'path' => '/test',
            'middleware' => CodeEmailMKT\Application\Action\TestPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'admin.customers.list',
            'path' => '/admin/customers',
            'middleware' => CodeEmailMKT\Application\Action\Customer\CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
    ],
];
