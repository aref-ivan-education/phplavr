<?php
require_once 'm_db.php';

function get_all_articles() {
    $query = db_query('SELECT * FROM news ORDER BY dt DESC');
    $articles = $query->fetchAll();
    return $articles;
}

function get_one_article($id) {
    $params = ['id_news' => $id];
    $query = db_query('SELECT title, content, dt FROM news WHERE id_news = :id_news', $params);
    if (!$article = $query->fetch()) {
        news_last_error('article', ERROR_ARTICLE_EXISTENCE);
    }
    return $article;
}

function save_article($title, $content) {
    $params = ['title' => $title, 'content' => $content];
    $query = db_query('INSERT INTO news (title, content) VALUES(:title, :content)', $params);
    $db = db_connect();
    return $db->lastInsertId();;
}

function edit_article($id_news, $title, $content) {
    $params = ['id_news' => $id_news, 'title' => $title, 'content' => $content];
    $query = db_query('UPDATE news SET title=:title, content=:content WHERE id_news=:id_news', $params);
    return $query;
}

?>