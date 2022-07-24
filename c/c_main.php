<?
    include_once("m/m_articles.php");
    $articles=get_article_all();
    $articles=set_article_category_name($articles);
    $articles=set_article_autor($articles);
    
    $categores=get_article_categores();
    $users=get_users();
   
    include("./v/v_main.php");

?>