<?php 

class Model_mainkpis_lte extends CI_Model{
	function cells(){
		$query = $this->db->query(
		"select * from umts_control.cells order by rnc,cellname;");

	return $query->result();
	}
	

////WEEKLY################################


	function network_monthly_report($reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
		#echo $monthnum;
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from lte_kpi.vw_main_kpis_network_rate_monthly where month = ".$monthnum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM lte_kpi.vw_main_kpis_region_rate_monthly 
			   where month = ".$monthnum."
			   and node != 'UNKNOWN'
			   order by sortcol,month, node
	;");
	
	return $query->result();
	}

	function network_weekly_report_graph($reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -270 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_network_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and week not in (53)
  order by year,week
	;");	
	
	return $query->result();
	}

	function region_weekly_report($weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from lte_kpi.vw_main_kpis_network_rate_weekly where week = ".$weeknum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM lte_kpi.vw_main_kpis_region_rate_weekly 
			   where week = ".$weeknum."
			   order by sortcol,week, node
	;");

	return $query->result();
	}
	
		function region_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and region = '".$node."'
	union
	SELECT month, node,'region'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_region_rate_monthly
	  where month = ".$monthnum." and node = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}

function region_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_region_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
  order by year,week
  
	;");	

	return $query->result();
	}
	
	function enodeb_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'nodeb'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_enodeb_rate_monthly
	  where month = ".$monthnum." 
	  and node = '".$node."'
	union
	SELECT month, node,'cell'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cell_rate_monthly
	  where month = ".$monthnum." 
	  and enodeb = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}
		
	function enodeb_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_enodeb_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}
	
	function cell_monthly_report($node,$reportdate){
		$site_array = $this->model_cellsinfo->find_enodeb_from_cell($node);
		$enodeb = $site_array[0]->site;
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'nodeb'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_enodeb_rate_monthly
	  where month = ".$monthnum." 
	  and node = '".$enodeb."'
	union
	SELECT month, node,'cell'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cell_rate_monthly
	  where month = ".$monthnum." 
	  and enodeb = '".$enodeb."'
	  order by month, node
	;");

		return $query->result();
		}
	function cell_weekly_report_graph($node,$reportdate){	
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_cell_rate_weekly 
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}
	
	function uf_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$node."'
	union
	SELECT month, concat(node,' - ',uf) as node,'cidade'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cidade_rate_monthly
	  where month = ".$monthnum." and uf = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}
		
	function uf_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_uf_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}
	
	function cidade_monthly_report($node,$reportdate){
		// $weeknum = $weeknum;
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$uf."'
	union
	SELECT month, concat(node,' - ',uf) as node,'cidade'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cidade_rate_monthly
	  where month = ".$monthnum." and uf = '".$uf."' and ibge = ".$ibge."
	  order by month, node
	;");

		return $query->result();
		}
		
	function cidade_weekly_report_graph($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, concat(node,' - ',uf) as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_cidade_rate_weekly 
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and uf = '".$uf."' and ibge = ".$ibge."
order by year,week
	;");	

	return $query->result();
	}
	
	function cluster_monthly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info_lte($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;	
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$uf."'
	union
	SELECT month, node,'cluster'::text as type, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cluster_rate_monthly
	  where month = ".$monthnum." and node = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}
		
	function cluster_weekly_report_graph($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;		
		
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_cluster_rate_weekly 
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}

	// function region_weekly_report($weeknum){
		// $weeknum = $weeknum;
			 // $query = $this->db->query(
			 // "SELECT *,1 as sortcol from lte_kpi.network_weekly_report where week = ".$weeknum."
	  // UNION
			// SELECT *,2 as sortcol 
			   // FROM lte_kpi.region_weekly_report 
			   // where week = ".$weeknum."
			   // order by sortcol,week, node
	// ;");

	// return $query->result();
	// }
	
	function enodeb_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT week, node,'enodebs'::text as type,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_enodeb_rate_weekly
  where week = ".$weeknum." and node = '".$node."'
  union
  SELECT week, node,'cell'::text as type,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_cell_rate_weekly
  where week = ".$weeknum." and enodeb = '".$node."'
  order by week,sortcol,node
	;");

	return $query->result();
	}

	function cell_weekly_report($node,$weeknum){
	$this->load->model('model_cellsinfo');
		$site_array = $this->model_cellsinfo->find_enodeb_from_cell($node);
		$enodeb = $site_array[0]->site;
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT week, node,'enodebs'::text as type,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_enodeb_rate_weekly
  where week = ".$weeknum." and node = '".$enodeb."'
  union
  SELECT week, node,'cell'::text as type,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_cell_rate_weekly
  where week = ".$weeknum." and enodeb = '".$enodeb."'
  order by week,sortcol,node
	;");

	return $query->result();
	}	
	
	function cluster_weekly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info_lte($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;		
		#$weeknum = $weeknum;
		$query = $this->db->query(
		"select *,datetime as week,'cluster'::text as type from lte_kpi.vw_main_kpis_cluster_rate_daily 
		where datetime = '".$reportdate."'
		and cluster_id = '".$cluster_id."'
		order by datetime
	;");

	return $query->result();
	}	
	

	function rnc_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"	
		SELECT 2 as sortcol,'uf'::text as type,week,node,
		rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_weekly
	  where week = ".$weeknum." and region = '".$node."'
	union
	SELECT 1 as sortcol,'region'::text as type,week,node,
		rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul	
	  FROM lte_kpi.vw_main_kpis_region_rate_weekly
	  where week = ".$weeknum." and node = '".$node."'
	  order by week, sortcol,node
	;");

		return $query->result();
		}
	
	// function rnc_weekly_report($node,$weeknum){
		// $weeknum = $weeknum;
			// $query = $this->db->query(
			// "
	// SELECT week, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.uf_weekly_report
  // where week = ".$weeknum." and region = '".$node."'
	// union
	// SELECT week, region as node,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.region_weekly_report
   // where week = ".$weeknum." and region = '".$node."'
	  // order by week, sortcol,node
	// ;");

		// return $query->result();
		// }
		
		function rnc_weekly_report_ufinput($node,$weeknum){
			$weeknum = $weeknum;
			$query = $this->db->query(
			"	
		SELECT week, node,'uf'::text as type, 2 as sortcol,
				rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_weekly
	  where week = ".$weeknum." and 
	  region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week, node,'region'::text as type, 1 as sortcol,
			rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_region_rate_weekly
	  where week = ".$weeknum." and 
	  node = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		order by week,sortcol, node
	;");

		return $query->result();
		}
		
	// function rnc_weekly_report_ufinput($node,$weeknum){
		// $weeknum = $weeknum;
			// $query = $this->db->query(
			// "	
		// SELECT week, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.uf_weekly_report
  // where week = ".$weeknum." and region =
		// CASE
			// WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text, 'TO'::text]) THEN 'CO'::text
			// WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			// WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			// WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END 
	// union
	// SELECT week, region as node,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.region_weekly_report
   // where week = ".$weeknum." and region =
		// CASE
			// WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			// WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			// WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			// WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END 
		// order by week, sortcol,node
	// ;");

		// return $query->result();
		// }

		

//////////////DAILY		
	function network_daily_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT *
  FROM lte_kpi.vw_main_kpis_network_rate_daily 
  WHERE date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}

	function enodeb_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, region, uf,node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_enodeb_rate_daily
  WHERE node = '".$node."'  
  and date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}
	
	function cell_daily_report($node,$reportdate){
#find_cellid_from_enodebs()	
	$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date,node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, case when availability > 100 then 100 else availability end as availability, 
	   intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_cell_rate_daily
  WHERE node = '".$node."'   
  and date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}	
	
	function cluster_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info_lte($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;		
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT *,datetime as date from lte_kpi.vw_main_kpis_cluster_rate_hourly
  WHERE cluster_id = '".$cluster_id."'
  and datetime between '".$inidate."' and '".$findate." 23:00:00' order by datetime
	;");	

	return $query->result();
	}	

	function enodeb_daily_report_dash($node,$reportdate){
		
			 $query = $this->db->query(
			 "SELECT  
			 date, node, 'enodebs'::text as type,1 as sortcol,rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_enodeb_rate_daily_2
  where date = '".$reportdate."' and node = '".$node."'
   union
  SELECT date, node,'cell'::text as type,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_cell_rate_daily_2
  where  date = '".$reportdate."' and enodeb = '".$node."'
  order by date,sortcol,node
	;");	

	return $query->result();
	}
	
	function cell_daily_report_dash($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$site_array = $this->model_cellsinfo->find_enodeb_from_cell($node);
		$enodeb = $site_array[0]->site;
			 $query = $this->db->query(
			 "SELECT  
			 date, node, 'enodebs'::text as type,1 as sortcol,rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.vw_main_kpis_enodeb_rate_daily_2
  where date = '".$reportdate."' and node = '".$enodeb."'
   union
  SELECT date, node,'cell'::text as type,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  from lte_kpi.vw_main_kpis_cell_rate_daily_2
  where  date = '".$reportdate."' and enodeb = '".$enodeb."'
  order by date,sortcol,node
	;");	

	return $query->result();
	}

	function cluster_daily_report_dash($node,$reportdate){
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, clustername as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.cluster_daily_report
  WHERE clustername = '".$node."'  
  and date = '".$reportdate."'
  order by date
	;");	

	return $query->result();
	}	
	
	function region_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from lte_kpi.vw_main_kpis_region_rate_daily
	where date between '".$inidate."' and '".$findate."'
	--where date between '2017-05-01' and '".$findate."'
	and node = '".$node."'
	order by date,node
	;");		
		return $query->result();
	}
	
	// function region_daily_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		// $findate = date('Y-m-d', strtotime($daterange));	
			 // $query = $this->db->query(
			 // "SELECT week, date, region as node, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.region_daily_report
	// where date between '".$inidate."' and '".$findate."' 
	// and region = '".$node."'
	// order by date,region
	// ;");	

	// return $query->result();
	// }
	
	function region_daily_report_dash($reportdate){
			 $query = $this->db->query(
			 "SELECT *,1 as sortcol,'network'::text as type from lte_kpi.vw_main_kpis_network_rate_daily_2 where date = '".$reportdate."'
	  UNION
			SELECT *,2 as sortcol, 'region'::text as type from lte_kpi.vw_main_kpis_region_rate_daily_2 
			   where date = '".$reportdate."'
			   order by sortcol,date, node
	;");

	return $query->result();
	}

	// function region_daily_report_dash($reportdate){
			 // $query = $this->db->query(
			 // "SELECT *,1 as sortcol from lte_kpi.network_daily_report where date = '".$reportdate."'
	  // UNION
			// SELECT week, date, region as node, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul,2 as sortcol 
			   // FROM lte_kpi.region_daily_report 
			   // where date = '".$reportdate."'
			   // order by sortcol,date, node
	// ;");

	// return $query->result();
	// }
	
	function uf_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	, 2 as sortcol,'uf'::text as type
  FROM lte_kpi.vw_main_kpis_uf_rate_daily_2
	  where date = '".$reportdate."' and region = '".$node."'
	union
	SELECT week, date, node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul	
	, 1 as sortcol,'region'::text as type
	FROM lte_kpi.vw_main_kpis_region_rate_daily_2
	  where date = '".$reportdate."' and node = '".$node."'
	  order by sortcol,date, node
	;");

		return $query->result();
		}	
	
	// function uf_daily_report_dash($node,$reportdate){
			// $query = $this->db->query(
			// "	
	// SELECT week, date, uf as node, 2 as sortcol,rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.uf_daily_report
	  // where date = '".$reportdate."' and region = '".$node."'
	// union
	// SELECT week, date, region as node, 1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.region_daily_report
	  // where date = '".$reportdate."' and region = '".$node."'
	  // order by sortcol,date, node
	// ;");

		// return $query->result();
		// }

 function uf_daily_report_ufinput_dash($node,$reportdate){
			$query = $this->db->query(
			"	
		SELECT week, date,node,'uf'::text as type,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
		   fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
		   call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
		   inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
		   iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
		   cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
		   downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
		   rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
		FROM lte_kpi.vw_main_kpis_uf_rate_daily_2
	    where date = '".$reportdate."' and 
	    region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week, date,node,'region'::text as type, 1 as sortcol,rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	FROM lte_kpi.vw_main_kpis_region_rate_daily_2
	  where date = '".$reportdate."' and 
	  node = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		order by sortcol,date, node
	;");

		return $query->result();
		}		
	// function uf_daily_report_ufinput_dash($node,$reportdate){
			// $query = $this->db->query(
			// "	
		// SELECT week, date, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
		   // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
		   // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
		   // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
		   // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
		   // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
		   // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
		   // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
		// FROM lte_kpi.uf_daily_report
	    // where date = '".$reportdate."' and 
	    // region = 
		// CASE
			// WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			// WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			// WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			// WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END 
	// union
	// SELECT week, date, region AS node, 1 as sortcol,rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.region_daily_report
	  // where date = '".$reportdate."' and 
	  // region = 
		// CASE
			// WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			// WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			// WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			// WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END 
		// order by sortcol,date, node
	// ;");

		// return $query->result();
		// }			

	function uf_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select * from lte_kpi.vw_main_kpis_uf_rate_daily
where date between '".$inidate."' and '".$findate."'
and node = '".$node."'
order by date,node	
	;");	

	return $query->result();
	}		
	
	// function uf_daily_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		// $findate = date('Y-m-d', strtotime($daterange));
			 // $query = $this->db->query(
			 // "SELECT week, date, region, uf as node, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.uf_daily_report
// where date between '".$inidate."' and '".$findate."'
// and uf = '".$node."'
// order by date,uf	
	// ;");	

	// return $query->result();
	// }


	function cidade_daily_report_dash($node,$reportdate){
			$this->load->model('model_cellsinfo');
			$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
			$ibge = $cidade_info[0]->ibge;
			 $query = $this->db->query(
			 "select year, month, week, date, gp, uf, ibge, concat(node,' - ',uf) as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul, 'cidades'::text as type from lte_kpi.vw_main_kpis_cidade_rate_daily
where date = '".$reportdate."'
and ibge = ".$ibge."
order by date,node	
	;");	

	return $query->result();
	}	

/////////////////////////////////////////////HOURLY	

function network_hourly_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT *
  FROM lte_kpi.vw_main_kpis_network_rate_hourly
  WHERE date between '".$inidate."' and '".$findate." 23:00:00' order by date
	;");		
		return $query->result();
	}

	function region_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select 
 week,date,node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop, cell_downlink_avg_thp,cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,downlink_traffic_volume,
 uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
 lte_kpi.vw_main_kpis_region_rate_hourly  
 WHERE node = '".$node."'
 and date between '".$inidate."' and '".$enddate." 23:00:00' order by date
	;");	

	return $query->result();
	}
	
