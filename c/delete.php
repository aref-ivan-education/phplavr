<?
    include_once("m/articles.php");
    include_once("m/check.php");

    $id_article = $params[1];

    if(checkID($id_article)){
        delete_article($id_article);
        header('Location: /');
        exit();
    }else{
        header('Location: /post/' .$id_article);
        $msg='удаление не получилось';
        exit();

    }



