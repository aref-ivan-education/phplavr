<?
    include_once("m/m_articles.php");
    $articles=get_article_all();
    
    $categores=get_article_categores();
    $users=get_users();
    $articles=add_field_name_by_id($articles,$categores,'category_name','id_cat','name');
    $articles=add_field_name_by_id($articles,$users,'autor','id_user','name');

    var_dump($articles);
    // include("./v/v_main.php");

?>