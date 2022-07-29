<?php

	include_once('models/blog.php');
	include_once('models/articles.php');
	
	$query = db_query("SELECT * FROM articles WHERE title != '' AND content != '' GROUP BY date DESC");
	$list = $query->fetchAll();
	
	$is_auth = blog_auth();
	
	if(blog_auth()){
				
		$add_link = 'add';
		
		$logout = ' <a href="login.php">Выход</a>';
					
	} else {
		
		$add_link = 'login';
		
	}
	
	include('views/view_index.php');
	
?>