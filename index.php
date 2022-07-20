<?php
	
	$list = scandir('data');
	
	foreach($list as $fname):
		if(is_file("data/$fname")):?>
			<a href="post.php?fname=<?=$fname?>"><?=$fname?></a>
			<a href="edit.php?fname=<?=$fname?>">  Редактировать</a><br>
		<?endif?>
	<?endforeach?>
<a href="add.php">Добавить</a>