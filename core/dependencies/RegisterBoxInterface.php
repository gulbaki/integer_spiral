<?php


namespace core\dependencies;


interface RegisterBoxInterface
{
    public function register(DIContainer $container) : void;
}