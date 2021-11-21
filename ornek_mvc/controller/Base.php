<?php


namespace controller;


use core\database\DBConnector;
use core\database\DBDriver;
use core\dependencies\ServiceBuilderBox;
use core\exceptions\NotFoundException;
use core\Registry;
use core\Request;
use model\Texts;
use model\User;
use core\Validator;

abstract class Base
{
    protected $title = '';
    protected $menu;
    protected $sidebar;
    protected $content;
    protected $footer;

    protected $message;

    protected $mainTemplate = 'v_main.php';
    protected $request;
    protected $container;

    private $registry;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->request = $this->registry->getRequest();

        $this->container = $this->registry->getDIContainer();
        $this->container->register(new ServiceBuilderBox());
    }

    /**
     * @param string $path
     * @param string $root
     */
    protected function redirect(string $path, string $root = ROOT)
    {
        header('Location: ' . $root . $path);
        exit();
    }

    /**
     * @param $name
     * @param $arguments
     * @throws NotFoundException
     */
    public function __call($name, $arguments)
    {
        throw new NotFoundException();
    }
}