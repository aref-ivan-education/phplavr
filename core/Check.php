<?php

namespace core;


class Check
{
    static function id($id)
    {
        $f = false;
        $f = Check::correct($id,'#^[0-9]+$#');
        $f = Check::allowLenth($id,1,4);
        return $f;
    }
  
    static function cleanInput($text){
        return htmlspecialchars(stripcslashes(trim($text)));
    } 

    static function notFilled($str)
    {
        return $str === '';
    }
    static function nonGiven($str)
     {
        return $str === null;
    }
    
    static function correct($str, $regExp) 
    {
        return preg_match($regExp, $str);
    }

    static function tooShort($data, $min_length) 
    {
        return mb_strlen($data) < $min_length;
    }
    
    static function tooLong($data, $max_length)
     {
        return mb_strlen($data) > $max_length;
    }
    static function allowLenth($str,$min,$max)
    {
        $lengtStr = mb_strlen($str);
        return ($min <= $lengtStr )&&( $lengtStr <= $max);
    }

    
    

}