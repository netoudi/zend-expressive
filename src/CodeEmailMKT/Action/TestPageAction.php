<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\Category;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestPageAction
{
    /**
     * @var EventManager
     */
    private $manager;
    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    public function __construct(EntityManager $manager, Template\TemplateRendererInterface $template = null)
    {
        $this->manager = $manager;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $category = new Category();
        $category->setName('My category');

        $this->manager->persist($category);
        $this->manager->flush();

        $categories = $this->manager->getRepository(Category::class)->findAll();

        return new HtmlResponse($this->template->render('app::test-page', ['data' => 'Minha primeira aplicação!', 'categories' => $categories]));
    }
}
