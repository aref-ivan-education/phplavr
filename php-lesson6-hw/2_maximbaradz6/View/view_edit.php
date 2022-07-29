<p style="color:red"><?=$err?></p>
    <form method="post">
        <i>Название</i><br>                    
        <input type="text" name="title" value="<?=$articles['title']?>"><br>
        <i>Контент</i><br>
        <textarea name="content" cols="120" rows="22"><?=$articles['content']?></textarea><br>
        <input type="submit" value="Сохранить изменения">
    </form>
    <form method="post" action="delete.php?fname=<?=$fname?>">
    <input type='submit' value='Удалить' onclick="return confirm('Вы точно хотите удалить эту статью?')">
    </form>     
    <strong><?= "<br> <a href= main.php><img src='image/main.png' alt='На главную'></a>"?></strong>