<?php

	function article_check_title($title){
		
		if($title == ''){
			
			blog_show_error('Введите заголовок.');
			return false;
			
		} elseif(iconv_strlen($title) > 128){
			
			blog_show_error('Максимальная длина заголовка — 128 символов.');
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	
	function article_check_content($content){
		
		if($content == ''){
		
			blog_show_error('Введите текст статьи.');
			return false;
			
		} else {
			
			return true;
			
		}
		
	}
	
	function article_check_exists($article_id, $article_show){
		
		if ($article_id === null || !$article_show || !preg_match("/^[0-9]+$/", $article_id)){
			
			blog_show_error('Ошибка 404.');
			return false;
			
		} else {
			
			return true;
			
		}
		
	}

?>