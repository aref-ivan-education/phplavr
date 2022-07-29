<?
    include_once('db.php');
    
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

    function template($filename, $vars = []){
		extract($vars);
		
		ob_start();
		include "v/$filename.php";
		return ob_get_clean();
	}
