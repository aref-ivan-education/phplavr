<?
namespace models;

use core\DBDriver;
use core\Validator;

class ArticleModel extends BaseModel
{
    private $id_article;
    private $title;
    private $content;
    private $excerpt;
    private $img;
    private $date;
    private $id_user;
    private $id_cat;

    public $scheme = 
    [
        "id"=>
        [
            "type" => "int",
            "prymary" => true,            
        ],
        "title"=>
        [
            "type" => "string",
            "length" => [2,50],
            "require" => true,
            'trim' => true,
        ],
        "content" =>
        [
            "type" => "text",
            "require" => true,
            'trim' => true,
        ],
        "except" => 
        [
            "type" => "string",
            "length" => 300,
        ],
        "img" =>
        [
            "type" => ["jpg","jpeg","png"],
            "size" =>  "2*1024*1024" 
        ],
        "date" =>
        [
            "type" => "date",
            "current" => true
        ],
        "id_user" =>
        [
            "type" => "int"
        ],
        "id_cat" =>
        [
            "type" => "int"
        ]
    ];

    public function __construct(DBDriver $dbDr, Validator $validator)
    {
        parent::__construct($dbDr,$validator,"articles","id_article");
        $this->validator->setRules($this->scheme);
    }

    

    public function getAll()
    {

        $sql = sprintf('SELECT a.*,c.name as category, u.name as user FROM %s as a 
                        LEFT JOIN categores as c ON a.id_cat = c.id_cat 
                        LEFT JOIN users as u ON a.id_user = u.id_user
                        ORDER by a.date DESC',
                        $this->table);

	    return $this->dbDr->select($sql);
    }

    public function getByID($id)
    {

        $sql = sprintf('SELECT a.*,c.name as category, u.name as user FROM %s as a 
                        LEFT JOIN categores as c ON a.id_cat = c.id_cat 
                        LEFT JOIN users as u ON a.id_user = u.id_user 
                        WHERE %s = :id',
                        $this->table,$this->idName);
        return $this->dbDr->select($sql,['id' => $id],'one');
    }


}