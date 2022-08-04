<? 
    // include_once("models/main.php");
    // include_once("models/articles.php");
    // include_once("models/categores.php");
    // include_once("models/users.php");
    // include_once('mFuncOld/auth.php');
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



    // Получение адреса
    $params = explode('/', $_GET['chpu']);
	$end = count($params) - 1;
	if($params[$end] === ''){
		unset($params[$end]);
		$end--;
	}

    $uModel = new UserModel($db);
    $uModel->isAuth();


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
        case 'users':
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
    if($uModel->isAuth){
        $userName = $uModel->getByLogin($_SESSION['userLogin'])['name'];

        $controller->setUserName($userName);
        $controller->setIsAuth($uModel->isAuth);
    }
    
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

