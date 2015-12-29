<?php
Class buscador extends CI_Model {
   function __construct()
	{
		parent::__construct();
	}
        
        public function search ($nombre){
             $this->db->select('id, '
                . 'empresa.nombre, '
                . 'direccion, '
                . 'latitud, '
                . 'longitud, '
                . 'disponible, '
                . 'hora_apertura, '
                . 'hora_cierre'                
        );
        $this->db->from('empresa'); 
         //$this->db->where('nombre', $nombre);
        $this->db->like('nombre',$nombre,'both');
        $this->db->or_like('direccion', $nombre, 'both');
       
        $query = $this->db->get();      
        return $query->result();           
          
        }

}



