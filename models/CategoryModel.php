<?

namespace models;

use PDO;

class CategoryModel extends BaseModel
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db,"categores","id_cat");  
    }
}