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
                
               // $dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'integer_spiral');
                //$db = new PDO($dsn, 'root', 'root');

                $dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'ulsq0qqx999wqz84.chr7pe7iynqr.eu-west-1.rds.amazonaws.com', 'khypvpajtdmcfvls');
                $db = new PDO($dsn, 'mkzsohlx2kuz9kjj', 't113zyjlt0h0dxht');
                $db->exec('set names utf8;');

                
            } catch (PDOException $e) {
                $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

                var_dump($url);
                exit;
                exit("Database fatal error!");
            }
        }
        return $db;
    }
}
