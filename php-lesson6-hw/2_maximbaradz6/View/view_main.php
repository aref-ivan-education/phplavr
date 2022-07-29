<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
    </head>
  <body>
            <div>
            <h3 align="center">Шапка</h3>
            </div>
            <a href="add.php"><img src='image/arrownew.png' alt='Добавить статью'></a>
            <hr>
<?php             
    if(count($articles) == 0) :;
        echo 'Нет статей';
        else:
      foreach($articles as $article) :;?>
            <ul class="menu">
                <li><a href=post.php?fname=<?=$article['id']?>><?=$article['title']?></a><a href=edit.php?fname=<?=$article['id']?>><img src='image/hand.png' alt='Редактировать'></a></li>
            </ul>
            <? 
      endforeach;
    endif;?>
  </body>
</html>