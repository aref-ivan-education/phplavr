<?php

	include_once("db.php");
  //Вывод новостей
	function show_accept_articles() {
		$query = db_query("SELECT * FROM `articles` WHERE `is_accept` = :yes ORDER BY `id` DESC", [ 'yes' => 2 ]);
    	return $query->fetchAll();
	}
  //Вывод одной новости
	function show_article($fname) {
		$query = db_query("SELECT * FROM `articles` WHERE `id` = :f ",['f' => $fname ]);
        return $query->fetch();
	}
  //Обновление новости
	function update_article($fname, $title, $content) {
		db_query("UPDATE `articles` SET `title` = :t, `content` = :c, `is_accept` = :yes WHERE `id`= :f " ,
               [
              't' => $title,
              'c' => $content,
              'f' => $fname,
              'yes' => 0
                ]);
          return true;
	}
  //Добавление новости
	function insert_article($title, $content) {
		$query = db_query("INSERT INTO `articles` (`title`, `content`, `author`) VALUES (:t, :c, :a)", 
                [
              't' => $title,
              'c' => $content,
              'a' => '1'
                ]);
        return true;
	}
   //Удаление новости
	function delete_article($fname) {
		db_query("DELETE FROM `articles` WHERE `id`=:fname ",[ 'fname' => $fname ]);
        return true;
	}

   //Функция проверки валидности контента
     function check_contents($content) {
         
        return (preg_match("/^[а-яА-ЯёЁa-zA-Z\d\s\?!;:.,()-]+$/iu", $content));
         
}
    //Функция проверки валидности гет запроса
     function check_fname($fname) {
         
        return (preg_match("/^[\d]+$/", $fname));
  
}