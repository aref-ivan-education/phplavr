<?php

    include_once("m_db.php");
    
    function get_user_by_login($login){
        $query = db_query("SELECT * FROM users WHERE login=:login",
        ['login'=>$login]);

        return $query->fetch();
    }

    function get_article_autor($id_user){
        $query = db_query("SELECT name FROM users WHERE id_user=:id_user",
        ['id_user'=>$id_user]);

        return  $query->fetch();
    }

    // Получить id пользователя
    function get_id_article_autor($name){
        $query = db_query("SELECT id_user FROM users WHERE name=:id_name",
        ['id_name'=>$name]);

        return $query->fetch();

    }