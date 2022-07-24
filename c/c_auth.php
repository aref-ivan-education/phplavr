<?
    
    include_once('../m/m_auth.php');
    include_once('../m/m_check.php');

    // $users=get_users();


    session_start();
    $logOut=logOut();
    $msg='';
    if($logOut){

        if(count($_POST) > 0){
            
            $login=checkInput($_POST['login']);
            $password=checkInput($_POST['password']);

            $user=get_user($login);

            
            if($user&& $password == $user['pass']){
                $_SESSION['is_auth'] = true;			
                
                if(isset($_POST['remember'])&&$_POST['remember']){
                    setcookie('login',$user['login'], time() + 3600 * 24 * 7, '/');
                    setcookie('pass',myhash($user['pass']), time() + 3600 * 24 * 7, '/');
                }
                // var_dump($_SESSION);
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