<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*******************************************************Database******************************************************/
define('SCHEMA', 'mysql');
define('HOST', 'eu-cdbr-west-01.cleardb.com');
define('DB_NAME', 'heroku_6c71c1e987b6102');
define('DB_USER', 'bf04bf2f2da686');
define('DB_PASSWORD', '756a31b4');
define('OPENAPI_PATH', '/Applications/MAMP/htdocs/controller/Layout.php'); ///Applications/MAMP/htdocs/controller/Layout.php   /app/controller/Layout.php
define('SWAGGER_PATH', 'http://localhost:8000/documentation/api.php');

define('ROOT', '/');
//http://localhost:8000
//https://integer-spiral.herokuapp.com/documentation/api.php
