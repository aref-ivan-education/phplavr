<? include_once('functions.php');?>

<?php
	
	$id_new = $_GET['id_new'] ?? null;
	$err="";

	if(!checkID($id_new)){
		$err= 'Ошибка 404,  Статья не найдена';
	}
	else{
		$query = db_query("SELECT * FROM `news` WHERE id_new=:id",
							['id'=>$id_new]);
		$new = $query->fetch();
		
		if($new){
			$content = $new["content"] ;
		}
		else{
			$err='Ошибка 404. Нет такой статьи!';

		}

		
	}
?>
<?if($err==""):?>
	<?=$content?>
<?else:?>
	<?=$err?>
<?endif?>