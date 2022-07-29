<?php
	
	include_once('models/blog.php');
		
	unset($_SESSION['user_login']);
	setcookie('login', '', time() - 3600 * 24 * 7, '/');
	setcookie('token', '', time() - 3600 * 24 * 7, '/');
	setcookie('user_id', '', time() + 3600 * 24 * 7, '/');
	
	if(count($_POST) > 0){
		
		if(!blog_check_login(blog_safe_input_data($_POST['login'])) | !blog_check_password(blog_safe_input_data($_POST['password']))){
			
			$msg_errors = blog_show_error();
			
		}
		
		if ($msg_errors == null) {
			
			$query = db_query("SELECT * FROM users WHERE login=:user_login", ['user_login' => blog_safe_input_data($_POST['login'])]);
			$user = $query->fetch();
			
			if(blog_safe_input_data($_POST['login']) == $user['login'] && blog_encryption(blog_safe_input_data($_POST['password'])) == $user['password'] && $user['status'] == 1){
			
				$_SESSION['user_login'] = $user['login'];
				$_SESSION['user_id'] = $user['id_user'];
				
				if($_POST['remember']){
					
					$cookie_token = blog_encryption($user['login']) . $user['password'];
					setcookie('login', $user['login'], time() + 3600 * 24 * 7, '/');
					setcookie('token', $cookie_token, time() + 3600 * 24 * 7, '/');
					setcookie('user_id', $user['id_user'], time() + 3600 * 24 * 7, '/');
					
				}
				
				header('Location: index.php');
				exit();
				
			} else {
				
				blog_show_error('Вы ввели неверное имя администратора или неверный пароль.');
				
			}
			
		}
		
	}
	
	$msg_errors = blog_show_error();
	
	include('views/view_login.php');

?>