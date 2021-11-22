<?php

include_once '../config.php';
include_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(["/controller/Layout.php"]);

print_r($openapi);
exit;

header('Content-Type: application/json');
 
echo $openapi->toJSON(); 