<?
    include_once("models/categores.php");
    // include_once("models/articles.php");
    include_once("models/check.php");
    include_once("models/auth.php");
    include_once("models/users.php");

use models\ArticleModel;
$mArticle = new ArticleModel($db);
    $isAuth= isAuth();
    $id_article = $params[1];
    if( checkID($id_article) && $article = $mArticle->getByID($id_article)){
        $inner=template('v_post',[
            'article' => $article,
            'isAuth' => $isAuth,
        ]);
        $title = $article['title'];
	}else{  
        $err404 = true;
    }