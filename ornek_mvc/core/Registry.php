<?php


namespace core;


use core\dependencies\DIContainer;

class Registry
{
    private static $instance = null;
    private $request = null;
    /**
     * DIContainer variable
     * @var null
     */
    private $container = null;

    private function __construct()
    {
    }

    public static function getInstance(): Registry
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getRequest(): Request
    {
        if ($this->request === null) {
            $this->request = new Request();
        }

        return $this->request;
    }

    public function getDIContainer(): DIContainer
    {
        if ($this->container === null) {
            $this->container = new DIContainer();
        }

        return $this->container;
    }
}