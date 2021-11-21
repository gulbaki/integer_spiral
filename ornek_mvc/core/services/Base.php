<?php


namespace core\services;

use core\Validator;

abstract class Base
{
    protected $validator;
    protected $params = [];

    /**
     * Base constructor.
     * @param $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function getParams(): array
    {
        $this->params = array_merge($this->params, $this->validator->clear);
        return $this->params;
    }
}