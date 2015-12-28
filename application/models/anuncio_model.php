<?php

Class Anuncio_model extends CI_Model {

    public function getPost() {
        return $this->db->get('post');
    }

    /* Extrae todos los anuncios registradas en la base de datos */

    function get_all() {
        $this->db->select('anuncio.id,'
                . 'titulo, '
                . 'descripcion img, '
                . 'fecha_inicio, '
                . 'fecha_fin,'
                . 'empresa_id,'
                . 'admin_id,'
                . 'emp.nombre empresa_nombre,'
                . 'user.nombres user_nombres,'
                . 'user.apellidos user_apellidos,'
        );
        $this->db->from('anuncio');
        $this->db->join('empresa emp', 'empresa_id = emp.id');
        $this->db->join('usuario user', 'emp.admin_id = user.id');

        $query = $this->db->get();
        return $query->result();
    }

    /* Extrae los ultimos 4 en la base de datos */

    function get_ultimos() {
        $this->db->select('anuncio.id,'
                . 'titulo, '
                . 'descripcion img, '
                . 'fecha_inicio, '
                . 'fecha_fin,'
                . 'empresa_id,'
                . 'url,'
                . 'admin_id,'
                . 'emp.nombre empresa_nombre,'
                . 'user.nombres user_nombres,'
                . 'user.apellidos user_apellidos,'
        );
        $this->db->from('anuncio');
        $this->db->join('empresa emp', 'empresa_id = emp.id');
        $this->db->join('usuario user', 'emp.admin_id = user.id');
        $this->db->order_by("fecha_inicio", "desc");
        $this->db->limit(4);

        $query = $this->db->get();
        return $query->result();
    }

    /* Guarda un nuevo anuncio */

    function save_new($titulo, $file, $empresa_id, $hora_registro, $fecha_inicio = '', $fecha_fin = '', $url = '') {
        $form_data = array(
            'titulo' => $titulo,
            'descripcion' => $file,
            'empresa_id' => $empresa_id,
            'hora_registro' => $hora_registro,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'url' => $url
        );
        $table_name = 'anuncio';
        $this->db->insert($table_name, $form_data);
        $anuncio = $this->db->insert_id();
        return $anuncio;
    }

}

?>