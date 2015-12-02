<?php

Class Usuario_model extends CI_Model {

    function save_new_user($username, $password) {
        
    }

    /* Extrae los datos de un solo usuario */

    function get_data($email) {
        $this->db->select('nombres, apellidos, cedula_ruc, email');
        $this->db->from('usuario');
        $this->db->where('email', $email);

        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae todos los usuarios registradas en la base de datos */

    function get_all() {
        $this->db->select('usuario.id,'
                . 'nombres, '
                . 'apellidos, '
                . 'cedula_ruc, '
                . 'email,'
                . 'usuario,'
                . 'rol.nombre rol');
        $this->db->from('usuario');
        $this->db->join('usuario_rol', 'usuario_id = usuario.id');
        $this->db->join('rol', 'rol_id = rol.id');
        $query = $this->db->get();
        return $query->result();
    }

    function get_users_by_type() {
        
    }


    /* Extrae los roles */

    function get_roles() {
        $this->db->from('rol');

        $query = $this->db->get();
        return $query->result();
    }

}
