<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Performance extends CI_Controller {

	public function index()
	{
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$weeknum = $date->format("W");
		#$week = $week -2;
		#echo "Weeknummer: $week";
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis');
		#$data['cells'] = $this->model_monitor->cells();
		$data['weeknum'] = $weeknum;
		$data['node_weekly_report'] = $this->model_mainkpis->region_weekly_report($weeknum);
		$data['node_daily_report'] = $this->model_mainkpis->network_daily_report($weeknum);	
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		$this->load->view('view_mainkpis_chart',$data);
		$this->load->view('view_mainkpis',$data);
	}
	
		public function other()
	{
		#############################HEADER#####################
		$this->load->helper('form');
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis');
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
			$netype = 'other';
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
		
		$data['rncs'] = $this->model_cellsinfo->rncs();
		$data['regional'] = $this->model_cellsinfo->regional();
		$data['cidades'] = $this->model_cellsinfo->cidades();
		$data['clusters'] = $this->model_cellsinfo->clusters();
		#$data['cells'] = $this->model_cellsinfo->cells();
		$data['nodebs'] = $this->model_cellsinfo->nodebs();
		$data['ufs'] = $this->model_cellsinfo->ufs();
		$data['custom'] = $this->model_cellsinfo->custom();
		
		#############################HEADER#####################		
		
		if($netype == 'other'){
			$data['node_weekly_report'] = $this->model_mainkpis->region_weekly_report($weeknum);
			$data['node_daily_report'] = $this->other_daily_report($node,$reportdate);
			#$data['reportnetype'] = 'rnc';
		}		
		// else{
			// if(substr($node,2,1) == '-'){
				// $nodes = explode("-", $node);
				// $node = $nodes[1];
			// }
			// $data['node_weekly_report'] = $this->model_mainkpis->cidade_weekly_report($node,$weeknum);
			// $data['node_daily_report'] = $this->model_mainkpis->cidade_daily_report($node,$reportdate);
			// $data['reportnetype'] = 'city';
			// }
		
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		#$this->load->view('view_theme_dark_unica');
		$this->load->view('view_mainkpis_chart',$data);
		$this->load->view('view_mainkpis',$data);
	}	
	
	function other_daily_report($node,$reportdate){
			 $query = $this->db->query(
			 "SELECT 
	date_part('week'::text, main_kpis_daily.date::date + '1 day'::interval) AS week,
	main_kpis_daily.date,
	'5G_SITES_45G'::text AS node,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_rrc_num) / NULLIF(sum(main_kpis_daily.acc_rrc_den), 0::real), 1::real))::numeric, 2) AS acc_rrc,
	sum(main_kpis_daily.acc_rrc_den) - sum(main_kpis_daily.acc_rrc_num) AS fails_acc_rrc,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_cs_rab_num) / NULLIF(sum(main_kpis_daily.acc_cs_rab_den), 0::real), 1::real))::numeric, 2) AS eff_cs,
	sum(main_kpis_daily.acc_cs_rab_den) - sum(main_kpis_daily.acc_cs_rab_num) AS fails_acc_cs,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_rrc_num) / NULLIF(sum(main_kpis_daily.acc_rrc_den), 0::real), 1::real) * COALESCE(sum(main_kpis_daily.acc_cs_rab_num) / NULLIF(sum(main_kpis_daily.acc_cs_rab_den), 0::real), 1::real))::numeric, 2) AS acc_cs,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_ps_rab_num) / NULLIF(sum(main_kpis_daily.acc_ps_rab_den), 0::real), 1::real))::numeric, 2) AS eff_ps,
	sum(main_kpis_daily.acc_ps_rab_den) - sum(main_kpis_daily.acc_ps_rab_num) AS fails_acc_ps,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_rrc_num) / NULLIF(sum(main_kpis_daily.acc_rrc_den), 0::real), 1::real) * COALESCE(sum(main_kpis_daily.acc_ps_rab_num) / NULLIF(sum(main_kpis_daily.acc_ps_rab_den), 0::real), 1::real))::numeric, 2) AS acc_ps,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_hs_num) / NULLIF(sum(main_kpis_daily.acc_hs_den), 0::real), 1::real))::numeric, 2) AS eff_hsdpa,
	sum(main_kpis_daily.acc_hs_den) - sum(main_kpis_daily.acc_hs_num) AS fails_acc_hsdpa,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_hs_f2h_num) / NULLIF(sum(main_kpis_daily.acc_hs_f2h_den), 0::real), 1::real))::numeric, 2) AS eff_f2h,
	sum(main_kpis_daily.acc_hs_f2h_den) - sum(main_kpis_daily.acc_hs_f2h_num) AS fails_f2h,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_rrc_num) / NULLIF(sum(main_kpis_daily.acc_rrc_den), 0::real), 1::real) * COALESCE(sum(main_kpis_daily.acc_hs_num) / NULLIF(sum(main_kpis_daily.acc_hs_den), 0::real), 1::real))::numeric, 2) AS acc_hsdpa,
	round((100::real * COALESCE(sum(main_kpis_daily.acc_rrc_num) / NULLIF(sum(main_kpis_daily.acc_rrc_den), 0::real), 1::real) * COALESCE((sum(main_kpis_daily.acc_hs_num) + sum(main_kpis_daily.acc_hs_f2h_num)) / NULLIF(sum(main_kpis_daily.acc_hs_den) + sum(main_kpis_daily.acc_hs_f2h_den), 0::real), 1::real))::numeric, 2) AS acc_hsdpa_f2h,
	round((100::real * (1::real - COALESCE(sum(main_kpis_daily.drop_cs_num) / NULLIF(sum(main_kpis_daily.drop_cs_den), 0::real), 1::real)))::numeric, 2) AS drop_cs,
	sum(main_kpis_daily.drop_cs_den) AS fails_drop_cs,
	round((100::real * (1::real - COALESCE(sum(main_kpis_daily.drop_ps_num) / NULLIF(sum(main_kpis_daily.drop_ps_den), 0::real), 1::real)))::numeric, 2) AS drop_ps,
	sum(main_kpis_daily.drop_ps_den) AS fails_drop_ps,
	round((100::real * (1::real - COALESCE(sum(main_kpis_daily.drop_hsdpa_num) / NULLIF(sum(main_kpis_daily.drop_hsdpa_den), 0::real), 1::real)))::numeric, 2) AS drop_hsdpa,
	sum(main_kpis_daily.drop_hsdpa_den) AS fails_drop_hsdpa,
	round((100::real * (1::real - COALESCE(sum(main_kpis_daily.drop_hsupa_num) / NULLIF(sum(main_kpis_daily.drop_hsupa_den), 0::real), 1::real)))::numeric, 2) AS drop_hsupa,
	sum(main_kpis_daily.drop_hsupa_den) AS fails_drop_hsupa,
	round((100::real * COALESCE(sum(main_kpis_daily.sho_succ_rate_num) / NULLIF(sum(main_kpis_daily.sho_succ_rate_den), 0::real), 1::real))::numeric, 2) AS sho_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.soft_hand_succ_rate_num) / NULLIF(sum(main_kpis_daily.soft_hand_succ_rate_den), 0::real), 1::real))::numeric, 2) AS soft_hand_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.hho_intra_freq_succ_num) / NULLIF(sum(main_kpis_daily.hho_intra_freq_succ_den), 0::real), 1::real))::numeric, 2) AS hho_intra_freq_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.cs_hho_intra_freq_succ_num) / NULLIF(sum(main_kpis_daily.cs_hho_intra_freq_succ_den), 0::real), 1::real))::numeric, 2) AS cs_hho_intra_freq_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.ps_hho_intra_freq_succ_num) / NULLIF(sum(main_kpis_daily.ps_hho_intra_freq_succ_den), 0::real), 1::real))::numeric, 2) AS ps_hho_intra_freq_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.hho_inter_freq_succ_num) / NULLIF(sum(main_kpis_daily.hho_inter_freq_succ_den), 0::real), 1::real))::numeric, 2) AS hho_inter_freq_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.iratho_cs_succ_num) / NULLIF(sum(main_kpis_daily.iratho_cs_succ_den), 0::real), 1::real))::numeric, 2) AS iratho_cs_succ_rate,
	round((100::real * COALESCE(sum(main_kpis_daily.iratho_ps_succ_num) / NULLIF(sum(main_kpis_daily.iratho_ps_succ_den), 0::real), 1::real))::numeric, 2) AS iratho_ps_succ_rate,
	round(100::numeric * (1::real - COALESCE(sum(main_kpis_daily.retention_cs_num) / NULLIF(sum(main_kpis_daily.retention_cs_den), 0::real), 0::real))::numeric, 2) AS retention_cs_succ_rate,
	round(100::numeric * (1::real - COALESCE(sum(main_kpis_daily.retention_ps_num) / NULLIF(sum(main_kpis_daily.retention_ps_den), 0::real), 0::real))::numeric, 2) AS retention_ps_succ_rate,
	round((100::real * (COALESCE(sum(main_kpis_daily.sho_over_num) / NULLIF(sum(main_kpis_daily.sho_over_den), 0::real), 1::real) - 1::double precision))::numeric, 2) AS sho_over,
	round(10::numeric * log(avg(power(10::double precision, main_kpis_daily.rtwp / 10::double precision)))::numeric, 2) AS rtwp,
	round((100::real * (1::double precision - (sum(main_kpis_daily.unavailtime) / (sum(main_kpis_daily.gp) * 60)::double precision)::real))::numeric, 2) AS availability,
	round((sum(main_kpis_daily.data_hsdpa) / 1024::real)::numeric, 2) AS data_hsdpa,
	round((sum(main_kpis_daily.data_hsupa) / 1024::real)::numeric, 2) AS data_hsupa,
	round((sum(main_kpis_daily.ps_r99_ul) / (1024 * 1024)::real)::numeric, 2) AS ps_r99_ul,
	round((sum(main_kpis_daily.ps_r99_dl) / (1024 * 1024)::real)::numeric, 2) AS ps_r99_dl,
	round(sum(main_kpis_daily.voice_traffic_dl)::numeric, 2) AS voice_traffic_dl,
	round(sum(main_kpis_daily.voice_traffic_ul)::numeric, 2) AS voice_traffic_ul,
	round(sum(main_kpis_daily.voice_erlangs_num)::numeric, 2) AS voice_erlangs_num,
	round(sum(main_kpis_daily.voice_erlangs_den)::numeric, 2) AS voice_erlangs_den,
	round(avg(main_kpis_daily.hsdpa_users)::numeric, 2) AS hsdpa_users,
	round(avg(main_kpis_daily.hsupa_users)::numeric, 2) AS hsupa_users,
	round(avg(main_kpis_daily.ps_nonhs_users)::numeric, 2) AS ps_nonhs_users,
	round(avg(main_kpis_daily.dch_users)::numeric, 2) AS dch_users,
	round(avg(main_kpis_daily.pch_users)::numeric, 2) AS pch_users,
	round(avg(main_kpis_daily.fach_users)::numeric, 2) AS fach_users,
	round(avg(main_kpis_daily.thp_hsdpa)::numeric, 2) AS thp_hsdpa,
	round(avg(main_kpis_daily.thp_hsupa)::numeric, 2) AS thp_hsupa   
