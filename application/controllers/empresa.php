<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

    private $res_msj = '';

    function __construct() {
        parent::__construct();

        $this->user->check_session();
        $this->load->model('empresa_model');
    }

    public function index() {
        
    }

    public function crear_local() {
        $emp_nombre = $this->input->post('emp_name');
        $emp_direccion = $this->input->post('emp_address');
        $emp_tipo = $this->input->post('emp_tipo');
        $emp_latitud = $this->input->post('emp_lat');
        $emp_longitud = $this->input->post('emp_lng');

        //Imprimimos los datos para verificar que los esta extrayendo correctamente:
//        echo 'Datos a guardar: <br>';
//        echo 'Nombre:' . $emp_nombre . ' <br>';
//        echo 'Direccion: ' . $emp_direccion . '<br>';
//        echo 'Tipo: ' . $emp_tipo . '<br>';
//        echo 'Latitud: ' . $emp_latitud . '<br>';
//        echo 'Longitud: ' . $emp_longitud . '<br>';

        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->empresa_model->save_new($emp_nombre, $emp_direccion, $emp_tipo, $this->user->id, $emp_latitud, $emp_longitud);
        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar la empresa en la base de datos.');
            echo $this->res_msj;
        }
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar la empresa en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Datos actualizados');
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function editar_local_view($id_emp) {
        $data['id_emp'] = $id_emp;
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();
        $data['empresa'] = $this->empresa_model->get_data($id_emp);
        $view = $this->load->view('empresa/edit_local', $data, TRUE);
        echo $view;
    }

    public function editar_local() {
        $emp_id = $this->input->post('id_emp');
        $emp_admin_id = $this->input->post('id_admin');
        $emp_nombre = $this->input->post('emp_name');
        $emp_direccion = $this->input->post('emp_address');
        $emp_tipo = $this->input->post('emp_tipo');
        $emp_latitud = $this->input->post('emp_lat');
        $emp_longitud = $this->input->post('emp_lng');

        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->empresa_model->update_local($emp_id, $emp_nombre, $emp_direccion, $emp_tipo, $emp_admin_id, $emp_latitud, $emp_longitud);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar la empresa en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Empresa actualizada');
            echo $this->res_msj;

            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function editar_tipo_view($id_tipo) {
        $data['id_tipo'] = $id_tipo;
        $data['tipo'] = $this->empresa_model->get_tipo($id_tipo);
        $view = $this->load->view('empresa/edit_tipo', $data, TRUE);
        echo $view;
    }

    public function editar_tipo() {
        $id_tipo = $this->input->post('id_tipo');
        $tipo_nombre = $this->input->post('tipo_name');
        $this->db->trans_begin(); // inicio de transaccion

        $nuevo_id = $this->empresa_model->update_tipo($id_tipo, $tipo_nombre);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al actualizar el tipo en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Tipo actualizado');
            echo $this->res_msj;

            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function delete_local_view($id_emp) {
        $data['id_emp'] = $id_emp;
        $data['tipos_empresa'] = $this->empresa_model->get_tipos();
        $data['empresa'] = $this->empresa_model->get_data($id_emp);
        $view = $this->load->view('empresa/delete_local', $data, TRUE);
        echo $view;
    }

    function delete_local() {
        $id_emp = $this->input->post('id_emp');

        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->delete_local($id_emp);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al eliminar el local/empresa de la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Local Eliminado');
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function delete_tipo_view($id_tipo) {
        $data['id_tipo'] = $id_tipo;
        $view = $this->load->view('empresa/delete_tipo', $data, TRUE);
        echo $view;
    }

    function delete_tipo() {
        $id_tipo = $this->input->post('id_tipo');

        $this->db->trans_begin(); // inicio de transaccion
        $this->empresa_model->delete_local($id_tipo);
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al eliminar el local/empresa de la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->res_msj .= success_msg('. Tipo de Empresa/Local Eliminado');
            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }

    function crear_anuncio() {
        $anunc_title = $this->input->post('anunc_name');
        $anunc_emp_id = $this->input->post('anuncio_emp_id');
        $admin_id = $this->user->id;
        $this->load->model('file');
        $anuncio = $this->uploadImg();
        $anunc_file = $anuncio['upload_data']['file_name'];
        $fecha_inicio = date("Y-n-j");//Fecha de hoy

        //Imprimimos los datos para verificar que los esta extrayendo correctamente:
//        echo 'Datos a guardar: <br>';
//        echo 'Nombre:' . $anunc_title . ' <br>';
//        echo 'File: ' . $anuncio['upload_data']['file_name']. '<br>';
//        echo "Empresa Id: " . $anunc_emp_id . '<br>';
//        echo "User Id: " . $admin_id . '<br>';

        $this->db->trans_begin(); // inicio de transaccion
        $this->load->model('anuncio_model');

        $nuevo_id = $this->anuncio_model->save_new($anunc_title, $anunc_file, $anunc_emp_id, $fecha_inicio);
        if ($nuevo_id <= 0) {
            $this->db->trans_rollback();
            echo $this->res_msj;
        }
        // verifico que todo elproceso en si este bien ejecutado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->res_msj .= error_msg('<br>Ha ocurrido un error al guardar el anuncio en la base de datos.');
            echo $this->res_msj;
//            echo error_msg('<br>Ha ocurrido un error al guardar el paciente en la base de datos.');
        } else {
            $this->crear_anuncio_view($anuncio);
//            echo $this->res_msj;
            $this->db->trans_commit(); // finaliza la transaccion de begin
        }
    }
    
    function crear_anuncio_view($anuncio_data){
        $infoPage['titulo'] = 'Administrador - Anuncios';

        $this->load->model('usuario_model');
        $datas['data_user'] = $this->usuario_model->get_data($this->user->email);
        
        //Consultamos los tipos de empresas para enviar al combobox
        $data['locales'] = $this->empresa_model->get_empresas_by_user($this->user->id);
        $data['upload_state'] = $anuncio_data['upload_state'];
        $data['msg'] = $anuncio_data['msg'];

        //Estructura del dashboard
        $infoPage['header'] = $this->load->view('login/header_login', '', TRUE);
        $infoPage['sidebar'] = $this->load->view('admin/sidebar', $datas, TRUE);
        $infoPage['content'] = $this->load->view('empresa/crear_anuncio', $data, TRUE);
        $infoPage['footer'] = $this->load->view('portal/static/footer', '', TRUE);

        //Cargamos el dashboard
        $this->load->view('portal/static/dashboard', $infoPage);
    }

    function uploadImg() {
        //Configure
        //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
        $config['upload_path'] = 'uploads/images/anuncios';

        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png';

        //load the upload library
        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        $this->upload->set_allowed_types('*');

        $data['upload_data'] = '';

        //if not successful, set the error message
        if (!$this->upload->do_upload('userfile')) {
            $data = array('msg' => $this->upload->display_errors());
            $data['upload_state'] = false;
        } else { //else, set the success message
            $data = array('msg' => "Subida completa!");

            $data['upload_data'] = $this->upload->data();
            $data['upload_state'] = true;
        }
        return $data;
    }

}
