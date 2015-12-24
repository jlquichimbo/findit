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
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $data, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function load_users() {

        $infoPage['titulo'] = 'Administrador';
        $this->load->model('usuario_model');
        $data['usuarios_list'] = $this->usuario_model->get_all();
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $data, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $infoPage, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function cargarCrearLocal() {
        $infoPage['titulo'] = 'Administrador';

        $this->load->model('usuario_model');
        //Consultamos los tipos de empresas para enviar al combobox
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('empresa/crear_local', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
        // $this->load->view('portal/static/footer');
    }

    function cargarMisLocales() {
        $infoPage['titulo'] = 'Administrador';

        $this->load->library('table');

        // Crear cabezera personalizada
        $this->load->model('empresa_model');

        $data['locales'] = $this->empresa_model->presentaEmpresa($this->user->email);
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $this->load->model('usuario_model');
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $datas, TRUE);

//        echo $this->user->id;
//        print_r($data['locales']);
        $infoPage['content'] = $this->load->view('admin/locales', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer2', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);


        //$this->load->view('portal/static/footer');
    }

    //Extrateer datos de la empresa que desea actualizar su horario
    public function getNombreLocal($id) {
        $local = $this->empresa_model->getNombreLocal($id);
        if (!empty($local)) {
            echo json_encode($local);
        }
    }

    public function desactivarHorario($id, $estado) {
        $confir = 0;
        $id_emp = $id;
        $est = $estado;
        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->desactivarHorario($id_emp, $est);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $confir = 1;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
        echo $confir;
    }

    public function activarHorario($id, $estado, $Hinicio, $Hfin) {
        $confir = 0;
        $id_emp = $id;
        $est = $estado;
        $hi = $Hinicio;
        $hf = $Hfin;
        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->activarHorario($id_emp, $est, $hi, $hf);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $confir = 1;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
        echo $confir;
    }

    public function loadAnuncios() {
        $infoPage['titulo'] = 'Administrador - Anuncios';
        //Consultamos los tipos de empresas para enviar al combobox
        $data['locales'] = $this->empresa_model->get_empresas_by_user($this->user->id);
        $data['upload_state'] = FALSE;
        $this->load->model('usuario_model');
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('empresa/crear_anuncio', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);
        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

}
