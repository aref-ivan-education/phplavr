<?php
    session_start();
    include_once("Model/auth.php");
    include_once("Model/articles.php");
      if(!isAuth()) :;
          header('Location: login.php');
          exit();             
      endif;   
  if(count($_POST) > 0) :;       
		      $title = trim($_POST['title']);         
		      $content = trim($_POST['content']);
          $title = htmlspecialchars($title);  
          $content = htmlspecialchars($content); 
		  if($title == '' || $content == '') :;         
	         $err = 'Ошибка: Заполните все поля!';        
      elseif(!check_contents($content)) :
          $err = 'Не допустимые символы в контенте!';
      else:
          insert_article($title, $content);
          header('Location: main.php');
          exit();
      endif;
    else :
          $title = '';
          $content = '';
  endif;   
          include("View/view_add.php");
?>
        