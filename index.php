<? include_once('functions.php');?>

<?//if(isAuth($user)):?>
	<!-- Привет,<?//=$user['login']?> <form action="logout.php" method="post"> <button name="logout">Выйти</button>  </form> -->
<?//else:?>
	<!-- <a href="auth.php">Войти</a><br> -->
<?//endif?>

<?php
	
	$query = db_query("SELECT * FROM news ORDER BY date_created DESC");

	$news = $query->fetchAll();
?>
	
<?foreach($news as $new):?>
	
	<a href="post.php?id_new=<?=$new['id_new']?>"><?=$new['title']?></a>
	<a href="edit.php?fname=<?=$new['id_new']?>"> &#9997</a><br>
	
<?endforeach?>
<a href="add.php">Добавить</a> 