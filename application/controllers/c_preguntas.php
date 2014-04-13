<?php

 class C_preguntas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_preguntas");
        $this->load->helper('url');
		$this->load->library("session");
    }
	function prueba(){
    	$id_pregunta = $this->m_preguntas->get_id_pre_rand($this->session->userdata("preguntas"));
		

		//foreach(
		
	}
    function index(){
		if(!$this->session->userdata("nombre")){
			redirect("welcome");
		}
		if($this->session->userdata("num_preguntas")==19){
			$this->session->unset_userdata("num_preguntas");
			$this->load->view("vista_score");
			return;
		}		
		//$this->session->unset_userdata("score");
    	$id_pregunta = $this->m_preguntas->get_id_pre_rand($this->session->userdata("preguntas"));
    	$data["pregunta_correcta"]=$this->m_preguntas->get_pregunta($id_pregunta->id);	
		if($this->session->userdata("num_preguntas")=="")
			$this->session->set_userdata("num_preguntas","0");
		
		if($this->input->post("respuesta")!=""){
		
			$correcta = $this->input->post("respuesta");;//estatico, se recibira por post
			$pregunta = $this->input->post("pregunta");			
			$data["imagen"] = $this->m_preguntas->get_description($pregunta);
			if($this->session->userdata("num_preguntas")!=""){
				$num_preguntas = $this->session->userdata("num_preguntas");
				$this->session->set_userdata("num_preguntas",$num_preguntas+1);
			}			
			if(count($this->session->userdata('preguntas'))==0 or  $this->session->userdata("preguntas")==""){
				$this->session->set_userdata("preguntas",$data["imagen"]->id);
				
				//entra cuando 
			}else{			
				//$num_preguntas = (isset($this->session->userdata("num_preguntas")))?$this->session->userdata("num_preguntas"):"0";
				$preguntas=$this->session->userdata('preguntas');
				//$this->session->set_userdata("num_preguntas",$num_preguntas+1);
				if(is_array($preguntas))$preguntas="0";
				$this->session->set_userdata("preguntas",$preguntas.",".$data["imagen"]->id);
			}
			$data["modal"] = true;
			if ($correcta == $pregunta) {				
				$data["correct"] = 1;				
				if($this->session->userdata("score")=="0"){
					$this->session->set_userdata("score","1");
				}else{
					$score = $this->session->userdata("score");
					$this->session->set_userdata("score",$score+1);
					
				}
			}else{				
				$data["correct"] = 0;
			}
		}
		//var_dump($num_preguntas);die();
		$data["score"] = $this->session->userdata("score");
		$this->load->database();
		$data["category"]=$this->db->query("SELECT * FROM categorias")->result();
		
		$this->load->database();
		$place=$this->db->query("SELECT place FROM places WHERE id='".$id_pregunta->id."'")->row();
		$plac=urlencode($place->place);
		$api='https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$plac;
		$result = file_get_contents($api);
		$result=json_decode($result);
		$real_comodines=array();
		$comodines=explode(",",$place->place);
		foreach($comodines as $values){
			$subvalues=explode(" ",$values);
			foreach($subvalues as $item){
				$real_comodines[]=$item;
			}
			$real_comodines[]=$values;
		}
		$imagenes=array();
		if(isset($result->responseData->results)){
			foreach($result->responseData->results as $item){
				$imagenes[]="<img class='rounded' width='200' height='200' title='' src='".$item->unescapedUrl."'/>";
			}
			$data["imagenes"]=$imagenes;
		}
		
		$data["imagenes"]=$imagenes;
		$data["comodines"]=$comodines;
		
		$this->load->view("vista_home",$data);					
	}
	function logout(){
		//$this->session->unset_userdata("nombre");
		$this->session->sess_destroy();
		if($this->m_preguntas->eliminar_sess($this->session->userdata("session_id")))
			echo "se hizo";
		//$this->load->database();
		//$this->db->query("DELETE FROM ci_sessions where session_id='".$this->session->userdata("session_id")."'");
		//$this->session->sess_destroy();
		//echo 1;
		
	}
  }
