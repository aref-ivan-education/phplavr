<?
    include_once("../m/m_articles.php");
    include_once("../m/m_check.php");
    include_once('../m/m_auth.php');

    $error="";
    $msg="";
    $id_article = $_GET['id_article'] ?? null;

    $isAuth=isAuth();
    if($isAuth){
        $user_name = $_SESSION['userName']??'anonim';
    }

    if(!checkID($id_article)){
	    $error = "Ошибка 404. Нет такой статьи.";
	}
    else{
        $article = get_article($id_article);
        if(!$article){
            $error = 'Ошибка 404. Нет такой статьи!';
        }
        else{
            // $category = get_article_category($article)[0]??'';
            $autor = get_article_autor($article)[0]??"";
            $categores = get_article_categores();
        }
    }
    if(count($_POST) > 0){
        $titlePost = checkInput($_POST['title']);
        $contentPost = checkInput($_POST['content']);
        $category = checkInput($_POST['category']);
        $autor = checkInput(get_id_article_autor($user_name)[0]??'');

        if($titlePost == '' || $contentPost == ''){
            $msg='Все поля должны быть заполнены';
        }
        elseif(!checkTitle($titlePost)){
            $msg = "Название должно содержать только буквы, числа и знак '-'";
        }
        elseif($titlePost==$article['title']&&$contentPost==$article['content']){
            $msg= 'Статья не изменена';
        }
        else{
            $updateData=[  
                        'title'=>$titlePost,
                        'content'=>$contentPost,
                        'id_cat'=>$category,
                        'id_user'=>$autor,
                        'id_article'=>$id_article,  
            ]   ;
            update_article($updateData);
            header("Location: /c/c_post.php?id_article=".$id_article);
			exit();
        }
        
    }
    include("../v/v_edit.php")
?>

