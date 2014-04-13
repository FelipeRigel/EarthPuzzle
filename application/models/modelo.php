<?php
	class Modelo_salones extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function consultar(){
		     
		    $this->db->order_by("nombre", "asc");
			return $this->db->get('salones')->result();
		}
		public function super_buscar($campos){
			if($campos['nombre']!=''){
				  $this->db->like('nombre',$campos['nombre']); 
			}
			if($campos['direccion']!=''){
				  $this->db->like('direccion',$campos['direccion']); 
			}
			if($campos['max_personas']!=''){
				  $this->db->where('max_personas '.$campos['o_max_personas'],$campos['max_personas']); 
			}
			if($campos['calificacion']!=''){
				  $this->db->where('calificacion '.$campos['o_calificacion'],$campos['calificacion']); 
			}
			if($campos['precio']!=''){
				  $this->db->where("precio ".$campos['o_precio'],$campos['precio']); 
			}
			if($campos['tam']!=''){
				  $this->db->where('tam '.$campos['o_tam'],$campos['tam']); 
			}
			if($campos['alberca']!=0){
				  $this->db->where('alberca',$campos['alberca']); 
			}
			if($campos['infantil']!=0){
				  $this->db->where('infantil',$campos['infantil']); 
			}
			if($campos['estacionamiento']!=0){
				  $this->db->where('estacionamiento',$campos['estacionamiento']); 
			}
			return $this->db->get('salones')->result();
		}

		public function consultar_id($id){
			$this->db->where('id', $id); 
			return $this->db->get('salones')->result();
		}

		public function consultar_nombre($dato,$tabla,$campo){
			return $this->db->query("select * from $tabla where $campo like '".$dato."%'")->result();
		}
		public function cambiar_estatus($dato){
			$aux=$this->db->query("select activo from productos where id = '".$dato."' ")->result();
			print_r($aux->activo);
			if($aux->activo == 1){
				
				$this->db->query("update productos set activo = 0 where id=$dato");
			}
			else{
				$this->db->query("update productos set activo = 1 where id=$dato");
			}
		}
	
		public function agregar_salon($campos)
		{	
			$this->db->insert('salones', $campos); 
	
		}
		public function editar_salon($campos,$id)
		{	
			$this->db->where('id', $id);
			$this->db->update('salones', $campos); 	
		}

		public function slider(){
			 $this->db->order_by("calificacion", "desc");
			return $this->db->get('salones',5)->result();
		}
		public function consulta_principal(){
			 $this->db->order_by("calificacion", "desc");
			return $this->db->get('salones',5)->result();
		}
		
	}
