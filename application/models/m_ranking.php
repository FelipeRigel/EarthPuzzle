 <?php

 class M_ranking extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	function ranking($number){
		return $this->db->query('SELECT * FROM scores 
							ORDER BY score DESC 
							LIMIT '.$number.';
						')->result();
						
	}
	
	function insertScore($data){
		$this->db->insert("scores",$data);
		return $this->db->insert_id();
	
	}
	function getScoreId($session_id){
		$data=$this->db->query("SELECT * FROM scores WHERE session_id='".$session_id."'");
		if($data->num_rows())
			return $data->row();
		return false;
	}
	
}