<?
    include_once("m/categores.php");
    include_once("m/articles.php");
    include_once("m/check.php");
    include_once("m/auth.php");
    include_once("m/users.php");


    $isAuth= isAuth();
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
            $autor=get_user($article['id_user'])[0];
        }

    }
    $inner=template('v_post',[
                    'article' => $article??"",
                    'category' => $category??"",
                    'autor' => $autor??"",
                    'isAuth' => $isAuth,
                    'err' => $err

    ]);
    // include("../v/v_post.php");
    $title = $article['title']??"Ошибка 404";

?>