<?php
	session_start();
    include_once("Model/articles.php");
    include_once("Model/auth.php");
    $articles = show_accept_articles();
    count($articles);    
    unsetSesCook();
    include("View/view_index.php"); 
?>
