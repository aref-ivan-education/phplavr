<?
    include_once('m_db.php');
    include_once('m_users.php');

    function myHash($str){
		return hash('sha256', $str . 'erwdsddsdsds');
    }

    function isAuth(){
        session_start();
        $isAuth=FALSE;

        if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']){ 
           $isAuth = TRUE;
  
        }
        
        if (isset($_COOKIE['login'])){
            $user=get_user_by_login($_COOKIE['login']);
                if($user){
                    if(isset($_COOKIE['pass']) && $_COOKIE['pass'] == myHash($user['pass'])){  
                        $isAuth=TRUE;
                        $_SESSION['is_auth'] = true;
                        $_SESSION['userName']=$user['name']??$user['login'];			
                        $_SESSION['userLogin']=$user['login'];	
                    }
                }         
        }
  
        return $isAuth;
    }


    


    function logOut(){
        if(isset($_SESSION['is_auth'])){
            unset($_SESSION['is_auth']);
        }
        if(isset($_COOKIE['login'])){
            setcookie('login','', 1, '/');
        }
        if(isset($_COOKIE['pass'])){
            setcookie('pass','', 1, '/');
        }
        return !(isset($_SESSION['is_auth'])&&isset($_COOKIE['login'])&&isset($_COOKIE['pass']));
    }

