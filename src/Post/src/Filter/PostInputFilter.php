<?php
declare(strict_types = 1);
namespace Post\Filter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

class PostInputFilter extends InputFilter
{

    public function __construct()
    {
        $this->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                [
                    'name' => ToInt::class
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                [
                    'name' => StripTags::class
                ],
                [
                    'name' => StringTrim::class
                ]
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100
                    ]
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'text',
            'required' => true,
            'filters' => [
                [
                    'name' => StripTags::class
                ],
                [
                    'name' => StringTrim::class
                ]
            ]
        ]);
    }
}

