<?php

include_once '../config.php';
include_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(["/app/controller/Layout.php"] );


echo "<pre>";
print_r($openapi);
echo "</pre>";
header('Content-Type: application/json');
 
echo $openapi->toJSON(); 