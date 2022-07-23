<?
    include_once("../m/m_articles.php");
    include_once("../m/m_check.php");

    $id_article = $_GET['id_article'] ?? null;
	$err="";
    if(!checkID($id_article)){
		$err= 'Ошибка 404,  Статья не найдена';
	}else{
        $article=get_article($id_article);
        // var_dump($article);

        $categores=get_article_categores();
        $users=get_users();
        if(!$article){
            $err='Ошибка 404. Нет такой статьи!';
        }

    }


    include("../v/v_post.php");

?>