<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->helper(array('url','cookie'));
		$this->load->library(array('form_validation','session'));
		$this->load->model("modelo_imagen");

	}
    function index(){
		//$this->session->sess_destroy();
		//echo $this->session->userdata("nombre");
		if(!$this->session->userdata("nombre")) {
			$this->load->view('vista_bienvenida');
		}else{
			redirect("c_preguntas");
		}
    }
	function bienvenida2(){
		$this->load->view('vista_bienvenida2');
	}
	function img_random(){
		$datos["imagenes"]=$this->modelo_imagen->get_img();
		$random = array_rand($datos["imagenes"], 1);
		$datos["imagenes"]=$datos["imagenes"][$random];
		$imagen=$datos["imagenes"]->imagen;
		echo '<a href='.$imagen.'><img style="margin:auto"class="ui medium image"src='.$imagen.'><img></a>';
	
	}
    function iniciar()
    {
    	$this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[4]|max_length[20]|xss_clean');
    	if($this->form_validation->run() == FALSE)
		{ 
			$array['error']=validation_errors();
			$array['estado']=0;
			redirect("welcome");
		}else{
			$nombre=$this->input->post('nombre');
			$cookie=array(
				'nombre'=>$nombre,
				'preguntas'=>array(),
				'image'=>'',
				'score'=>0
			);
			$this->session->set_userdata($cookie);
			$dato['usuario']=$this->session->userdata("nombre");
			
			redirect("c_preguntas");
		}
    }
	function login_fb(){
			$nombre=$this->input->post('nombre');
			$cookie=array(
				'nombre'=>$nombre,
				'preguntas'=>array(),
				'score'=>0
			);
			$this->session->set_userdata($cookie);
			$dato['usuario']=$this->session->userdata("nombre");
	}
	function setimage(){
		$image=$this->input->post("image");
		$this->session->set_userdata("image",$image);
	}
}///FINAL

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */