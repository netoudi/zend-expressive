<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class CustomerCreatePageAction
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;
    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;

    /**
     * CustomerCreatePageAction constructor.
     * @param CustomerRepositoryInterface $repository
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->repository = $repository;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $entity = new Customer();
            $entity
                ->setName($data['name'])
                ->setEmail($data['email']);
            $this->repository->create($entity);
        }

        return new HtmlResponse($this->template->render('app::customer/create'));
    }
}
