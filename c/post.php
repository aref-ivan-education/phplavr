<?
    include_once("m/categores.php");
    include_once("m/articles.php");
    include_once("m/check.php");
    include_once("m/auth.php");
    include_once("m/users.php");


    $isAuth= isAuth();
    $id_article = $params[1];
    if( checkID($id_article) && $article = get_article( $id_article)){
        $inner=template('v_post',[
            'article' => $article,
            'isAuth' => $isAuth,
        ]);
        $title = $article['title'];
	}else{  
        $err404 = true;
    }