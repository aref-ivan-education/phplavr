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
                        LEFT JOIN users as u ON a.id_user = u.id_user',
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

    // public function updateArticle($data)
    // {
    //     $table = $this->getTable();
    //     $idName = $this->getIdName();
    //     $key_mask=[];
    //     $sql="";
    //     foreach(array_keys($data) as $k){
    //         if($k!='id_article'){
    //             $key_mask[] = $k ." = :" . $k ;
    //         }
    //     }
    //     $key_mask=implode(' , ',$key_mask);
    //     $sql = sprintf("UPDATE %s SET %s WHERE  %s = :%s",$table,$key_mask,$idName,$idName);
    //     $query=db_query($sql, $data);
    //     return $query;
        
    // }
}