// function network_hourly_report($reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		// $findate = date('Y-m-d', strtotime($daterange));
		// #$weeknum_start = $weeknum -4;
			 // $query = $this->db->query(
			 // "SELECT week, datetime::date, node, rrc_service, fails_rrc_service, rrc_signaling, 
       // fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       // call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       // inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       // iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       // cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       // downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       // rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  // FROM lte_kpi.network_hourly_report
  // WHERE datetime::date between '".$inidate."' and '".$findate."' order by date::date
	// ;");		
		// return $query->result();
	// }	

	// function region_hourly_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		// $enddate = date('Y-m-d', strtotime($daterange));	
			 // $query = $this->db->query(
			 // "select 
 // t1.week,t1.datetime AS date,t1.region as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 // fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 // retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 // rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 // round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   // FROM 
   // (select * from lte_kpi.vw_accessibility_region_rate_hourly
   // where lte_kpi.vw_accessibility_region_rate_hourly.region = '".$node."'
// and vw_accessibility_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00') t1
 // inner join 
 // (select * from lte_kpi.vw_availability_region_rate_hourly
 // where lte_kpi.vw_availability_region_rate_hourly.region = '".$node."'
	// and  vw_availability_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t2
 // ON t1.datetime = t2.datetime AND t1.region = t2.region
 // inner join
	// (select * from lte_kpi.vw_mobility_region_rate_hourly
 // where lte_kpi.vw_mobility_region_rate_hourly.region = '".$node."'
	// and  vw_mobility_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t3
