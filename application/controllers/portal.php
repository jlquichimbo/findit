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
        $this->load->view('portal/static/headerAdm', $infoPage);
        $this->load->view('portal/principal', $data);
        $this->load->view('portal/static/footer');
        //$this->vistaRegistrarUsuario();
    }

    public function vistaRegistrarUsuario() {
        $infoPage['titulo'] = 'Registrar Usuario';
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

    public function get_locales_by_tipe($type) {
        //Graba nueva empresa con generic model:
//        $data_empresa = array('nombre'=>'Cafecito',
//            'direccion'=>'18 de noviembre',
//            'tipo_id'=>'2');
//        
//        $this->generic_model->save($data_empresa, 'empresa');
        $this->load->model('empresa_model');

        $locales = $this->empresa_model->get_by_type($type);
        //print_r($locales);
        if (!empty($locales)) {
//                print_r($res);
//                $locales[0]->id = '$ '.$locales[0]->nombre;
            echo json_encode($locales);
        } else {
//                    echo '{"id":"--","name":"No hay resultados para '.$type.'"}';
        }
    }

    public function getLocalesCercanos() {
        $this->load->model('empresa_model');
        $locales = $this->empresa_model->getMasCercanos();
        if (!empty($locales)) {
            echo json_encode($locales);
        }
    }

    public function getLocalSeleccionado($localSeleccionado) {
        $this->load->model('empresa_model');
        $local = $this->empresa_model->getLocSeleccionado($localSeleccionado);
        if (!empty($local)) {
            echo json_encode($local);
        }
    }

    //controlador para cargar vista recuperar contraseña
    public function vistaRecuperarPass() {
        $infoPage['titulo'] = 'Recuperar Password';
        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('portal/recuperarpassword');
        $this->load->view('portal/static/footer');
    }

    //controlador para enviar email y regresar al loguin
    public function enviarEmail() {
        $this->load->model('usuario_model');
        $destino = $this->input->post('txtMail');
        $usu = $this->usuario_model->getUsuario($destino);
        if (!empty($usu)) {
            $fecha = date("d-m-y");
            $hora = date("h:i:s");
            $asunto = "Recuperación de contraseña- Find-It";
            $mensaje="
              <h2>Para: ".$usu[0]->nombres." ".$usu[0]->apellidos."
              </h2><br><h2>De: Find-It</h2><br>
              <h2>Enviado el: ".$fecha." a las ".$hora."</h2><br>
              <h3>Reciba un cordial saludo ".$usu[0]->nombres." ".$usu[0]->apellidos.", Find-It le informa
              que a solicitado su contraseña para acceder a su cuenta Find-It; por tal razón, se le informa
              que usted debe proporcionar la siguiente información en el formulario de logueo para poder acceder
              a su cuenta.</h3><br><h3>Usuario: ".$destino."
              </h3><h3>Password: ".md5($usu[0]->password)."
              </h3><br><h2>Gracias, por formar parte de nuestra comunidad...!!!</h2>";
            //configuracion para gmail
            $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'findit25122015@gmail.com',
                'smtp_pass' => 'findit25122015utpl',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );
            //cargamos la configuración para enviar con gmail
            $this->email->initialize($configGmail);
            $this->email->from('findit25122015@gmail.com', 'Find - It');
            $this->email->to($destino);
            $this->email->subject($asunto);
            $this->email->message($mensaje);
            if ($this->email->send()) {
                $infoPage['titulo'] = 'Ingresar';
                $this->load->view('portal/static/header', $infoPage);
                $this->load->view('login/login_view');
                $this->load->view('portal/static/footer');
            }
        }
    }

}
