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
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional();
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
		
		
		
		
		if($node == 'NETWORK'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_weekly_report($weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_daily_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif (in_array($node, $regions)) {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_daily_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif(in_array($node, $ufs)){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->rnc_weekly_report_ufinput($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_daily_report($node,$reportdate);
			$data['reportnetype'] = 'ufs';
		}
		elseif((strlen($node) == 8 && in_array(substr($node,1,2), $ufs) ) || (strlen($node) == 12 && substr($node,0,5) == 'IMP_E')){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_weekly_report($node,$weeknum);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_daily_report($node,$reportdate);
			$data['reportnetype'] = 'enodeb';
		}
		elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_weekly_report($node,$weeknum);
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

		//Set Date and Weeknum
		if($this->input->post('reportdate')){
			$reportdate = $this->input->post('reportdate');
			//$reportdate = date('Y-m-d', strtotime($reportdate);
			$referencedate = date("Y-m-d");
			$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			if(strtotime($reportdate) > strtotime($referencedate)){ //IF the date if greater than yesterday then it changes to yesterday as currently lte only calculates kpi in the following day.
				$reportdate = $referencedate;
			}
		} else {
			$reportdate = date("Y-m-d");
			$daterange = $reportdate;
			$reportdate = date('Y-m-d', strtotime($daterange.' -1 day'));
		}


		$data['reportdate'] = $reportdate;		
		$data['reportagg'] = 'daily';		
		
		$date = new DateTime($reportdate);
		$weeknum = $date->format("W");
		
		
		//Set Node
		if($this->input->post('reportnename')){
			$node = $this->input->post('reportnename');
		} else {
			$node = 'NETWORK';
		}
		$data['reportnename'] = $node;
		
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();	
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		
		if($node == 'NETWORK'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->region_daily_report_dash($reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->network_hourly_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif (in_array($node, $regions)) {
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->region_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		elseif(in_array($node, $ufs)){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->uf_daily_report_ufinput_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->uf_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'ufs';
		}
		elseif((strlen($node) == 8 && in_array(substr($node,1,2), $ufs) ) || (strlen($node) == 12 && substr($node,0,5) == 'IMP_E')){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->enodeb_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->enodeb_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'enodeb';
		}
		elseif($node == 'DF-Taguatinga' || $node == 'Bahia-teste'){
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cluster_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cluster_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'cluster';
		}	
		
		else{
			$data['node_weekly_report'] = $this->model_mainkpis_lte->cidade_daily_report_dash($node,$reportdate);
			$data['node_daily_report'] = $this->model_mainkpis_lte->cidade_hourly_report($node,$reportdate);
			$data['reportnetype'] = 'city';
		}
		
		$this->load->view('view_header_lte');
		$this->load->view('view_nav_lte',$data);
		$this->load->view('view_mainkpis_chart_lte',$data);
		$this->load->view('view_mainkpis_lte',$data);
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
		$data['reportkpi'] = 'nqi';
		#echo $weeknum;

		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['regional'] = $this->model_cellsinfo->regional();
		$data['cidades'] = $this->model_cellsinfo->cidades_lte();
		$data['clusters'] = $this->model_cellsinfo->clusters_lte();
		$data['enodebs'] = $this->model_cellsinfo->enodebs();
		
		#############################HEADER#####################		
		
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		$ufs = array("AC","AL","BA","CE","DF","ES","GO","MG","MS","MT","PB","PE","PI","PR","RN","RO","SC","TO");
		if($node == 'NETWORK'){
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_network($reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->network_daily_report($reportdate);	
			$data['reportnetype'] = 'network';
		}
		elseif (in_array($node, $regions)) {
			$data['nqi_weekly_region'] = $this->model_nqi_lte->nqi_weekly_region($node,$reportdate);
			$data['node_daily_report'] = $this->model_nqi_lte->region_daily_report($node,$reportdate);
			$data['reportnetype'] = 'region';
		}
		// elseif(in_array($node, $ufs)){
			// $data['nqi_weekly_region'] = $this->model_nqi_lte->rnc_weekly_report_ufinput($node,$weeknum);
			// $data['node_daily_report'] = $this->model_nqi_lte->uf_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'ufs';
		// }
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
		$this->load->view('view_nav_lte',$data);
		$this->load->view('view_nqi_chart_lte',$data);
		$this->load->view('view_nqi_lte',$data);
	}	

public function worstcells()
	{
		$this->load->model('model_worstcells_lte');
		$this->load->model('model_monitor_lte');
		$node_query = $this->input->post('node');

		$daterange = $this->input->post('wcdate');
		$inidate = date('Y-m-d', strtotime($daterange.' -6 day'));
		$findate = date('Y-m-d', strtotime($daterange));

		###Map kpi
		
		$data['reportdate'] = $daterange;	
		$data['reportnename'] = $node_query;
		
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

	$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
	
	#echo $kpimap[$kpi];
		#if($this->input->post('rnc') &&  $this->input->post('cellid') && $cellid_query != "undefined"){
		if($this->input->post('cellname')){
			$cellid_array = $this->model_worstcells->find_cellid($this->input->post('cellname'));
			$cellid = $cellid_array[0]->cellid;
			$cell_family = "cell_".$kpi_family_map[$kpi];
			$data['result'] = $this->model_monitor->$cell_family($node_query,$cellid,$daterange,$daterange);
			$data['level'] = 'Cell';
			$data['ne'] = $this->input->post('cellname');
		} 
		elseif (in_array($node_query, $regions)) {
			$node_family = "region_".$kpi_family_map[$kpi];
			$data['result'] = $this->model_monitor_lte->$node_family($node_query,$daterange,$daterange);

			$data['ne'] = $node_query;
		}
			if(strpos($kpimap[$kpi], 'retention') !== FALSE){ #FOR RETENTION KPIs we use the same methodology as the retainability kpi (1 - num/den)
				$data['wc'] = $this->model_worstcells_lte->nodewc_retainability($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			}
			elseif(in_array($kpi_family_map[$kpi], $kpis_group1)){
				#echo "ola";
				$data['wc'] = $this->model_worstcells_lte->nodewc($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			}
			 elseif (in_array($kpi_family_map[$kpi], $kpis_group2)) {
				 #echo "ola2";
				 $data['wc'] = $this->model_worstcells_lte->nodewcalt($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }
			 elseif (in_array($kpi_family_map[$kpi], $kpis_group3)) {
				 #echo "ola2";
				 $data['wc'] = $this->model_worstcells_lte->nodecalt2($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }			 
			 elseif ($kpi_family_map[$kpi] == "retainability"){
				 #echo "ola3";
				 $data['wc'] = $this->model_worstcells_lte->nodewc_retainability($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }
			 elseif ($kpi_family_map[$kpi] == "service_integrity"){
				 #echo "ola3";
				 $data['wc'] = $this->model_worstcells_lte->nodewc_service_integrity($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }			 
			 elseif ($kpi_family_map[$kpi] == "nqi"){
				 #echo "ola3";
				 $data['wc'] = $this->model_worstcells_lte->nodewc_nqi($kpimap[$kpi],$node_query,$kpi_family_map[$kpi],$inidate,$findate);
			 }
			

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
	
}
