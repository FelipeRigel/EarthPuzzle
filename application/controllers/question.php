<?php
 class Question extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_question");
        $this->load->helper('url');
		$this->load->library("session");
    }
	function prueba(){
    	$id_question = $this->m_question->get_id_question_rand($this->session->userdata("questions"));
		
		
	}
    function index(){
		if(!$this->session->userdata("name")){
			redirect("welcome");   
		}
		$correct = $this->input->post("answer");//estatico, se recibira por post

		if($this->session->userdata("questions_num")>18){
			$this->session->unset_userdata("questions_num");
			$question = $this->session->userdata("quest");
			$data["image"] = $this->m_question->get_description($question);
			$data["modal"] = true;
			$puntos=10;
			$min_score=$this->session->userdata('min_score');
			$sumar=$puntos+$min_score;
			
			if (isset($correct) and $correct == $question) {				
				$data["correct"] = 1;				
				if($this->session->userdata("score")=="0"){
					$this->session->set_userdata("score",$sumar);
						$this->session->userdata('min_score');
				}else{
					$score = $this->session->userdata("score");
					$this->session->set_userdata("score",$score+$sumar);
					$this->session->userdata('min_score');
					
				}
			}else{				
				$data["correct"] = 0;
			}
			$this->load->view("v_score",$data);
			return;
		}		
		//$this->session->unset_userdata("score");
    	$id_question = $this->m_question->get_id_question_rand($this->session->userdata("questions"));
    	$data["correct_question"]=$this->m_question->get_question($id_question->id);
		$data['question']=$this->m_question->question_of($id_question->id);
		if($this->session->userdata("questions_num")=="")
			$this->session->set_userdata("questions_num","0");
		
		if($this->input->post("answer")!=""){
		
			$correct = $this->input->post("answer");//estatico, se recibira por post
			//$question = $this->input->post("question");			
			$question = $this->session->userdata("quest");
			$data["image"] = $this->m_question->get_description($question);
			if($this->session->userdata("questions_num")!=""){
				$questions_num = $this->session->userdata("questions_num");
				$this->session->set_userdata("questions_num",$questions_num+1);
			}			
			if(count($this->session->userdata('questions'))==0 or  $this->session->userdata("questions")==""){
				$this->session->set_userdata("questions",$data["image"]->id);
				
				//entra cuando 
			}else{			
				//$questions_num = (isset($this->session->userdata("questions_num")))?$this->session->userdata("questions_num"):"0";
				$questions = $this->session->userdata('questions');
				//$this->session->set_userdata("questions_num",$questions_num+1);
				if(is_array($questions))$questions="0";
				$this->session->set_userdata("questions",$questions.",".$data["image"]->id);
			}
			$data["modal"] = true;
			$puntos=10;
			$min_score=$this->session->userdata('min_score');
			$sumar=$puntos+$min_score;
			if ($correct == $question) {				
				$data["correct"] = 1;				
				if($this->session->userdata("score")=="0"){
					$this->session->set_userdata("score",$sumar);
						$this->session->userdata('min_score');
				}else{
					$score = $this->session->userdata("score");
					$this->session->set_userdata("score",$score+$sumar);
					$this->session->userdata('min_score');
					
				}
			}else{				
				$data["correct"] = 0;
			}
		}
		//var_dump($questions_num);die();
		$data["score"] = $this->session->userdata("score");
		$this->load->database();
		$data["category"]=$this->m_question->get_category($id_question->id);
		$this->load->database();
		$place      = $this->m_question->get_place($id_question->id);
		$plac       = urlencode($place->place);
		$api        = 'https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$plac;
		$result     = file_get_contents($api);
		$result     = json_decode($result);
		$real_joker = array();
		$joker      = explode(",",$place->place);
		foreach($joker as $values){
			$subvalues = explode(" ",$values);
			/*foreach($subvalues as $item){
				$real_joker = $item."|";
			}*/
			$real_joker= $values."|";
		}
		
		$images = array();
		if(isset($result->responseData->results)){
			foreach($result->responseData->results as $item){
				$images[] = "<img class='rounded' width='200' height='200' title='' src='".$item->unescapedUrl."'/>";
			}
			$data["images"] = $images;
		}
		
		$data["images"] = $images;
		///$data["joker"]  = $joker;
		//var_dump($place);die();
		$this->session->set_userdata('min_score','0');
		$this->session->set_userdata('hint1',"0");
		$this->session->set_userdata('hint2',"0");
		$hints_place=$this->m_question->get_hints_by_place($place->id);///$this->wikidefinition($place->comodin);
		//print_r($hints_place);die();
		if($hints_place){
			foreach($hints_place as $h){//print_r($place);s						
				$h->hint=str_replace($place->comodin,"******",$h->hint);
			}
		}	
		$data["hints"]=$hints_place;
		$this->load->view("v_home",$data);					
	}
	function logout(){
		//$this->session->unset_userdata("nombre");
		$this->session->sess_destroy();
		if($this->m_question->delete_sess($this->session->userdata("session_id")))
			echo "It´s done";
		//$this->load->database();
		//$this->db->query("DELETE FROM ci_sessions where session_id='".$this->session->userdata("session_id")."'");
		//$this->session->sess_destroy();
		//echo 1;
		
	}
	/*
	function wikidefinition($s) {
	//ENGLISH WIKI
		$url = "http://en.wikipedia.org/w/api.php?action=opensearch&search=".urlencode($s)."&format=xml&limit=4";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
		curl_setopt($ch, CURLOPT_POST, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, FALSE);
		curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
		curl_setopt($ch, CURLOPT_REFERER, "");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; he; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8");

		$page = curl_exec($ch);
		//echo $page;
		$xml = simplexml_load_string($page);
		//var_dump($xml);
		$datos=array();
		//var_dump($xml);
		foreach($xml as $item){
			//var_dump($item);
			foreach($item->Item as $sub_item){
				//$dato=(string)($sub_item->Description);
				//$description_clean=str_replace($s,"**THIS COUNTRY**",$dato);
					$imagen=(string)($sub_item->Image["source"]);
					$dato=(string)($sub_item->Description);
					//var_dump($sub_item);
					//echo $dato;
					
					//$description_clean=str_replace($trash,"",$dato);
					//echo "<img src='$imagen' width=150 height=150 />";
					$datos[]=array("image"=>$imagen,"description"=>$description_clean);
			}
		}
		return $datos;
	}*/
	
	function hints(){
		/*$this->load->database();
		$data=$this->db->query("SELECT places.* FROM places
INNER JOIN images ON images.id=places.id
 WHERE STATUS=1")->result();
		foreach($data as $item){
			$information=$this->wikidefinition($item->comodin);
			var_dump($information);
			if(count($information)>0){
				foreach($information as $su){
				//utf8_encode
				//echo htmlentities($su["description"],ENT_QUOTES);
					$this->db->query("INSERT INTO hints SET id_place='".$item->id."', hint='".htmlentities($su["description"],ENT_QUOTES)."', image='".$su["image"]."'");
				}
			//echo $this->db->last_query();
			}
		}*/
	}
	
	
	function restar_puntos(){
		$hint=$this->input->post('hint');
		if($hint=="1" && $this->session->userdata('hint1')!="1"){
			$this->session->set_userdata('hint1',"1");
			$this->session->set_userdata('min_score',intval($this->session->userdata('min_score'))-3);
		}else{
		
		}
		if($hint=="2" && $this->session->userdata('hint2')!="2"){
			$this->session->set_userdata('hint2',"2");
			$this->session->set_userdata('min_score',intval($this->session->userdata('min_score'))-3);
		}else{
		
		}
	}
  }
