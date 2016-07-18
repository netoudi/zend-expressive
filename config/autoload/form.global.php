<?php

$forms = [
    'dependencies' => [
        'aliases' => [
            //
        ],
        'invokables' => [
            //
        ],
        'factories' => [
            Zend\View\HelperPluginManager::class =>
                CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory::class
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
