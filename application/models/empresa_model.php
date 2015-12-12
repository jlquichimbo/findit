<?php

Class Empresa_model extends CI_Model {

    function save_new($nombre, $direccion, $tipo_id, $admin_id, $lat, $lng, $open_hour = '0:00', $close_hour ='0:00') {
        $form_data = array(
            'nombre' => $nombre,
            'direccion' => $direccion,
            'tipo_id' => $tipo_id,
            'admin_id' => $admin_id,
            'latitud' => $lat,
            'longitud' => $lng,
            'hora_apertura' => $open_hour,
            'hora_cierre' => $close_hour,
        );
        $table_name = 'empresa';
        $this->db->insert($table_name, $form_data);
        return $this->db->insert_id();
    }

    /* Extrae los datos de una sola empresa */

    function get_data($empresa_id) {
        $this->db->select('empresa.id, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . 'empresa_tipo.nombre tipo, '
                . 'usuario.cedula_ruc ci_admin, '
                . 'usuario.id id_admin, '
                . 'CONCAT_WS(" ", usuario.nombres, usuario.apellidos) nombre_admin'
        );
        $this->db->from('empresa');
        $this->db->join('empresa_tipo', 'tipo_id = empresa_tipo.id');
        $this->db->join('usuario', 'admin_id = usuario.id');
        $this->db->where('empresa.id', $empresa_id);

        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    function presentaEmpresa($username) {
        $this->db->select('empresa.id, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . 'empresa_tipo.nombre tipo, '
                . 'usuario.cedula_ruc ci_admin, '
                . 'usuario.id id_admin, '
                . 'CONCAT_WS(" ", usuario.nombres, usuario.apellidos) nombre_admin'
        );
        $this->db->from('empresa');
        $this->db->join('empresa_tipo', 'tipo_id = empresa_tipo.id');
        $this->db->join('usuario', 'admin_id = usuario.id');
        $this->db->where('usuario.email', $username);

        
        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae todas las empresas registradas en la base de datos */

    function get_all() {
        $this->db->select('empresa.id, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . 'empresa_tipo.nombre tipo, '
                . 'usuario.cedula_ruc ci_admin, '
                . 'usuario.id id_admin, '
                . 'CONCAT_WS(" ", usuario.nombres, usuario.apellidos) nombre_admin'
        );
        $this->db->from('empresa');
        $this->db->join('empresa_tipo', 'tipo_id = empresa_tipo.id');
        $this->db->join('usuario', 'admin_id = usuario.id');
        $query = $this->db->get();
        return $query->result();
    }

    function empresaUsuario($usuarios) {
        $this->db->select('empresa.id, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . 'empresa_tipo.nombre tipo, '
                . 'usuario.cedula_ruc ci_admin, '
                . 'usuario.id id_admin, '
                . 'CONCAT_WS(" ", usuario.nombres, usuario.apellidos) nombre_admin'
        );
        $this->db->from('empresa');
        $this->db->join('empresa_tipo', 'tipo_id = empresa_tipo.id');
        $this->db->join("usuario', '" . $usuarios . " = usuario.id");
        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae las empresas segun su tipo (farmacia, restaurante, etc) */

    function get_by_type($type_id) {
        $this->db->select('empresa.id AS identificador, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . 'empresa_tipo.nombre tipo, '
                . 'usuario.cedula_ruc ci_admin, '
                . 'usuario.id id_admin, '
                . 'CONCAT_WS(" ", usuario.nombres, usuario.apellidos) nombre_admin'
        );
        $this->db->from('empresa');
        $this->db->join('empresa_tipo', 'tipo_id = empresa_tipo.id');
        $this->db->join('usuario', 'admin_id = usuario.id');
        $this->db->where('tipo_id', $type_id);

        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae los tipos de empresa/servicio */

    function get_tipos() {
        $this->db->from('empresa_tipo');

        $query = $this->db->get();
        return $query->result();
    }
    /* Extrae UN tipo de empresa/servicio */

    function get_tipo($id_tipo) {
        $this->db->where('id', $id_tipo);
        $this->db->from('empresa_tipo');

        $query = $this->db->get();
        return $query->result();
    }

    //obtener los 5 locales mas cercanos de la ubicacion del usuario

    function getMasCercanos() {
        $rango = 20;

        $this->db->select('id AS identificador, '
                . 'nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre, '
                . '(6371 * ACOS(SIN(RADIANS(latitud)) * SIN(RADIANS(-3.996083))+ COS(RADIANS(longitud - -79.205675)) * COS(RADIANS(latitud)) * COS(RADIANS(-3.996083)))) AS distancia'
        );
        $this->db->from('empresa');
        $this->db->where('disponible', 1);
        $this->db->having('distancia <', $rango);
        $this->db->order_by('distancia');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result();
    }

    function getLocSeleccionado($localSeleccionado) {
        $this->db->select('id, '
                . 'nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre'
        );
        $this->db->from('empresa');
        $this->db->where('id', $localSeleccionado);
        $query = $this->db->get();
        return $query->result();
    }

    //funcion para desactivar Horario
    function desactivarHorario($id){
        $data_set = array(
            'disponible' => 0,
            'hora_apertura' => "00:00:00",
            'hora_cierre' => "00:00:00",
        );        
        $table_name = 'empresa';
        $where_data = array('id'=>$id);
        $this->db->update($table_name, $data_set, $where_data);
        return $this->db->affected_rows();
    }
    /*Actualiza los datos de empresa/local */
    function update_local($id, $nombre, $direccion, $tipo_id, $admin_id, $lat, $lng, $open_hour = '0:00', $close_hour = '0:00') {
        //Se deja comentado latitud y longitud para que no se actualizen esos campos
        $data_set = array(
            'nombre' => $nombre,
            'direccion' => $direccion,
            'tipo_id' => $tipo_id,
            'admin_id' => $admin_id,
//            'latitud' => $lat,
//            'longitud' => $lng,
            'hora_apertura' => $open_hour,
            'hora_cierre' => $close_hour,
        );
        $table_name = 'empresa';
        $where_data = array('id'=>$id);
        $this->db->update($table_name, $data_set, $where_data);
        return $this->db->affected_rows();
    }
    
    /*Borra una empresa/ local*/
    function delete_local($id_emp) {
         //Borrando de la tabla usuario
        $table_name = 'empresa';
        $this->db->where('id', $id_emp);
        $this->db->delete($table_name);
        $afected_row = $this->db->affected_rows();

        return $afected_row;
    }
    
    /*Actualiza los datos de un tipo de empresa/local */
    function update_tipo($id, $nombre) {
        //Se deja comentado latitud y longitud para que no se actualizen esos campos
        $data_set = array(
            'nombre' => $nombre,
        );
        $table_name = 'empresa_tipo';
        $where_data = array('id'=>$id);
        $this->db->update($table_name, $data_set, $where_data);
        return $this->db->affected_rows();
    }
    
    /*Borra un tipo de empresa/ local*/
    function delete_tipo($id_tipo) {
         //Borrando de la tabla usuario
        $table_name = 'empresa_tipo';
        $this->db->where('id', $id_tipo);
        $this->db->delete($table_name);
        $afected_row = $this->db->affected_rows();

        return $afected_row;
    }

}
