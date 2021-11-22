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
              //  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
               
               // $dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'integer_spiral');
                //$db = new PDO($dsn, 'root', 'root');
                 
                $dsn = sprintf('%s:host=%s;dbname=%s', $url['schema'], $url['host'] , substr($url["path"], 1));
                $db = new PDO($dsn, $url['user'], $url['pass']);
                $db->exec('set names utf8;');

                
            } catch (PDOException $e) {
                
             
                exit("Database fatal error!");
            }
        }
        return $db;
    }
}
