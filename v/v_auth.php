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