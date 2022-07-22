<? include_once('functions.php');?>

<?php
	
	$id_new = $_GET['id_new'] ?? null;
	$content="";
	

	if($id_new === null){
		echo 'Ошибка 404, не передано название';
	}
	else{
		$query = db_query("SELECT * FROM `news` WHERE id_new='$id_new'");
		$new = $query->fetch();
		

	// }
	// elseif(!file_exists('posts/' . $fname)){
	// 	echo 'Ошибка 404. Нет такой статьи!';
	// }
	// else{
		if($new){
			$content = $new["content"] ;
		}
		else{
			echo 'Ошибка 404. Нет такой статьи!';

		}

		
	}
?>
<?=$content?>