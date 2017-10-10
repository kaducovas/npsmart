<?php 

class Model_mainkpis_lte extends CI_Model{
	function cells(){
		$query = $this->db->query(
		"select * from umts_control.cells order by rnc,cellname;");

	return $query->result();
	}
	

////WEEKLY################################

	function region_weekly_report($weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from lte_kpi.network_weekly_report where week = ".$weeknum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM lte_kpi.region_weekly_report 
			   where week = ".$weeknum."
			   order by sortcol,week, node
	;");

	return $query->result();
	}
	
	function enodeb_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT week, region, uf, enodeb as node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.enodeb_weekly_report
			   where week = ".$weeknum."
			   and enodeb = '".$node."'
			   order by week
	;");

	return $query->result();
	}	
	
	function cluster_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT week,clustername as node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.cluster_weekly_report
			   where week = ".$weeknum."
			   and clustername = '".$node."'
			   order by week
	;");

	return $query->result();
	}	
	
	
	function rnc_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"
	SELECT week,'uf'::text as type, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.uf_weekly_report
  where week = ".$weeknum." and region = '".$node."'
	union
	SELECT week,'region'::text as type, region as node,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.region_weekly_report
   where week = ".$weeknum." and region = '".$node."'
	  order by week, sortcol,node
	;");

		return $query->result();
		}
		
	function rnc_weekly_report_ufinput($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"	
		SELECT week,'uf'::text as type, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.uf_weekly_report
  where week = ".$weeknum." and region =
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text, 'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week,'uf'::text as type, region as node,1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.region_weekly_report
   where week = ".$weeknum." and region =
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		order by week, sortcol,node
	;");

		return $query->result();
		}

		

