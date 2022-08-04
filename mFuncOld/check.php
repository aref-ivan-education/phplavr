<?
    function checkID($id){
        $regName="#^[0-9]+$#";
        return preg_match($regName,$id);
        }

    function checkTitle($title){
            // $regName="#^[a-zA-Z0-9- ]+$#";
            $regName="#^[a-zA-Z0-9а-яА-Я-\s]+$#u";
            return preg_match($regName,$title);
        }
    function IsString($var){
        $regName="#^[a-zA-Z]+$#";
        return preg_match($regName,$var);

    }
    function checkMetod($metod,$class){
        return method_exists($class,$metod);
    }

    function cleanInput($text){
        return htmlspecialchars(stripcslashes(trim($text)));
    } 
    
?>