<?php


namespace core\exceptions;


use Throwable;

class IncorrectDataException extends \Exception
{
    private $errors;

    public function __construct(array $errors, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors() {
        return $this->errors;
    }
}