<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa{
    
//    private $id_empresa;
    
    function __construct() {
//        $this->id_empresa = $id_empresa;
    }
    
    public function get_coordenadas($id){
        return '<h3>Aqui van las coordenadas de la empresa'.$id.' </h3>';
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

