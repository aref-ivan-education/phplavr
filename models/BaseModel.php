<?php
namespace models;

abstract class BaseModel
{
    private $db;
    private $table;
    private $idName;

    public function __construct(\PDO $db, $table ,$idName)
    {
        $this->db = $db;
        $this->table = $table;
        $this->idName = $idName;
    }

    public function getTable()
    {
        return $this->table;
    }
    public function getIdName()
    {
        return $this->idName;
    }
    public function getDB()
    {
        return $this->db;
    }

    protected function db_query($sql, $params = [])
    {
        $db = $this->db;
        $query = $db->prepare($sql);
        $query->execute($params);
        
        $this->db_check_error($query);
        
        return $query;

    }

    private function db_check_error($query)
    {
        $info = $query->errorInfo();

        if($info[0] != \PDO::ERR_NONE)
        {
            exit($info[2]);
        }
    }

    public function getAll()
    {
        $sql = sprintf('SELECT * FROM %s', $this->table);
        $query = $this->db_query($sql);

	    return $query->fetchAll();
    }
    public function getByID($id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE %s = :id', $this->table, $this->idName);
        $query = $this->db_query($sql,['id'=>$id]);

	    return $query->fetch();
    }
    public function deleteByID($id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s = :id', $this->table,$this->idName);
        $query = $this->db_query($sql,['id'=>$id]);

        return $query;
    } 
}


?>