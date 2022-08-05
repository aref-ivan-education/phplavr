<?
    
    include_once('models/auth.php');
    include_once('models/check.php');
    include_once('models/users.php');

    
    $logOut = logOut();
    $msg = '';
    if( $logOut ){

        if( count($_POST) > 0){
            $login = cleanInput($_POST['login']);
            $password = cleanInput($_POST['password']);

            $user = get_user_by_login($login);

            
            if( $user && $password == $user['pass']){
                $_SESSION['is_auth'] = true;
                $_SESSION['userName'] = $user['name']??$user['login'];			
                $_SESSION['userLogin'] = $user['login'];
                
                if( isset($_POST['remember']) && $_POST['remember'] ){
                    setcookie('login',$user['login'], time() + 3600 * 24 * 7, '/');
                    setcookie('pass',myhash($user['pass']), time() + 3600 * 24 * 7, '/');
                }
                header('Location:'.$_SESSION['loginRef']);
                unset( $_SESSION['loginRef'] );
                exit();
            }
            else {
                if( !$user ){
                    $msg = "Пользователь не найден";
                    
                }else {
                    $msg = "Пароль не верен";
                    
                }
            }
        }
        else{
            $_SESSION['loginRef'] = $_SERVER['HTTP_REFERER']??"/";
        }
    }  
    $inner = template('v_auth',[
        'loginRef' => $_SESSION['loginRef'],
        'msg' => $msg
        ]);

    $title = "Авторизация";
     


?>