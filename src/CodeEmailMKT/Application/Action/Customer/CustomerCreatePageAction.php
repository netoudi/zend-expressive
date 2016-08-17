<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
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
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CustomerForm
     */
    private $form;

    /**
     * CustomerCreatePageAction constructor.
     * @param CustomerRepositoryInterface $repository
     * @param Template\TemplateRendererInterface|null $template
     * @param RouterInterface $router
     * @param CustomerForm $form
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CustomerForm $form
    ) {
        $this->repository = $repository;
        $this->template = $template;
        $this->router = $router;
        $this->form = $form;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $flash = $request->getAttribute('flash');

        if ($request->getMethod() == 'POST') {
            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);

            if ($this->form->isValid()) {
                $entity = $this->form->getData();
                $this->repository->create($entity);
                $flash->setMessage('success', 'Customer successfully registered.');

                return new RedirectResponse($this->router->generateUri('admin.customers.list'));
            }
        }

        return new HtmlResponse($this->template->render('app::customer/create', [
            'form' => $this->form,
        ]));
    }
}
