<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BLMain extends CI_Controller {

	public function index()
	{
		
		$this->main();
	}
	
	public function main()
	{
				#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');
	//	$this->load->model('model_mainkpis');
		$this->load->model('model_cellsinfo');
		
//Set Node
			$node = 'NETWORK';
		$data['reportnename'] = $node;
		
		$referencedate = $this->model_cellsinfo->reference_date($node);
		#echo $referencedate;
		
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				$reportdate = $referencedate;
			}
		} 
		else {
			$reportdate = $referencedate;
		}
		date_default_timezone_set("GMT");
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;
		$data['reportagg'] = 'weekly';
		$data['reportkpi'] = 'all';
		#echo $weeknum;
		
		$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['regional'] = $this->model_cellsinfo->regional();
		$data['cidades'] = $this->model_cellsinfo->cidades();
		$data['clusters'] = $this->model_cellsinfo->clusters();
		
		#############################HEADER#####################	
		
		$data['node_weekly_report']=null;
		$data['node_daily_report'] = null;
		$data['reportnetype'] = 'rnc';
			
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		ini_set('memory_limit', '2048M');
		$this->load->library('table');
		

		$this->load->view('view_header_baseline');
		$this->load->view('view_nav_baseline',$data);
	//	$this->load->view('view_mainkpis_chart',$data);
	//	$this->load->view('view_mainkpis',$data);
		
	}
}