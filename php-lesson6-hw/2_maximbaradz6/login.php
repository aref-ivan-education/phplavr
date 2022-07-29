<?php
	session_start();
    include_once("Model/db.php");
    include_once("Model/auth.php");
    dataconnect();   
    unsetSesCook();    
	authorization();	
	include("View/view_login.php");	
?>


