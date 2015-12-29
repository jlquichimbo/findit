<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    private $res_msj = '';

    //primero tener un constructor
    function __construct() {
        //fundamental para que no de error, lo que hace es ejecutar el constructo del padre CI_Controller 
        parent::__construct();
        $this->load->model('usuario_model');
    }

    // funcion que se ejecuta x defecto al llamar el controlador
    public function index() {
        //$this->load->view('registrousuario_view');
    }

    /* public function insert() {
      $post= $this->input->post();
      $this->load->model('upload');
      $file_name = $this->upload->UploadImage('uploads/images/users','no es posible cargar imagen... :(');
      $post['file_name']=$file_name; //Asignar una nueva key lamada file_name con el nombre del fichero
      $bool=$this->usuario_model->insert($post);

      if($bool){
      header("Location:".base_url()."portal/vistaloguearUsuario");
      }else{
      header("Location:".base_url()."portal");
      }

      } */

    public function registrar() {


        $user_cedula = $this->input->post('txtCedula');
        $user_nombres = $this->input->post('txtNombre');
        $user_apellidos = $this->input->post('txtApellido');
        //$userfile = $this->input->post('userfile');
        $userfile = $this->input->post('userfile');
        $user_telefono = $this->input->post('txtTelefono');
        $user_mail = $this->input->post('txtMail');
        $user_password = md5($this->input->post('txtPassword'));



        $foto = $userfile;
        $this->load->model('file');
        $foto = $this->file->UploadImage('uploads/images/users', 'Ocurrio un error al subir la imagen, Comuniquese con el administrador');

        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->usuario_model->save_new($user_cedula, $user_nombres, $user_apellidos, $foto, $user_telefono, $user_mail, $user_password);

        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar el usuario en la base de datos.');
            echo $this->res_msj;
        }
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar el usuario en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            header("Location:" . base_url() . "portal/vistaloguearUsuario");
            /* $this->res_msj .= success_msg('. Usuario Registrado');
              echo $this->res_msj; */




            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    public function editar_view($user_id) {
        $data['id_user'] = $user_id;
        $data['roles'] = $this->usuario_model->get_roles();
        $data['usuario'] = $this->usuario_model->get_data_by_id($user_id);
        $view = $this->load->view('usuarios/edit_usuario', $data, TRUE);
        echo $view;
    }

    public function editar() {
        $user_id = $this->input->post('id_user');
        $user_cedula = $this->input->post('txtCedula');
        $user_nombres = $this->input->post('txtNombre');
        $user_apellidos = $this->input->post('txtApellido');
        $user_telefono = $this->input->post('txtTelefono');
        $user_mail = $this->input->post('txtMail');
        $user_password = $this->input->post('txtPassword');
        $user_rol = $this->input->post('rol');

        //Aqui va a ir la ruta de la imagen
        $user_usuario = '';

        //Imprimimos los datos para verificar que los esta extrayendo correctamente:
//        echo 'Datos a guardar: <br>';
//        echo 'Cedula:' . $user_cedula . ' <br>';
//        echo 'Nombre:' . $user_nombres . ' <br>';
//        echo 'Apellido:' . $user_apellidos . ' <br>';
//        echo 'Telefono: ' . $user_telefono . '<br>';
//        echo 'Mail: ' . $user_mail . '<br>';
//        echo 'PWD: ' . $user_password . '<br>';
//        die();
        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->usuario_model->update($user_id, $user_cedula, $user_nombres, $user_apellidos, $user_usuario, $user_password, $user_mail, $user_telefono, $user_rol);
        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar el usuario en la base de datos.');
            echo $this->res_msj;
        }
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar el usuario en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Usuario Actualizado');
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function editarADM() {
        $user_id = $this->input->post('id_user');
        $user_cedula = $this->input->post('txtCedula');
        $user_nombres = $this->input->post('txtNombre');
        $user_apellidos = $this->input->post('txtApellido');
        //$userfile = $this->input->post('userfile');
        $user_telefono = $this->input->post('txtTelefono');
        $user_mail = $this->input->post('txtMail');
        $user_password = md5($this->input->post('txtPassword'));
        $user_rol = $this->input->post('rol');

        $this->load->model('file');
        $anuncio = $this->uploadImg();
        $anunc_file = $anuncio['upload_data']['file_name'];

        $fotoperfil = $this->uploadImg();
        $fotoperfil_file = $fotoperfil['upload_data']['file_name'];

        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->usuario_model->update($user_id, $user_cedula, $user_nombres, $user_apellidos, $anunc_file, $user_password, $user_mail, $user_telefono, $user_rol = 2);

        $nuevo_id = $this->usuario_model->update($user_id, $user_cedula, $user_nombres, $user_apellidos, $fotoperfil_file, $user_password, $user_mail, $user_telefono, $user_rol = 2);

        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();

            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar los dsatos en la base de datos.');
            echo $this->res_msj;

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
        $infoPage['titulo'] = 'Administrador - Perfil';
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        $data['upload_state'] = $user_data['upload_state'];
        $data['msg'] = $user_data['msg'];
        $infoPage['header'] = $this->load->view('login/header_admin', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('usuarios/edit_adm', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer');

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    public function delete_view($id_user) {
        $data['id_user'] = $id_user;
        $data['usuario'] = $this->usuario_model->get_data_by_id($id_user);
        $view = $this->load->view('usuarios/delete_usuario', $data, TRUE);
        echo $view;
    }

    //Comprobar si existe un email registrado en la base de datos
    public function check_email() {
        $email = $this->input->post('email');
        $check_email = $this->usuario_model->check_email($email);
        if (!empty($check_email)) {
            echo 'Este correo ya se encuentra registrado, inicie sesion';
        } else {
            echo '-1';
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

?>
