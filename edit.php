<?php
    include_once("functions.php");
    var_dump($_SESSION);
    $error="";
    $msg="";
    $title=$_GET["fname"] ?? null;
    $content=(is_file("posts/$title"))?file_get_contents("posts/$title"):'';
    // если зашли get
	if(!count($_POST) > 0){
        //проверки валидности заголовка
        if($title == null){
            $error = 'Ошибка 404, не передано название';
            }
            elseif(!checkTitle($title)){
                $error ='Ошибка 404, не корректное название';
            }
            elseif(!file_exists('posts/' . $title)){
                $error ='Ошибка 404. Нет такой статьи!';
            }
    }
    // если зашли post
    else{

        // получаем title и content из полей
        $titlePost = trim($_POST['title']);
        $contentPost = trim($_POST['content']);

        //проверка значений
        if($titlePost == '' || $contentPost == ''){
            $msg='Все поля должны быть заполнены';
        }
        elseif(!checkTitle($titlePost)){
            $msg = 'некорректное название';
        }
        elseif($titlePost==$title&&$contentPost==$content){
            $msg= 'Статья не изменена';
        }
        // проверка на изменение title и запись статьи
        else{
            if($titlePost==$title){
                file_put_contents("posts/$title",$contentPost);
                header("Location: index.php");
                exit();
            }
            else{
                unlink("posts/$title");
                file_put_contents("posts/$titlePost",$contentPost);
                header("Location: index.php");
                exit();

            }
        }

    }

?>
<?if($error==""):?>
    <form method="post">
        Название<br>
        <input type="text" name="title"value =<?=$title?>><br>
        Контент<br>
        <textarea name="content">'<?=$content?></textarea><br>
        <input type="submit" value="редактировать"><br>
        <button><a href="index.php">Вернуться</a></button>
        <?=$msg;?>

    </form>	

<?else:?>
    <?=$error?>
<?endif?>