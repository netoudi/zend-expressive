<?php

namespace CodeEmailMKT\Application\Action;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TestPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new TestPageAction($container->get(EntityManager::class), $template);
    }
}
