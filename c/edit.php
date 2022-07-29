<?
    include_once("m/articles.php");
    include_once('m/categores.php');
    include_once("m/users.php");
    include_once("m/check.php");
    include_once('m/auth.php');

    $error="";
    $msg="";
    $id_article = $_GET['id_article']??"";
 
    $isAuth=isAuth();
    if(!checkID($id_article)){
	    $error = "Ошибка 404. Нет такой статьи.";
	}
    else{
        $article = get_article($id_article);
        if(!$article){
            $error = 'Ошибка 404. Нет такой статьи!';
        }
        else{
            $autor = get_user($article['id_user'])[0]??"";
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
        elseif($titlePost==$article['title']&&$contentPost==$article['content']&&$category==$article['id_cat']){
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
            header("Location: index.php?c=post&id_article=".$id_article);
		    exit();
        }
        
    }
    $inner = template("v_edit",[
        'error' => $error,
        'article' => $article,
        'categores' => $categores,
        'msg' => $msg

    ]) ;
    
        $title=( $error == '')? "Редактирование статьи : " . $article['title'] : "Ошибка 404";
  
    

