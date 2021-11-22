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
                $dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'localhost', 'integer_spiral');
                $db = new PDO($dsn, 'root', 'root');
                $db->exec('set names utf8;');

                //$dsn = sprintf('%s:host=%s;dbname=%s', 'mysql', 'ulsq0qqx999wqz84.chr7pe7iynqr.eu-west-1.rds.amazonaws.com', 'khypvpajtdmcfvls');
               // $db = new PDO($dsn, 'mkzsohlx2kuz9kjj', 't113zyjlt0h0dxht');
            } catch (PDOException $e) {
                exit("Database fatal error!");
            }
        }
        return $db;
    }
}
