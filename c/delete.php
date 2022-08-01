<?
    // include_once("models/articles.php");
    include_once("models/check.php");
use models\ArticleModel;

$aModel= new ArticleModel($db);

    $id_article = $params[1];

    if(checkID($id_article)){
        $aModel->deleteByID($id_article);
        header('Location: /');
        exit();
    }else{
        header('Location: /post/' .$id_article);
        $msg='удаление не получилось';
        exit();

    }



