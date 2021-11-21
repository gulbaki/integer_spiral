<?php

namespace model;

use core\database\DBDriverInterface;

abstract class Base
{
    protected $db;
    protected $tableName;
    protected $idAlias;

    /**
     * BaseModel constructor.
     * @param DBDriverInterface $db
     * @param string $tableName
     * @param string $idAlias
     */
    public function __construct(DBDriverInterface $db, string $tableName, string $idAlias)
    {
        $this->db = $db;
        $this->tableName = $tableName;
        $this->idAlias = $idAlias;
    }

    public function getById($id)
    {
        return $this->db->read(
            "SELECT * FROM {$this->tableName} WHERE {$this->idAlias} = :id",
            $this->db::FETCH_ONE,
            ['id' => $id]
        );
    }

    public function getAll()
    {
        return $this->db->read("SELECT * FROM {$this->tableName}");
    }

   
    public function insert(array $params)
    {
        return $this->db->create($this->tableName, $params);
    }

    public function getIdAlias()
    {
        return $this->idAlias;
    }

}