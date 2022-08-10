<? 
    include_once ('config.php');
    use core\DB;
    use core\DBDriver;
    use core\Check;   
    use core\Request;
    use models\UserModel;

    // автозагрузка классов(надо изменить на новую)
    function __autoload($classname) {
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    }
    // Включаем сессию
    session_start();
    // Подключение к базе данных
    $db = new DBDriver( DB::getConnect());

    // Получение адреса
    $params = explode('/', $_GET['chpu']);
	$end = count($params) - 1;
	if($params[$end] === ''){
		unset($params[$end]);
		$end--;
	}

    // Подключаем модель пользователей. Смотрим авторизацию
    $uModel = new UserModel($db);
    // $uModel->isAuth();


    
	$controller = trim($params[0]??"article");
    $controller = Check::cleanInput($controller);

    $id = false;
    if(isset ($params[1]) && $params[1]!== "" && is_numeric($params[1]))
    {
        $id = $params[1];
        $params[1] = 'post';
    }
   
    $action = $params[1]??'index';
    $action = Check::cleanInput($action);
    
    if(!$id)
    {
        $id = (isset($params[2]) && is_numeric($params[2]) && $params[2] !== "")
              ?$params[2] : false;   
    }
    $id = Check::cleanInput($id);
    $_GET['id']=$id;
   
    switch ($controller) {
        case 'article':
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

    $request = new Request($_GET,$_POST,$_SERVER,$_COOKIE,$_FILES,$_SESSION);
    $controller = new $controller($request);

    $action = sprintf('%sAction', $action);
    $action = (method_exists($controller,$action))?$action : 'error404';

    $controller->$action();
    $controller->render();

?>

