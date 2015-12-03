<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper(array('form'));
        $infoPage['titulo'] = 'Ingresar';
        $infoPage['header'] = $this->load->view('portal/static/header', '', TRUE);
        $infoPage['sidebar'] = '';
        $infoPage['content'] = $this->load->view('login/login_view');
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
//        $this->load->view('portal/static/header', $infoPage);
//        $this->load->view('login/login_view');
//        $this->load->view('portal/static/footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('index.php/portal', 'refresh');
    }

}
