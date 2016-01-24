<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

    //primero tener un constructor
    function __construct() {
        //fundamental para que no de error, lo que hace es ejecutar el constructo del padre CI_Controller 
        parent::__construct();
        //$this-> load -> model('model_portal');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        /*         * ********************************* */
//        if (isset($_SERVER['HTTP_ORIGIN'])) {
//            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//            header('Access-Control-Allow-Credentials: true');
//            header('Access-Control-Max-Age: 86400');
//        }
//        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//
//            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//                header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//
//            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//        }
    }

    // funcion que se ejecuta x defecto al llamar el controlador
    public function index() {
        //Consultamos los tipos de empresas para enviar al combobox
        $this->load->model("empresa_model");
        $this->load->model("anuncio_model");
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();
        $data['anuncios'] = $this->anuncio_model->get_ultimos();

        $infoPage['titulo'] = 'Inicio';
        $infoPage['footer'] = $this->load->view('portal/static/headerAdm', $infoPage);
        $infoPage['footer'] = $this->load->view('portal/principal', $data);
        $infoPage['footer'] = $this->load->view('portal/static/footer2');
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
        $this->load->view('portal/static/dashboard', $infoPage);
        $infoPage['footer'] = $this->load->view('portal/static/footer');
        //Cargamos el dashboard
    }

    public function vistaloguearUsuario() {
        $infoPage['titulo'] = 'Ingresar';

        $this->load->view('portal/static/header', $infoPage);
        $this->load->view('login/login_view');
//        $this->load->view('login/login/index');
        $infoPage['footer'] = $this->load->view('portal/static/footer');
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

    public function search($nombre) {
        $this->load->model("buscador");
        $local = $this->buscador->search($nombre);
        if (!empty($local)) {
            echo json_encode($local);
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
        $infoPage['mensajeEstado'] = '';
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
            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $longitudCadena = strlen($cadena); //Longitud de cadena
            $pass = ""; //Nueva pass
            for ($i = 1; $i <= 10; $i++) {
                $pos = rand(0, $longitudCadena - 1); //posicion aleatoria de la cadena de caracteres
                $pass = $pass . substr($cadena, $pos, 1);
            }
            $this->db->trans_begin(); // inicio de transaccion
            $this->usuario_model->nuevaPass($destino, md5($pass));
            // verifico que todo elproceso en si este bien ejecutado
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                // finaliza la transaccion de begin
                $this->db->trans_commit();
                $fecha = date("d-m-y");
                $hora = date("h:i:s");
                $asunto = "Recuperación de contraseña- Find-It";
                $mensaje = "
                    <h2>Para: " . $usu[0]->nombres . " " . $usu[0]->apellidos . "
                    </h2><br><h2>De: Find-It</h2><br>
                    <h2>Enviado el: " . $fecha . " a las " . $hora . "</h2><br>
                    <h3>Reciba un cordial saludo " . $usu[0]->nombres . " " . $usu[0]->apellidos . ", Find-It le informa
                    que a solicitado una contraseña nueva para acceder a su cuenta Find-It; por tal razón, se le informa
                    que usted debe proporcionar la siguiente información en el formulario de logueo para poder acceder
                    a su cuenta.</h3><br><h3>Usuario: " . $destino . "
                    </h3><br><h3>Nuevo password: " . $pass . "
                    </h3><br>Usted puede cambiar este password en editar perfil, luego de haber accedido a su cuenta<br><h2>Gracias, por formar parte de nuestra comunidad...!!!</h2>";
                //configuracion para gmail
                $configGmail = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_timeout' => '5',
                    'smtp_port' => 465,
                    'smtp_user' => 'findit25122015@gmail.com',
                    'smtp_pass' => 'findit25122015utpl',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'validation' => TRUE
                );
                //cargamos la configuración para enviar con gmail
                $this->email->initialize($configGmail);
                $this->email->from('findit25122015@gmail.com', 'Find - It');
                $this->email->to($destino);
                $this->email->subject($asunto);
                $this->email->message($mensaje);
                if ($this->email->send()) {
                    $infoPage['titulo'] = 'Recuperar Password';
                    $infoPage['mensajeEstado'] = 'Estimado usuario, se a enviado un mail a ' . $destino . ' con su nueva password';
                    $this->load->view('portal/static/header', $infoPage);
                    $this->load->view('portal/recuperarpassword');
                    $this->load->view('portal/static/footer');
                }
            }
        } else {
            $infoPage['titulo'] = 'Recuperar Password';
            $infoPage['mensajeEstado'] = 'El usuario al que usted desea recuperar su contraseña no existe.<br>Find-It te invita a registrarte para que formes parte de nuestra gran comunidad...! Lamentamos el inconveniente.';
            $this->load->view('portal/static/header', $infoPage);
            $this->load->view('portal/recuperarpassword');
            $this->load->view('portal/static/footer');
        }
    }

}
