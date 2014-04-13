<?php
	class Modelo_imagen extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function get_img(){
			$this->db->where('status',0);
			return  $this->db->get('imagenes')->result(); 
			
		}
		
	}