<?php 

class Model_npm_reports extends CI_Model{

function network_hourly_report($reportdate){
		$query = $this->db->query(
		"SELECT 'NETWORK' as node,
		 datetime as date,
		ROUND((SUM(vs_lc_ulcreditused_mean)/2)::NUMERIC,2) as vs_lc_ulcreditused_mean,
		ROUND(avg(vs_hsupa_ue_mean_tti10ms)::NUMERIC,2) as vs_hsupa_ue_mean_tti10ms,
		ROUND(avg(vs_hsupa_ue_mean_tti2ms)::NUMERIC,2) as vs_hsupa_ue_mean_tti2ms,
		ROUND((SUM(vs_nodeb_ulcreditused_mean)/2)::NUMERIC,2) as vs_nodeb_ulcreditused_mean,
		SUM(vs_paging1_succ1_idle_realtime_cell) as vs_paging1_succ1_idle_realtime_cell,
		SUM(vs_utran_attpaging1) as vs_utran_attpaging1,
		SUM(vs_paging1_att1_idle_nonerealtime_cell) as vs_paging1_att1_idle_nonerealtime_cell,
		SUM(vs_paging1_att1_idle_realtime_cell) as vs_paging1_att1_idle_realtime_cell,
		SUM(vs_utran_paging1_att_idle_ps) as vs_utran_paging1_att_idle_ps,
		SUM(vs_paging1_succ1_idle_nonerealtime_cell) as vs_paging1_succ1_idle_nonerealtime_cell,
		SUM(vs_rrc_paging1_loss_pchcong_cell) as vs_rrc_paging1_loss_pchcong_cell,
		SUM(vs_utran_paging1_att_idle_cs) as vs_utran_paging1_att_idle_cs,
		SUM(vs_hsdpa_dyncfgatt_longcqi) as vs_hsdpa_dyncfgatt_longcqi,
		ROUND(avg(vs_meanulactualpowerload)::NUMERIC,2) as vs_meanulactualpowerload,
		ROUND(avg(vs_backgroundnoise_mean)::NUMERIC,2) as vs_backgroundnoise_mean,
		SUM(vs_hsdpa_dyncfgatt_shortcqi) as vs_hsdpa_dyncfgatt_shortcqi
		  FROM npm_reports.feature_phase2
		  GROUP BY datetime
		  ORDER BY DATETIME;"
		);
			
	return $query->result();
	}


	function rnc_hourly_report($node,$reportdate){
		$query = $this->db->query(
		"SELECT rnc as node,
		 datetime as date,
		ROUND((SUM(vs_lc_ulcreditused_mean)/2)::NUMERIC,2) as vs_lc_ulcreditused_mean,
		ROUND(avg(vs_hsupa_ue_mean_tti10ms)::NUMERIC,2) as vs_hsupa_ue_mean_tti10ms,
		ROUND(avg(vs_hsupa_ue_mean_tti2ms)::NUMERIC,2) as vs_hsupa_ue_mean_tti2ms,
		ROUND((SUM(vs_nodeb_ulcreditused_mean)/2)::NUMERIC,2) as vs_nodeb_ulcreditused_mean,
		SUM(vs_paging1_succ1_idle_realtime_cell) as vs_paging1_succ1_idle_realtime_cell,
		SUM(vs_utran_attpaging1) as vs_utran_attpaging1,
		SUM(vs_paging1_att1_idle_nonerealtime_cell) as vs_paging1_att1_idle_nonerealtime_cell,
		SUM(vs_paging1_att1_idle_realtime_cell) as vs_paging1_att1_idle_realtime_cell,
		SUM(vs_utran_paging1_att_idle_ps) as vs_utran_paging1_att_idle_ps,
		SUM(vs_paging1_succ1_idle_nonerealtime_cell) as vs_paging1_succ1_idle_nonerealtime_cell,
		SUM(vs_rrc_paging1_loss_pchcong_cell) as vs_rrc_paging1_loss_pchcong_cell,
		SUM(vs_utran_paging1_att_idle_cs) as vs_utran_paging1_att_idle_cs,
		SUM(vs_hsdpa_dyncfgatt_longcqi) as vs_hsdpa_dyncfgatt_longcqi,
		ROUND(avg(vs_meanulactualpowerload)::NUMERIC,2) as vs_meanulactualpowerload,
		ROUND(avg(vs_backgroundnoise_mean)::NUMERIC,2) as vs_backgroundnoise_mean,
		SUM(vs_hsdpa_dyncfgatt_shortcqi) as vs_hsdpa_dyncfgatt_shortcqi
		  FROM npm_reports.feature_phase2
		  WHERE rnc = '".$node."'
		  GROUP BY rnc, datetime
		  ORDER BY DATETIME;"
		);
			
	return $query->result();
	}
	
function network_tx_hourly_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		$query = $this->db->query(
		"select * from npm_reports.vw_tx_integrity_network
		 WHERE date between '".$inidate."' and '".$findate." 23:30:00'
		ORDER BY date;"
		);
			
	return $query->result();
	}

function rnc_tx_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		$query = $this->db->query(
		"select * from npm_reports.vw_tx_integrity_rnc
		WHERE node = '".$node."'
		 and date between '".$inidate."' and '".$findate." 23:30:00'
		ORDER BY date;"
		);
			
	return $query->result();
	}

function nodeb_tx_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		$query = $this->db->query(
		"select * from npm_reports.vw_tx_integrity_nodeb
		WHERE node = '".$node."'
		 and date between '".$inidate."' and '".$findate." 23:30:00'
		ORDER BY date;"
		);
			
	return $query->result();
	}	
	
}
