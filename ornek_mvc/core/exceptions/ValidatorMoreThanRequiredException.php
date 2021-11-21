<?php


namespace core\exceptions;


use Throwable;

class ValidatorMoreThanRequiredException extends \Exception
{
    private $currentLen;
    private $maxLength;

    public function __construct(int $currentLength, int $maxLength, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->currentLen = $currentLength;
        $this->maxLength = $maxLength;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getCurrentLen(): int
    {
        return $this->currentLen;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

}