// ON t1.datetime = t3.datetime AND t1.region = t3.region
 // inner join
	// (select * from lte_kpi.vw_retainability_region_rate_hourly
 // where lte_kpi.vw_retainability_region_rate_hourly.region = '".$node."'
	// and  vw_retainability_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t4
// ON t1.datetime = t4.datetime AND t1.region = t4.region
 // inner join
	// (select * from lte_kpi.vw_service_integrity_region_rate_hourly
 // where lte_kpi.vw_service_integrity_region_rate_hourly.region = '".$node."'
	// and  vw_service_integrity_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t5
// ON t1.datetime = t5.datetime AND t1.region = t5.region
 // inner join
	// (select * from lte_kpi.vw_traffic_region_rate_hourly
 // where lte_kpi.vw_traffic_region_rate_hourly.region = '".$node."'
	// and  vw_traffic_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t6
// ON t1.datetime = t6.datetime AND t1.region = t6.region
 // inner join
	// (select * from lte_kpi.vw_utilization_region_rate_hourly
 // where lte_kpi.vw_utilization_region_rate_hourly.region = '".$node."'
	// and  vw_utilization_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t7
// ON t1.datetime = t7.datetime AND t1.region = t7.region
// order by t1.datetime
	// ;");	

	// return $query->result();
	// }	
	
	function uf_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select 
 week,date,region,node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,cell_downlink_avg_thp,cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,downlink_traffic_volume,
 uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
