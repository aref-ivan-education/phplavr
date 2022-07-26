<?if($error==""):?>
        <form method="post">
            Название<br>
            <input type="text" name="title"value ="<?=$article['title']?>"><br>
            Контент<br>
            <textarea name="content"><?=$article['content']?></textarea><br>
            Категория<br>
            <select name="category" id="">
                <? foreach($categores as $item):?>
                    <?if($article['id_cat']==$item['id_cat']):?>
                        <option selected value="<?=$item['id_cat']?>"><?=$item['name']?></option>
                    <?else:?>
                        <option value="<?=$item['id_cat']?>"><?=$item['name']?></option>
                    <?endif?>
                <?endforeach?>
            </select><br>

            <input type="submit" value="редактировать"><br>

            <!-- <button><a href="index.php">Вернуться</a></button> -->
            <?=$msg;?>

        </form>	

    <?else:?>
        <?=$error?>
    <?endif?>
<?//else:?>
	<!-- Для редактирования статьи войдите под своим логином
	<a href="auth.php">Войти</a><br> -->
<?//endif?>