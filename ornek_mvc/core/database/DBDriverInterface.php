<?php


namespace core\database;


use core\exceptions\DataBaseException;

interface DBDriverInterface
{
    const FETCH_ONE = 1;
    const FETCH_ALL = 2;
    const DB_FATAL_ERROR_MSG = 'Database error!';

    /**
     * @param string $table
     * @param array $params
     * @return mixed
     */
    public function create(string $table, array $params);

    /**
     * @param string $sql
     * @param int $fetch
     * @param array $params
     * @return mixed
     */
    public function read(string $sql, $fetch = self::FETCH_ALL, array $params = []);

    /**
     * @param string $table
     * @param array $setParams
     * @param string $where
     * @param array $whereParams
     * @throws DataBaseException
     * @return mixed
     */
    public function update(string $table, array $setParams, string $where, array $whereParams);

    /**
     * @param string $table
     * @param string $where
     * @param array $whereParams
     * @return mixed
     */
    public function delete(string $table, string $where, array $whereParams);
}