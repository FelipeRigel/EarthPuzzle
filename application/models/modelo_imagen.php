<?php
	class Modelo_imagen extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function get_img(){
			$this->db->where('status',0); // we get the images with status 0 to show in the home as random images
			return  $this->db->get('imagenes')->result(); 
			
		}
		
	}