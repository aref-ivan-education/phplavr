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
    
    function add_field_name_by_id($change_arr,$targetArr,$field_name,$id_name,$name){

        for ($i=0; $i <count($change_arr) ; $i++) { 
            if($change_arr[$i][$id_name]!='0'){

                foreach($targetArr as $item){
                    if($change_arr[$i][$id_name]==$item[$id_name]){
                        $change_arr[$i][$field_name]=$item[$name];
                        break;
                    }
                    else{
                        $change_arr[$i][$field_name]="";
                    }
                }
            }
            else{
                $change_arr[$i][$field_name]="";  
            }
        }
        return $change_arr;
    }
    
    

?>