<?php

class Test extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper("url");
	}
	
	function index(){

		$this->load->view("test_images");
	}
	
	function test_o(){
		/*$int=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=eua&sensor=true");
		$var=json_decode($int);

		foreach($var->results as $result){
			foreach($result->address_components as $item){
				echo $item->long_name;
				echo "<br>";
			}
		}*/
	
		/*$api='http://en.wikipedia.org/w/api.php?action=opensearch&search=mexico&limit=4&format=json';
		$result = json_decode(file_get_contents($api));
		echo "<html><pre>";
		foreach($result as $item):
		var_dump($item);
		endforeach;
		echo "</pre></html>";*/
		$array=$this->wikidefinition("New Zealand Coastline");
		var_dump($array);
	}
	
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
		foreach($xml as $item){
			//var_dump($item);
			foreach($item->Item as $sub_item){
				$imagen=(string)($sub_item->Image["source"]);
				//echo "<img src='$imagen' width=150 height=150 />";
				$dato=(string)($sub_item->Description);
				$datos[]=array("image"=>$imagen,"descriptio"=>$dato);
			}
		}
		return $datos;
	}
	
	function test_modal(){
		$this->load->view("vista_home_old");
	}
}