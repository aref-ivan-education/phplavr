<?php

	include_once('models/blog.php');
	include_once('models/articles.php');
	
	if(!blog_auth()){
		
		header('Location: login.php');
		exit();
		
	}
		
	if(count($_POST) > 0){
		
		if(!article_check_title(blog_safe_input_data($_POST['title'])) | !article_check_content(blog_safe_input_data($_POST['content']))){
			
			$msg_errors = blog_show_error();
			
		}
		
		if ($msg_errors == null) {
			
			$new_article_id = db_query_add_article("INSERT INTO articles (title, content) VALUES (:title, :content)", [
				'title' => blog_safe_input_data($_POST['title']),
				'content' => blog_safe_input_data($_POST['content'])
			]);
			
			header("Location: post.php?article_id=$new_article_id");
			exit();
			
		}
		
	}
	
	$msg_errors = blog_show_error();
	
	include('views/view_add.php');
	
?>