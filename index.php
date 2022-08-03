<? 
    include_once("models/main.php");
    // include_once("models/articles.php");
    include_once("models/categores.php");
    // include_once("models/users.php");
    include_once('models/auth.php');
    include_once('models/check.php');
    use core\DB;
    use models\UserModel;

    function __autoload($classname) {
        include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    }
    // Включаем сессию
    session_start();
    // Подключение к базе данных
    $db = DB::connect();
    // Проверка на авторизацию
    $isAuth = isAuth();
    $categores = get_article_categores();
    // $user_name = "";
    $err404 = false;
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

	$controller = trim($params[0]??'home');

    $controller = cleanInput($controller);

    if(file_exists("c/$controller.php")){
        include_once("c/$controller.php");
    }
    else{
        $title="Ошибка 404";
        $inner= template('v_404',[]);
    }


    
    echo template('v_main', [

		'title' => $title,
        'categores'=>$categores,
        'user_name'=>$user['name']??"",
        'isAuth'=>$isAuth,
		'content' => $inner
	]);
?>

