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

        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->id);
        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $infoPage, TRUE);
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
        $data['locales'] = $this->empresa_model->get_data($this->user->id);
        
        $infoPage['content'] = $this->load->view('admin/locales', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);



        //$this->load->view('portal/static/footer');
    }

    /*Esta funcion se traslado al controlador empresa, ya que van a acceder a esta admin y superadmin*/
    function save_local() {
//        $emp_nombre = $this->input->post('emp_name');
//        $emp_direccion = $this->input->post('emp_address');
//        $emp_tipo = $this->input->post('emp_tipo');
//        $emp_latitud = $this->input->post('emp_lat');
//        $emp_longitud = $this->input->post('emp_lng');
//
//        //Imprimimos los datos para verificar que los esta extrayendo correctamente:
////        echo 'Datos a guardar: <br>';
////        echo 'Nombre:' . $emp_nombre . ' <br>';
////        echo 'Direccion: ' . $emp_direccion . '<br>';
////        echo 'Tipo: ' . $emp_tipo . '<br>';
////        echo 'Latitud: ' . $emp_latitud . '<br>';
////        echo 'Longitud: ' . $emp_longitud . '<br>';
//
//        $this->db->trans_begin(); // inicio de transaccion
//
//        $nuevo_id = $this->empresa_model->save_new($emp_nombre, $emp_direccion, $emp_tipo, $this->user->id, $emp_latitud, $emp_longitud);
//        if($nuevo_id <= 0){
//            $this->db->trans_rollback();
//            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar la empresa en la base de datos.');
//            echo $this->res_msj;
//        }
//        // verifico que todo elproceso en si este bien ejecutado
//        if ($this->db->trans_status() === FALSE) {
//            $this->db->trans_rollback();
//            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar la empresa en la base de datos.');
//            echo $this->res_msj;
////            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
//        } else {
//            $this->res_msj .= success_msg('. Empresa registrada');
//            echo $this->res_msj;
//
//            $this->db->trans_commit(); // finaliza la transaccion de begin
//        }
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
