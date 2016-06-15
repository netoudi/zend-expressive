<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\Address;
use CodeEmailMKT\Entity\Category;
use CodeEmailMKT\Entity\Client;
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
        // Categories
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

        return new HtmlResponse($this->template->render('app::test-page', ['data' => 'Minha primeira aplicação!', 'categories' => $categories, 'clients' => $clients]));
    }
}
