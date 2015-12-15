<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    private $res_msj = '';

    function __construct() {
        parent::__construct();

        $this->user->check_session();
        $this->load->model('empresa_model');
    }

    public function index() {

        $infoPage['titulo'] = 'Administrador';
        $this->load->model('usuario_model');

        $data['data_user'] = $this->usuario_model->get_data($this->user->email);
//        print_r($data['data_user']);
        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);

        //cargamos el foterr
        //$this->load->view('portal/static/footer');
    }

    function load_users() {

        // $infoPage['titulo'] = 'Super Administrador';
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', '', TRUE);

        //Cargamos modelo usuarios
        $this->load->model('usuario_model');

        //Extraemos todos los uausrios
        $data['usuarios_list'] = $this->usuario_model->get_all();
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $infoPage, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function cargarCrearLocal() {
        $this->load->model('usuario_model');
        $infoPage['titulo'] = 'Administrador';

        //Consultamos los tipos de empresas para enviar al combobox
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
        $infoPage['content'] = $this->load->view('empresa/crear_local', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
        // $this->load->view('portal/static/footer');
    }

    function cargarMisLocales() {
        $this->load->library('table');

        $infoPage['titulo'] = 'Administrador';
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);

        // Crear cabezera personalizada
        $this->load->model('empresa_model');
        $data['locales'] = $this->empresa_model->presentaEmpresa($this->user->email);
//        echo $this->user->id;
//        print_r($data['locales']);
        $infoPage['content'] = $this->load->view('admin/locales', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);


        //$this->load->view('portal/static/footer');
    }

    public function desactivarHorario($id, $estado) {
        $confir=0;
        $id_emp = $id;
        $est = $estado;
        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->desactivarHorario($id_emp, $est);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $confir=1;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
        echo $confir;
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
