<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estadolocal extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->user->check_session();
        $this->load->model('empresa_model');
    }
    public function desactivarHorario($id, $estado){
        $local = $this->empresa_model->desactivarHorario($id, $estado);
        if(!empty($local)) {
            echo $local;
        }
        
    }

    /* function vista_registrar_empresa() {
      $infoPage['titulo'] = 'Registrar Empresa';
      $this->load->view('login/header_login', $infoPage);
      $this->load->view('admin/empresa_register_form');
      $this->load->view('portal/static/footer');
      }


      function datos_usuario(){
      $this->load->model('usuario_model');

      $data_user['data_user'] = $this->usuario_model->get_user_data();
      $this->load->view('login/header_login');
      $this->load->view('admin/datos_registro',$data_user);
      $this->load->view('portal/static/footer');
      } */
}