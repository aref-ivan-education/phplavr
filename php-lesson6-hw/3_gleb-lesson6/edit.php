<?php
	
	include_once('models/blog.php');
	include_once('models/articles.php');
	
	if(!blog_auth()){
		
		header('Location: login.php');
		exit();
		
	}
		
	$edit_article = $_GET['article_id'] ?? null;
	
	$query = db_query("SELECT * FROM articles WHERE id_article=:edit_article", ['edit_article' => $edit_article]);
	$article_show = $query->fetch();
	
	if(count($_POST) > 0){
		
		$title = blog_safe_input_data($_POST['title']);
		$content = blog_safe_input_data($_POST['content']);
		
		if(!article_check_title($title) | !article_check_content($content)){
			
			$msg_errors = blog_show_error();
			
		}
		
		if ($msg_errors == null) {
			
			db_query("UPDATE articles SET title = :title, content = :content WHERE id_article='$edit_article'", [
				'title' => $title,
				'content' => $content
			]);
			
			header("Location: post.php?article_id=$edit_article");
			exit();
			
		}
		
	} else {

		if(!article_check_exists($edit_article, $article_show)){
			
			$msg_errors = blog_show_error();
			$article_show['title'] = 'Ошибка!';
			
		} else {
			
			$title = $article_show['title'];
			$content = $article_show['content'];
			
		}
		
	}
	
	$msg_errors = blog_show_error();
	
	include('views/view_edit.php');
	
?>