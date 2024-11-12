<?php


namespace App\Classes;


class StringConversion
{

    public static function stringToUpper($value){
        return strtoupper($value);
    }

    public static function stringToLower($value){
        return strtolower($value);
    }

    public static function stringToUpperCaseFirst($value){
        return ucfirst($value);
    }

    public static function stringToLowerCaseFirst($value){
        return lcfirst($value);
    }

    public static function stringToUpperCaseWords($value){
        return ucwords($value);
    }


    public static function stringUpperArray($value) {
        if (is_array($value)) {
            return array_map('stringUpperArray', $value);
        }
        return strtoupper($value);
    }

}