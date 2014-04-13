<?php

 class Score extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library("session");
    }


    function index(){
		if(!$this->session->userdata("num_preguntas")==19){
			$this->load->view("vista_score");
		}else{
			redirect("c_preguntas");
		}
    }
	
	function restart(){
		$this->session->set_userdata("score",0);
		redirect("c_preguntas");
	}
	function share($score){
		$this->load->view("share");
		echo 1;
	}
  }
