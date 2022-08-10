<?php
namespace models;

use core\DBDriver;

abstract class BaseModel
{
    protected $dbDr;
    private $table;
    private $idName;

    public function __construct(DBDriver $dbDr, $table ,$idName)
    {
        $this->dbDr = $dbDr;
        $this->table = $table;
        $this->idName = $idName;
    }

    public function getAll()
    {
        $sql = sprintf('SELECT * FROM %s', $this->table);
	    return $this->dbDr->select($sql);
    }
    
    public function getOne($fieldName,$fieldValue)
    {
        $sql = sprintf('SELECT * FROM %s WHERE %s = :field', $this->table,$fieldName);
        return $this->dbDr->select($sql,['field'=>$fieldValue],'one');
    }

    public function deleteByField($fieldName,$fieldValue)
    {
        $this->dbDr->delete($this->table,$fieldName,$fieldValue);
    } 

    public function deleteByID($id)
    {
        $this->dbDr->delete($this->table,$this->idName,$id);
    } 

    public function updateByID($id,$data)
    {
        return $this->dbDr->update($this->table , $this->idName, $id, $data);
    }
    public function add($data)
    {
   
        return $this->dbDr->add($this->table,$data);

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
        return $this->dbDR;
    }

}


?>