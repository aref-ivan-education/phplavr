<?php
    session_start();
    include_once("Model/auth.php");
    include_once("Model/articles.php");
      if(!isAuth()) :;
          header('Location: login.php');
          exit();
      endif;    
      $fname = $_GET['fname'] ?? null;   
      if($fname === null) :;           
          exit("<strong>Ошибка 404. Не правильный параметр!</strong>");
      elseif (!check_fname($fname)) :
          exit('Не правильное действие!');
      else :
          delete_article($fname);              
          header('Location: main.php');
          exit();
      endif;     
        header('Location: main.php');
      exit();