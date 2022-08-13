<?php
namespace models;

use core\DBDriver;
use core\Validator;

abstract class BaseModel
{
    protected $dbDr;
    protected $table;
    protected $idName;
    protected $validator;

    public function __construct(DBDriver $dbDr,Validator $validator, $table ,$idName)
    {
        $this->dbDr = $dbDr;
        $this->validator = $validator;
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

    public function add($data)
    {   
        return $this->dbDr->add($this->table,$data);
    }
    
    public function update($id, $data, $where)
    {
        return $this->dbDr->update($this->table, $data, $where  );
    }

    public function delete($where)
    {
        $this->dbDr->delete($this->table,$where);
    } 

    public function updateByID($id,$data)
    {
        $where = sprintf('%s = %d',$this->idName , $id);
        return $this->dbDr->update($this->table, $data, $where  );
    }

    public function deleteByID($id)
    {
        $where = sprintf('%s = %d',$this->idName , $id);
        $this->dbDr->delete($this->table , $where) ;
    } 


}


?>