<?
namespace models;

use core\DBDriver;

class ArticleModel extends BaseModel
{
    public function __construct(DBDriver $dbDr)
    {
        parent::__construct($dbDr,"articles","id_article");
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

	    return $this->dbDr->select($sql);
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
        return $this->dbDr->select($sql,['id' => $id],'one');
    }


}