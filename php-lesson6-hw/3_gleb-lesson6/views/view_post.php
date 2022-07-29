<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $article_show['title'] ?> | Блог</title>
        <link rel="stylesheet" href="./views/css/style.css">
    </head>
    <body>
		<div class="page_rubber">
			<div class="wrapper">
				<h1><?= $article_show['title'] ?></h1>
				<div class="content">
					<?php
						if ($msg_errors != null): ?>
							<div class="error_text">
								<?php foreach($msg_errors as $msg_error_one): ?>
									<p><?= $msg_error_one ?></p>
								<?php endforeach; ?>
							</div>
						<? endif;
						if ($msg_errors == null):
							echo nl2br($article_show['content']);
						endif;
					?>
				</div>
				<div class="nav">
					<div class="nav_link"><a href="<?= $add_link ?>">Редактировать</a> <a href="./">К списку статей</a></div>
				</div>
			</div>
		</div>
	</body>
</html>