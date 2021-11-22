<?php

include_once '../config.php';
include_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(["/app/controller/Layout.php"] ); //  /Applications/MAMP/htdocs/controller/Layout.php


header('Content-Type: application/json');
 
echo $openapi->toJSON(); 