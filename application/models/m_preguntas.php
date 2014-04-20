<?php

 class M_question extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_question($question){
    	 //we get random options to show with the correct answer
    	$x= $this->db->query("(SELECT imagenes.`id`,imagenes.`imagen`,imagenes.id_place,places.`place`,1 AS respuesta FROM imagenes JOIN places ON places.`id` = imagenes.`id_place` WHERE imagenes.id=".$pregunta." and imagenes.status=1)
UNION ALL
(SELECT '','',imagenes.`id_place`,places.`place`,0 FROM imagenes JOIN places ON places.`id` = imagenes.`id_place` WHERE imagenes.id!=".$pregunta." and imagenes.status=1  ORDER BY RAND() LIMIT 3)
ORDER BY RAND()")->result();
    	return $x;

    }

    function get_id_question_rand($preguntas_contestadas=""){
	//we get a random image that it hasn't been answered yet
    	if($questions_answered==false || ($questions_answered)=="" ){
    		$query=$this->db->query("SELECT * FROM imagenes WHERE imagenes.`id` NOT IN (0) AND imagenes.status=1 ORDER BY RAND() LIMIT 1");
    	}else{
    		
    		$query=$this->db->query("SELECT * FROM imagenes WHERE imagenes.`id` NOT IN (".$questions_answered.") AND imagenes.status=1  ORDER BY RAND() LIMIT 1");
			
    	}
    	return $query->row(); 
    }
   function get_description($id_p){ // we get the description with the ip of that image
        $this->db->select("id,imagen,description,latitud,longitud");
        $this->db->where("md5(id_place)",$id_p);
        $row = $this->db->get("imagenes");		
        if($row->num_rows==1)
            return $row->row();
        else
            return false;
    } 
	
	function get_descriptions(){
        return $this->db->query("SELECT id,description  FROM description")->result(); //we get all the descriptions
       
    }
	
	
	function delete_sess($id_session){
	// we delete the session
		if($this->db->query("DELETE FROM ci_sessions where session_id='".$this->session->userdata("session_id")."'"))
			return true;
	}
}

