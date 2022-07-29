<?php 
    //Функция подключения к базе
    function dataconnect() {
        static $db;
        if($db == null){
    $db = new PDO('mysql:host=localhost;dbname=myblog', 'root', '');
    $db->exec('SET NAMES UTF8');
    }
    return $db;
    }
    //Универсальная функция
    function db_query($sql, $params = []) {
        $db = dataconnect();
        $query = $db->prepare($sql);
        $query->execute($params);
        db_check_error($query);
        return $query;
    }
    //Функция проверки ошибки
    function db_check_error($query) {
        $info = $query->errorinfo();
        if($info[0] != PDO::ERR_NONE) {
            exit($info[2]);
        }
    }
    