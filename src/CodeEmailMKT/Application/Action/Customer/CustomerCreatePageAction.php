<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use Zend\Form\Form;

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
     * CustomerCreatePageAction constructor.
     * @param CustomerRepositoryInterface $repository
     * @param Template\TemplateRendererInterface|null $template
     * @param RouterInterface $router
     */
    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router
    ) {
        $this->repository = $repository;
        $this->template = $template;
        $this->router = $router;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $myForm = new Form();

        $myForm->add([
            'name' => 'name',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Name:'
            ]
        ]);

        $myForm->add([
            'name' => 'email',
            'type' => 'email',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'E-mail:'
            ]
        ]);

        $myForm->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'class' => 'btn btn-primary',
            ]
        ]);

        $flash = $request->getAttribute('flash');

        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $entity = new Customer();
            $entity
                ->setName($data['name'])
                ->setEmail($data['email']);
            $this->repository->create($entity);
            $flash->setMessage('success', 'Customer successfully registered.');

            return new RedirectResponse($this->router->generateUri('admin.customers.list'));
        }

        return new HtmlResponse($this->template->render('app::customer/create', [
            'myForm' => $myForm,
        ]));
    }
}