lte_kpi.vw_main_kpis_uf_rate_hourly
WHERE node = '".$node."'
and date between '".$inidate."' and '".$enddate." 23:00:00' order by date
	;");	

	return $query->result();
	}

function cidade_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$weeknum = $weeknum;
			$query = $this->db->query(
			"
		SELECT week, concat(node,' - ',uf) as node,'cidades'::text as type, 2 as sortcol,
				rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_cidade_rate_weekly
	  where week = ".$weeknum." 
	  and uf = '".$uf."' and ibge = ".$ibge."
	union
	SELECT week, node,'uf'::text as type, 1 as sortcol,
			rrc_service, fails_rrc_service, rrc_signaling, fails_rrc_signaling, s1sig, 
       fails_s1sig, e_rab, fails_e_rab, call_setup, csfb, fails_csfb, 
       availability, intra_freq_hoo_out, inter_freq_hoo_out, handover_in, 
       iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, retention_4g, 
       service_drop, cell_downlink_avg_thp, cell_uplink_avg_thp, rb_cell_downlink_avg_thp, 
       rb_cell_uplink_avg_thp, downlink_traffic_volume, uplink_traffic_volume, 
       average_user_volume, rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
	  FROM lte_kpi.vw_main_kpis_uf_rate_weekly
	  where week = ".$weeknum." 
	  and node = '".$uf."' 
		order by week,sortcol, node
	;");

		return $query->result();
		}	
	

