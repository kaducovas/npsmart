<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lte extends CI_Controller {

	public function index()
	{
		
		$this->main();
	}
	
		public function main()
	{
		#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');		
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');

		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;		
		#echo $netype;
		
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		#echo $referencedate;
		
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			//$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				$reportdate = $referencedate;
			}
		} 
		else {
			$reportdate = $referencedate;
		}
		#print($referencedate);
		#$reportdate = '2016-12-22';
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;
		$data['reportagg'] = 'weekly';
		$data['reportkpi'] = 'all';		
		#echo $weeknum;
		
		

		#echo $node;
		
		#$node = $this->input->post('node');

		#$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['ufs'] = $this->model_cellsinfo->ufs_lte();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		#############################HEADER#####################		
		#echo $netype;
		#echo $this->input->post('reportnetype');
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");

		// if($netype == 'network'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->region_weekly_report($weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->network_daily_report($reportdate);
			// #$data['reportnetype'] = 'network';
		// }
		// elseif ($netype == 'region') {
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->region_daily_report($node,$reportdate);
			// #$data['reportnetype'] = 'region';
		// }
		// elseif($netype == 'uf'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report_ufinput($node,$weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->uf_daily_report($node,$reportdate);
			// #$data['reportnetype'] = 'ufs';
		// }		
		
		
		
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_weekly_report($weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_daily_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif ($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_daily_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report_ufinput($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_daily_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_daily_report($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}		
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_daily_report($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		elseif($netype == 'cell'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cell_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cell_daily_report($node,$reportdate);
			$data['reportnetype'] = 'cell';
		}
		elseif('cluster'){
		#elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_weekly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cluster_daily_report($node,$reportdate);
			$data['reportnetype'] = 'cluster';
		}			
		else{
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_daily_report($node,$reportdate);
			$data['reportnetype'] = 'city';
			}
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_lte',$data);
		$this->load->view('view_mainkpis_chart_lte',$data);
		$this->load->view('view_mainkpis_lte',$data);
	}
	
		public function daily()
	{
		$this->load->helper('form');
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');

		// //Set Date and Weeknum
		// if($this->input->post('reportdate')){
			// $reportdate = $this->input->post('reportdate');
			// //$reportdate = date('Y-m-d', strtotime($reportdate);
			// $referencedate = date("Y-m-d");
			// $referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			// if(strtotime($reportdate) > strtotime($referencedate)){ 
// //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				// $reportdate = $referencedate;
			// }
		// } else {
			// $reportdate = date("Y-m-d");
			// $daterange = $reportdate;
			// $reportdate = date('Y-m-d', strtotime($daterange.' -1 day'));
		// }
		// print($referencedate);
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		#echo $referencedate;
		
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			//$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				$reportdate = $referencedate;
			}
		} 
		else {
			$reportdate = $referencedate;
		}
		
		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;
		#echo $netype;
		// $referencedate = $this->model_cellsinfo->reference_date_lte($node);
		
		// //Set Date and Weeknum
		// if($this->input->post('reportdate')){
			// $reportdate = $this->input->post('reportdate');
			// #echo $reportdate;
			// if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				// $reportdate = $referencedate;
			// }
		// } 
		// else {
			// $reportdate = $referencedate;
			// #echo $reportdate;
		// }


		$data['reportdate'] = $reportdate;		
		$data['reportagg'] = 'daily';		
		$data['reportkpi'] = 'all';
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		
		$data['ufs'] = $this->model_cellsinfo->ufs_lte();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();	
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_daily_report_dash($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_hourly_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_ufinput_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }
		// elseif($netype == 'cluster'){
		// #elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }			
		
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}
		elseif($netype == 'cell'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cell_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cell_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'cell';
		}
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_lte',$data);
		if ($netype == 'cluster'){
		$this->load->view('view_lte_daily_error',$data);
		}
		else{
		$this->load->view('view_mainkpis_chart_lte',$data);
		$this->load->view('view_mainkpis_lte',$data);
		}
	}
	
	public function monthly()
	{
		$this->load->helper('form');
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');

		// //Set Date and Weeknum
		// if($this->input->post('reportdate')){
			// $reportdate = $this->input->post('reportdate');
			// //$reportdate = date('Y-m-d', strtotime($reportdate);
			// $referencedate = date("Y-m-d");
			// $referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			// if(strtotime($reportdate) > strtotime($referencedate)){ 
// //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				// $reportdate = $referencedate;
			// }
		// } else {
			// $reportdate = date("Y-m-d");
			// $daterange = $reportdate;
			// $reportdate = date('Y-m-d', strtotime($daterange.' -1 day'));
		// }
		// print($referencedate);
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		#echo $referencedate;
		
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			//$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				$reportdate = $referencedate;
			}
		} 
		else {
			$reportdate = $referencedate;
		}
		
		$date = new DateTime($reportdate);
		$monthnum = $date->format("M");
		$data['monthnum'] = $monthnum;
		$data['reportdate'] = $reportdate;
		$data['reportagg'] = 'monthly';
		$data['reportkpi'] = 'all';
		
		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;
		
		$data['ufs'] = $this->model_cellsinfo->ufs_lte();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();	
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->network_monthly_report($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_weekly_report_graph($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_monthly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_monthly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_monthly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }
		// elseif($netype == 'cluster'){
		// #elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }			
		
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_monthly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}
		elseif($netype == 'cell'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cell_monthly_report($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cell_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'cell';
		}
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_lte',$data);
		if ($netype == 'cluster'){
		$this->load->view('view_lte_daily_error',$data);
		}
		else{
		$this->load->view('view_mainkpis_chart_lte',$data);
		$this->load->view('view_mainkpis_lte',$data);
		}
	}
	
