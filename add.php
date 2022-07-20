<?php
    $regName="#^[a-zA-Z0-9- ]+$#";

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
		elseif(!preg_match($regName,$title)){
			$msg = "Название должно содержать только латинский буквы, числа и знак '-'";
		}

		elseif(file_exists('data/' . $title)){
			$msg= "такая статья уже существует";
		}

		else{
			file_put_contents("data/$title",$content);
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