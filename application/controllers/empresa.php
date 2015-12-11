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
        $this->empresa_model->delete($id_emp);
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

}
