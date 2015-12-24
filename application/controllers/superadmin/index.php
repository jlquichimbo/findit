<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->user->check_session();
    }

    public function index() {

        $infoPage['titulo'] = 'Super Administrador';
        $this->load->model('usuario_model');
        
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/datos_registro', $infoPage, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function load_users() {

        $infoPage['titulo'] = 'Super Administrador';
        $this->load->model('usuario_model');
        //sacamos la imagen
        $data['usuarios_list'] = $this->usuario_model->get_all();
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);

        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('superadmin/usuarios_list', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function load_empresas() {

        $infoPage['titulo'] = 'Super Administrador';
        $this->load->model('empresa_model');

        $data['empresas_list'] = $this->empresa_model->get_all();
        //sacamos la imagen
        $this->load->model('usuario_model');
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);

        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('superadmin/empresas_list', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function load_tipo_empresas() {
        $infoPage['titulo'] = 'Super Administrador';
        $this->load->model('empresa_model');
        $data['tipos_list'] = $this->empresa_model->get_tipos();
        //sacamos la imagen
        $this->load->model('usuario_model');
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);
        
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('superadmin/tipos_empresa_list', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function load_roles() {
        $infoPage['titulo'] = 'Super Administrador';
        $this->load->model('usuario_model');
        $data['roles'] = $this->usuario_model->get_roles();
        //sacamos la imagen
        $this->load->model('usuario_model');
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);
        
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('superadmin/roles_list', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function crear_local() {
        $this->load->model('usuario_model');
        $this->load->model('empresa_model');

        $infoPage['titulo'] = 'Administrador';

        //Consultamos los tipos de empresas para enviar al combobox
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);
        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('empresa/crear_local', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
        // $this->load->view('portal/static/footer');
    }

}
