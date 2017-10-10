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
		#$this->load->view('view_header');
		#$this->load->view('view_nav',$data);
		#$this->load->view('view_mainkpis_chart',$data);
		#$this->load->view('view_mainkpis',$data);
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
		
		$this->load->view('view_header');
		#$this->load->view('view_nav',$data);
		#$this->load->view('view_theme_dark_unica');
		$this->load->view('view_mainkpis_chart',$data);
		$this->load->view('view_other',$data);
		#$this->load->view('view_mainkpis',$data);
	}	
	
	function other_daily_report($node,$reportdate){
			 $query = $this->db->query(
			 "SELECT 
	date_part('week'::text, main_kpis_daily.date::date + '1 day'::interval) AS week,
	main_kpis_daily.date,
	'3G_SITES_45G'::text AS node,
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
and main_kpis_daily.date >='2017-04-15'
   
GROUP BY 	
	date_part('week'::text, main_kpis_daily.date::date + '1 day'::interval),
	main_kpis_daily.date
ORDER BY main_kpis_daily.date
	;");	
	return $query->result();
	}		

}
