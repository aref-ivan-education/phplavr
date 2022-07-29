<?php
session_start();
error_reporting(-1);

require_once 'config.php';
require_once 'lib.php';
require_once 'm/m_article.php';
require_once 'm/m_url.php';
require_once 'm/m_validate.php';
require_once 'c/c_auth.php';

$is_auth = is_auth();
if (!$is_auth) {
    $_SESSION['returnUrl'] = 'edit.php?id='.$id;
    redirect_user_to('login.php');
}

$page_title = set_page_title(__FILE__);
$id = get_data('get', 'id');
$bad = false;

if (news_check_param($id))
    $bad = true;

if (count($_POST) > 0) {
    $title = get_data('post', 'title');
    $content = get_data('post', 'content');

    if (!$bad && news_check_content($content))
        $bad = true;

    if (news_check_title($title))
        $bad = true;

    if (!$bad && news_article_not_exists($id))
        $bad = true;

    if (!$bad && edit_article($id, $title, $content))
        redirect_user_to('post.php?id='.$id);
    else
        $bad = true;
}

else {

    if (!$bad && !$article = get_one_article($id))
        $bad = true;
}

 if ($bad) {
    $title_errors = news_last_error('title');
    $content_errors = news_last_error('content');
    $param_errors = news_last_error('param');
} else {
    $title = $article['title'];
    $content = $article['content'];
}

include 'v/v_edit.php';
?>