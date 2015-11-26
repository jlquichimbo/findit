<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu {

    
    private $arr_menu = array();
    
    function __construct($array) {
        $this->arr_menu = $array;
    }
    
    function construct_menu(){
        $menu = '<nav><ul>';
        foreach ($this->arr_menu as $opcion) {
            $menu .= '<li>'.$opcion.'</li>';
        }
        $menu .= '</ul></nav>';
        return $menu;
        
    }

}