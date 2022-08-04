<? 
    // include_once("models/main.php");
    // include_once("models/articles.php");
    // include_once("models/categores.php");
    // include_once("models/users.php");
    include_once('mFuncOld/auth.php');
    // include_once('mFuncOld/check.php');
    use core\DB;
    use models\UserModel;
    use core\Check;
   
    

    function __autoload($classname) {
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    }
    // Включаем сессию
    session_start();
    // Подключение к базе данных
    $db = DB::connect();
    // Проверка на авторизацию
    $isAuth = isAuth();
    // $categores = get_article_categores();
    // $user_name = "";
    // $err404 = false;
    // Получение адреса
    $params = explode('/', $_GET['chpu']);
	$end = count($params) - 1;
	if($params[$end] === ''){
		unset($params[$end]);
		$end--;
	}

    if($isAuth){
        $uModel = new UserModel($db);
        $user = $uModel->getByLogin($_SESSION['userLogin']);
    }

	$controller = trim($params[0]??"articles");
    $controller = Check::cleanInput($controller);

    $action = $params[1]??'index';
    $action = Check::cleanInput($action);
    $action = sprintf('%sAction', $action);

    $id = isset($params[2]) && Check::id($params[2])? $params[2] : false;
    $id = Check::cleanInput($id);



    // var_dump($controller);
    // die;        
    switch ($controller) {
        case 'articles':
            $controller = 'Article';
            break;
        case 'user':
            $controller = 'User';
            break;
        
        default:
            $controller = "Base";
            $action = "error404";
            break;
    }

    $controller = sprintf('controllers\%sController', $controller);
    $controller = new $controller();
    $action = (method_exists($controller,$action))?$action : 'error404';
    $controller->setId($id);
    $controller->$action();
    $controller->render();




    
    // echo template('v_main', [

	// 	'title' => $title,
    //     'categores'=>$categores,
    //     'user_name'=>$user['name']??"",
    //     'isAuth'=>$isAuth,
	// 	'content' => $inner
	// ]);
?>

