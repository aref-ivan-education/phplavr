<p style="color:red"><?=$err?></p>
<form method="post">
            <i>Название</i><br>                    
                 <input type="text" name="title" value= "<?=$title?>"><br>
            <i>Контент</i><br>
                    <textarea name="content" placeholder="<?=$content?>"></textarea><br>
                    <input type="submit" value="Добавить">
        </form>
        <strong><?= $msg, "<br> <a href= main.php><img src='image/main.png' alt='На главную'></a>"?></strong>