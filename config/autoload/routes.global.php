<?php

use CodeEmailMKT\Application\Action\Customer;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            CodeEmailMKT\Application\Action\HomePageAction::class => CodeEmailMKT\Application\Action\HomePageFactory::class,
            CodeEmailMKT\Application\Action\TestPageAction::class => CodeEmailMKT\Application\Action\TestPageFactory::class,
            Customer\CustomerListPageAction::class => Customer\Factory\CustomerListPageFactory::class,
            Customer\CustomerCreatePageAction::class => Customer\Factory\CustomerCreatePageFactory::class,
            Customer\CustomerUpdatePageAction::class => Customer\Factory\CustomerUpdatePageFactory::class,
            Customer\CustomerDeletePageAction::class => Customer\Factory\CustomerDeletePageFactory::class,
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
            'middleware' => Customer\CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'admin.customers.create',
            'path' => '/admin/customers/create',
            'middleware' => Customer\CustomerCreatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'admin.customers.update',
            'path' => '/admin/customers/update/{id}',
            'middleware' => Customer\CustomerUpdatePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+',
                ],
            ],
        ],
        [
            'name' => 'admin.customers.delete',
            'path' => '/admin/customers/delete/{id}',
            'middleware' => Customer\CustomerDeletePageAction::class,
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'tokens' => [
                    'id' => '\d+',
                ],
            ],
        ],
    ],
];
