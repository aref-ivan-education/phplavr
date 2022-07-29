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
						<?php endif;
						if (count($_POST) > 0 || $msg_errors == null): ?>
							<form method="post">
								<div class="form_item"><input type="text" name="title" value="<?= $title ?>" placeholder="Название"></div>
								<div class="form_item"><textarea name="content" placeholder="Текст статьи"><?= $content ?></textarea></div>
								<div class="form_submit"><input type="submit" value="Изменить"></div>
							</form>
						<?php endif;
					?>
				</div>
				<div class="nav">
					<div class="nav_link"><a href="./">Назад</a></div>
				</div>
			</div>
		</div>
	</body>
</html>