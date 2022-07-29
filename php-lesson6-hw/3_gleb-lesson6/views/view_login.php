<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Авторизация на сайте | Блог</title>
        <link rel="stylesheet" href="./views/css/style.css">
    </head>
    <body>
		<div class="page_rubber">
			<div class="wrapper">
				<h1>Авторизация на сайте</h1>
				<div class="content">
					<?php if ($msg_errors != null): ?>
						<div class="error_text">
							<?php foreach($msg_errors as $msg_error_one): ?>
								<p><?= $msg_error_one ?></p>
							<?php endforeach; ?>
						</div>
					<?php endif;?>
					<form method="post">
						<div class="form_item"><input type="text" name="login" value="<?= blog_safe_input_data($_POST['login']) ?>" placeholder="Логин"></div>
						<div class="form_item"><input type="password" name="password" placeholder="Пароль"></div>
						<div class="form_item"><input type="checkbox" name="remember">Запомнить</div>
						<div class="form_submit"><input type="submit" value="Войти"></div>
					</form>
				</div>
				<div class="nav">
					<div class="nav_link"><a href="./">Назад</a></div>
				</div>
			</div>
		</div>
	</body>
</html>