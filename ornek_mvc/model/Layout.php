<?php


namespace model;

use core\database\DBDriverInterface;
use core\exceptions\DataBaseException;

class Layout extends Base
{
    private $joinTable = null;

    public function __construct(DBDriverInterface $db)
    {
        parent::__construct($db, 'layout', 'layout_id');
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->db->read(
            sprintf(
                'SELECT %1$s.layout_matrix, %1$s.row, %1$s.col from %1$s  order by created_at desc;',
                $this->tableName,
            )
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->db->read(
            sprintf(
                'SELECT %1$s.* from %1$s  where %2$s = :id',
                $this->tableName,
                $this->idAlias
            ),
            $this->db::FETCH_ONE,
            [
                'id' => $id
            ]
        );
    }

   
}