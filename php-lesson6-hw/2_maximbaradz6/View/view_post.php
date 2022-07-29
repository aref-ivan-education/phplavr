
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
    <h4><?=$articles['title']?></h4><hr>
    <p><?=$articles['login'] . ' ' . $articles['pubdate']?></p><hr>
    
    <p><?=nl2br($articles['content'])?></p>
    <hr><a href="main.php"><img src='image/main.png' alt='На главную'></a>
</body>
</html>
 