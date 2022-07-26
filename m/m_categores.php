<?php 
    include_once('m_db.php');

    // получить все категории
    function get_article_categores(){
        $query = db_query("SELECT * FROM categores  ");

	    return $query->fetchAll();
    }
    // получить название категории новости
    function get_name_article_category($id_cat){
        $query = db_query("SELECT name FROM categores WHERE id_cat=:id_cat",
        ['id_cat'=>$id_cat]);

        return  $query->fetch();    
    }
