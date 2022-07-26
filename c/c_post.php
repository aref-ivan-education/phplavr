<?
    include_once("../m/m_categores.php");
    include_once("../m/m_articles.php");
    include_once("../m/m_check.php");
    include_once("../m/m_auth.php");
    include_once("../m/m_users.php");

    $isAuth=isAuth();
    if($isAuth){
        $user_name=$_SESSION['userName']??'anonim';
    }

    $id_article = $_GET['id_article'] ?? null;
	$err="";
    if(!checkID($id_article)){
		$err= 'Ошибка 404,  Статья не найдена';
	}else{
        $article=get_article($id_article);
       
        if(!$article){
            $err='Ошибка 404. Нет такой статьи!';
        }
        else{
            $category=get_name_article_category($article['id_cat'])[0];
            $autor=get_article_autor($article['id_user'])[0];
        }

    }
    include("../v/v_post.php");

?>