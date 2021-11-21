<?php


namespace core\exceptions;


use Throwable;

class ValidatorLessThanRequiredException extends \Exception
{
    private $currentLen;
    private $minLen;

    public function __construct(int $currentLength, int $maxLength, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->currentLen = $currentLength;
        $this->minLen = $maxLength;
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
    public function getMinLen(): int
    {
        return $this->minLen;
    }

}