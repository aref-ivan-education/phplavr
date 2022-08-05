<?
namespace models;

class ArticleModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db,"articles","id_article");
    }


    public function getAll()
    {
        $table = $this->getTable(); 
        $sql = sprintf('SELECT a.*,c.name as category, u.name as user FROM %s as a 
                        LEFT JOIN categores as c ON a.id_cat = c.id_cat 
                        LEFT JOIN users as u ON a.id_user = u.id_user
                        ORDER by a.date DESC'
                        ,
                        $table);
        $query = $this->dbQuery($sql);

	    return $query->fetchAll();
    }

    public function getByID($id)
    {
        $table = $this->getTable();
        $idName = $this->getIdName();
        $sql = sprintf('SELECT a.*,c.name as category, u.name as user FROM %s as a 
                        LEFT JOIN categores as c ON a.id_cat = c.id_cat 
                        LEFT JOIN users as u ON a.id_user = u.id_user 
                        WHERE %s = :id',
                        $table,$idName);
        $query = $this->dbQuery($sql,['id' => $id]);

        return $query->fetch();
        

    }

    public function setArticle($data)
    {
        $table = $this->getTable();
        $sql = sprintf('INSERT INTO %s (title, content ,id_cat ,id_user) 
                        VALUES (:title, :content , :id_cat, :id_user)',$table);


        $this->dbQuery($sql, $data);

		return $this->getDB()->lastInsertId();
    }


}