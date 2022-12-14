<?

namespace controllers;

use core\DB;
use core\DBDriver;
use models\UserModel;
use core\Check;

class UserController extends BaseController
{
    public function authAction()
    {
        $mUser = new UserModel(new DBDriver(DB::getConnect()));

        // Если зашли на авторицацию разлогинимся
        $logOut = $mUser->logOut();
        $msg = "";
        // Проверка на выход
        if( $logOut ){
            // Отправили форму
            if($this->request->isPost()){
                // Проверяем логин пароль
                $login = Check::cleanInput($this->request->post('login'));
                $password = Check::cleanInput($this->request->post('password'));
                // Ищем пользователя в базе
                $user = $mUser->getone("login",$login);
    
                // Если нашли и пароль правильный запоминаем в сессию
                if( $user && $password == $user['pass'])
                {
                    $_SESSION['isAuth'] = true;
                    $_SESSION['userName'] = $user['name']??$user['login'];			
                    $_SESSION['userLogin'] = $user['login'];
                    $_SESSION['userId'] = $user['id_user'];
                    // Если чекбокс 'запомнить' кидаем куки
                    if( $this->request->post('remember') )
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
                $_SESSION['loginRef'] = $this->request->server('HTTP_REFERER')??"/";
            }
        }
        $this->content = $this->build(
                        'v_auth',
                        [
                        'loginRef' => $_SESSION['loginRef'],
                        'msg' => $msg
                        ]);
        $this->title = "Авторизация";

    }
    public function logoutAction()
    {
        $mUser = new UserModel(new DBDriver(DB::getConnect()));
        $mUser->logOut();
        
       

    }
    

}