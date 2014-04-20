<?php

 class Score extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library("session");
    }


    function index(){
		if(!$this->session->userdata("questions_num")==19){
			$this->load->model("m_ranking");
			$data=$this->m_ranking->getScoreId($this->session->userdata("session_id"));
			if(!$data){
				$data=array(
				"user"=>$this->session->userdata("name"),
				"facebook_user"=>$this->session->userdata("f_id"),
				"score"=>$this->session->userdata("score"),
				"session_id"=>$this->session->userdata("session_id")
				);
				$this->m_ranking->insertScore($data);
			}
			$this->load->view("v_score");
		}else{
			redirect("question");
		}
    }
	
	function restart(){
		$this->session->set_userdata("score",0);
		redirect("question");
	}
	function share($score){
		$this->load->view("share");
		echo 1;
	}
  }
