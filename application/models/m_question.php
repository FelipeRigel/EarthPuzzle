<?php

 class M_question extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
   
	function get_place($id_question){
		return $this->db->query("SELECT * FROM places WHERE id='".$id_question."'")->row();
	}
	function get_category($id_question){
		return $this->db->query("SELECT * FROM category")->result();		
	}
	
	
   
    function get_question($question){
    	 //we get random options to show with the correct answer
    	$x= $this->db->query("(SELECT images.`id`,images.`image_local`,images.`image`,images.id_place,places.`place`,1 AS answer,latitude,length FROM images JOIN places ON places.`id` = images.`id_place` WHERE images.id=".$question." and images.status=1)
UNION ALL
(SELECT '','',images.`id_place`,images.`image_local`,places.`place`,0,0,0 FROM images JOIN places ON places.`id` = images.`id_place` WHERE images.id!=".$question." and images.status=1  ORDER BY RAND() LIMIT 3)
ORDER BY RAND()")->result();
    	return $x;

    }
	function question_of($question){
		$this->db->select('images.id,category.*');
		$this->db->where('images.status',1);
		$this->db->where('images.id',$question);
		$this->db->join('category','category.id = images.category_id');
		$this->db->join('places','places.id = images.id_place');
		return $this->db->get('images')->result();
	}
    function get_id_question_rand($questions_answered=""){
	//we get a random image that it hasn't been answered yet
    	if($questions_answered==false || ($questions_answered)=="" ){
    		$query=$this->db->query("SELECT * FROM images WHERE images.`id` NOT IN (0) AND images.status=1 ORDER BY RAND() LIMIT 1");
    	}else{
    		
    		$query=$this->db->query("SELECT * FROM images WHERE images.`id` NOT IN (".$questions_answered.") AND images.status=1  ORDER BY RAND() LIMIT 1");
			
    	}
    	return $query->row(); 
    }
   function get_description($id_p){ // we get the description with the ip of that image
        $this->db->select("id,image,image_local,description,latitude,length");
        $this->db->where("md5(id_place)",$id_p);
        $row = $this->db->get("images");		
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
	public function get_img(){
		$this->db->where('status',0); // we get the images with status 0 to show in the home as random images
		return  $this->db->get('images')->result(); 
		
	}
	public function get_latitude_length($id){
		$this->db->select("latitude,length");
		$this->db->where("md5(id)",$id);
		$row=$this->db->get("images");
		 if($row->num_rows==1)
            return $row->row();
        else
            return false;
	}
	
	function get_hints_by_place($id_place){
		$datos=$this->db->get_where("hints",array("id_place"=>$id_place));
		if($datos->num_rows()>3)
			return $datos->result();
		return false;
	}
}