public function nqi()
	{
#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');
		$this->load->model('model_nqi_lte');
		$this->load->model('model_cellsinfo');
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;		

		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;		
		
		//Set KPI
		if($this->input->post('kpi')){
			$nekpi = $this->input->post('kpi');
		} else {
			$nekpi = 'nqi';
		}
		#echo $nekpi;
		$data['reportnetype'] = $netype;			
		
		//Set Date and Weeknum
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		$referencedate = $this->model_cellsinfo->reference_date($node);
		//echo $referencedate;
		
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
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;
		#echo $reportdate;
		$data['reportagg'] = 'weekly';
		$data['reportkpi'] = 'nqi';
		#echo $weeknum;

		$data['ufs'] = $this->model_cellsinfo->ufs_lte();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		#############################HEADER#####################		
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		if($netype == 'network'){
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_network($reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->network_daily_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif ($netype == 'region') {
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_region($node,$reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->region_daily_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_uf($node,$reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->uf_daily_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
			elseif($netype == 'cidades'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_cidade($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->cidade_daily_report($node,$reportdate);
				$data['reportnetype'] = 'cidades';
			}
		elseif($netype == 'enodebs'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_enodeb($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->enodeb_daily_report($node,$reportdate);
				$data['reportnetype'] = 'enodebs';
		}
		elseif($netype == 'cell'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_cell($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->cell_daily_report($node,$reportdate);
				$data['reportnetype'] = 'cell';
		}
		// elseif((strlen($node) == 8 && in_array(substr($node,1,2), $ufs) ) || (strlen($node) == 12 && substr($node,0,5) == 'IMP_E')){
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->enodeb_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->enodeb_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'enodeb';
		// }
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->cluster_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->cluster_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }			
		// else{
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->cidade_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->cidade_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'city';
			// }		
// #################################################################################
		
		// $regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		// if($node == 'NETWORK'){
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_network($reportdate);
			// #$data['node_weekly_report'] = $this->model_mainkpis->region_weekly_report($weeknum);
			// $data['node_daily_report'] = $this->model_nqi->network_daily_report($reportdate);	
			// $data['reportnetype'] = 'network';
		// }
		// elseif (in_array($node, $regions)) {
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_region($node,$reportdate);
			// $data['node_daily_report'] = $this->model_nqi->region_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'region';
		// }
		// elseif(substr($node,0,3) == 'RNC'){
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_rnc($node,$reportdate);
			// $data['node_daily_report'] = $this->model_nqi->rnc_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'rnc';
		// }
		// else{
			// $data['node_weekly_report'] = $this->model_mainkpis->cidade_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis->cidade_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'city';
			// }		
		

		#$data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_region();
		#$data['cells'] = $this->model_monitor->cells();
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_nqi_lte',$data);
		if ($netype == 'network' or $netype == 'region' or $netype == 'uf' or $netype == 'cidades' or $netype == 'enodebs' or $netype == 'cell'){
		$this->load->view('view_nqi_chart_lte',$data);
		$this->load->view('view_nqi_lte',$data);
		}
		else{
		$this->load->view('view_nqi_lte_error',$data);
		}
	}

public function nqi_monthly()
	{
#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');
		$this->load->model('model_nqi_lte');
		$this->load->model('model_cellsinfo');
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;		

		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;		
		
		//Set KPI
		if($this->input->post('kpi')){
			$nekpi = $this->input->post('kpi');
		} else {
			$nekpi = 'nqi';
		}
		#echo $nekpi;
		$data['reportnetype'] = $netype;			
		
		//Set Date and Weeknum
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		$referencedate = $this->model_cellsinfo->reference_date($node);
		//echo $referencedate;
		
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
		$date = new DateTime($reportdate);
		$monthnum = $date->format("M");
		$data['monthnum'] = $monthnum;
		$data['reportdate'] = $reportdate;
		#echo $reportdate;
		$data['reportagg'] = 'monthly';
		$data['reportkpi'] = 'nqi';
		#echo $weeknum;

		$data['ufs'] = $this->model_cellsinfo->ufs_lte();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		#############################HEADER#####################		
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		if($netype == 'network'){
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_network($reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->network_weekly_report_graph($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif ($netype == 'region') {
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_region($node,$reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->region_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_uf($node,$reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->uf_weekly_report_graph($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
			elseif($netype == 'cidades'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_cidade($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->cidade_weekly_report_graph($node,$reportdate);
				$data['reportnetype'] = 'cidades';
			}
		elseif($netype == 'enodebs'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_enodeb($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->enodeb_weekly_report_graph($node,$reportdate);
				$data['reportnetype'] = 'enodebs';
		}
		elseif($netype == 'cell'){
				$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_monthly_cell($node,$reportdate);
				$data['node_daily_report'] = $this->model_nqi_lte->cell_weekly_report_graph($node,$reportdate);
				$data['reportnetype'] = 'cell';
		}
		// elseif((strlen($node) == 8 && in_array(substr($node,1,2), $ufs) ) || (strlen($node) == 12 && substr($node,0,5) == 'IMP_E')){
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->enodeb_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->enodeb_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'enodeb';
		// }
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->cluster_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->cluster_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }			
		// else{
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->cidade_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->cidade_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'city';
			// }		
// #################################################################################
		
		// $regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		// if($node == 'NETWORK'){
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_network($reportdate);
			// #$data['node_weekly_report'] = $this->model_mainkpis->region_weekly_report($weeknum);
			// $data['node_daily_report'] = $this->model_nqi->network_daily_report($reportdate);	
			// $data['reportnetype'] = 'network';
		// }
		// elseif (in_array($node, $regions)) {
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_region($node,$reportdate);
			// $data['node_daily_report'] = $this->model_nqi->region_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'region';
		// }
		// elseif(substr($node,0,3) == 'RNC'){
			// $data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_rnc($node,$reportdate);
			// $data['node_daily_report'] = $this->model_nqi->rnc_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'rnc';
		// }
		// else{
			// $data['node_weekly_report'] = $this->model_mainkpis->cidade_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis->cidade_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'city';
			// }		
		

		#$data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_region();
		#$data['cells'] = $this->model_monitor->cells();
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_nqi_lte',$data);
		if ($netype == 'network' or $netype == 'region' or $netype == 'uf' or $netype == 'cidades' or $netype == 'enodebs' or $netype == 'cell'){
		$this->load->view('view_nqi_chart_lte',$data);
		$this->load->view('view_nqi_lte',$data);
		}
		else{
		$this->load->view('view_nqi_lte_error',$data);
		}
	}	

		public function baseline_enodeb()
	{
		#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis');
		$this->load->model('model_cellsinfo');
		$this->load->model('model_baseline');
		
 		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		//Set Type
		if($this->input->post('reportnetype')){
			$netype = $this->input->post('reportnetype');
		} else {
			$netype = 'network';
		}
		$data['reportnetype'] = $netype;
		#echo $netype;
		
		$referencedate = $this->model_cellsinfo->reference_date($node);
		#$referencedate = $this->model_cellsinfo->reference_date_daily($node);
		#echo $referencedate;
		
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			#echo $reportdate;
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				$reportdate = $referencedate;
			}
		} 
		else {
			$reportdate = $referencedate;
			#echo $reportdate;
		}
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;
		$data['reportagg'] = 'weekly';
		$data['reportkpi'] = 'all';
		#echo $weeknum;
		
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		
		#############################HEADER#####################		
		
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		if($netype == 'network'){
			$data['baseline_by_mo'] = $this->model_baseline->baseline_enodeb_by_mo($reportdate);
			$data['baseline_by_rnc'] = $this->model_baseline->baseline_enodeb_by_uf($reportdate);
			#$data['reportnetype'] = 'network';
		 }
		
		$this->load->view('view_header');
		$this->load->view('view_nav_baseline_lte',$data);
		#$this->load->view('view_theme_dark_blue');
		$this->load->view('view_theme_sand_signika');
		#$this->load->view('view_theme_dark_unica');
		$this->load->view('view_baseline_enodeb_chart',$data);
		$this->load->view('view_baseline_enodeb',$data);
		#$this->load->view('view_mainkpis',$data);
	}		
	
	
public function worstcells()
	{
		ini_set('memory_limit', '2048M');
		$this->load->model('model_worstcells_lte');
		$this->load->model('model_monitor_lte');
		$this->load->model('model_cellsinfo');
		
		// if($this->input->post('node')){
			// $rnc_query = $this->input->post('node');
		// } else {
			// $rnc_query = $this->input->post('reportnename');
		// }
		if($this->input->post('date')){
			$daterange = $this->input->post('date');
		} else {
			$daterange = $this->input->post('reportdate');
		}		
		$node_query = $this->input->post('node');

		$reportnename = $this->input->post('reportnename');
		$reportdate = $this->input->post('reportdate');
		$reportnetype = $this->input->post('reportnetype');	
		$timeagg = $this->input->post('timeagg');	
		#$inidate = date('Y-m-d', strtotime($daterange.' -6 day'));
		#$findate = date('Y-m-d', strtotime($daterange));

		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();		
		
		###Map kpi
		$data['reportagg'] = $timeagg;
		$data['reportdate'] = $reportdate;	
		$data['reportnename'] = $reportnename;
		$data['reportnetype'] = $reportnetype;
		$data['reportkpi'] = $this->input->post('kpi');
		#echo $this->input->post('kpi');
		$kpi = preg_replace('/\s+/', '', $this->input->post('kpi'));
		$kpi = strtolower($kpi);

		// $daterange = $this->input->post('wcdate');
		// $inidate = date('Y-m-d', strtotime($daterange.' -6 day'));
		// $findate = date('Y-m-d', strtotime($daterange));

		###Map kpi
		
		// $data['reportdate'] = $daterange;	
		// $data['reportnename'] = $node_query;
		
		$kpi = preg_replace('/\s+/', '', $this->input->post('kpi'));
		$kpi = strtolower($kpi);
		$kpimap = [
			"rrcservice" => "rrc_service",
			"rrcsignaling" => "rrc_signaling",
			"s1signaling" => "s1signaling",
			"e-rabacc" => "e_rab",
			"csfbsr" => "csfb",
			"serviceretainability" => "service_drop",
			"4gretention" => "retention_4g",
			//"dl" => "hsupa_drop",
			//"ul" => "traffic",
			//"users" => "traffic",
			"dlthp" => "cell_downlink_avg_thp",
			"ulthp" => "cell_uplink_avg_thp",
			//"rbutilizationdl" => "traffic",
			"intrafreqout" => "intra_freq_hoo_out",
			"interfreqout" => "inter_freq_hoo_out",
			"hoin" => "handover_in",
			"iratltetowcdma" => "iratho_l2w",
			"iratltetogsm" => "iratho_l2g",
			"availability" => "availability",
		];
		
		$kpi_family_map = [
			"rrcservice" => "accessibility",
			"rrcsignaling" => "accessibility",
			"s1signaling" => "accessibility",
			"e-rabacc" => "accessibility",
			"csfbsr" => "accessibility",
			"serviceretainability" => "retainability",
			"4gretention" => "mobility",
			//"dl" => "hsupa_drop",
			//"ul" => "traffic",
			//"users" => "traffic",
			"dlthp" => "service_integrity",
			"ulthp" => "service_integrity",
			//"rbutilizationdl" => "traffic",
			"intrafreqout" => "mobility",
			"interfreqout" => "mobility",
			"hoin" => "mobility",
			"iratltetowcdma" => "mobility",
			"iratltetogsm" => "mobility",
			"availability" => "availability",
		];

	$kpis_group1 = array("accessibility", "mobility"); //KPIs with num and den
	$kpis_group2 = array("availability", "traffic"); //KPIs without num and den		
	$kpis_group3 = array("coverage"); //KPIs without num and den		

	// $regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
	
		if($kpi_family_map[$kpi] !== "nqi" and $reportnetype !='cell' and $reportnetype !='custom'){
			$rnc_family = "rnc_main_kpis";

		}
		elseif($kpi_family_map[$kpi] !== "nqi" and $reportnetype == 'custom'){
			$rnc_family = "custom_main_kpis";
		}
		elseif($kpi_family_map[$kpi] !== "nqi" and $reportnetype == 'cell'){
			$rnc_family = "cell_main_kpis";
		}
		
		else{
			$rnc_family = "node_nqi";
		}
			
			$data['result'] = $this->model_monitor_lte->$rnc_family($reportnename,$reportdate,$timeagg,$reportnetype);
			$data['ne'] = $reportnename;	
	
	#echo $kpimap[$kpi];
		#if($this->input->post('rnc') &&  $this->input->post('cellid') && $cellid_query != "undefined"){
		// if($this->input->post('cellname')){
			// $cellid_array = $this->model_worstcells->find_cellid($this->input->post('cellname'));
			// $cellid = $cellid_array[0]->cellid;
			// $cell_family = "cell_".$kpi_family_map[$kpi];
			// $data['result'] = $this->model_monitor->$cell_family($node_query,$cellid,$daterange,$daterange);
			// $data['level'] = 'Cell';
			// $data['ne'] = $this->input->post('cellname');
		// } 
		// elseif (in_array($node_query, $regions)) {
			// $node_family = "region_".$kpi_family_map[$kpi];
			// $data['result'] = $this->model_monitor_lte->$node_family($node_query,$daterange,$daterange);

			// $data['ne'] = $node_query;
		// }
		
		
		###query para retorno das worst cells dependendo do indicador selecionado
			if(strpos($kpimap[$kpi], 'retention') !== FALSE && $kpi_family_map[$kpi] !== "nqi"){ #FOR RETENTION KPIs not from nqi we use the same methodology as the retainability kpi (1 - num/den)
				$data['wc'] = $this->model_worstcells_lte->rncwc_retainability($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			}
			elseif(in_array($kpi_family_map[$kpi], $kpis_group1)){
				#echo "ola";
				$data['wc'] = $this->model_worstcells_lte->rncwc($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			}
			 elseif (in_array($kpi_family_map[$kpi], $kpis_group2)) {
				 #echo "ola2";
				 $data['wc'] = $this->model_worstcells_lte->rncwcalt($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			 }
			 elseif (in_array($kpi_family_map[$kpi], $kpis_group3)) {
				 #echo "ola2";
				 $data['wc'] = $this->model_worstcells_lte->rncwcalt2($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			 }			 
			 elseif ($kpi_family_map[$kpi] == "retainability"){
				 #echo "ola3";
				 $data['wc'] = $this->model_worstcells_lte->rncwc_retainability($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			 }
			 elseif (strpos($kpimap[$kpi], 'nqi_retention') !== FALSE && $kpi_family_map[$kpi] == "nqi"){
				 #echo "ola3";
				 #$data['wc'] = $this->model_worstcells->rncwc_nqi_retention($kpimap[$kpi],$rnc_query,$kpi_family_map[$kpi],$inidate,$findate);
				 $data['wc'] = $this->model_worstcells_lte->rncwc_retainability($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
			 }			 
			 elseif ($kpi_family_map[$kpi] == "nqi"){
				 #echo "ola3";
				 $data['wc'] = $this->model_worstcells_lte->rncwc_nqi($kpimap[$kpi],$reportnename,$reportdate,$reportnetype,$timeagg);
				 #$data['wc'] = $this->model_worstcells->rncwc_nqi($kpimap[$kpi],$rnc_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }		
		
		
			// if(strpos($kpimap[$kpi], 'retention') !== FALSE){ #FOR RETENTION KPIs we use the same methodology as the retainability kpi (1 - num/den)
				// $data['wc'] = $this->model_worstcells_lte->nodewc_retainability($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			// }
			// elseif(in_array($kpi_family_map[$kpi], $kpis_group1)){
				// #echo "ola";
				// $data['wc'] = $this->model_worstcells_lte->nodewc($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			// }
			 // elseif (in_array($kpi_family_map[$kpi], $kpis_group2)) {
				 // #echo "ola2";
				 // $data['wc'] = $this->model_worstcells_lte->nodewcalt($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 // }
			 // elseif (in_array($kpi_family_map[$kpi], $kpis_group3)) {
				 // #echo "ola2";
				 // $data['wc'] = $this->model_worstcells_lte->nodecalt2($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 // }			 
			 // elseif ($kpi_family_map[$kpi] == "retainability"){
				 // #echo "ola3";
				 // $data['wc'] = $this->model_worstcells_lte->nodewc_retainability($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 // }
			 // elseif ($kpi_family_map[$kpi] == "service_integrity"){
				 // #echo "ola3";
				 // $data['wc'] = $this->model_worstcells_lte->nodewc_service_integrity($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 // }			 
			 // elseif ($kpi_family_map[$kpi] == "nqi"){
				 // #echo "ola3";
				 // $data['wc'] = $this->model_worstcells_lte->nodewc_nqi($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 // }
		

		

		#} 
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_lte',$data);
		#$trimmed = preg_replace('/\s+/', '', $this->input->post('kpi'));
		#echo $this->input->post('wcdate');
		#echo $this->input->post('rnc');
		#echo $trimmed;
		#$this->load->view('view_theme_sand_signika');
		#$this->load->view('view_theme_dark_unica');
		#$this->load->view('view_sparklines',$data);
		$this->load->view('view_sparklines_new',$data);
		$this->load->view('view_menu');
		
		if($this->input->post('node') || $this->input->post('cluster') || $this->input->post('cidade')){
			$wc_view = "view_wc_lte_".$kpimap[$kpi];
			#echo $wc_view;
			#$this->load->view('vw_wc_rrc',$data);
			$this->load->view($wc_view,$data);
		}
		if (in_array($kpi_family_map[$kpi], $kpis_group3) || $kpi_family_map[$kpi] == "service_integrity") {
			$this->load->view('view_wc_kpigroup3_lte',$data);
		}
		elseif ($kpi_family_map[$kpi] == "nqi"){
			$this->load->view('view_wc_nqi',$data);
		}
		else{
			$this->load->view('view_wc_lte',$data);
			
		}


		$this->load->view('view_footer');
	}
	
public function enodebcfg()
	{
		
		ini_set('memory_limit', '2048M');
		#############################HEADER#####################
		$this->load->helper('form');
		$this->load->library('table');
		$this->load->model('model_cellsinfo');
		$this->load->model('model_configuration');
		$this->load->library('Datatables');
		$data['reportnetype'] = 'network';
		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
		} else {
			$reportdate = date("Y-m-d");
		}
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;
		$data['reportagg'] = 'weekly';
		$data['reportkpi'] = 'all';
		#echo $weeknum;
		
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		#echo $node;
		
		//SET MO
		
		if($this->input->post('reportmo')){
			$mo = $this->input->post('reportmo');
		} else {
			$mo = 'enodebcell';
		}
		$data['reportmo'] = $mo;
		$data['mos'] = $this->model_cellsinfo->enodeb_mo();
		$data['schema'] = "enodeb_configuration.";
		$data['element'] = "enodeb";
		
		#############################HEADER#####################	
		
		#$data['results'] = $this->model_configuration->rnc_cfg();
		#$data['cells'] = $this->model_configuration->cells();
		
		
		$this->load->view('view_header');
		$this->load->view('view_nav_cfg_lte',$data);
		$this->load->view('view_configuration',$data);
	}	
	
public function event()
	{
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');
		#$data['cells'] = $this->model_monitor->cells();
		//Set Node
		
		#echo($this->input->get('reportnename'));
		if($this->input->get('reportnename')){
			$node = $this->input->get('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		//Set Type
		#print($this->input->get('reportnetype'));
				if($this->input->get('reportnetype')){
					$netype = $this->input->get('reportnetype');
				} else {
					$netype = 'network';
				}

				$data['reportnetype'] = $netype;
				#echo $netype;		
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		
		//Set Date and Weeknum
		if($this->input->get('reportdate')){
			$reportdate = $this->input->get('reportdate');
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				$reportdate = $referencedate;
			}
		} else {
			$reportdate = $referencedate;
		}
		
		$max_date = $this->model_cellsinfo->find_max_datetime_from_main_kpis_lte();
		$reportdate = $max_date[0]->datetime;	
	
		
		#print($referencedate);
		#$reportdate = '2016-12-22';
		#$date = new DateTime($reportdate);
		#$weeknum = $date->format("W");
		#$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;		
		$data['reportagg'] = 'daily';
		$data['reportkpi'] = 'all';		
		#echo $weeknum;
		
		

		#echo $node;
		
		#$node = $this->input->post('node');

		#$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_daily_report_dash($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_hourly_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_ufinput_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }
		elseif($netype == 'cluster'){
		#elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			#$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cluster';
		}			
		
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}
		elseif($netype == 'cell'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cell_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cell_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'cell';
		}
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_event_lte',$data);
		$this->load->view('view_mainkpis_chart_lte',$data);
		#$this->load->view('view_mainkpis_lte',$data);
		$this->load->view('view_other_lte',$data);		
	}

public function event2()
	{
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');
		#$data['cells'] = $this->model_monitor->cells();
		//Set Node
		
		#echo($this->input->get('reportnename'));
		if($this->input->get('reportnename')){
			$node = $this->input->get('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		//Set Type
		#print($this->input->get('reportnetype'));
				if($this->input->get('reportnetype')){
					$netype = $this->input->get('reportnetype');
				} else {
					$netype = 'network';
				}

				$data['reportnetype'] = $netype;
				#echo $netype;		
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		
		//Set Date and Weeknum
		if($this->input->get('reportdate')){
			$reportdate = $this->input->get('reportdate');
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				$reportdate = $referencedate;
			}
		} else {
			$reportdate = $referencedate;
		}
		
		$max_date = $this->model_cellsinfo->find_max_datetime_from_main_kpis_lte();
		$reportdate = $max_date[0]->datetime;	
	
		
		#print($referencedate);
		#$reportdate = '2016-12-22';
		#$date = new DateTime($reportdate);
		#$weeknum = $date->format("W");
		#$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;		
		$data['reportagg'] = 'daily';
		$data['reportkpi'] = 'all';		
		#echo $weeknum;
		
		

		#echo $node;
		
		#$node = $this->input->post('node');

		#$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_daily_report_dash($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_hourly_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_ufinput_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }
		elseif($netype == 'cluster'){
		#elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			#$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cluster';
		}			
		
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_event_lte',$data);
		$this->load->view('view_mainkpis_chart_lte2',$data);
		#$this->load->view('view_mainkpis_lte',$data);
		$this->load->view('view_other_lte2',$data);		
	}	

public function event3()
	{
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis_lte');
		$this->load->model('model_cellsinfo');
		#$data['cells'] = $this->model_monitor->cells();
		//Set Node
		
		#echo($this->input->get('reportnename'));
		if($this->input->get('reportnename')){
			$node = $this->input->get('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		//Set Type
		#print($this->input->get('reportnetype'));
				if($this->input->get('reportnetype')){
					$netype = $this->input->get('reportnetype');
				} else {
					$netype = 'network';
				}

				$data['reportnetype'] = $netype;
				#echo $netype;		
		
		$referencedate = $this->model_cellsinfo->reference_date_lte($node);
		
		//Set Date and Weeknum
		if($this->input->get('reportdate')){
			$reportdate = $this->input->get('reportdate');
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to the reference date
				$reportdate = $referencedate;
			}
		} else {
			$reportdate = $referencedate;
		}
		
		$max_date = $this->model_cellsinfo->find_max_datetime_from_main_kpis_lte();
		$reportdate = $max_date[0]->datetime;	
	
		
		#print($referencedate);
		#$reportdate = '2016-12-22';
		#$date = new DateTime($reportdate);
		#$weeknum = $date->format("W");
		#$data['weeknum'] = $weeknum;
		$data['reportdate'] = $reportdate;		
		$data['reportagg'] = 'daily';
		$data['reportkpi'] = 'all';		
		#echo $weeknum;
		
		

		#echo $node;
		
		#$node = $this->input->post('node');

		#$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional_lte();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		
		if($netype == 'network'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_daily_report_dash($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_hourly_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif($netype == 'region') {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif($netype == 'uf'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_ufinput_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'uf';
		}
		elseif($netype == 'enodebs'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'enodebs';
		}
		// elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			// $data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			// $data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			// $data['reportnetype'] = 'cluster';
		// }
		elseif($netype == 'cluster'){
		#elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			#$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report2_last($node,$reportdate);
			$data['reportnetype'] = 'cluster';
		}			
		
		elseif($netype == 'cidades'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_hourly_report2($node,$reportdate);
			$data['reportnetype'] = 'cidades';
		}
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_event_lte',$data);
		#$this->load->view('view_mainkpis_chart_lte2',$data);
		$this->load->view('view_mainkpis_lte2',$data);
		#$this->load->view('view_other_lte2',$data);		
	}	
	
}
