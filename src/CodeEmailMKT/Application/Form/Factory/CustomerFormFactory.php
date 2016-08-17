<?php

namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    function __invoke(ContainerInterface $container)
    {
        $customerForm = new CustomerForm();
        $customerForm->setHydrator(new ClassMethods());
        $customerForm->setObject(new Customer());
        $customerForm->setInputFilter(new CustomerInputFilter());

        return $customerForm;
    }
}
