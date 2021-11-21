<?php


namespace core\dependencies;


use core\exceptions\DIContainerException;

class DIContainer
{
    private $storage = [];

    public function register(RegisterBoxInterface $registerBox)
    {
        $registerBox->register($this);
    }

    public function set(string $name, callable $factory)
    {
        $this->storage[$name] = $factory;
    }

    public function fabricate(string $name, ...$params)
    {
        if (!isset($this->storage[$name])) {
            throw new DIContainerException("No handler found for $name");
        }

        return call_user_func_array($this->storage[$name], $params);
    }
}