<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    //primero tener un constructor
    function __construct() {
        //fundamental para que no de error, lo que hace es ejecutar el constructo del padre CI_Controller 
        parent::__construct();
        //$this-> load -> model('model_portal');
    }

    // funcion que se ejecuta x defecto al llamar el controlador
    public function index() {
         //Consultamos los tipos de empresas para enviar al combobox
        $this->load->model("empresa_model");
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();
        
        $infoPage['titulo'] = 'Inicio';
        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('portal/principal', $data);
        $this->load->view('portal/static/footer');
        //$this->vistaRegistrarUsuario();
    }

    public function vistaRegistrarUsuario() {
        $infoPage['titulo'] = 'Registrar Usuario';
//        $this->load->view('portal/static/header', $infoPage);
//        $this->load->view('portal/registro');
//        $this->load->view('portal/static/footer');
        
        $this->load->model('usuario_model');

        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->id);
        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('portal/static/header', '', TRUE);
        $infoPage['sidebar'] = '';
        $infoPage['content'] = $this->load->view('portal/registro', '', TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    public function vistaloguearUsuario() {
        $infoPage['titulo'] = 'Ingresar';
        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('login/login_view');
//        $this->load->view('login/login/index');
        $this->load->view('portal/static/footer');
    }

    /*public function vistaDatosRegistro() {
        $infoPage['titulo'] = 'Dat_Registro';
        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('portal/datos_registro');
        $this->load->view('portal/static/footer');
    }

    public function modelRegistrarUsuario() {
        $this->form_validation->set_rules('Cedula', 'La cedula que ingreso es incorrecta', 'required');
        $this->form_validation->set_rules('Nombres', 'El nombre debe contener solo letras', 'required');
        $this->form_validation->set_rules('Apellido', 'El apellido debe contener solo letras', 'required');
        $this->form_validation->set_rules('Direcion', 'La Direcion no existe', 'required');
        $this->form_validation->set_rules('Mail', 'Debe ingresar un mail', 'required');
        $this->form_validation->set_rules('User', 'El usuario ya existe', 'required');
        $this->form_validation->set_rules('Password', 'El passworddebe ser mayor a 5 caracteres', 'required');
        if ($this->form_validation->run == FALSE) {
            $infoPage['titulo'] = 'Registrar Usuario';
            $this->load->view('portal/static/header', $infoPage);
            $this->load->view('portal/registro');
            $this->load->view('portal/static/footer');
        } else {
            $datosUsuario = array(
                'ceduladb' => $this->input->post('Cedula'),
                'nombresdb' => $this->input->post('Nombres'),
                'apellidodb' => $this->input->post('Apellido'),
                'direcciondb' => $this->input->post('Direcion'),
                'maildb' => $this->input->post('Mail'),
                'userdb' => $this->input->post('User'),
                'passworddb' => $this->input->post('Password')
            );
            $this->model_portal->registrarUsuario($datosUsuario);
            redirect(base_url() . 'portal/');
        }
    }*/
    
    public function get_locales_by_tipe($type){
        //Graba nueva empresa con generic model:
//        $data_empresa = array('nombre'=>'Cafecito',
//            'direccion'=>'18 de noviembre',
//            'tipo_id'=>'2');
//        
//        $this->generic_model->save($data_empresa, 'empresa');
        $this->load->model('empresa_model');
        
        $locales = $this->empresa_model->get_by_type($type);
        //print_r($locales);
        if(!empty($locales)) {
//                print_r($res);
//                $locales[0]->id = '$ '.$locales[0]->nombre;
                    echo json_encode($locales);
            } else {
//                    echo '{"id":"--","name":"No hay resultados para '.$type.'"}';
            }
        
    }
    public function getLocalesCercanos(){
        $this->load->model('empresa_model');
        $locales = $this->empresa_model->getMasCercanos();
        if(!empty($locales)) {
            echo json_encode($locales);
        }
    }
    public function getLocalSeleccionado($localSeleccionado){
        $this->load->model('empresa_model');
        $local = $this->empresa_model->getLocSeleccionado($localSeleccionado);
        if(!empty($local)) {
            echo json_encode($local);
        }
    }

}
