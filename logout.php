<?
    require_once("functions.php");
	session_start();

    $urlCurrent=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if(!isset($_SESSION['loginRef']) || isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=$urlCurrent){
        $_SESSION['loginRef']=$_SERVER['HTTP_REFERER'];
    }
    if(count($_POST) > 0){
        echo 1;
        if(isset($_SESSION['is_auth'])){
            unset($_SESSION['is_auth']);
         }
         if(isset($_COOKIE['login'])){
            setcookie('login','admin', 1, '/');
         }
         if(isset($_COOKIE[$user['password']])){
            setcookie('password','', 1, '/');
         }

    }

    header('Location:'.$_SESSION['loginRef']);
	unset($_SESSION['loginRef']);
?>