<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estadolocal extends CI_Controller {
    private $res_msj = '';
    function __construct() {
        parent::__construct();

        $this->user->check_session();
        $this->load->model('empresa_model');
    }
    public function desactivarHorario($id, $estado){
        
        $data['id_emp'] = $id;
        $data['est_emp'] = $estado;
        $data['empresa'] = $this->empresa_model->get_data($id);
        $view = $this->load->view('Estadolocal/ejecDescativarH', $data, TRUE);
        echo $view;
        
    }


    function ejecDescativarH() {
        $id_emp = $this->input->post('id_emp');
        $est = $this->input->post('est_emp');

        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->desactivarHorario($id_emp, $est);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al eliminar el local/empresa de la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Local Eliminado');
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
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