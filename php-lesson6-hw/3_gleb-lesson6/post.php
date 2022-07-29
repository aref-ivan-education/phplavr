<?php
	
	include_once('models/blog.php');
	include_once('models/articles.php');
	
	$article_id = $_GET['article_id'] ?? null;
	
	$query = db_query("SELECT * FROM articles WHERE id_article=:article_id", ['article_id' => $article_id]);
	$article_show = $query->fetch();

	if(!article_check_exists($article_id, $article_show)){
			
		$msg_errors = blog_show_error();
		$article_show['title'] = 'Ошибка!';
			
	}
	
	
	if(blog_auth()){
				
		$add_link = 'edit.php?article_id=' . $article_id;
					
	} else {
		
		$add_link = 'login.php';
		
	}
	
	$msg_errors = blog_show_error();
	
	include('views/view_post.php');
	
?>