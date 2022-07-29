<?php
	
	include_once('models/db.php');
	
	session_start();
	
	function blog_check_login($login){
		
		if($login == ''){
		
			blog_show_error('Введите логин.');
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	
	function blog_check_password($password){
		
		if($password == ''){
		
			blog_show_error('Введите пароль.');
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	
	function blog_show_error($msg = null){
		
		static $show_error = [];
		
		if($msg != null){
			
			$show_error[] = $msg;
			
		}
		
		return $show_error;
		
	}
	
	function blog_auth(){
		
		if($_SESSION['user_id'] != null) {
			
			$this_user_id = $_SESSION['user_id'];
			
		} elseif($_COOKIE['user_id'] != null) {
			
			$this_user_id = $_COOKIE['user_id'];
			
		}
		
		if($this_user_id != null) {
			
			$query = db_query("SELECT * FROM users WHERE id_user=:user_id", ['user_id' => $this_user_id]);
			$user = $query->fetch();
			
			$is_auth = (($_SESSION['user_login'] == $user['login']) || ($_COOKIE['login'] == $user['login'] && $_COOKIE['token'] == encryption($user['login']) . $user['password']));
			
			return $is_auth;
			
		}
		
	}
	
	function blog_safe_input_data($input_data){
		
		$input_data = htmlspecialchars(trim($input_data));
		return $input_data;
		
	}
	
	function blog_encryption($data){
		
		$data = hash('sha256', $data);
		return $data;
	}

?>