<?
    // include_once("models/articles.php");
	include_once("models/categores.php");
	// include_once('models/users.php');
    include_once("models/check.php");
    include_once('models/auth.php');

use models\ArticleModel;
use models\UserModel;
$aModel = new ArticleModel($db);
$uModel = new UserModel($db); 


	$categores = get_article_categores();

    if(count($_POST) > 0){
		$title = cleanInput($_POST['title']);
		$content = cleanInput($_POST['content']);			
		$category = cleanInput($_POST['category']);
		$autor = cleanInput(get_id_user_by_name($user_name)[0]??'');
		
		if($title == '' || $content == ''){
			$msg = 'Заполните все поля';
		}

		elseif(!checkTitle($title)){
			$msg = "Название должно содержать только буквы, числа и знак '-'";
		}


		else{

			$set=$aModel->add(['title'=>$title,
                        	'content'=>$content,
							'id_cat'=>$category,
							'id_user'=>$autor,
							]);
							
			header("Location: /post/".$set);
			exit();
		}
	}
	else{
		$title = '';
		$content ='';
		$msg = '';
	}

	$inner = template('v_add',[
		'title'=>$title,
		'content'=>$content,
		'msg'=>$msg,
		'categores'=>$categores

	]);
	$title = "Добавление статьи";
?>