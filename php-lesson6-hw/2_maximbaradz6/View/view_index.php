<!DOCTYPE html>
	<html lang="en">
		<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Document</title>
		</head>
	<body>
		<h3 align="center">Шапка</h3><hr>
<?php
	if(count($articles) == 0) :;
        echo 'Нет статей<br><hr>';
     else :
		foreach($articles as $article) :;
?>
	<ul class="menu">
        <li><a href=post.php?fname=<?=$article['id']?>><?=$article['title']?></a></li>
    </ul>	
<?php 
		endforeach;
	endif; 
	echo '<a href="login.php"><img src="image/in.png" alt="Войти"></a>';
?>
</body>
</html>