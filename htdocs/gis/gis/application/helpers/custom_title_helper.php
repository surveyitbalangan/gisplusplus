<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('custom_title')){
    function customTitle($str){
        // $toLower = strtolower($str);
        // $rem_space = str_replace($toLower,' ','-');

        return strtolower(str_replace(' ','-',$str)).'.html';
        // return strtolower($str);
    }

    function customString($str){
        return strtolower(str_replace(' ','-',$str));
    }
}