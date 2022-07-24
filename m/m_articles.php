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
    function get_users(){
        $query = db_query("SELECT * FROM users  ");

	    return $query->fetchAll();
    }
    function get_article($id_article){

        $query = db_query("SELECT * FROM `articles` WHERE id_article=:id",
							['id'=>$id_article]);

		return $new = $query->fetch();
    }
    function set_article_category_name($articles){
        $categores=get_article_categores();
        for ($i=0; $i <count($articles) ; $i++) { 
            if($articles[$i]['id_cat']!='0'){
                foreach($categores as $category){
                    if($articles[$i]['id_cat']==$category['id_cat']){
                        $articles[$i]['category']=$category['name'];
                        break;
                    }
                    else{
                        $articles[$i]['category']="";
                    }
                }
            }
            else{
                $articles[$i]['category']="";  
            }
        }
        return $articles;
    }
    function set_article_autor($articles){
        $users=get_users();
        for ($i=0; $i <count($articles) ; $i++) { 
            if($articles[$i]['id_user']!='0'){
                foreach($users as $user){
                    if($articles[$i]['id_user']==$user['id_user']){
                        $articles[$i]['autor']=$user['name'];
                        break;
                    }
                    else{
                        $articles[$i]['autor']=""; 
                    }
                }
            }
            else{
                $articles[$i]['autor']="";  
            }
        }
        return $articles;
    }
    

?>