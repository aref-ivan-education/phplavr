<?php
  session_start();
  include_once("Model/articles.php");         
  $fname = $_GET['fname'] ?? null;
  $err404 = false;
        if($fname === null || $fname =='') :;
           $err404 = true;
        endif;    
        if(!check_fname($fname)) :;
            $err404 = true;            
        endif;
  $articles = show_article($fname);
        if($articles === false) :;
            $err404 = true;
        endif;    
        if($err404) :;
            echo " Ошибка 404!";
        else :
            include("View/view_post.php");
        endif;
?>   