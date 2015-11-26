<?php

Class Login_model extends CI_Model {

    function login($username, $password) {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->select('*');
        $this->db->from('usuario');

        $this->db->join('usuario_rol', 'usuario_id = usuario.id');
        $this->db->join('rol', 'rol_id = rol.id');
        $query = $this->db->get();

//        $query = $this->db->query('SELECT *
//	FROM  usuario
//	WHERE email = "' . $username . '" AND password = "' . MD5($password . get_settings('PASSWORDSALTMAIN')) . '"');

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('index.php/portal', 'refresh');
    }

}