// function cidade_weekly_report($node,$weeknum){
		// $weeknum = $weeknum;
			// $query = $this->db->query(
			// "select 
 // t1.week,t1.region,t1.uf,t1.ibge,t1.cidade as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 // fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 // retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 // rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 // round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   // FROM 
   // (select * from lte_kpi.vw_accessibility_cidade_rate_weekly
   // where lte_kpi.vw_accessibility_cidade_rate_weekly.cidade = '".$node."'
// and vw_accessibility_cidade_rate_weekly.week  = ".$weeknum." ) t1
 // inner join 
 // (select * from lte_kpi.vw_availability_cidade_rate_weekly
 // where lte_kpi.vw_availability_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_availability_cidade_rate_weekly.week = ".$weeknum." ) t2
 // ON t1.week = t2.week AND t1.ibge = t2.ibge
 // inner join
	// (select * from lte_kpi.vw_mobility_cidade_rate_weekly
 // where lte_kpi.vw_mobility_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_mobility_cidade_rate_weekly.week = ".$weeknum." ) t3
// ON t1.week = t3.week AND t1.ibge = t3.ibge
 // inner join
	// (select * from lte_kpi.vw_retainability_cidade_rate_weekly
 // where lte_kpi.vw_retainability_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_retainability_cidade_rate_weekly.week = ".$weeknum." ) t4
