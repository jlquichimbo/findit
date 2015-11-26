<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model', '', TRUE);
    }

    function index() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
//            redirect('index.php/portal/vistaLoguearUsuario', 'refresh');
            $infoPage['titulo'] = 'Ingresar';
            $this->load->view('portal/static/header', $infoPage);
            $this->load->view('login/login_view');
            $this->load->view('portal/static/footer');
        } else {
            $rol = $this->session->userdata('rol');
            switch ($rol) {
                case 1://user superadmin
                    redirect('superadmin/index', 'refresh');
                    break;
                case 2://user admin
                    redirect('admin/index', 'refresh');
                    break;
                default:
                    echo 'default';
                    break;
            }
            //Go to private area
        }
    }

    function check_database($password) {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->login_model->login($username, $password);
        if ($result) {
            $USER = array();
            foreach ($result as $row) {
                $USER = array(
                    'id' => $row->id,
                    'userid' => $row->cedula_ruc,
                    'username' => $row->usuario,
                    'nombres' => $row->nombres,
                    'apellidos' => $row->apellidos,
                    'email' => $row->email,
                    'telefono' => $row->telefono,
                    'rol' => $row->rol_id
                );
                $this->session->set_userdata('userid', $row->cedula_ruc);
            }
            $this->session->set_userdata($USER);

            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'El nombre de usuario o la contrase&ntilde;a parecen incorrectos');
            return false;
        }
    }

}
