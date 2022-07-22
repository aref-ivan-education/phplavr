<?
    require_once("functions.php");
	// if(isAuth($user)):?>
		<!-- Привет,<?//=$user['login']?> <form action="logout.php" method="post"> <button name="logout">Выйти</button>  </form> -->
<? if(count($_POST) > 0){
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

		// elseif(file_exists('posts/' . $title)){
		// 	$msg= "такая статья уже существует";
		// }

		else{
			db_query("INSERT INTO news (title, content) VALUES (:title, :content)", [
				'title' => $title,
				'content' => $content
			]);
			header("Location: index.php");
			exit();
		}
	}
	else{
		$title = '';
		$content ='';
		$msg = '';
	}
	
?>

<form method="post">
	Название<br>
	<input type="text" name="title" value = "<?= $title?>"><br>
	Контент<br>
	<textarea name="content"><?=$content?></textarea><br>
	<input type="submit" value="Добавить">
</form>
<?php echo $msg; ?>

<?//else:?>
	<!-- <a href="auth.php">Войти</a><br> -->
<?//endif?>