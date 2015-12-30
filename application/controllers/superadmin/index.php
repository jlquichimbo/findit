<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    private $res_msj = '';
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

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }
    
    function editarSUPERADM() {
        $this->load->model('usuario_model');
        $user_id = $this->input->post('id_user');
        $user_cedula = $this->input->post('txtCedula');
        $user_nombres = $this->input->post('txtNombre');
        $user_apellidos = $this->input->post('txtApellido');
        $user_telefono = $this->input->post('txtTelefono');
        $user_mail = $this->input->post('txtMail');
        $user_password = md5($this->input->post('txtPassword'));
        $fotoperfil = $this->uploadImg();
        $fotoperfil_file = $fotoperfil['upload_data']['file_name'];
        $this->db->trans_begin(); // inicio de transaccion
        $nuevo_id = $this->usuario_model->update($user_id, $user_cedula, $user_nombres, $user_apellidos, $fotoperfil_file, $user_password, $user_mail, $user_telefono, $user_rol = 1);
        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar los dsatos de usuario en la base de datos.');
            //echo $this->res_msj;
        }
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar los datos de usuario en la base de datos.');
            //echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Usuario Actualizado');
            //echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
            $this->editar_perfil_view($fotoperfil);
        }
    }
    
    //Volver acargar vistas despues de q se aya actualizado el perfil
    function editar_perfil_view($user_data) {
        
        $infoPage['titulo'] = 'Super Administrador - Perfil';
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        $data['upload_state'] = $user_data['upload_state'];
        $data['msg'] = $user_data['msg'];
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/edit_superadmin', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer');
        
        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }
    //Cargar datos para edición de perfil de usuario
    function perfil() {
        $infoPage['titulo'] = 'Super Administrador - Perfil';
        $this->load->model('usuario_model');
        //sacamos la imagen
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        $data['upload_state'] = FALSE;
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/edit_superadmin', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer');

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
        $infoPage['footer'] = $this->load->view('portal/static/footer');

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
        $infoPage['footer'] = $this->load->view('portal/static/footer');

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
        $infoPage['footer'] = $this->load->view('portal/static/footer');

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
        $infoPage['footer'] = $this->load->view('portal/static/footer');

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
        $infoPage['footer'] = $this->load->view('portal/static/footer');

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
        // $this->load->view('portal/static/footer');
    }

    function create_category_view() {
        $this->load->model('usuario_model');

        $infoPage['titulo'] = 'Administrador - Crear Categoria';
        $infoPage['data_user'] = $this->usuario_model->get_data($this->user->email);

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('superadmin/sidebar', $infoPage, TRUE);
        $infoPage['content'] = $this->load->view('superadmin/crear_categoria', null, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer');

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function create_category() {
        $this->load->model('empresa_model');
        $nombre_tipo = $this->input->post('categoria');

        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->create_tipo($nombre_tipo);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            //Enviamos 0 al formulario de ajax de la vista para que sepa que la transaccion fallo
            echo 0;
        } else {
            //Enviamos 1 al formulario de ajax de la vista para que sepa que la transaccion se completo
            $this->db->trans_commit(); // finaliza la transaccion de begin
            echo 1;
        }
    }
    
    //funcion para subir imagen
    function uploadImg() {
        $config['upload_path'] = './uploads/images/users/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $data['upload_data'] = '';
        if (!$this->upload->do_upload('userfile')) {
            echo '<script>alert(' . $this->upload->display_errors() . ');</script>';
            $data = array('msg' => $this->upload->display_errors());
            $data['upload_state'] = false;
        } else { //else, set the success message
            $data = array('msg' => ".<br>Edición de perfil completo!");

            $data['upload_data'] = $this->upload->data();
            $data['upload_state'] = true;
        }
        return $data;
    }

}
