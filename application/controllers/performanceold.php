<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Performance extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
		//$this->welcome();
	}
	
		public function welcome()
	{
		$this->load->view('welcome_message');
	}
	
		public function tp()
	{
		$this->load->model('teste');
		$rnc_query = $this->input->post('rnc');
		$cellid_query = $this->input->post('cellid');
		if($this->input->post('rnc')){
			$data['result'] = $this->teste->query($rnc_query,$cellid_query);		
		}

		$this->load->view('view_header');
		$this->load->view('view_theme');		
		if($this->input->post('rnc')){
			$this->load->view('view_pd',$data);
		}
		$this->load->view('view_home');
	}

		public function rrc()
	{
		$this->load->model('model_rrc');
		$rnc_query = $this->input->post('rnc');
		$cellid_query = $this->input->post('cellid');
		if($this->input->post('rnc')){
			$data['result'] = $this->teste->query($rnc_query,$cellid_query);		
		}
		$this->load->view('welcome_message');
		//$this->load->view('view_header');
		//$this->load->view('view_theme');		
		//if($this->input->post('rnc')){
		//	$this->load->view('view_rrc',$data);
		}
		//$this->load->view('view_home_rrc');
	}

		public function monitor()
	{
		$this->load->view('welcome_message');
	}
	
}
