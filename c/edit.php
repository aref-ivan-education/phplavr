<?
    include_once("m/articles.php");
    include_once('m/categores.php');
    include_once("m/users.php");
    include_once("m/check.php");
    include_once('m/auth.php');

    $msg="";
    $id_article = $params[1];
 
    $isAuth=isAuth();

    if(checkID($id_article) && $article = get_article($id_article) ){
        $autor = $article['user']??"";
        $categores = get_article_categores();

        if(count($_POST) > 0){
            $titlePost = cleanInput($_POST['title']);
            $contentPost = cleanInput($_POST['content']);
            $category = cleanInput($_POST['category']);
            $autor = cleanInput($article['user']);
    
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
                header("Location: /post/".$id_article);
                exit();
            }
            
        }

        $inner = template("v_edit",[
            'article' => $article,
            'categores' => $categores,
            'msg' => $msg   
        ]) ;        
        $title = "Редактирование статьи : " . $article['title'] ;
	}
    else{       
            $err404 = true;
    }

   
  
    

