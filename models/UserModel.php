<?
namespace models;

class UserModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db,"user","id_user");
    }
    
    public function setUser($data)
    {
        $table = $this->getTable();
        $sql = sprintf('INSERT INTO %s (`name`, `login` , pass ,id_role) 
                        VALUES (:name, :login , :pass, :id_role)',$table);


        $this->dbQuery($sql, $data);

		return $this->getDB()->lastInsertId();
    }

    public function updateUser($data)
    {
        $table = $this->getTable();
        $idName = $this->getIdName();
        $keyMask=[];
        $sql="";
        foreach(array_keys($data) as $k){
            if($k!=$idName){
                $key_mask[] = $k ." = :" . $k ;
            }
        }
        $key_mask=implode(' , ',$key_mask);
        $sql = sprintf("UPDATE %s SET %s WHERE  %s = :%s",$table,$keyMask,$idName,$idName);
        $query=db_query($sql, $data);
        return $query;
        
    }
}