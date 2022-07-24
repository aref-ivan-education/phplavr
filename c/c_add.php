<?
    include_once("../m/m_articles.php");
    include_once("../m/m_check.php");

    if(count($_POST) > 0){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		
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
                        'content'=>$content]);
            var_dump($set->rowCount());
			// header("Location: index.php");
			// exit();
		}
	}
	else{
		$title = '';
		$content ='';
		$msg = '';
	}
	include('../v/v_add.php');
?>