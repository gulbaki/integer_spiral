<?php


namespace core\database;


use core\exceptions\DataBaseException;
use PDO;
use PDOStatement;

class DBDriver implements DBDriverInterface
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * @param false|PDOStatement $statement
     * @return void
     * @throws DataBaseException
     */
    protected static function checkErrors($statement)
    {
        if ($statement === false) {
            throw new DataBaseException('Request failed!');
        }

        $errorInfo = $statement->errorInfo();
        if ($errorInfo[0] !== PDO::ERR_NONE) {
            throw new DataBaseException(self::DB_FATAL_ERROR_MSG);
//        save to logs     exit($errorInfo[2]);
        }

    }

    /**
     * @param string $table
     * @param array $params
     * @return mixed|string
     * @throws DataBaseException
     */
    public function create(string $table, array $params)
    {
        $paramsKeys = array_keys($params);

        $keys = sprintf('(%s)', implode(', ', $paramsKeys));
        $values = sprintf('(:%s)', implode(', :', $paramsKeys));

        $sql = "INSERT INTO $table $keys VALUES $values;";
        $statement = $this->db->prepare($sql);

        $statement->execute($params);
        self::checkErrors($statement);

        return $this->db->lastInsertId();
    }

    /**
     * @param string $sql
     * @param int $fetch
     * @param array $params
     * @return array|bool|mixed
     * @throws DataBaseException
     */
    public function read(string $sql, $fetch = self::FETCH_ALL, array $params = [])
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($params);

        self::checkErrors($statement);
        if ($fetch === self::FETCH_ONE) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        if ($fetch === self::FETCH_ALL) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        throw new DataBaseException(
            sprintf('Undefined fetch style in method %s!', __METHOD__)
        );
    }

    private function mapParams(array $paramKeys)
    {
        $mapped = [];
        foreach ($paramKeys as $key) {
            $mapped [] = sprintf('%1$s = :%1$s', $key);
        }
        return $mapped;
    }

    /**
     * @param string $table
     * @param array $setParams
     * @param string $where
     * @param array $whereParams
     * @return bool|int|mixed
     * @throws DataBaseException
     */
    public function update(string $table, array $setParams, string $where, array $whereParams)
    {
        if (!empty(array_intersect_key($setParams, $whereParams))) {
            throw new DataBaseException('The same keys in $setParams and $whereParams');
        };

        $set = implode(', ', $this->mapParams(array_keys($setParams)));
        $sql = "UPDATE $table SET $set WHERE $where;";

        $statement = $this->db->prepare($sql);
        $statement->execute(array_merge($setParams, $whereParams));

        self::checkErrors($statement);

        return $statement->rowCount();
    }

    /**
     * @param string $table
     * @param string $where
     * @param array $whereParams
     * @return int|mixed
     * @throws DataBaseException
     */
    public function delete(string $table, string $where, array $whereParams)
    {
        $sql = "DELETE FROM $table WHERE $where;";
        $statement = $this->db->prepare($sql);
        $statement->execute($whereParams);
        self::checkErrors($statement);

        return $statement->rowCount();
    }
}