<?php





header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');



include_once 'config.php';

include_once("vendor/autoload.php");





$router = new core\Route();


$router->run('/', [controller\Layout::class, 'getLayout'], 'get');

$router->run('/api/create-layout', [controller\Layout::class, 'createLayout'], 'post');
$router->run('/api/get-layout', [controller\Layout::class, 'getLayout'], 'get');
$router->run('/api/get-value-of-layout/{int}/{int}/{int}', [controller\Layout::class, 'getValueOfLayout'], 'get');
