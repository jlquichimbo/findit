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

    public function registrar() {
        $this->load->library('form_validation');

        $user_cedula = $this->input->post('txtCedula');
        $user_nombres = $this->input->post('txtNombre');
        $user_apellidos = $this->input->post('txtApellido');
        $file_name = $this->input->post('file_name');
        $user_password = $this->input->post('txtPassword');
        $user_confirm_password = $this->input->post('txtConfirmarPassword');
        $user_mail = $this->input->post('txtMail');
        $user_telefono = $this->input->post('txtTelefono');
        //$user_usuario = $user_mail;

        $user_password = md5($user_password);



        $this->db->trans_begin(); // inicio de transaccion
        $this->load->model('file');
        $this->file->UploadImage('./public/img/', 'no es posible cargar imagen');

        $nuevo_id = $this->usuario_model->save_new($user_cedula, $user_nombres, $user_apellidos, $file_name, $user_password, $user_mail, $user_telefono);

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
            //Redireccionar al login
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
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    public function delete_view($id_user) {
        $data['id_user'] = $id_user;
        $data['usuario'] = $this->usuario_model->get_data_by_id($id_user);
        $view = $this->load->view('usuarios/delete_usuario', $data, TRUE);
        echo $view;
    }

    public function delete() {
        $user_id = $this->input->post('id_user');

        $this->db->trans_begin(); // inicio de transaccion
        $this->usuario_model->delete($user_id);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al eliminar el usuario de la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Usuario Eliminado');
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

}

?>
