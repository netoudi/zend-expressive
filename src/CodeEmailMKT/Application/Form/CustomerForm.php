<?php

namespace CodeEmailMKT\Application\Form;

use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class CustomerForm extends Form
{
    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods());
        $this->setObject(new Customer());
        $this->setInputFilter(new CustomerInputFilter());

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Name',
            ],
            'attributes' => [
                'id' => 'name',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => Element\Email::class,
            'options' => [
                'label' => 'E-mail',
            ],
            'attributes' => [
                'id' => 'email',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'options' => [
                'label' => 'Save',
            ],
            'attributes' => [
                'type' => 'submit',
            ],
        ]);
    }
}
