<?
	include_once("functions.php");
 
	session_start();
	$msg='';
	$urlCurrent=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	

	if(!isset($_SESSION['loginRef']) || isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=$urlCurrent){
		$_SESSION['loginRef']=$_SERVER['HTTP_REFERER'];
	}
    else $_SESSION['loginRef']="/";
	if(count($_POST) > 0){
		if($_POST['login'] == $user['login']&& $_POST['password'] == $user['password']){
			$_SESSION['is_auth'] = true;			
			
			if($_POST['remember']){
				setcookie('login',$user['login'], time() + 3600 * 24 * 7, '/');
				setcookie('password',myhash($user['password']), time() + 3600 * 24 * 7, '/');
			}
			
			header('Location:'.$_SESSION['loginRef']);
			unset($_SESSION['loginRef']);
			exit();
		}
		else {
			if($_POST['login'] == $user['login']){
				$msg="Пароль не верен";
				
			}else {
				$msg="Пользователь не найден";
				
			}
		}
	}
?>
<form method="post">
	Логин<br>
	<input type="text" name="login"><br>
	Пароль<br>
	<input type="password" name="password"><br>
	<input type="checkbox" name="remember">Запомнить<br>
	<input type="submit" value="Войти">
	<button><a href='<?=$_SESSION['loginRef'] ?>'>вернуться</a></button>
	<?php echo $msg?>

</form>