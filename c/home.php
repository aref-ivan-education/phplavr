<?  
    include_once("m/main.php");
    include_once("m/articles.php");
    include_once("m/categores.php");
    include_once("m/users.php");
    include_once('m/auth.php');
    $articles=get_article_all();
    
    $categores=get_article_categores();
    $users=get_users();
    $articles=add_field_name_by_id($articles,$categores,'category_name','id_cat','name');
    $articles=add_field_name_by_id($articles,$users,'autor','id_user','name');
    $inner = template('v_home',[
        "articles"=>$articles
    ]);

    $title = "Главная";

?>