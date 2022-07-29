<?php
    session_start();
    include_once("Model/auth.php");
    include_once("Model/articles.php");    
      if(!isAuth()) :;
          header('Location: login.php');
          exit();
      endif;
    $fname = $_GET['fname'] ?? null;
    $err404 = false;     
      if(!check_fname($fname)) :;
            $err404 = true;            
      endif;
    if(count($_POST) > 0) :;        
		        $title = trim($_POST['title']);          
  		      $content = trim($_POST['content']);
            $title = htmlspecialchars($title);             
            $content = htmlspecialchars($content);                   
  		//Проверка на пустоту полей.
  		if($title == '' || $content == '') :;                
            $err = 'Ошибка: Заполните все поля!';                
      elseif(!check_contents($content)) :
            $err = 'Не допустимые символы в контенте!';
      else :
            update_article($fname, $title, $content);
            header('Location: main.php');
            exit();         
      endif;
    endif;
    //Получаем статью в поле
    $articles = show_article($fname);  
  if($err404) :;
        echo " Ошибка 404!";
  else :
        include("View/view_edit.php");
  endif;


  
    
    