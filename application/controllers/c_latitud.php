<?php
  class C_latitud  extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_preguntas");
        $this->load->helper('url');
		$this->load->library("session");
    }
	
	function get_l(){
		
		$preguntas = $this->m_preguntas->get_descriptions();
		if(is_array($preguntas)){
			//print_r($preguntas);
			foreach($preguntas as $pregunta){
				//print_r($pregunta);
				echo $pregunta->description;
				//echo preg_match('//',$pregunta->description);
				echo "<br><br>";
						
			}
		}
	}
	
}