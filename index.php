<a href="auth.php">Войти</a><br>

<?php
	
	$list = scandir('posts');
	
	foreach($list as $fname):
		if(is_file("posts/$fname")):?>
			<a href="post.php?fname=<?=$fname?>"><?=$fname?></a>
			<a href="edit.php?fname=<?=$fname?>"> &#9997</a><br>
		<?endif?>
	<?endforeach?>
<a href="add.php">Добавить</a>