<?
    include_once("m/articles.php");
	include_once("m/categores.php");
	include_once('m/users.php');
    include_once("m/check.php");
    include_once('m/auth.php');


	$isAuth=isAuth();
		if($isAuth){
			$user_name = $_SESSION['userName'];
		}
	$categores = get_article_categores();

    if(count($_POST) > 0){
		$title = cleanInput($_POST['title']);
		$content = cleanInput($_POST['content']);			
		$category = cleanInput($_POST['category']);
		$autor = cleanInput(get_id_article_autor($user_name)[0]??'');
		
		if($title == '' || $content == ''){
			$msg = 'Заполните все поля';
		}

		elseif(!checkTitle($title)){
			$msg = "Название должно содержать только буквы, числа и знак '-'";
		}


		else{

			$set=set_article(['title'=>$title,
                        	'content'=>$content,
							'id_cat'=>$category,
							'id_user'=>$autor,
							]);
							
			header("Location: /index.php?c=post&id_article=".$set);
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