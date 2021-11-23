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
          //      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                 
                $dsn = sprintf('%s:host=%s;dbname=%s', SCHEMA, HOST , DB_NAME);
                $db = new PDO($dsn, DB_USER, DB_PASSWORD);
                $db->exec('set names utf8;');

                
            } catch (PDOException $e) {
                
                exit("Database fatal error!");
            }
        }
        return $db;
    }
}
