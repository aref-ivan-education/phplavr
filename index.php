<? 
    // include_once("m/main.php");
    // include_once("m/articles.php");
    // include_once("m/categores.php");
    // include_once("m/users.php");
    // include_once('m/auth.php');
    // include_once('m/check.php');
    use core\DB;
    use models\ArticleModel;

    function __autoload($classname) {
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    }

    $db = DB::connect();
    $aModel = new ArticleModel($db);

    $post = $aModel->getByID(8);

    var_dump($post);


//     $categores = get_article_categores();
//     $isAuth = isAuth();
//     $user_name = "";
//     $err404 = false;

//     $params = explode('/', $_GET['chpu']);
// 	$end = count($params) - 1;
	
// 	if($params[$end] === ''){
// 		unset($params[$end]);
// 		$end--;
// 	}
//     if($isAuth){
//         $user_name=$_SESSION['userName']??'anonim';
//     }

// 	$controller = trim($params[0]??'home');

//     $controller = cleanInput($controller);

//     if(file_exists("c/$controller.php")){
//         include_once("c/$controller.php");
//     }
//     else{
//         $title="Ошибка 404";
//         $inner= template('v_404',[]);
//     }


    
//     echo template('v_main', [

// 		'title' => $title,
//         'categores'=>$categores,
//         'user_name'=>$user_name,
//         'isAuth'=>$isAuth,
// 		'content' => $inner
// 	]);
// ?>

