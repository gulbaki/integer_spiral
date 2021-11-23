<?php


namespace model;

use core\database\DBDriverInterface;
use core\exceptions\DataBaseException;

class Layout extends Base
{
    private string $joinTable = "";

    public function __construct(DBDriverInterface $db)
    {
        parent::__construct($db, 'layout', 'layout_id');
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed
    {
        return $this->db->read(
            sprintf(
                'SELECT %1$s.layout_id, %1$s.row, %1$s.col from %1$s  order by created_at desc;',
                $this->tableName,
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id): mixed
    {
        return $this->db->read(
            sprintf(
                'SELECT %1$s.* from %1$s  where %2$s = :id',
                $this->tableName,
                $this->idAlias,
            ),
            $this->db::FETCH_ONE,
            [
                'id' => $id,
            ]
        );
    }


    /**
     * @param $id
     * @param $x
     * @param $y
     * @return mixed
     */
    public function getByIdCoordinates($id, $x, $y): mixed
    {
        return $this->db->read(
            sprintf(
                'SELECT %1$s.* from %1$s  where %2$s = :id and %3$s = :row and  %4$s = :col',
                $this->tableName,
                $this->idAlias,
                $x,
                $y,
            ),
            $this->db::FETCH_ONE,
            [
                'id' => $id,
                'row' => $x,
                'col' => $y
            ]
        );
    }

   
}