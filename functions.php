<?php
    $user=[  
        "login" => "aris",
        "password" => "Terrika"]
    ;
    function isAuth($user){
        session_start();
        $isAuth=FALSE;

        if(isset($_SESSION['is_auth']) && $_SESSION['is_auth']){ 
           $isAuth=TRUE;
  
        }
        if ((isset($_COOKIE['login']) && $_COOKIE['login'] == $user['login']) && (isset($_COOKIE['password']) && $_COOKIE['password'] == myhash($user['password']))){
           
           $isAuth=TRUE;
           $_SESSION['is_auth'] = true;			
           
        }
  
        return $isAuth;
     }
    function checkTitle($title){
        $regName="#^[a-zA-Z0-9- ]+$#";
        return preg_match($regName,$title);
    } 

    function myHash($str){
		return hash('sha256', $str . 'erwdsddsdsds');
   }
?>