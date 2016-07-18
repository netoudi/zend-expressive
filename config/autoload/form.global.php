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
            //
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
