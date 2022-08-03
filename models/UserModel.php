<?
namespace models;

class UserModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db,"users","id_user");
    }
    public function getByLogin($login)
    {
        $table = $this->getTable();
        $sql = sprintf('SELECT * FROM %s WHERE `login` = :id', $table);
        $query = $this->dbQuery($sql,['id'=>$login]);

	    return $query->fetch();
    }
}