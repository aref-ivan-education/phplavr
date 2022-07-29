<?php
session_start();
error_reporting(-1);

require_once 'config.php';
require_once 'lib.php';
require_once 'c/c_auth.php';
require_once 'm/m_article.php';
require_once 'm/m_url.php';
require_once 'm/m_validate.php';

$is_auth = is_auth();
if (!$is_auth) {
    $_SESSION['returnUrl'] = 'add.php';
    redirect_user_to('login.php');
}

$page_title = set_page_title(__FILE__);
$bad = false;

if (count($_POST) > 0) {

    $title = get_data('post', 'title');
    $content = get_data('post', 'content');

    if (news_check_title($title))
        $bad = true;

    if (news_check_content($content))
        $bad = true;

    if ($bad) {
        $title_errors = news_last_error('title');
        $content_errors = news_last_error('content');
    } else {
        if ($id = save_article($title, $content))
            redirect_user_to('post.php?id='.$id);
    }

}

include 'v/v_add.php';
?>

