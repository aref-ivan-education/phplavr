<?

namespace controllers;

use core\DB;
use models\UserModel;
use core\Check;

class UserController extends BaseController
{
    public function authAction()
    {
        $mUser = new UserModel(DB::connect());

        // Если зашли на авторицацию разлогинимся
        $logOut = $mUser->logOut();
        $msg = "";
        // Проверка на выход
        if( $logOut ){
            // Отправили форму
            if( count($_POST) > 0){
                // Проверяем логин пароль
                $login = Check::cleanInput($_POST['login']);
                $password = Check::cleanInput($_POST['password']);
                // Ищем пользователя в базе
                $user = $mUser->getByLogin($login);
    
                // Если нашли и пароль правильный запоминаем в сессию
                if( $user && $password == $user['pass'])
                {
                    $_SESSION['is_auth'] = true;
                    $_SESSION['userName'] = $user['name']??$user['login'];			
                    $_SESSION['userLogin'] = $user['login'];
                    // Если чекбокс 'запомнить' кидаем куки
                    if( isset($_POST['remember']) && $_POST['remember'] )
                    {
                        setcookie('login',$user['login'], time() + 3600 * 24 * 7, '/');
                        setcookie('pass',$mUser->myHash($user['pass']), time() + 3600 * 24 * 7, '/');
                    }
                    header('Location:'.$_SESSION['loginRef']);
                    unset( $_SESSION['loginRef'] );
                    exit();
                }
                else 
                {
                    if( !$user )
                    {
                        $msg = "Пользователь не найден";                       
                    }
                    else
                    {
                        $msg = "Пароль не верен";    
                    }
                }
            }
            else{
                $_SESSION['loginRef'] = $_SERVER['HTTP_REFERER']??"/";
            }
        }
        $this->content = $this->build(
                        __DIR__ . '/../v/v_auth.php',
                        [
                        'loginRef' => $_SESSION['loginRef'],
                        'msg' => $msg
                        ]);
        $this->title = "Авторизация";

    }
    

}