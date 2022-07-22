<?
    require_once("functions.php");

    session_start();

    $urlCurrent=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if(!isset($_SESSION['loginRef']) || isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=$urlCurrent){
        $_SESSION['loginRef']=$_SERVER['HTTP_REFERER'];
    }

    if(count($_POST) > 0){
        $id_new = $_POST['id_new'] ?? null;

        if($id_new!==null){
            // echo $id_new;
        
            $query = db_query(" SELECT * FROM news WHERE id_new = '$id_new' ");
                if($query->rowCount()){
                    // echo "Удаляю пост";
                    $query = db_query(" DELETE FROM news WHERE id_new = '$id_new' ");

                }
                else{
                    echo "Нет такого поста";
                }
            
        }
        else{
            echo "НЕ передан параметр";
        }
        header('Location:'.$_SESSION['loginRef']);
        unset($_SESSION['loginRef']);
    }else{
        header('Location:'.$_SESSION['loginRef']);
        unset($_SESSION['loginRef']);
    }
   
?>