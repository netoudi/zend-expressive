<?php

namespace CodeEmailMKT\Application\InputFilter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class CustomerInputFilter extends InputFilter
{
    /**
     * CustomerInputFilter constructor.
     */
    public function __construct()
    {
        $this->add([
            'name' => 'name',
            'required' => false,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class],
            ],
        ]);

        $this->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
                ['name' => EmailAddress::class],
            ],
        ]);
    }
}
