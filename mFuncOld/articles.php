<?
    include_once("db.php");
    // Получить новость
    function get_article($id_article){

        $query = db_query("SELECT a.*,c.name as category, u.name as user
                           FROM articles as a LEFT JOIN categores as c
                           ON a.id_cat = c.id_cat
                           LEFT JOIN users as u 
                           ON a.id_user = u.id_user 
                           WHERE id_article=:id",
							['id'=>$id_article]);

		return $query->fetch();
    }
    // Получить все новости
    function get_article_all($order = "date DESC"){

        $query = db_query("SELECT a.*,c.name as category, u.name as user
                           FROM articles as a LEFT JOIN categores as c
                           ON a.id_cat = c.id_cat
                           LEFT JOIN users as u 
                           ON a.id_user = u.id_user
                           ORDER BY $order");
        // $query = db_query("SELECT * FROM articles ORDER BY $order");

	    return $query->fetchAll();
    }
    // добавить новость
    function set_article($data){

        db_query("INSERT INTO articles (title, content ,id_cat ,id_user) VALUES (:title, :content , :id_cat, :id_user)", $data);


        $db = db_connect();
		return $db->lastInsertId();
    }
    // Изменить новость
    function update_article($data){
            $key_mask=[];
            $sql="";
        foreach($data as $k=>$v){
            if($k!='id_article'){
                $key_mask[] = $k ." = :" . $k ;
            }
        }
        $key_mask=implode(' , ',$key_mask);
        $sql = "UPDATE articles SET " . $key_mask . " WHERE  id_article = :id_article";
        $query=db_query($sql, $data);
        return $query;
    }
    // удалить новость
    function delete_article($id_article){

        $query=db_query("DELETE FROM `articles` WHERE `id_article`=:id_article",[
            'id_article'=>$id_article
        ]);
        return $query;

    }
