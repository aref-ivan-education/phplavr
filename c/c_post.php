<?
    include_once("../m/m_articles.php");
    include_once("../m/m_check.php");
    include_once("../m/m_auth.php");

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
            $category=get_article_category($article)[0];
            $autor=get_article_autor($article)[0];
        }

    }
    include("../v/v_post.php");

?>