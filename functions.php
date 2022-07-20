<?php

    function checkTitle($title){
        $regName="#^[a-zA-Z0-9- ]+$#";
        return preg_match($regName,$title);
    } 
?>