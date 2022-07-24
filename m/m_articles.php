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

    function set_article($data){


        $query=db_query("INSERT INTO articles (title, content) VALUES (:title, :content)", [
            'title' => $data['title'],
            'content' => $data['content']
        ]);
        return $query;
    }

    function update_article($data){
        $query=db_query("UPDATE articles SET title = :title, content =:content ,id_cat = :id_cat ,id_user = :id_user WHERE id_article = :id_article", $data
        );
        return $query;
    }

    function get_article_category($article){
        $query = db_query("SELECT name FROM categores WHERE id_cat=:id_cat",
        ['id_cat'=>$article['id_cat']]);

        return  $query->fetch();    
    }

    function get_article_autor($article){
        $query = db_query("SELECT name FROM users WHERE id_user=:id_user",
        ['id_user'=>$article['id_user']]);

        return  $query->fetch();
    }    
    function get_id_article_autor($name){
        $query = db_query("SELECT id_user FROM users WHERE name=:id_name",
        ['id_name'=>$name]);

        return $query->fetch();

    }
    function get_article($id_article){

        $query = db_query("SELECT * FROM `articles` WHERE id_article=:id",
							['id'=>$id_article]);

		return $query->fetch();
    }
    
  
    
    

?>