FROM   
   umts_kpi.main_kpis_daily
   
WHERE 

cellname like any (array['%DFSQN11%','%DFSQN54%','%DFSQS01%','%DFSQS02%','%DFSQS19%','%DFSQS28%','%DFSQS45%','%DFSQS57%','%DFSQS58%','%DFSQS62%','%DFSQS69%','%DFSQS80%','%DFSQSIB%','%DFSQSIK%','%DFSQSIB%'])
and main_kpis_daily.date >='2017-04-18'
   
GROUP BY 	
	date_part('week'::text, main_kpis_daily.date::date + '1 day'::interval),
	main_kpis_daily.date
ORDER BY main_kpis_daily.date
	;");	
	return $query->result();
	}		
	
		public function main()
	{
		$node = $this->input->get('node');
		#$node = 'CO';
		#$rnc = 'RNCDF04';
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis');
		#$data['cells'] = $this->model_monitor->cells();
		
		if(substr($node,0,3) == 'RNC'){
			$data['node_weekly_report'] = $this->model_mainkpis->rnc_weekly_report_rncinput($node);
			$data['node_daily_report'] = $this->model_mainkpis->rnc_daily_report($node);
		} else {
			$data['node_weekly_report'] = $this->model_mainkpis->rnc_weekly_report($node);
			$data['node_daily_report'] = $this->model_mainkpis->region_daily_report($node);
		}
		
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		$this->load->view('view_mainkpis_chart',$data);
		$this->load->view('view_mainkpis',$data);
	}
	
		public function daily()
	{
		$node = $this->input->get('node');
		$this->load->model('model_monitor');
		$this->load->model('model_mainkpis');
		#$data['cells'] = $this->model_monitor->cells();
		
		if(substr($node,0,3) == 'RNC'){
			$data['node_weekly_report'] = $this->model_mainkpis->rnc_weekly_report_rncinput($node);
			$data['node_daily_report'] = $this->model_mainkpis->rnc_hourly_report($node);
		} else {
			$data['node_weekly_report'] = $this->model_mainkpis->rnc_weekly_report($node);
			$data['node_daily_report'] = $this->model_mainkpis->region_daily_report($node);
		}
		
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		$this->load->view('view_mainkpis_chart',$data);
		$this->load->view('view_mainkpis',$data);
	}	
	
		public function welcome()
	{
		#$this->load->view('welcome_message');
		$this->load->view('view_testeweek');
	}

	public function configuration()
	{
		ini_set('memory_limit', '2048M');
		$this->load->library('table');
		$this->load->model('model_monitor');
		$this->load->model('model_configuration');
		$data['results'] = $this->model_configuration->rnc_cfg();
		$data['cells'] = $this->model_configuration->cells();
		$this->load->view('view_header');
		#$this->load->view('view_testeweek');
		$this->load->view('view_configuration',$data);
		#$this->load->view('welcome_message');
		#$this->load->view('datatables',$data);
		
	}	
	
		public function nqi()
	{
		$this->load->model('model_monitor');
		$this->load->model('model_nqi');
		$data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_region();
		#$data['cells'] = $this->model_monitor->cells();
		$this->load->view('view_header');	
		$this->load->view('view_nav',$data);
		#$this->load->view('view_weekjs');
		#$this->load->view('view_sitejs');
		$this->load->view('view_networkelementsjs');
		$this->load->view('datatables',$data);
	}
	
			public function bruno()
	{
		$this->load->view('bruno');
	}
	
	public function nqirnc()
	{
		$this->load->model('model_nqi');
		$data['nqi_weekly_region'] = $this->model_nqi->nqi_weekly_rnc();
		$this->load->view('datatables',$data);
	}
	
		public function autocomplete()
	{
		$this->load->view('teste');
	}
	
		public function detail()
	{
		$this->load->view('view_detail');
	}
	
		public function maps()
	{
		$this->load->view('view_maps');
	}
	
	public function monitor()
	{
		#$this->load->view('welcome_message');
		$this->load->model('model_worstcells');
		$this->load->model('model_monitor');
		$rnc_query = $this->input->post('rnc');
		$cellid_query = $this->input->post('cellid');
		$cluster_query = $this->input->post('cluster');
		$cidade_query = $this->input->post('cidade');
		$kpi = $this->input->post('kpi');
		$daterange = $this->input->post('daterange');
		$daterangeinput = explode(" - ", $daterange);
		if($this->input->post('daterange')){
		$inidate = date('Y-m-d', strtotime($daterangeinput[0]));
		$findate = date('Y-m-d', strtotime($daterangeinput[1]));
		}
		$data['cells'] = $this->model_monitor->cells();
		if($this->input->post('rnc') &&  $this->input->post('cellid') && $cellid_query != "undefined"){
			if($kpi == 'Accessibility'){
				#$data['result'] = $this->model_worstcells->rncaccrrc($rnc_query,'2015-09-24','2015-09-30');
				$data['result'] = $this->model_monitor->cellacc($rnc_query,$cellid_query,$inidate,$findate);
				#$data['result'] = $this->model_monitor->rnckpi($rnc_query);
			} elseif ($kpi == 'Traffic'){
				$data['result'] = $this->model_monitor->celltraffic($rnc_query,$cellid_query,$inidate,$findate);
			}
	
			#$data['result'] = $this->model_monitor->cellkpi($rnc_query,$cellid_query);
			#$data['result'] = $this->model_monitor->cellacc($rnc_query,$cellid_query,$inidate,$findate);
			$data['level'] = 'Cell';
			$data['kpi'] = $kpi;
			$data['ne'] = $cellid_query;
			$data['necellid'] = $cellid_query;
			$data['nernc'] = $rnc_query;
			$data['daterange'] = $daterange;
			//$data['inidate'] = $inidate;
			//$data['findate'] = $findate;
			#echo $data['level'];
		} elseif($this->input->post('cluster')){
			$data['result'] = $this->model_monitor->clusterkpi($cluster_query);
			$data['level'] = 'Cluster';
			$data['ne'] = $cluster_query;
		}
		  elseif($this->input->post('cidade')){
			$data['result'] = $this->model_monitor->cidadekpi($cidade_query);
			$data['level'] = 'Cidade';
			$data['ne'] = $cidade_query;			
		} elseif($this->input->post('rnc')){
			if($kpi == 'Accessibility'){
				#$data['result'] = $this->model_monitor->rncaccrrc($rnc_query,'2015-10-01','2015-10-16');
				$data['result'] = $this->model_monitor->rncaccrrc($rnc_query,$inidate,$findate);
				#$data['result'] = $this->model_monitor->rnckpi($rnc_query);
			} elseif ($kpi == 'Traffic'){
				$data['result'] = $this->model_monitor->rnctraffic($rnc_query,$inidate,$findate);
			}
			$data['level'] = 'RNC';
			$data['kpi'] = $kpi;
			$data['ne'] = $rnc_query;
			$data['nernc'] = $rnc_query;
			$data['daterange'] = $daterange;
			#$data['inidate'] = $inidate;
			#$data['findate'] = $findate;
		} 
		
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		///
		///$this->load->view('view_theme_dark_unica');
		if($this->input->post('rnc') || $this->input->post('cluster') || $this->input->post('cidade')){
			if($kpi == 'Accessibility'){
				//$this->load->view('view_theme_sand_signika');
				$this->load->view('view_accessibility',$data);
			} elseif ($kpi == 'Traffic'){
				#echo "worked";
				//$this->load->view('view_theme_dark_blue');
				$this->load->view('view_traffic2',$data);
			}			
		}
		$this->load->view('view_home',$data);
	}
	
		public function wc()
	{

		$this->load->model('model_worstcells');
		#$rnc_query = $this->input->post('rnc');
		#$cellid_query = $this->input->post('cellid');
		#$cluster_query = $this->input->post('cluster');
		#$cidade_query = $this->input->post('cidade');
		#$data['cells'] = $this->model_monitor->cells();
		$data['wc'] = $this->model_worstcells->rncwc('RNCMS02','2015-09-27','2015-10-03');
		$this->load->view('view_worstcells',$data);
	}
	
		public function worstcells()
	{
		$this->load->model('model_worstcells');
		$this->load->model('model_monitor');
		$rnc_query = $this->input->post('rnc');
		#echo $this->input->post('kpi');
		#$cellid_query = $this->input->post('cellid');
		#$cluster_query = $this->input->post('cluster');
		#$cidade_query = $this->input->post('cidade');
		$daterange = $this->input->post('wcdate');
		$inidate = date('Y-m-d', strtotime($daterange.' -6 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#echo $inidate;
		#echo $findate;
		#$data['cells'] = $this->model_monitor->cells();
		###Map kpi
		$kpi = preg_replace('/\s+/', '', $this->input->post('kpi'));
		$kpi = strtolower($kpi);
		$kpimap = [
			"rrcacc" => "rrc_efc",
			"psacc" => "ps_rab_acc",
			"csacc" => "cs_rab_acc",
			"hsacc" => "hs_acc_f2h",
			"retainabilitycs" => "cs_drop",
			"retainabilityps" => "ps_drop",
			"retainabilityhsdpa" => "retainability",
			"retainabilityhsupa" => "retainability",
			"r99dltraffic" => "traffic",
			"r99ultraffic" => "traffic",
			"hsdpatraffic" => "traffic",
			"hsupatraffic" => "traffic",
			"hsdpaues" => "traffic",
			"hsupaues" => "traffic",
			"r99ues" => "traffic",
			"hsdpathp" => "service_integrity",
			"hsupathp" => "service_integrity",
			"csretention" => "mobility",
			"psretention" => "mobility",
			"softho" => "mobility",
			"cshhointrafreq" => "mobility",
			"pshhointrafreq" => "mobility",
			"hhointerfreq" => "mobility",
			"irathocs" => "mobility",
			"irathops" => "mobility",
			"shooverhead" => "coverage",
			"availability" => "availability",
			"rtwp" => "coverage"
		];
		
		$kpi_family_map = [
			"rrcacc" => "acccessibility",
			"psacc" => "acccessibility",
			"csacc" => "acccessibility",
			"hsacc" => "acccessibility",
			"retainabilitycs" => "retainability",
			"retainabilityps" => "retainability",
			"retainabilityhsdpa" => "retainability",
			"retainabilityhsupa" => "retainability",
			"r99dltraffic" => "traffic",
			"r99ultraffic" => "traffic",
			"hsdpatraffic" => "traffic",
			"hsupatraffic" => "traffic",
			"hsdpaues" => "traffic",
			"hsupaues" => "traffic",
			"r99ues" => "traffic",
			"hsdpathp" => "service_integrity",
			"hsupathp" => "service_integrity",
			"csretention" => "mobility",
			"psretention" => "mobility",
			"softho" => "mobility",
			"cshhointrafreq" => "mobility",
			"pshhointrafreq" => "mobility",
			"hhointerfreq" => "mobility",
			"irathocs" => "mobility",
			"irathops" => "mobility",
			"shooverhead" => "coverage",
			"availability" => "availability",
			"rtwp" => "coverage"
		];		
		
		#echo $kpimap[$kpi];
		#if($this->input->post('rnc') &&  $this->input->post('cellid') && $cellid_query != "undefined"){
		if($this->input->post('cellname')){
			#$data['result'] = $this->model_monitor->cellkpi($rnc_query,$cellid_query);
			$cellid_array = $this->model_worstcells->find_cellid($this->input->post('cellname'));
			$cellid = $cellid_array[0]->cellid;
			#var_dump($cellid);
			#echo $rnc_query;
			$data['result'] = $this->model_monitor->cellacc($rnc_query,$cellid,$daterange,$daterange);
			#$data['result'] = $this->model_monitor->rncaccrrc($rnc_query,$daterange,$daterange);
			$data['wc'] = $this->model_worstcells->rncwc($kpimap[$kpi],$rnc_query,'accessibility',$inidate,$findate);
			$data['level'] = 'Cell';
			$data['ne'] = $this->input->post('cellname');
		} elseif($this->input->post('cluster')){
			$data['result'] = $this->model_monitor->clusterkpi($cluster_query);
			$data['level'] = 'Cluster';
			$data['ne'] = $cluster_query;
		}
		  elseif($this->input->post('cidade')){
			$data['result'] = $this->model_monitor->cidadekpi($cidade_query);
			$data['level'] = 'Cidade';
			$data['ne'] = $cidade_query;			
		} elseif($this->input->post('rnc')){
			$data['result'] = $this->model_monitor->rncaccrrc($rnc_query,$daterange,$daterange);
			#$data['result'] = $this->model_worstcells->rncaccrrc($rnc_query,$inidate,$findate);
			#$data['result'] = $this->model_monitor->rncaccrrc($rnc_query,$inidate,$findate);
			$data['wc'] = $this->model_worstcells->rncwc($kpimap[$kpi],$rnc_query,'accessibility',$inidate,$findate);
			$data['level'] = 'RNC';
			$data['ne'] = $rnc_query;
		} 
		
		$this->load->view('view_header');
		$this->load->view('view_nav',$data);
		#$trimmed = preg_replace('/\s+/', '', $this->input->post('kpi'));
		#echo $this->input->post('wcdate');
		#echo $this->input->post('rnc');
		#echo $trimmed;
		#$this->load->view('view_theme_sand_signika');
		#$this->load->view('view_theme_dark_unica');
		$this->load->view('view_sparklines',$data);
		if($this->input->post('rnc') || $this->input->post('cluster') || $this->input->post('cidade')){
		#	$this->load->view('view_accessibility',$data);
		}		
		$this->load->view('view_menu');
		if($this->input->post('rnc') || $this->input->post('cluster') || $this->input->post('cidade')){
			$this->load->view('vw_wc_rrc',$data);
			$this->load->view('view_wc',$data);
		}

		$this->load->view('view_footer');
	}	
}