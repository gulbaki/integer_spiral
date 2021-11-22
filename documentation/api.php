<?php

include_once '../config.php';
include_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(["/Applications/MAMP/htdocs/controller/Layout.php"] ); // /app/controller/Layout.php



header('Content-Type: application/json');
 
echo $openapi->toJSON(); 