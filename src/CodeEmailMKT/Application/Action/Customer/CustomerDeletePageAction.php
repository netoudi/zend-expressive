<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\HttpMethodElement;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class CustomerDeletePageAction
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
     * CustomerDeletePageAction constructor.
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
        $idCustomer = (int)$request->getAttribute('id');
        $entity = $this->repository->find($idCustomer);
        $this->form->add(new HttpMethodElement('DELETE'));
        $this->form->bind($entity);

        if ($request->getMethod() == 'DELETE') {
            $this->repository->remove($entity);
            $flash->setMessage('success', 'Customer successfully deleted.');

            return new RedirectResponse($this->router->generateUri('admin.customers.list'));
        }

        return new HtmlResponse($this->template->render('app::customer/delete', [
            'form' => $this->form,
        ]));
    }
}
