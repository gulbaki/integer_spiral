<?php


namespace core\services;

use core\Validator;

abstract class Base
{
    protected Validator $validator;
    protected array $params = [];

    /**
     * Base constructor.
     * @param Validator $validator
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