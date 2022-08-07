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

    protected function dbQuery($sql, $params = [])
    {
        $db = $this->db;
        $query = $db->prepare($sql);
        $query->execute($params);       
        $this->dbCheckError($query);     
        return $query;

    }

    private function dbCheckError($query)
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
        $query = $this->dbQuery($sql);

	    return $query->fetchAll();
    }
    public function getByID($id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE %s = :id', $this->table, $this->idName);
        $query = $this->dbQuery($sql,['id'=>$id]);

	    return $query->fetch();
    }
    public function deleteByID($id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s = :id', $this->table,$this->idName);
        $query = $this->dbQuery($sql,['id'=>$id]);

        return $query;
    } 
    public function updateByID($id,$data)
    {
        $table = $this->getTable();
        $idName = $this->getIdName();
        $keyMask=implode(' , ',array_map(function($k){
            return sprintf('%1$s = :%1$s',$k);}
            ,array_keys($data)
            )
        );
        $data[$idName]= $id;
        $sql = sprintf('UPDATE %1$s SET %2$s WHERE  %3$s = :%3$s',$table,$keyMask,$idName);
        $query=$this->dbQuery($sql, $data);
        return $query;
        
    }
    public function add($data)
    {
        $table = $this->getTable();
        $keyMask1 = implode(' , ', array_keys($data));
        $keyMask2 = sprintf(':%s', implode(' , :', array_keys($data)));
        $sql = sprintf('INSERT INTO %1$s (%2$s) VALUES (%3$s)', $table ,$keyMask1, $keyMask2);
        $this->dbQuery($sql, $data);

		return $this->getDB()->lastInsertId();

    }


}

?>