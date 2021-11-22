<?php


namespace core\dependencies;


use core\database\DBConnector;
use core\database\DBDriver;

use core\services\Layout as LayoutService;

use model\Layout as LayoutModel;

use core\Validator;


class ServiceBuilderBox implements RegisterBoxInterface
{

    public function register(DIContainer $container): void
    {
        $dbDriver = new DBDriver(DBConnector::getPdo());
        $container->set('layout-service', function () use ($dbDriver) {
            return new LayoutService(
                new LayoutModel($dbDriver),
                new Validator()
            );
        });

    }
}