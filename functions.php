<?php

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
        // $regName="#^[a-zA-Z0-9- ]+$#";
        $regName="#^[a-zA-Z0-9а-яА-Я-\s]+$#u";
        return preg_match($regName,$title);
    } 

    function checkID($id){
        $regName="#^[0-9]+$#";
        return preg_match($regName,$id);

    }

    function myHash($str){
		return hash('sha256', $str . 'erwdsddsdsds');
   }

   function db_connect(){
    static $db;

    if($db==null){
        $db = new PDO('mysql:host=localhost;dbname=phplavr_news', 'root' , '');
        $db->exec('SET NAMES UTF8');
    }
    return $db;
   }
   function db_query($sql, $params = []){
        $db = db_connect();
        
        $query = $db->prepare($sql);
        $query->execute($params);
        
        db_check_error($query);
        
        return $query;
    }

    function db_check_error($query){
        $info = $query->errorInfo();

        if($info[0] != PDO::ERR_NONE){
            exit($info[2]);
        }
    }


?>