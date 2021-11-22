<?php

namespace core\database;

use PDO;
use PDOException;

abstract class DBConnector
{
    private static  $pdo = null;

    public static function getPdo()
    {
        $db = &self::$pdo;
        if ($db === null) {
            try {
                $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
               
               // $dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'integer_spiral');
                //$db = new PDO($dsn, 'root', 'root');
                 
                $dsn = sprintf('%s:host=%s;dbname=%s', "mysql", "eu-cdbr-west-01.cleardb.com" , "heroku_6c71c1e987b6102");
                $db = new PDO($dsn, "bf04bf2f2da686", "756a31b4");
                $db->exec('set names utf8;');

                
            } catch (PDOException $e) {
                
                exit("Database fatal error!");
            }
        }
        return $db;
    }
}