// ON t1.week = t4.week AND t1.ibge = t4.ibge
 // inner join
	// (select * from lte_kpi.vw_service_integrity_cidade_rate_weekly
 // where lte_kpi.vw_service_integrity_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_service_integrity_cidade_rate_weekly.week = ".$weeknum." ) t5
// ON t1.week = t5.week AND t1.ibge = t5.ibge
 // inner join
	// (select * from lte_kpi.vw_traffic_cidade_rate_weekly
 // where lte_kpi.vw_traffic_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_traffic_cidade_rate_weekly.week = ".$weeknum." ) t6
// ON t1.week = t6.week AND t1.ibge = t6.ibge
 // inner join
	// (select * from lte_kpi.vw_utilization_cidade_rate_weekly
 // where lte_kpi.vw_utilization_cidade_rate_weekly.cidade = '".$node."'
	// and  vw_utilization_cidade_rate_weekly.week = ".$weeknum." ) t7
// ON t1.week = t7.week AND t1.ibge = t7.ibge
// order by t1.week
	// ;");

		// return $query->result();
		// }		

	function cidade_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select year, month, week, date, gp, uf, ibge, concat(node,' - ',uf) as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul from lte_kpi.vw_main_kpis_cidade_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and ibge = ".$ibge."
	AND uf = '".$uf."'
	AND ibge not in (4117602)
	--and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
	order by date,node
	;");	

	return $query->result();
	}		
	
	// function cidade_daily_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		// $findate = date('Y-m-d', strtotime($daterange));
			 // $query = $this->db->query(
			 // " select 
 // t1.week, t1.datetime as date,t1.region,t1.uf,t1.ibge,t1.cidade as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 // fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 // retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 // rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 // round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   // FROM 
   // (select * from lte_kpi.vw_accessibility_cidade_rate_daily
   // where lte_kpi.vw_accessibility_cidade_rate_daily.cidade = '".$node."'
// and vw_accessibility_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t1
 // inner join 
 // (select * from lte_kpi.vw_availability_cidade_rate_daily
 // where lte_kpi.vw_availability_cidade_rate_daily.cidade = '".$node."'
	// and  vw_availability_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t2
 // ON t1.datetime = t2.datetime AND t1.ibge = t2.ibge
 // inner join
	// (select * from lte_kpi.vw_mobility_cidade_rate_daily
 // where lte_kpi.vw_mobility_cidade_rate_daily.cidade = '".$node."'
	// and  vw_mobility_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t3
// ON t1.datetime = t3.datetime AND t1.ibge = t3.ibge
 // inner join
	// (select * from lte_kpi.vw_retainability_cidade_rate_daily
 // where lte_kpi.vw_retainability_cidade_rate_daily.cidade = '".$node."'
	// and  vw_retainability_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t4
// ON t1.datetime = t4.datetime AND t1.ibge = t4.ibge
 // inner join
	// (select * from lte_kpi.vw_service_integrity_cidade_rate_daily
 // where lte_kpi.vw_service_integrity_cidade_rate_daily.cidade = '".$node."'
	// and  vw_service_integrity_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t5
// ON t1.datetime = t5.datetime AND t1.ibge = t5.ibge
 // inner join
	// (select * from lte_kpi.vw_traffic_cidade_rate_daily
 // where lte_kpi.vw_traffic_cidade_rate_daily.cidade = '".$node."'
	// and  vw_traffic_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t6
// ON t1.datetime = t6.datetime AND t1.ibge = t6.ibge
 // inner join
	// (select * from lte_kpi.vw_utilization_cidade_rate_daily
 // where lte_kpi.vw_utilization_cidade_rate_daily.cidade = '".$node."'
	// and  vw_utilization_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t7
