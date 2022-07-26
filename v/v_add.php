<form method="post">
	Название<br>
	<input type="text" name="title" value = "<?= $title?>"><br>
	Контент<br>
	<textarea name="content"><?=$content?></textarea><br>
	Категория<br>
	<select name="category" id="">
		<? foreach($categores as $item):?>
			<option value="<?=$item['id_cat']?>"><?=$item['name']?></option>
		<?endforeach?>
	</select><br>
	<input type="submit" value="Добавить">
</form>
 <?=$msg; ?> 