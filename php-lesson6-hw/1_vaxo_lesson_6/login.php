<?php
session_start();

require_once 'config.php';
require_once 'lib.php';
require_once 'm/m_url.php';
require_once 'm/m_validate.php';
require_once 'c/c_auth.php';

check_session_auth();
check_cookie_auth();

$is_auth = is_auth();
$page_title = set_page_title(__FILE__);
$bad = false;

if (count($_POST) > 0) {
    $login = get_data('post', 'login');
    if (check_login($login))
        $bad = true;

    $password = get_data('post', 'password');
    if (check_password($password))
        $bad = true;

    $remember = get_data('post', 'remember');

    if (check_identity($login, 'admin') && check_identity($password, 'qwerty')) {

        set_session_params('admin', 'qwerty');
        if (isset($remember))
            set_cookie_params('admin', 'qwerty');

        if (isset($_SESSION['returnUrl'])) {
            redirect_user_to('returnUrl');
        } else {
            redirect_user_to('index.php');
        }
    }
    else $bad = true;

    if ($bad) {
        $login_errors = news_last_error('login');
        $password_errors = news_last_error('login');
        $log_pass_errors = news_last_error('log_pass');
    }
}

include 'v/v_login.php';
?>

