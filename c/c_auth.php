<?
    
    include_once('../m/m_auth.php');
    include_once('../m/m_check.php');
    include_once('../m/m_users.php');



    session_start();
    $logOut=logOut();
    $msg='';
    if($logOut){

        if(count($_POST) > 0){
            
            $login=checkInput($_POST['login']);
            $password=checkInput($_POST['password']);

            $user=get_user_by_login($login);

            
            if($user&& $password == $user['pass']){
                $_SESSION['is_auth'] = true;
                $_SESSION['userName']=$user['name']??$user['login'];			
                $_SESSION['userLogin']=$user['login'];
                
                if(isset($_POST['remember'])&&$_POST['remember']){
                    setcookie('login',$user['login'], time() + 3600 * 24 * 7, '/');
                    setcookie('pass',myhash($user['pass']), time() + 3600 * 24 * 7, '/');
                }
                header('Location:'.$_SESSION['loginRef']);
                unset($_SESSION['loginRef']);
                exit();
            }
            else {
                if(!$user){
                    $msg="Пользователь не найден";
                    
                }else {
                    $msg="Пароль не верен";
                    
                }
            }
        }
        else{
            $_SESSION['loginRef'] = $_SERVER['HTTP_REFERER']??"/";
        }
    }  
    include('../v/v_auth.php');
     


?>