<?php

 class M_preguntas extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_pregunta($pregunta){
    	
    	$x= $this->db->query("(SELECT imagenes.`id`,imagenes.`imagen`,imagenes.id_place,places.`place`,1 AS respuesta FROM imagenes JOIN places ON places.`id` = imagenes.`id_place` WHERE imagenes.id=".$pregunta." and imagenes.status=1)
UNION ALL
(SELECT '','',imagenes.`id_place`,places.`place`,0 FROM imagenes JOIN places ON places.`id` = imagenes.`id_place` WHERE imagenes.id!=".$pregunta." and imagenes.status=1  ORDER BY RAND() LIMIT 3)
ORDER BY RAND()")->result();
    	return $x;

    }

    function get_id_pre_rand($preguntas_contestadas=""){
    	if($preguntas_contestadas==false || ($preguntas_contestadas)=="" ){
    		$query=$this->db->query("SELECT * FROM imagenes WHERE imagenes.`id` NOT IN (0) AND imagenes.status=1 ORDER BY RAND() LIMIT 1");
    	}else{
    		
    		$query=$this->db->query("SELECT * FROM imagenes WHERE imagenes.`id` NOT IN (".$preguntas_contestadas.") AND imagenes.status=1  ORDER BY RAND() LIMIT 1");
			
    	}
    	return $query->row();
    }
   function get_description($id_p){
        $this->db->select("id,imagen,description,latitud,longitud");
        $this->db->where("md5(id_place)",$id_p);
        $row = $this->db->get("imagenes");		
        if($row->num_rows==1)
            return $row->row();
        else
            return false;
    } 
	
	function get_descriptions(){
        return $this->db->query("SELECT id,description  FROM description")->result();
       
    }
	
	
	function eliminar_sess($id_session){
		if($this->db->query("DELETE FROM ci_sessions where session_id='".$this->session->userdata("session_id")."'"))
			return true;
	}
}

