
<div class="row">
	<div class="column large-8 align-center" >

		<form method="post">
			<div>
                <label>Логин</label>
                <input class="h-full-width" type="text" placeholder="ваш логин" name="login">
            </div>
			<div>
				<label>Пароль</label>
                <input class="h-full-width" type="password" placeholder="Ваш пароль" name="password">
            </div>
			<label class="h-add-bottom">
                <input type="checkbox" name="remember">
                <span class="label-text">Запомнить меня</span>
            </label>
			<input type="submit" value="Войти">
			<button><a href='<?=$loginRef ?>'>вернуться</a></button>
		</form>
		<?if($msg!=''):?>
			<div class="alert-box alert-box--error">
				<p><?=$msg?></p>
				<span class="alert-box__close"></span>
			</div><!-- end error -->
		<?endif?>
	</div>
</div>