//////////////DAILY		
	function network_daily_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT * FROM lte_kpi.network_daily_report 
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
			 "SELECT week, date, region, uf, enodeb as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.enodeb_daily_report
  WHERE enodeb = '".$node."'  
  and date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}
	
	function cluster_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date,clustername as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.cluster_daily_report
  WHERE clustername = '".$node."'  
  and date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}	

	function enodeb_daily_report_dash($node,$reportdate){
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, region, uf, enodeb as node, rrc_service, fails_rrc_service, 
       rrc_signaling, fails_rrc_signaling, s1sig, fails_s1sig, e_rab, 
       fails_e_rab, call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.enodeb_daily_report
  WHERE enodeb = '".$node."'  
  and date = '".$reportdate."'
  order by date
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
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "SELECT week, date, region as node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.region_daily_report
	where date between '".$inidate."' and '".$findate."' 
	and region = '".$node."'
	order by date,region
	;");	

	return $query->result();
	}
	
	function region_daily_report_dash($reportdate){
			 $query = $this->db->query(
			 "SELECT *,1 as sortcol from lte_kpi.network_daily_report where date = '".$reportdate."'
	  UNION
			SELECT week, date, region as node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul,2 as sortcol 
			   FROM lte_kpi.region_daily_report 
			   where date = '".$reportdate."'
			   order by sortcol,date, node
	;");

	return $query->result();
	}
	
	function uf_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, uf as node, 2 as sortcol,rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.uf_daily_report
	  where date = '".$reportdate."' and region = '".$node."'
	union
	SELECT week, date, region as node, 1 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.region_daily_report
	  where date = '".$reportdate."' and region = '".$node."'
	  order by sortcol,date, node
	;");

		return $query->result();
		}
		
	function uf_daily_report_ufinput_dash($node,$reportdate){
			$query = $this->db->query(
			"	
		SELECT week, date, uf as node,2 as sortcol, rrc_service, fails_rrc_service, rrc_signaling, 
		   fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
		   call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
		   inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
		   iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
		   cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
		   downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
		   rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
		FROM lte_kpi.uf_daily_report
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
	SELECT week, date, region AS node, 1 as sortcol,rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.region_daily_report
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
		order by sortcol,date, node
	;");

		return $query->result();
		}			
	
	function uf_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, uf as node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.uf_daily_report
where date between '".$inidate."' and '".$findate."'
and uf = '".$node."'
order by date,uf	
	;");	

	return $query->result();
	}


	function cidade_daily_report_dash($node,$reportdate){
			 $query = $this->db->query(
			 "select * from umts_kpi.cidade_daily_report
where date = '".$reportdate."'
and node = '".$node."'
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
			 "SELECT week, datetime::date, node, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb, availability, intra_freq_hoo_out, 
       inter_freq_hoo_out, handover_in, iratho_l2c, iratho_l2w, iratho_l2g, 
       iratho_l2t, retention_4g, service_drop, cell_downlink_avg_thp, 
       cell_uplink_avg_thp, rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp, 
       downlink_traffic_volume, uplink_traffic_volume, average_user_volume, 
       rb_utilization_dl, rrc_signaling_ul, rb_preschedule_rb_urul
  FROM lte_kpi.network_hourly_report
  WHERE datetime::date between '".$inidate."' and '".$findate."' order by datetime::date
	;");		
		return $query->result();
	}	

	function region_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select 
 t1.week,t1.datetime AS date,t1.region as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_region_rate_hourly
   where lte_kpi.vw_accessibility_region_rate_hourly.region = '".$node."'
and vw_accessibility_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_region_rate_hourly
 where lte_kpi.vw_availability_region_rate_hourly.region = '".$node."'
	and  vw_availability_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.region = t2.region
 inner join
	(select * from lte_kpi.vw_mobility_region_rate_hourly
 where lte_kpi.vw_mobility_region_rate_hourly.region = '".$node."'
	and  vw_mobility_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.region = t3.region
 inner join
	(select * from lte_kpi.vw_retainability_region_rate_hourly
 where lte_kpi.vw_retainability_region_rate_hourly.region = '".$node."'
	and  vw_retainability_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.region = t4.region
 inner join
	(select * from lte_kpi.vw_service_integrity_region_rate_hourly
 where lte_kpi.vw_service_integrity_region_rate_hourly.region = '".$node."'
	and  vw_service_integrity_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.region = t5.region
 inner join
	(select * from lte_kpi.vw_traffic_region_rate_hourly
 where lte_kpi.vw_traffic_region_rate_hourly.region = '".$node."'
	and  vw_traffic_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.region = t6.region
 inner join
	(select * from lte_kpi.vw_utilization_region_rate_hourly
 where lte_kpi.vw_utilization_region_rate_hourly.region = '".$node."'
	and  vw_utilization_region_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.region = t7.region
order by t1.datetime
	;");	

	return $query->result();
	}	
	
	function uf_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select 
 t1.week,t1.datetime as date,t1.region,t1.uf as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_uf_rate_hourly
   where lte_kpi.vw_accessibility_uf_rate_hourly.uf = '".$node."'
and vw_accessibility_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_uf_rate_hourly
 where lte_kpi.vw_availability_uf_rate_hourly.uf = '".$node."'
	and  vw_availability_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.uf = t2.uf
 inner join
	(select * from lte_kpi.vw_mobility_uf_rate_hourly
 where lte_kpi.vw_mobility_uf_rate_hourly.uf = '".$node."'
	and  vw_mobility_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.uf = t3.uf
 inner join
	(select * from lte_kpi.vw_retainability_uf_rate_hourly
 where lte_kpi.vw_retainability_uf_rate_hourly.uf = '".$node."'
	and  vw_retainability_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.uf = t4.uf
 inner join
	(select * from lte_kpi.vw_service_integrity_uf_rate_hourly
 where lte_kpi.vw_service_integrity_uf_rate_hourly.uf = '".$node."'
	and  vw_service_integrity_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.uf = t5.uf
 inner join
	(select * from lte_kpi.vw_traffic_uf_rate_hourly
 where lte_kpi.vw_traffic_uf_rate_hourly.uf = '".$node."'
	and  vw_traffic_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.uf = t6.uf
 inner join
	(select * from lte_kpi.vw_utilization_uf_rate_hourly
 where lte_kpi.vw_utilization_uf_rate_hourly.uf = '".$node."'
	and  vw_utilization_uf_rate_hourly.datetime between '".$inidate."' and '".$enddate." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.uf = t7.uf
order by t1.datetime
	;");	

	return $query->result();
	}

	
	
function cidade_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"select 
 t1.week,t1.region,t1.uf,t1.ibge,'cidade'::text as type,t1.cidade as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cidade_rate_weekly
   where lte_kpi.vw_accessibility_cidade_rate_weekly.cidade = '".$node."'
and vw_accessibility_cidade_rate_weekly.week  = ".$weeknum." ) t1
 inner join 
 (select * from lte_kpi.vw_availability_cidade_rate_weekly
 where lte_kpi.vw_availability_cidade_rate_weekly.cidade = '".$node."'
	and  vw_availability_cidade_rate_weekly.week = ".$weeknum." ) t2
 ON t1.week = t2.week AND t1.ibge = t2.ibge
 inner join
	(select * from lte_kpi.vw_mobility_cidade_rate_weekly
 where lte_kpi.vw_mobility_cidade_rate_weekly.cidade = '".$node."'
	and  vw_mobility_cidade_rate_weekly.week = ".$weeknum." ) t3
ON t1.week = t3.week AND t1.ibge = t3.ibge
 inner join
	(select * from lte_kpi.vw_retainability_cidade_rate_weekly
 where lte_kpi.vw_retainability_cidade_rate_weekly.cidade = '".$node."'
	and  vw_retainability_cidade_rate_weekly.week = ".$weeknum." ) t4
ON t1.week = t4.week AND t1.ibge = t4.ibge
 inner join
	(select * from lte_kpi.vw_service_integrity_cidade_rate_weekly
 where lte_kpi.vw_service_integrity_cidade_rate_weekly.cidade = '".$node."'
	and  vw_service_integrity_cidade_rate_weekly.week = ".$weeknum." ) t5
ON t1.week = t5.week AND t1.ibge = t5.ibge
 inner join
	(select * from lte_kpi.vw_traffic_cidade_rate_weekly
 where lte_kpi.vw_traffic_cidade_rate_weekly.cidade = '".$node."'
	and  vw_traffic_cidade_rate_weekly.week = ".$weeknum." ) t6
ON t1.week = t6.week AND t1.ibge = t6.ibge
 inner join
	(select * from lte_kpi.vw_utilization_cidade_rate_weekly
 where lte_kpi.vw_utilization_cidade_rate_weekly.cidade = '".$node."'
	and  vw_utilization_cidade_rate_weekly.week = ".$weeknum." ) t7
ON t1.week = t7.week AND t1.ibge = t7.ibge
order by t1.week
	;");

		return $query->result();
		}		
	
	
	function cidade_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 " select 
 t1.week, t1.datetime as date,t1.region,t1.uf,t1.ibge,t1.cidade as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cidade_rate_daily
   where lte_kpi.vw_accessibility_cidade_rate_daily.cidade = '".$node."'
and vw_accessibility_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t1
 inner join 
 (select * from lte_kpi.vw_availability_cidade_rate_daily
 where lte_kpi.vw_availability_cidade_rate_daily.cidade = '".$node."'
	and  vw_availability_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t2
 ON t1.datetime = t2.datetime AND t1.ibge = t2.ibge
 inner join
	(select * from lte_kpi.vw_mobility_cidade_rate_daily
 where lte_kpi.vw_mobility_cidade_rate_daily.cidade = '".$node."'
	and  vw_mobility_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t3
ON t1.datetime = t3.datetime AND t1.ibge = t3.ibge
 inner join
	(select * from lte_kpi.vw_retainability_cidade_rate_daily
 where lte_kpi.vw_retainability_cidade_rate_daily.cidade = '".$node."'
	and  vw_retainability_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t4
ON t1.datetime = t4.datetime AND t1.ibge = t4.ibge
 inner join
	(select * from lte_kpi.vw_service_integrity_cidade_rate_daily
 where lte_kpi.vw_service_integrity_cidade_rate_daily.cidade = '".$node."'
	and  vw_service_integrity_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t5
ON t1.datetime = t5.datetime AND t1.ibge = t5.ibge
 inner join
	(select * from lte_kpi.vw_traffic_cidade_rate_daily
 where lte_kpi.vw_traffic_cidade_rate_daily.cidade = '".$node."'
	and  vw_traffic_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t6
ON t1.datetime = t6.datetime AND t1.ibge = t6.ibge
 inner join
	(select * from lte_kpi.vw_utilization_cidade_rate_daily
 where lte_kpi.vw_utilization_cidade_rate_daily.cidade = '".$node."'
	and  vw_utilization_cidade_rate_daily.datetime between '".$inidate."' and '".$findate."') t7
ON t1.datetime = t7.datetime AND t1.ibge = t7.ibge
order by t1.datetime
	;");	

	return $query->result();
	}

function cidade_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 " select 
 t1.datetime as date,t1.region,t1.uf,t1.ibge,t1.cidade as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
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
		$inidate1 = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate1 = date('Y-m-d', strtotime($daterange.' -5 day'));
		$inidate2= date('Y-m-d', strtotime($daterange.' -4 day'));
		$enddate2 = date('Y-m-d', strtotime($daterange.' -2 day'));
		$inidate3 = date('Y-m-d', strtotime($daterange.' -1 day'));
		$enddate3 = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "select 
 t1.datetime AS date,t1.region,t1.uf, t1.enodeb as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_enodeb_rate
   where lte_kpi.vw_accessibility_enodeb_rate.enodeb =  '".$node."'
and vw_accessibility_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_enodeb_rate
 where lte_kpi.vw_availability_enodeb_rate.enodeb =  '".$node."'
	and  vw_availability_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.enodeb =  t2.enodeb
 inner join
	(select * from lte_kpi.vw_mobility_enodeb_rate
 where lte_kpi.vw_mobility_enodeb_rate.enodeb =  '".$node."'
	and  vw_mobility_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.enodeb =  t3.enodeb
 inner join
	(select * from lte_kpi.vw_retainability_enodeb_rate
 where lte_kpi.vw_retainability_enodeb_rate.enodeb =  '".$node."'
	and  vw_retainability_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.enodeb =  t4.enodeb
 inner join
	(select * from lte_kpi.vw_service_integrity_enodeb_rate
 where lte_kpi.vw_service_integrity_enodeb_rate.enodeb =  '".$node."'
	and  vw_service_integrity_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.enodeb =  t5.enodeb
 inner join
	(select * from lte_kpi.vw_traffic_enodeb_rate
 where lte_kpi.vw_traffic_enodeb_rate.enodeb =  '".$node."'
	and  vw_traffic_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.enodeb =  t6.enodeb
 inner join
	(select * from lte_kpi.vw_utilization_enodeb_rate
 where lte_kpi.vw_utilization_enodeb_rate.enodeb =  '".$node."'
	and  vw_utilization_enodeb_rate.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.enodeb =  t7.enodeb
union
select 
 t1.datetime AS date,t1.region,t1.uf, t1.enodeb as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_enodeb_rate
   where lte_kpi.vw_accessibility_enodeb_rate.enodeb =  '".$node."'
and vw_accessibility_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_enodeb_rate
 where lte_kpi.vw_availability_enodeb_rate.enodeb =  '".$node."'
	and  vw_availability_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.enodeb =  t2.enodeb
 inner join
	(select * from lte_kpi.vw_mobility_enodeb_rate
 where lte_kpi.vw_mobility_enodeb_rate.enodeb =  '".$node."'
	and  vw_mobility_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.enodeb =  t3.enodeb
 inner join
	(select * from lte_kpi.vw_retainability_enodeb_rate
 where lte_kpi.vw_retainability_enodeb_rate.enodeb =  '".$node."'
	and  vw_retainability_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.enodeb =  t4.enodeb
 inner join
	(select * from lte_kpi.vw_service_integrity_enodeb_rate
 where lte_kpi.vw_service_integrity_enodeb_rate.enodeb =  '".$node."'
	and  vw_service_integrity_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.enodeb =  t5.enodeb
 inner join
	(select * from lte_kpi.vw_traffic_enodeb_rate
 where lte_kpi.vw_traffic_enodeb_rate.enodeb =  '".$node."'
	and  vw_traffic_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.enodeb =  t6.enodeb
 inner join
	(select * from lte_kpi.vw_utilization_enodeb_rate
 where lte_kpi.vw_utilization_enodeb_rate.enodeb =  '".$node."'
	and  vw_utilization_enodeb_rate.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.enodeb =  t7.enodeb
union
select 
 t1.datetime AS date,t1.region,t1.uf, t1.enodeb as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_enodeb_rate
   where lte_kpi.vw_accessibility_enodeb_rate.enodeb =  '".$node."'
and vw_accessibility_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_enodeb_rate
 where lte_kpi.vw_availability_enodeb_rate.enodeb =  '".$node."'
	and  vw_availability_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.enodeb =  t2.enodeb
 inner join
	(select * from lte_kpi.vw_mobility_enodeb_rate
 where lte_kpi.vw_mobility_enodeb_rate.enodeb =  '".$node."'
	and  vw_mobility_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.enodeb =  t3.enodeb
 inner join
	(select * from lte_kpi.vw_retainability_enodeb_rate
 where lte_kpi.vw_retainability_enodeb_rate.enodeb =  '".$node."'
	and  vw_retainability_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.enodeb =  t4.enodeb
 inner join
	(select * from lte_kpi.vw_service_integrity_enodeb_rate
 where lte_kpi.vw_service_integrity_enodeb_rate.enodeb =  '".$node."'
	and  vw_service_integrity_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.enodeb =  t5.enodeb
 inner join
	(select * from lte_kpi.vw_traffic_enodeb_rate
 where lte_kpi.vw_traffic_enodeb_rate.enodeb =  '".$node."'
	and  vw_traffic_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.enodeb =  t6.enodeb
 inner join
	(select * from lte_kpi.vw_utilization_enodeb_rate
 where lte_kpi.vw_utilization_enodeb_rate.enodeb =  '".$node."'
	and  vw_utilization_enodeb_rate.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.enodeb =  t7.enodeb
order by date
	;");		
		return $query->result();
	}

function cluster_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate1 = date('Y-m-d', strtotime($daterange.' -7 day'));
		$enddate1 = date('Y-m-d', strtotime($daterange.' -5 day'));
		$inidate2= date('Y-m-d', strtotime($daterange.' -4 day'));
		$enddate2 = date('Y-m-d', strtotime($daterange.' -2 day'));
		$inidate3 = date('Y-m-d', strtotime($daterange.' -1 day'));
		$enddate3 = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "select 
 t1.datetime AS date,t1.clustername as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cluster_rate_hourly
   where lte_kpi.vw_accessibility_cluster_rate_hourly.clustername =  '".$node."'
and vw_accessibility_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_cluster_rate_hourly
 where lte_kpi.vw_availability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_availability_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.clustername =  t2.clustername
 inner join
	(select * from lte_kpi.vw_mobility_cluster_rate_hourly
 where lte_kpi.vw_mobility_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_mobility_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.clustername =  t3.clustername
 inner join
	(select * from lte_kpi.vw_retainability_cluster_rate_hourly
 where lte_kpi.vw_retainability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_retainability_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.clustername =  t4.clustername
 inner join
	(select * from lte_kpi.vw_service_integrity_cluster_rate_hourly
 where lte_kpi.vw_service_integrity_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_service_integrity_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.clustername =  t5.clustername
 inner join
	(select * from lte_kpi.vw_traffic_cluster_rate_hourly
 where lte_kpi.vw_traffic_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_traffic_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.clustername =  t6.clustername
 inner join
	(select * from lte_kpi.vw_utilization_cluster_rate_hourly
 where lte_kpi.vw_utilization_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_utilization_cluster_rate_hourly.datetime between '".$inidate1."' and '".$enddate1." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.clustername =  t7.clustername
union
select 
 t1.datetime AS date,t1.clustername as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cluster_rate_hourly
   where lte_kpi.vw_accessibility_cluster_rate_hourly.clustername =  '".$node."'
and vw_accessibility_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_cluster_rate_hourly
 where lte_kpi.vw_availability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_availability_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.clustername =  t2.clustername
 inner join
	(select * from lte_kpi.vw_mobility_cluster_rate_hourly
 where lte_kpi.vw_mobility_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_mobility_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.clustername =  t3.clustername
 inner join
	(select * from lte_kpi.vw_retainability_cluster_rate_hourly
 where lte_kpi.vw_retainability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_retainability_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.clustername =  t4.clustername
 inner join
	(select * from lte_kpi.vw_service_integrity_cluster_rate_hourly
 where lte_kpi.vw_service_integrity_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_service_integrity_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.clustername =  t5.clustername
 inner join
	(select * from lte_kpi.vw_traffic_cluster_rate_hourly
 where lte_kpi.vw_traffic_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_traffic_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.clustername =  t6.clustername
 inner join
	(select * from lte_kpi.vw_utilization_cluster_rate_hourly
 where lte_kpi.vw_utilization_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_utilization_cluster_rate_hourly.datetime between '".$inidate2."' and '".$enddate2." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.clustername =  t7.clustername
union
select 
 t1.datetime AS date,t1.clustername as node,rrc_service,fails_rrc_service,rrc_signaling,fails_rrc_signaling,s1sig,fails_s1sig,e_rab,
 fails_e_rab,call_setup,csfb,fails_csfb,availability,intra_freq_hoo_out,inter_freq_hoo_out,handover_in,iratho_l2c,iratho_l2w,iratho_l2g,iratho_l2t,
 retention_4g,service_drop,round(cell_downlink_avg_thp / 1024::numeric, 2) AS cell_downlink_avg_thp,round(cell_uplink_avg_thp / 1024::numeric, 2) AS cell_uplink_avg_thp,
 rb_cell_downlink_avg_thp,rb_cell_uplink_avg_thp,round((downlink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS downlink_traffic_volume,
 round((uplink_traffic_volume / 8589934592::bigint::double precision)::numeric, 2) AS uplink_traffic_volume,average_user_volume,rb_utilization_dl,rrc_signaling_ul,rb_preschedule_rb_urul
   FROM 
   (select * from lte_kpi.vw_accessibility_cluster_rate_hourly
   where lte_kpi.vw_accessibility_cluster_rate_hourly.clustername =  '".$node."'
and vw_accessibility_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00') t1
 inner join 
 (select * from lte_kpi.vw_availability_cluster_rate_hourly
 where lte_kpi.vw_availability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_availability_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t2
 ON t1.datetime = t2.datetime AND t1.clustername =  t2.clustername
 inner join
	(select * from lte_kpi.vw_mobility_cluster_rate_hourly
 where lte_kpi.vw_mobility_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_mobility_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t3
ON t1.datetime = t3.datetime AND t1.clustername =  t3.clustername
 inner join
	(select * from lte_kpi.vw_retainability_cluster_rate_hourly
 where lte_kpi.vw_retainability_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_retainability_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t4
ON t1.datetime = t4.datetime AND t1.clustername =  t4.clustername
 inner join
	(select * from lte_kpi.vw_service_integrity_cluster_rate_hourly
 where lte_kpi.vw_service_integrity_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_service_integrity_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t5
ON t1.datetime = t5.datetime AND t1.clustername =  t5.clustername
 inner join
	(select * from lte_kpi.vw_traffic_cluster_rate_hourly
 where lte_kpi.vw_traffic_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_traffic_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t6
ON t1.datetime = t6.datetime AND t1.clustername =  t6.clustername
 inner join
	(select * from lte_kpi.vw_utilization_cluster_rate_hourly
 where lte_kpi.vw_utilization_cluster_rate_hourly.clustername =  '".$node."'
	and  vw_utilization_cluster_rate_hourly.datetime between '".$inidate3."' and '".$enddate3." 23:30:00' ) t7
ON t1.datetime = t7.datetime AND t1.clustername =  t7.clustername
order by date
	;");		
		return $query->result();
	}
	
}
