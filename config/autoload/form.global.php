<?php

use CodeEmailMKT\Application\Form;
use CodeEmailMKT\Infrastructure;
use Zend\View;

$forms = [
    'dependencies' => [
        'aliases' => [
            //
        ],
        'invokables' => [
            //
        ],
        'factories' => [
            View\HelperPluginManager::class => Infrastructure\View\HelperPluginManagerFactory::class,
            Form\CustomerForm::class => Form\Factory\CustomerFormFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            //
        ],
        'invokables' => [
            //
        ],
        'factories' => [
            //
        ],
    ],
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm, $forms);
