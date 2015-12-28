<?php

Class Usuario_model extends CI_Model {

    function save_new_user($username, $password) {
        
    }

    public function getPost() {
        return $this->db->get('post');
    }

    /* Extrae los datos de un solo usuario */

    function get_data($email) {
        $this->db->select('id, nombres, apellidos, usuario, cedula_ruc, email, telefono');
        $this->db->from('usuario');
        $this->db->where('email', $email);

        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result();
    }

    function get_data_by_id($id) {
        $this->db->select('nombres, apellidos, usuario, password,  cedula_ruc, email, telefono');
        $this->db->from('usuario');
        $this->db->where('id', $id);

        $this->db->limit(1);

        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae todos los usuarios registradas en la base de datos */

    function get_all() {
        $this->db->select('usuario.id,'
                . 'nombres, '
                . 'apellidos, '
                . 'usuario,'
                . 'cedula_ruc, '
                . 'email,'
                . 'telefono,'
                . 'usuario,'
                . 'rol.nombre rol,'
                . 'rol.id rol_ids,'
        );
        $this->db->from('usuario');
        $this->db->join('usuario_rol', 'usuario_id = usuario.id');
        $this->db->join('rol', 'rol_id = rol.id');
        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae Usuario para enviar correo */

    function getUsuario($email) {
        $this->db->select('nombres, '
                . 'apellidos, '
        );
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
    }

    //funcion para actualizar la generación de la nueva contraseña
    function nuevaPass($mail, $pass) {
        $data_set = array(
            'password' => $pass,
        );
        $table_name = 'usuario';
        $where_data = array('email' => $mail);
        $this->db->update($table_name, $data_set, $where_data);
        return $this->db->affected_rows();
    }

    function get_users_by_type() {
        
    }

    /* Extrae los roles */

    function get_roles() {
        $this->db->from('rol');

        $query = $this->db->get();
        return $query->result();
    }

    /* Guarda un nuevo usuario */
    /* public function insert($post = null) {
      if ($post != null){
      $cedula = $post['txtCedula'];
      $nombres = $post['txtNombre'];
      $apellidos = $post['txtApellido'];
      $file_name = $post['file_name'];
      $telefono = $post['txtTelefono'];
      $email = $post['txtMail'];
      $password = $post['txtPassword'];

      $SQL ="INSERT INTO USUARIO(cedula_ruc,nombres, apellidos, usuario, telefono, email, password) VALUES ('$cedula', '$nombres','$apellidos', '$file_name', '$telefono', '$email', '$password')";

      if($this->db->query($SQL)){
      return true;
      }
      return false;

      }
      } */

    function save_new($cedula, $nombres, $apellidos, $imagen, $telefono, $email, $password) {
        $form_data = array(
            'cedula_ruc' => $cedula,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'usuario' => $imagen = 'user.jpg',
            'telefono' => $telefono,
            'email' => $email,
            'password' => $password,
        );



        $table_name = 'usuario';
        $this->db->insert($table_name, $form_data);
        $usuario_id = $this->db->insert_id();


        //Guardar rol 2
        $rol_data = array(
            'usuario_id' => $usuario_id,
            'rol_id' => 2
        );

        $this->db->insert('usuario_rol', $rol_data);
        return $usuario_id;
    }

    /* Actualizar usuario existente por id */

    function update($user_id, $cedula, $nombres, $apellidos, $usuario, $password, $email, $telefono, $rol_id = 2) {
        $data_set = array(
            'cedula_ruc' => $cedula,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'usuario' => $usuario,
            'password' => $password,
            'email' => $email,
            'telefono' => $telefono,
        );
        $table_name = 'usuario';
        $this->db->where('id', $user_id);
        $this->db->update($table_name, $data_set);
        $afected_row = $this->db->affected_rows();

        //Guardar rol nuevo
        $rol_data = array(
            'rol_id' => $rol_id
        );
        $this->db->where('usuario_id', $user_id);
        $this->db->update('usuario_rol', $rol_data);

        return $afected_row;
    }

    function check_email($email) {
        $this->db->select('email');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->result();
    }

}

?>