// ON t1.datetime = t7.datetime AND t1.ibge = t7.ibge
// order by t1.datetime
	// ;");	

	// return $query->result();
	// }

	function cluster_hourly_report2($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info_lte($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));		
		#--vw_main_kpis_cluster_rate_hourly
		$query = $this->db->query(
			 "select datetime as date,* from lte_kpi.vw_main_kpis_cluster_rate_hourly_2 
	where datetime between '".$inidate."' and '".$findate." 23:00:00' 
	and datetime >= '2017-05-24'
	and cluster_id = '".$cluster_id."'
	--and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
	order by date,node
	;");	

	return $query->result();
	}			
	
	function cluster_hourly_report2_last($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info_lte($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;	
		$query = $this->db->query(
			 "select datetime as date,* from lte_kpi.vw_main_kpis_cluster_rate_hourly
	where datetime = '".$reportdate."'
	and cluster_id = '".$cluster_id."'
	--and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
	order by date,node
	;");	

	return $query->result();
	}	
	
	function cidade_hourly_report2($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select week, date, gp, uf, ibge, concat(node,' - ',uf) as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul from lte_kpi.vw_main_kpis_cidade_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:00' 
	and ibge = ".$ibge."
	AND ibge not in (4117602)
	AND uf =  '".$uf."'
	order by date,node
	;");	

	return $query->result();
	}			
	
function cidade_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 " select 
 t1.datetime as date,t1.region,t1.uf,t1.ibge,concat(t1.cidade,' - ',t1.uf) as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cidade_rate
   where lte_kpi.vw_accessibility_cidade_rate.cidade = '".$node."'
and vw_accessibility_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t1
 inner join 
 (select * from lte_kpi.vw_availability_cidade_rate
 where lte_kpi.vw_availability_cidade_rate.cidade = '".$node."'
	and  vw_availability_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t2
 ON t1.datetime = t2.datetime AND t1.ibge = t2.ibge
 inner join
	(select * from lte_kpi.vw_mobility_cidade_rate
 where lte_kpi.vw_mobility_cidade_rate.cidade = '".$node."'
	and  vw_mobility_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t3
ON t1.datetime = t3.datetime AND t1.ibge = t3.ibge
 inner join
	(select * from lte_kpi.vw_retainability_cidade_rate
 where lte_kpi.vw_retainability_cidade_rate.cidade = '".$node."'
	and  vw_retainability_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t4
ON t1.datetime = t4.datetime AND t1.ibge = t4.ibge
 inner join
	(select * from lte_kpi.vw_service_integrity_cidade_rate
 where lte_kpi.vw_service_integrity_cidade_rate.cidade = '".$node."'
	and  vw_service_integrity_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t5
ON t1.datetime = t5.datetime AND t1.ibge = t5.ibge
 inner join
	(select * from lte_kpi.vw_traffic_cidade_rate
 where lte_kpi.vw_traffic_cidade_rate.cidade = '".$node."'
	and  vw_traffic_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t6
ON t1.datetime = t6.datetime AND t1.ibge = t6.ibge
 inner join
	(select * from lte_kpi.vw_utilization_cidade_rate
 where lte_kpi.vw_utilization_cidade_rate.cidade = '".$node."'
	and  vw_utilization_cidade_rate.datetime between '".$inidate."' and '".$findate."' ) t7
ON t1.datetime = t7.datetime AND t1.ibge = t7.ibge
order by t1.datetime
	;");	

	return $query->result();
	}
		
	function enodeb_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select
 date,node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,cell_downlink_avg_thp,cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,downlink_traffic_volume,
 uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
lte_kpi.vw_main_kpis_enodeb_rate_hourly
where date between '".$inidate."' and '".$enddate." 23:00:00' 
and node = '".$node."'
order by date
	;");	

	return $query->result();
	}


function cell_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select
 date,node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,cell_downlink_avg_thp,cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,downlink_traffic_volume,
 uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
lte_kpi.vw_main_kpis_cell_rate_hourly
where date between '".$inidate."' and '".$enddate." 23:00:00' 
and node = '".$node."'
order by date
	;");	

	return $query->result();
	}
	
}