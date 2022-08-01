<?php

    include_once("db.php");

    // Получить все пользователей
    function get_users(){
        $query = db_query("SELECT * FROM users  ");
    
        return $query->fetchAll();
        }
    // Получить пользователя по логину
    function get_user_by_login($login){
        $query = db_query("SELECT * FROM users WHERE login=:login",
        ['login'=>$login]);

        return $query->fetch();
    }
    // получить пользователя по id
    function get_user($value,$field_name="id_user"){
        $query = db_query("SELECT name FROM users WHERE $field_name=:value",
        ['value'=>$value]);

        return  $query->fetch();
    }

    // Получить id пользователя
    function get_id_article_autor($name){
        $query = db_query("SELECT id_user FROM users WHERE name=:id_name",
        ['id_name'=>$name]);

        return $query->fetch();

    }