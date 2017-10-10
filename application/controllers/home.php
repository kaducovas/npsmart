<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class performance extends CI_Controller {

	public function index()
	{
		$this->tp();
	}
	
		public function welcome()
	{
		$this->load->view('welcome_message');
	}
	
		public function tp()
	{
		$this->load->helper('form');
		$this->load->model('teste');
		
		$data['result'] = $this->teste->query();
		$this->load->view('view_home',$data);
	}

	
}
