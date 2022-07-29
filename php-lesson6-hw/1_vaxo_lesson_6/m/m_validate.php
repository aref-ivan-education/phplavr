<?php

function not_filled($data) {
    return $data === '';
}

function not_given($data) {
    return $data === null;
}

function incorrect_data($data, $not_alowed) {
    return preg_match($not_alowed, $data);
}

function too_short($data, $min_length) {
    return mb_strlen($data) < $min_length;
}

function too_long($data, $max_length) {
    return mb_strlen($data) > $max_length;
}

function news_check_param($param) {
    $check = false;
    if (not_given($param)) {
        $check = true;
        news_last_error('param', ERROR_PARAM_GIVEN);
    }
    elseif (not_filled($param)) {
        $check = true;
        news_last_error('param', ERROR_PARAM_EMPTY);
    }
    elseif (incorrect_data($param, NOT_ALLOWED_IN_ID)) {
        $check = true;
        news_last_error('param', ERROR_PARAM_INCORRECT);
    }

    return $check;
}

function news_check_title($title) {
    $check = false;
    if (not_given($title)) {
        $check = true;
        news_last_error('title', ERROR_TITLE_GIVEN);
    }
    elseif (not_filled($title)) {
        $check = true;
        news_last_error('title', ERROR_TITLE_EMPTY);
    }
    elseif (too_short($title, TITLE_MIN)) {
        $check = true;
        news_last_error('title', ERROR_TITLE_SHORT);
    }
    elseif (too_long($title, TITLE_MAX)) {
        $check = true;
        news_last_error('title', ERROR_TITLE_BIG);
    }
    return $check;
}

function news_check_content($content) {
    $check = false;
    if (not_given($content)) {
        $check = true;
        news_last_error('content', ERROR_CONTENT_GIVEN);
    }
    elseif (not_filled($content)) {
        $check = true;
        news_last_error('content', ERROR_CONTENT_EMPTY);
    }
    elseif (too_short($content, CONTENT_MIN)) {
        $check = true;
        news_last_error('content', ERROR_CONTENT_SHORT);
    }
    elseif (too_long($content, CONTENT_MAX)) {
        $check = true;
        news_last_error('content', ERROR_CONTENT_BIG);
    }
    return $check;   
}

function news_article_not_exists($id) {
    $not_exists = false;
    $params = ['id_news'=> $id];
    $query = db_query('SELECT id_news FROM news WHERE id_news=:id_news', $params);
    $rslt = $query->fetchAll();
    if (count($rslt) != 1) {
        news_last_error('param', ERROR_ARTICLE_EXISTENCE);
        $not_exists = true;
    }
    return $not_exists;
}

function check_login($login) {
    $check = false;
    if (not_given($login)) {
        $check = true;
        news_last_error('login', ERROR_LOGIN_GIVEN);
    }
    elseif (not_filled($login)) {
        $check = true;
        news_last_error('login', ERROR_LOGIN_EMPTY);
    }
    elseif (too_short($login, LOGIN_MIN)) {
        $check = true;
        news_last_error('login', ERROR_LOGIN_SHORT);
    }
    elseif (too_long($login, LOGIN_MAX)) {
        $check = true;
        news_last_error('login', ERROR_LOGIN_BIG);
    }
    elseif (incorrect_data($login, NOT_ALLOWED_IN_LOGIN)) {
        $check = true;
        news_last_error('login', ERROR_LOGIN_INCORRECT);
    }
    return $check;
}

function check_password($password) {
    $check = false;
    if (not_given($password)) {
        $check = true;
        news_last_error('title', ERROR_PASSWORD_GIVEN);
    }
    elseif (not_filled($password)) {
        $check = true;
        news_last_error('password', ERROR_PASSWORD_EMPTY);
    }
    elseif (too_short($password, PASSWORD_MIN)) {
        $check = true;
        news_last_error('password', ERROR_PASSWORD_SHORT);
    }
    elseif (too_long($password, PASSWORD_MAX)) {
        $check = true;
        news_last_error('password', ERROR_PASSWORD_BIG);
    }
    elseif (check_necessary_simbols($password)) {
        $check = true;
        news_last_error('password', ERROR_NECESSARY_SIMBOLS);
    }
    return $check;
}

function check_necessary_simbols($password) {
	return false;
}

function check_identity($val1, $val2) {
    if (!$identity = $val1 == $val2)
        news_last_error('log_pass', ERROR_LOGIN_PASSWORD);
    return $identity;
}

function news_last_error($type, $msg = '') {
    static $last_errors = [];
    
    if ($msg) {
        $last_errors[$type][] = $msg;
    } else {
        return $last_errors[$type] ?? [];
    }
}

?>