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
?>