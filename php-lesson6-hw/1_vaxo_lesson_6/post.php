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
$page_title = set_page_title(__FILE__);
$id_news = get_data('get', 'id');
$bad = false;

if (news_check_param($id_news))
	$bad = true;

if (!$bad && !$article = get_one_article($id_news)) 
	$bad = true;

if (isset($article['title']))
	$page_title .= ' - ' . $article['title'];

if ($bad) {
	$param_errors = news_last_error('param');
    $article_errors = news_last_error('article');
}

include 'v/v_post.php';
?>