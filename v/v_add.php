<div class="row">
	<div class="column large-8 align-center" >
		<form method="post">
			<div>
				<label>Название</label>
				<input class="h-full-width" type="text" name="title" value = "<?= $title?>"><br>
			</div>
			<div>
				<label>Контент</label>
				<textarea class="h-full-width" type="text" name="content"><?=$content?></textarea>

			</div>
			<div>
				<label>Категория</label>
				<div class="ss-custom-select">
					<select class="h-full-width" name="category" >
						<? foreach($categores as $item):?>
							<option value="<?=$item['id_cat']?>"><?=$item['name']?></option>
						<?endforeach?>
					</select>
				</div>
			</div>

			<input type="submit" value="Добавить">
		</form>
		<?if($msg!=''):?>
			<div class="alert-box alert-box--error">
				<p><?=$msg?></p>
				<span class="alert-box__close"></span>
			</div><!-- end error -->
		<?endif?>
	</div>
</div>