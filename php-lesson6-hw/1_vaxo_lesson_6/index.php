<?php
session_start();
error_reporting(-1);

require_once 'config.php';
require_once 'lib.php';
require_once 'c/c_auth.php';
require_once 'm/m_article.php';
require_once 'm/m_view.php';

$is_auth = is_auth();
$page_title = set_page_title(__FILE__);
$articles = get_all_articles();

$views = ['compact', 'extended'];
$view = $_GET['view'] ?? 'compact';
include get_view($views, $view);


// 2. erti shesvlis certilis gaketeba
// 6. validacia checkis magivrad gadaecema yvela she
//    samocmebeli parametri