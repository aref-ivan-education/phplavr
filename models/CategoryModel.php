<?

namespace models;


use core\DBDriver;

class CategoryModel extends BaseModel
{
    public function __construct(DBDriver $db)
    {
        parent::__construct($db,"categores","id_cat");  
    }
}