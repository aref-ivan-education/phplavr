<?php
    include_once("functions.php");
    $error="";
    $msg="";
    $id_new = $_GET['id_new'] ?? null;
    // $content=(is_file("posts/$title"))?file_get_contents("posts/$title"):'';
    if($id_new === null){
		$error="Ошибка 404. Нет такой статьи.";
	}
        $query = db_query("SELECT * FROM `news` WHERE id_new='$id_new'");
        $new = $query->fetch();
            if(!$new){
                $error='Ошибка 404. Нет такой статьи!';
            }
            else{
                $title=$new['title'];
                $content = $new['content'] ;


            }
    //проверки валидности заголовка
    // if($title == null){
    //     $error = 'Ошибка 404, не передано название';
    //     }
    //     elseif(!checkTitle($title)){
    //         $error ='Ошибка 404, не корректное название';
    //     }
    //     elseif(!file_exists('posts/' . $title)){
    //         $error ='Ошибка 404. Нет такой статьи!';
    //     }
    
    // если зашли post
    if(count($_POST) > 0){

        // получаем title и content из полей
        $titlePost = trim($_POST['title']);
        $contentPost = trim($_POST['content']);
        echo $title;
        echo $titlePost;
        echo $content;
        echo $contentPost;

        // проверка значений
        if($titlePost == '' || $contentPost == ''){
            $msg='Все поля должны быть заполнены';
        }
        elseif(!checkTitle($titlePost)){
            $msg = "Название должно содержать только буквы, числа и знак '-'";
        }
        elseif($titlePost==$title&&$contentPost==$content){
            $msg= 'Статья не изменена';
        }
        // проверка на изменение title и запись статьи
        else{
            db_query("UPDATE news SET title=:title, content=:content  WHERE id_new ='$id_new'", [
				'title' => $titlePost,
				'content' => $contentPost
			]);
			header("Location: index.php");
			exit();
        }

    }

?>
<?//if(isAuth($user)):?>
		<!-- Привет,<?//=$user['login']?> <form action="logout.php" method="post"> <button name="logout">Выйти</button>  </form> -->

    <?if($error==""):?>
        <form method="post">
            Название<br>
            <input type="text" name="title"value ="<?=$title?>"><br>
            Контент<br>
            <textarea name="content"><?=$content?></textarea><br>
            <input type="submit" value="редактировать"><br>
            <button><a href="index.php">Вернуться</a></button>
            <?=$msg;?>

        </form>	

    <?else:?>
        <?=$error?>
    <?endif?>
<?//else:?>
	<!-- Для редактирования статьи войдите под своим логином
	<a href="auth.php">Войти</a><br> -->
<?//endif?>
