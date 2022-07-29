<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Просмотр статей | Блог</title>
        <link rel="stylesheet" href="./views/css/style.css">
    </head>
    <body>
		<div class="page_rubber">
			<div class="wrapper">
				<h1>Просмотр статей</h1>
				<div class="content">
					<?php if (count($list) > 0): ?>
						<?php foreach($list as $article):
							if($is_auth):
								$edit_link = '(<a href="edit.php?article_id=' . $article['id_article'] . '">Редактировать</a>)';
							endif; ?>
							<div class="article-link"><span class="date"><?= $article['date'] ?> | </span><a href="post.php?article_id=<?= $article['id_article'] ?>"><?= $article['title'] ?></a> <?= $edit_link ?></div>
						<?php endforeach;
					else: ?>
						<p>Статей нет.</p>
					<?php endif; ?>
				</div>
				<div class="nav">
					<div class="nav_link"><a href="<?= $add_link ?>.php">Добавить статью</a><?= $logout ?></div>
				</div>
			</div>
		</div>
	</body>
</html>