<?

namespace controllers;

use core\DB;
use models\UserModel;
use core\Check;

class UserController extends BaseController
{
    public function authAction()
    {
        $mUser = new UserModel(DB::getConnect());

        // Если зашли на авторицацию разлогинимся
        $logOut = $mUser->logOut();
        $msg = "";
        // Проверка на выход
        if( $logOut ){
            // Отправили форму
            if($this->request->isPost()){
                // Проверяем логин пароль
                $login = Check::cleanInput($this->request->get('post','login'));
                $password = Check::cleanInput($this->request->get('post','password'));
                // Ищем пользователя в базе
                $user = $mUser->getByLogin($login);
    
                // Если нашли и пароль правильный запоминаем в сессию
                if( $user && $password == $user['pass'])
                {
                    $_SESSION['isAuth'] = true;
                    $_SESSION['userName'] = $user['name']??$user['login'];			
                    $_SESSION['userLogin'] = $user['login'];
                    $_SESSION['userId'] = $user['id'];
                    // Если чекбокс 'запомнить' кидаем куки
                    if( $this->request->get('post','remember') )
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
                $_SESSION['loginRef'] = $this->request->get('server','HTTP_REFERER')??"/";
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

    }
    

}