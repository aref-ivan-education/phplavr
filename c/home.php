<?  
    include_once("models/main.php");
    // include_once("models/articles.php");
    include_once("models/categores.php");
    include_once("models/users.php");
    include_once('models/auth.php');

    use models\ArticleModel;

    $aModel = new ArticleModel($db);



    // $articles=get_article_all();
    $articles=$aModel->getAll();
    // var_dump($articles);
    $categores=get_article_categores();
    $users=get_users();
    // $articles=add_field_name_by_id($articles,$categores,'category_name','id_cat','name');
    // $articles=add_field_name_by_id($articles,$users,'autor','id_user','name');
    $inner = template('v_home',[
        "articles"=>$articles
    ]);

    $title = "Главная";

?>