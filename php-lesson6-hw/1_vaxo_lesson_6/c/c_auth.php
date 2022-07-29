<?php

function is_auth() {
    $is_auth = false;
    if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
       $is_auth = true;
    }
    elseif (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
        if ($_COOKIE['login'] == 'admin' && $_COOKIE['password'] == myhash('qwerty')) {
            $_SESSION['is_auth'] = true;
            $is_auth = true;
        }
    }
    return $is_auth;
}

function check_session_auth() {
	if (isset($_SESSION['is_auth']))
    	unset($_SESSION['is_auth']);
}

function check_cookie_auth() {
	if (isset($_COOKIE['login']))
    	setcookie('login', '', 1, '/');
	if (isset($_COOKIE['password']))
    	setcookie('password', '', 1, '/');
}

function set_session_params($login, $password) {
	$_SESSION['is_auth'] = true;
    $_SESSION['login'] = $login;
    $_SESSION['password'] = myhash($password);
}

function set_cookie_params($login, $password) {
	setcookie('login', $login, time() + 3600 * 24 * 30, '/');
    setcookie('password', myhash($password), time() + 3600 * 24 * 30, '/');
}

?>