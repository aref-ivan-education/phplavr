<?
namespace models;

class UserModel extends BaseModel
{
    public $isAuth = false;

    private $hash = "4fgdhd43s9";
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
    public function isAuth()
    {
        if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']){ 
            $this->isAuth = TRUE;
   
         }
         
         if (isset($_COOKIE['login'])){
             $user=$this->getByLogin($_COOKIE['login']);
                 if($user){
                     if(isset($_COOKIE['pass']) && $_COOKIE['pass'] == $this->myHash($user['pass'])){  
                         $this->isAuth=TRUE;
                         $_SESSION['is_auth'] = true;
                         $_SESSION['userName']=$user['name']??$user['login'];			
                         $_SESSION['userLogin']=$user['login'];	
                     }
                 }         
         }
   
         return $this->isAuth;
    } 

    public function myHash($str)
    {
        return hash('sha256', sprintf('%s%s',$str,$this->hash));
    }
    public function logOut()
    {
        if(isset($_SESSION['is_auth'])){
            unset($_SESSION['is_auth']);
            unset($_SESSION['userName']);
            unset($_SESSION['userLogin']);
        }
        if(isset($_COOKIE['login'])){
            setcookie('login','', 1, '/');
        }
        if(isset($_COOKIE['pass'])){
            setcookie('pass','', 1, '/');
        }
        return !(isset($_SESSION['is_auth'])&&isset($_COOKIE['login'])&&isset($_COOKIE['pass']));
    }
}