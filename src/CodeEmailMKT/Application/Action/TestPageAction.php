<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Address;
use CodeEmailMKT\Domain\Entity\Category;
use CodeEmailMKT\Domain\Entity\Client;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;

class TestPageAction
{
    /**
     * @var Template\TemplateRendererInterface
     */
    private $template;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * TestPageAction constructor.
     * @param CustomerRepositoryInterface $repository
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $customer = new Customer();
        $customer->setName('Customer Name')
            ->setEmail('customer@email.com');

        $this->repository->create($customer);

        /*// Categories
        $category = new Category();
        $category->setName('My category');

        $this->manager->persist($category);
        $this->manager->flush();

        // Select all categories
        $categories = $this->manager->getRepository(Category::class)->findAll();

        // Client
        $client = new Client();
        $client->setName('Client Name');
        $client->setEmail('client@domain.com');
        $client->setCpf(mt_rand(100, 999) . '.' . mt_rand(100, 999) . '.' . mt_rand(100, 999) . '-' . mt_rand(10, 99));

        // Address
        $maxAddress = mt_rand(1, 4);
        for ($i = 1; $i <= $maxAddress; $i++) {
            $address = new Address();
            $address->setStreet('250 Broadway # ' . mt_rand(10, 99));
            $address->setCity('New York');
            $address->setState('NY');
            $address->setZipCode('10007');

            $client->addAddress($address);
            $address->setClient($client);
        }

        $this->manager->persist($client);

        // Save data in database
        $this->manager->flush();

        // Select all clients
        $clients = $this->manager->getRepository(Client::class)->findAll();

        return new HtmlResponse($this->template->render('app::test-page', ['data' => 'Minha primeira aplicação!', 'categories' => $categories, 'clients' => $clients]));*/

        $customers = $this->repository->findAll();

        return new HtmlResponse(
            $this->template->render('app::test-page', [
                    'data' => 'Minha primeira aplicação!',
                    'categories' => [],
                    'clients' => [],
                    'customers' => $customers,
                ]
            )
        );
    }
}
