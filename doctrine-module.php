<?php

ini_set('display_errors', true);
chdir(__DIR__);

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);

$cli = $app->getContainer()->get('doctrine.cli');

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(function ($className) {
    return class_exists($className);
});

exit($cli->run());
