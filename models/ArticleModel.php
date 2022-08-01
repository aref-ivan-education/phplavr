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
        $query = $this->db_query($sql);

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
        $query = $this->db_query($sql,['id' => $id]);

        return $query->fetch();
        

    }

    public function set_article($data)
    {
        $table = $this->getTable();
        $sql = sprintf('INSERT INTO %s (title, content ,id_cat ,id_user) 
                        VALUES (:title, :content , :id_cat, :id_user)',$table);


        $this->db_query($sql, $data);

		return $this->db->lastInsertId();
    }

    public function update_article($data)
    {
        $table = $this->getTable();
        $idName = $this->getIdName();
        $key_mask=[];
        $sql="";
        foreach($data as $k=>$v){
            if($k!='id_article'){
                $key_mask[] = $k ." = :" . $k ;
            }
        }
        $key_mask=implode(' , ',$key_mask);
        $sql = "UPDATE articles SET " . $key_mask . " WHERE  id_article = :id_article";
        $query=db_query($sql, $data);
        return $query;
        
    }
}