<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->helper(array('url','cookie'));
		$this->load->library(array('form_validation','session'));
		$this->load->model("m_question");
		$this->load->model("m_ranking");
		

	}
    function index(){
		if(!$this->session->userdata("name")) {
			$data["ranking"] = $this->m_ranking->ranking(5);
			$this->load->view('v_welcome',$data);
		}else{
			redirect("question");
		}
    }
	function img_random(){
		$data["images"] = $this->m_question->get_img();
		$random         = array_rand($data["images"], 1);
		$data["images"] = $data["images"][$random];
		$image          = $data["images"]->image_local;
		echo '<a href='.base_url().'assets/img/place/'.$image.'><img style="margin:auto"class="ui medium image"src='.base_url().'assets/img/place/'.$image.'><img></a>';
	
	}
    function start(){
    	$this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[20]|xss_clean');
    	if($this->form_validation->run() == FALSE){ 
			$array['error']=validation_errors();
			$array['estado']=0;
			redirect("welcome");
		}else{
			$name = $this->input->post('name');			
			$cookie=array(
				'name'=>$name,
				'questions'=>array(),
				'image'=>'',
				'score'=>0
			);
			$this->session->set_userdata($cookie);
			$dato['user'] = $this->session->userdata("name");			
			redirect("question");
		}
    }
	function login_fb(){
			$name=$this->input->post('name');
			$f_id=$this->input->post('f_id');
			$cookie=array(
				'name'      => $name,
				'f_id'      => $f_id,
				'questions'=> array(),
				'score'     => 0
			);
			$this->session->set_userdata($cookie);
			$dato['user']=$this->session->userdata("name");
	}
	function setimage(){
		$image = $this->input->post("image");
		$this->session->set_userdata("image",$image);
	}
	

	
}///FINAL

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */