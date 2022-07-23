<?
    include_once("m_db.php");

    function get_article_all($order = "date DESC"){

        $query = db_query("SELECT * FROM articles ORDER BY $order");

	    return $query->fetchAll();
    }
    function get_article_categores(){
        $query = db_query("SELECT * FROM categores  ");

	    return $query->fetchAll();
    }
    function get_users(){
        $query = db_query("SELECT * FROM users  ");

	    return $query->fetchAll();
    }
    function get_article($id_article){

        $query = db_query("SELECT * FROM `articles` WHERE id_article=:id",
							['id'=>$id_article]);

		return $new = $query->fetch();
    }
    

?>