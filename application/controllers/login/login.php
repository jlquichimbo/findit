<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $infoPage['titulo'] = 'Ingresar';
        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('login/login_view');
        $this->load->view('portal/static/footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('index.php/portal', 'refresh');
    }

}
