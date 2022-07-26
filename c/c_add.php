<?
    include_once("../m/m_articles.php");
	include_once("../m/m_categores.php");
	include_once('../m/m_users.php');
    include_once("../m/m_check.php");
    include_once('../m/m_auth.php');


	$isAuth=isAuth();
		if($isAuth){
			$user_name = $_SESSION['userName'];
		}
	$categores = get_article_categores();

    if(count($_POST) > 0){
		$title = checkInput($_POST['title']);
		$content = checkInput($_POST['content']);			
		$category = checkInput($_POST['category']);
		$autor = checkInput(get_id_article_autor($user_name)[0]??'');
		
		if($title == '' || $content == ''){
			$msg = 'Заполните все поля';
		}
		/*
			проверка корректности title
			проверка уникальности title
		*/
		elseif(!checkTitle($title)){
			$msg = "Название должно содержать только буквы, числа и знак '-'";
		}


		else{

			$set=set_article(['title'=>$title,
                        	'content'=>$content,
							'id_cat'=>$category,
							'id_user'=>$autor,
							]);
							
			header("Location: /index.php");
			exit();
		}
	}
	else{
		$title = '';
		$content ='';
		$msg = '';
	}
	include('../v/v_add.php');
?>