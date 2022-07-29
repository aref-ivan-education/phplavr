<?php 

    //Функция проверки на авторизацию по сессии или кукам
    function isAuth() {
    $isAuth = false;
 
     if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
         $isAuth = true;
     } elseif ((isset($_COOKIE['login'])) && (isset($_COOKIE['password']))) {
        $query = db_query("SELECT * FROM `user` WHERE `id` = :f", [
      'f' => 1
           ]);
    $articles = $query->fetch();

         if(isset($_COOKIE['login']) == $articles['login'] && isset($_COOKIE['password']) == $articles['password_hash']) {
         $_SESSION['is_auth'] = true;
         $isAuth = true;
     }  
         }
        
        return $isAuth;
 }
    //Функция сообщения приветствия
    function hello() {
     if(isset($_COOKIE['login']) && $_COOKIE['password']) {
         echo "Здравствуйте,". " " . " " . ($_COOKIE['login']) . "!<br>";
     } else { 
         
         echo "Здравствуйте,". " " . " " . ($_SESSION['login']) . "!<br>";
         
     }
 }
    //Функция удаления сессии и куков
    function unsetSesCook() {
        $isAuth = false;
        if($_SESSION['is_auth']) {
		unset($_SESSION['is_auth']);
    }
        
        if(isset($_COOKIE['login'])) {
        setcookie('login', '', 1, '/');
        } 
        if(isset($_COOKIE['login'])) {
        setcookie('password', '', 1, '/');
            }
        if(($_COOKIE['login'] && $_COOKIE['password']) != NULL) {

        $query = db_query("DELETE FROM `user` ORDER BY `id` DESC LIMIT 1 ");
    }

        
 }
    //Функция авторизации
    function authorization() {

        $logan = $_POST['login'];
        $passs = $_POST['password'];

    $query = db_query("SELECT * FROM `user` WHERE `login` = :l AND `password_hash` = :p ", 
        [
        'l' => $logan,
        'p' => $passs
        ] );

    $articles = $query->fetch();

    if(count($_POST) > 0){

        if((($_POST['login']) != $articles['login']) || (($_POST['password']) != $articles['password_hash'])) {
             echo 'Не правильный логин и\или пароль!';
             var_dump($articles);

        } else {


		if($_POST['login'] == $articles['login'] && $_POST['password'] == $articles['password_hash']){
			$_SESSION['is_auth'] = true;
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            $login = $_POST['login'];
            $auth = $_POST['password'];
            
			
			if($_POST['remember']){
				setcookie('login', 'Maxon', time() + 3600 * 24 * 7, '/');
				setcookie('password', hash('sha512', 'qwerty'), time() + 3600 * 24 * 7, '/');
                $pascook = hash('sha512', 'qwerty');
                $logcook = $login;
                 $query = db_query("INSERT INTO `user` SET  `login` = :log , `password_hash` = :cook",

        [
        'cook' => $pascook,
        'log'  => $logcook
        ] );
			}
			
			header('Location: main.php');
			exit();
		}
	}
    }
}

    //Функция вывода сообщения о приветствии по сессии или по кукам
    function inout() {
     if(isset($_SESSION['login']) && $_SESSION['is_auth']) {
         echo '<hr>Здравствуйте,' . ' ' . ' ' . ($_SESSION['login']) . '!<br>' . '<a href="index.php"><img src="image/out.png" alt="Выйти"></a>';
     } elseif(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
         echo '<hr>Здравствуйте,'. ' ' . ' ' . ($_COOKIE['login']) . '!<br>' . '<a href="index.php"><img src="image/out.png" alt="Выйти"></a>';
     } else{
        
         echo '<hr><a href="login.php"><img src="image/in.png" alt="Войти"></a>';
     }
     }
 