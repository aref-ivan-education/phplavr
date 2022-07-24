<?
    include_once("m/m_articles.php");
    include_once("m/m_main.php");
    include_once('m/m_auth.php');
    $articles=get_article_all();
    
    $categores=get_article_categores();
    $users=get_users();
    $articles=add_field_name_by_id($articles,$categores,'category_name','id_cat','name');
    $articles=add_field_name_by_id($articles,$users,'autor','id_user','name');
    $isAuth=isAuth();

    if($isAuth){
        $user_name=(isset($_COOKIE['login']))?get_user($_COOKIE['login'])['name']:'anonim';
    }

    
    include("./v/v_main.php");

?>