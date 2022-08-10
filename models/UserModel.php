<?
namespace models;

use core\DBDriver;

class UserModel extends BaseModel
{
    public $isAuth = false;

    private $hash = "4fgdhd43s9";
    public function __construct(DBDriver $db)
    {
        parent::__construct($db,"users","id_user");
    }

    public function isAuth()
    {
        if(isset($_SESSION['isAuth']) && $_SESSION['isAuth']){ 
            $this->isAuth = TRUE;
   
         }
         
         if (isset($_COOKIE['login'])){
             $user=$this->getOne("login",$_COOKIE['login']);
                 if($user){
                     if(isset($_COOKIE['pass']) && $_COOKIE['pass'] == $this->myHash($user['pass'])){  
                         $this->isAuth=TRUE;
                         $_SESSION['isAuth'] = true;
                         $_SESSION['userName']=$user['name']??$user['login'];			
                         $_SESSION['userLogin']=$user['login'];	
                         $_SESSION['userId'] = $user['id_user'];
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
        if(isset($_SESSION['isAuth'])){
            unset($_SESSION['isAuth']);
            unset($_SESSION['userName']);
            unset($_SESSION['userLogin']);
            unset($_SESSION['userId']);
        }
        if(isset($_COOKIE['login'])){
            setcookie('login','', 1, '/');
        }
        if(isset($_COOKIE['pass'])){
            setcookie('pass','', 1, '/');
        }
        return !(isset($_SESSION['isAuth'])&&isset($_COOKIE['login'])&&isset($_COOKIE['pass']));
    }
}