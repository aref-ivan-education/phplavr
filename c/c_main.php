<?
    include_once("m/m_articles.php");
    $articles=get_article_all();
    $categores=get_article_categores();
    $users=get_users();



    include("./v/v_main.php");

?>