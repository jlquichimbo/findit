<?php

Class locales_model extends CI_Model {
    function eliminar($id){
		$this->db->where('id', $id);
		$this->db->delete('empresa'); 
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
    }
}

