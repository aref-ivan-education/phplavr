<?php
	session_start();
    include_once("Model/auth.php");
    include_once("Model/articles.php");
    if(!isAuth()) :;
        header('Location: index.php');
        exit();            
    endif;    
    $articles = show_accept_articles();
    count($articles);
    include("View/view_main.php");   
    if(!inout()) :;
        exit();
    else :
        hello();
    endif;
    ?>
