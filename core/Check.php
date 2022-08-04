<?php

namespace core;


class Check
{

    static function id($id)
    {
        return Check::correct($id,'#^[0-9]+$#');
    }
  
    static function cleanInput($text){
        return htmlspecialchars(stripcslashes(trim($text)));
    } 

    private function notFilled($str)
    {
        return $str === '';
    }
    private function nonGiven($str) {
        return $str === null;
    }
    
    private function correct($str, $regExp) {
        return preg_match($regExp, $str);
    }

    private function tooShort($data, $min_length) {
        return mb_strlen($data) < $min_length;
    }
    
    private function tooLong($data, $max_length) {
        return mb_strlen($data) > $max_length;
    }

    
    

}