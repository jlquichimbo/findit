<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->user->check_session();
    }
    
    function index() {
        $infoPage['titulo'] = 'Super Administrador';

        $data_view['header'] = $this->load->view('login/header_login', $infoPage);
        $data['datos'] = $this->user->getData();
        
        $data_view['view'] = $this->load->view('superadmin/datos_personales',$data,TRUE);
//        $res['top_nav_actions'] = $this->load->view('top_nav_actions_cxc','',TRUE);
        $data_view['slidebar'] =$this->load->view('superadmin/slidebar','',TRUE);
        $this->load->view('superadmin/index', $data_view);
    }
}