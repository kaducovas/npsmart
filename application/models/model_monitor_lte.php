<?php 

class Model_monitor_lte extends CI_Model{
	function cells(){
		$query = $this->db->query(
		"select * from umts_control.cells order by rnc,cell;");

	return $query->result();
	}
	function cellkpi($rnc_query,$cellid_query){
		$query = $this->db->query(
		"SELECT datetime, rnc, cellname, cellid, 
		acc_rrc, fails_acc_rrc, 
       eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
       fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h
		
		FROM vw_accessibility_rate
			where rnc='".$rnc_query."'
			and cellid = ".$cellid_query.";");
			
	return $query->result();
	}
	
function cell_accessibility($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		
		$query = $this->db->query(
		"select vw_accessibility_rate.rnc, vw_accessibility_rate.datetime, vw_accessibility_rate.cellname,vw_accessibility_rate.cellid,
			acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
			fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h,
			vs_rrc_rej_code_cong,vs_rrc_rej_dlce_cong,vs_rrc_rej_dliubband_cong,vs_rrc_rej_dlpower_cong,vs_rrc_rej_nodebresunavail,
			vs_rrc_rej_redir_dist,vs_rrc_rej_redir_dist_intrarat,vs_rrc_rej_redir_interrat,vs_rrc_rej_redir_intrarat,vs_rrc_rej_redir_service,
			vs_rrc_rej_rl_fail,vs_rrc_rej_sum,vs_rrc_rej_tnl_fail,vs_rrc_rej_ulce_cong,vs_rrc_rej_uliubband_cong,vs_rrc_rej_ulpower_cong,vs_rrc_failconnestab_noreply,vs_rrc_failconnestab_cong,
			vs_rab_failestabcs_code_cong,vs_rab_failestabcs_cong,vs_rab_failestabcs_dlce_cong,vs_rab_failestabcs_dliubband_cong,vs_rab_failestabcs_dlpower_cong,vs_rab_failestabcs_iubfail,
			vs_rab_failestabcs_phychfail,vs_rab_failestabcs_rbcfgunsup,vs_rab_failestabcs_rbinccfg,vs_rab_failestabcs_rnl,vs_rab_failestabcs_tnl,vs_rab_failestabcs_ulce_cong,
			vs_rab_failestabcs_uliubband_cong,vs_rab_failestabcs_ulpower_cong,vs_rab_failestabcs_unsp,vs_rab_failestabcs_uufail,vs_rab_failestabcs_uunoreply,vs_rab_failestabps_cellupd,
			vs_rab_failestabps_code_cong,vs_rab_failestabps_cong,vs_rab_failestabps_dlce_cong,vs_rab_failestabps_dliubband_cong,vs_rab_failestabps_dlpower_cong,vs_rab_failestabps_hsdpauser_cong,
			vs_rab_failestabps_hsupauser_cong,vs_rab_failestabps_iubfail,vs_rab_failestabps_phychfail,vs_rab_failestabps_rbcfgunsupp,vs_rab_failestabps_rbinccfg,vs_rab_failestabps_rnl,
			vs_rab_failestabps_srbreset,vs_rab_failestabps_tnl,vs_rab_failestabps_ulce_cong,vs_rab_failestabps_uliubband_cong,vs_rab_failestabps_ulpower_cong,vs_rab_failestabps_unsp,
			vs_rab_failestabps_uufail,vs_rab_failestabps_uunoreply
			
			  FROM umts_kpi.vw_accessibility_rate,umts_kpi.accessibility_fails
			WHERE vw_accessibility_rate.rnc = umts_kpi.accessibility_fails.rnc
			AND vw_accessibility_rate.datetime = umts_kpi.accessibility_fails.datetime
			AND vw_accessibility_rate.cellid = umts_kpi.accessibility_fails.cellid
			and vw_accessibility_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_accessibility_rate.rnc = '".$rnc_query."'
			AND vw_accessibility_rate.cellid = '".$cellid_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}

function rncaccrrc($rnc_query,$inidate,$findate){
		$query = $this->db->query(
		"select vw_accessibility_rnc_rate.rnc, vw_accessibility_rnc_rate.datetime, 
			acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
			fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h,
			vs_rrc_rej_code_cong,vs_rrc_rej_dlce_cong,vs_rrc_rej_dliubband_cong,vs_rrc_rej_dlpower_cong,vs_rrc_rej_nodebresunavail,
			vs_rrc_rej_redir_dist,vs_rrc_rej_redir_dist_intrarat,vs_rrc_rej_redir_interrat,vs_rrc_rej_redir_intrarat,vs_rrc_rej_redir_service,
			vs_rrc_rej_rl_fail,vs_rrc_rej_sum,vs_rrc_rej_tnl_fail,vs_rrc_rej_ulce_cong,vs_rrc_rej_uliubband_cong,vs_rrc_rej_ulpower_cong,vs_rrc_failconnestab_noreply,vs_rrc_failconnestab_cong,
			vs_rab_failestabcs_code_cong,vs_rab_failestabcs_cong,vs_rab_failestabcs_dlce_cong,vs_rab_failestabcs_dliubband_cong,vs_rab_failestabcs_dlpower_cong,vs_rab_failestabcs_iubfail,
			vs_rab_failestabcs_phychfail,vs_rab_failestabcs_rbcfgunsup,vs_rab_failestabcs_rbinccfg,vs_rab_failestabcs_rnl,vs_rab_failestabcs_tnl,vs_rab_failestabcs_ulce_cong,
			vs_rab_failestabcs_uliubband_cong,vs_rab_failestabcs_ulpower_cong,vs_rab_failestabcs_unsp,vs_rab_failestabcs_uufail,vs_rab_failestabcs_uunoreply,vs_rab_failestabps_cellupd,
			vs_rab_failestabps_code_cong,vs_rab_failestabps_cong,vs_rab_failestabps_dlce_cong,vs_rab_failestabps_dliubband_cong,vs_rab_failestabps_dlpower_cong,vs_rab_failestabps_hsdpauser_cong,
			vs_rab_failestabps_hsupauser_cong,vs_rab_failestabps_iubfail,vs_rab_failestabps_phychfail,vs_rab_failestabps_rbcfgunsupp,vs_rab_failestabps_rbinccfg,vs_rab_failestabps_rnl,
			vs_rab_failestabps_srbreset,vs_rab_failestabps_tnl,vs_rab_failestabps_ulce_cong,vs_rab_failestabps_uliubband_cong,vs_rab_failestabps_ulpower_cong,vs_rab_failestabps_unsp,
			vs_rab_failestabps_uufail,vs_rab_failestabps_uunoreply			
	
			  FROM umts_kpi.vw_accessibility_rnc_rate,umts_kpi.accessibility_fails_rnc
			WHERE vw_accessibility_rnc_rate.rnc = umts_kpi.accessibility_fails_rnc.rnc
			AND vw_accessibility_rnc_rate.datetime = umts_kpi.accessibility_fails_rnc.datetime
			and vw_accessibility_rnc_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_accessibility_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function rnc_accessibility($rnc_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select vw_accessibility_rnc_rate.rnc, vw_accessibility_rnc_rate.datetime, 
			acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
			fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h,
			vs_rrc_rej_code_cong,vs_rrc_rej_dlce_cong,vs_rrc_rej_dliubband_cong,vs_rrc_rej_dlpower_cong,vs_rrc_rej_nodebresunavail,
			vs_rrc_rej_redir_dist,vs_rrc_rej_redir_dist_intrarat,vs_rrc_rej_redir_interrat,vs_rrc_rej_redir_intrarat,vs_rrc_rej_redir_service,
			vs_rrc_rej_rl_fail,vs_rrc_rej_sum,vs_rrc_rej_tnl_fail,vs_rrc_rej_ulce_cong,vs_rrc_rej_uliubband_cong,vs_rrc_rej_ulpower_cong,vs_rrc_failconnestab_noreply,vs_rrc_failconnestab_cong,
			vs_rab_failestabcs_code_cong,vs_rab_failestabcs_cong,vs_rab_failestabcs_dlce_cong,vs_rab_failestabcs_dliubband_cong,vs_rab_failestabcs_dlpower_cong,vs_rab_failestabcs_iubfail,
			vs_rab_failestabcs_phychfail,vs_rab_failestabcs_rbcfgunsup,vs_rab_failestabcs_rbinccfg,vs_rab_failestabcs_rnl,vs_rab_failestabcs_tnl,vs_rab_failestabcs_ulce_cong,
			vs_rab_failestabcs_uliubband_cong,vs_rab_failestabcs_ulpower_cong,vs_rab_failestabcs_unsp,vs_rab_failestabcs_uufail,vs_rab_failestabcs_uunoreply,vs_rab_failestabps_cellupd,
			vs_rab_failestabps_code_cong,vs_rab_failestabps_cong,vs_rab_failestabps_dlce_cong,vs_rab_failestabps_dliubband_cong,vs_rab_failestabps_dlpower_cong,vs_rab_failestabps_hsdpauser_cong,
			vs_rab_failestabps_hsupauser_cong,vs_rab_failestabps_iubfail,vs_rab_failestabps_phychfail,vs_rab_failestabps_rbcfgunsupp,vs_rab_failestabps_rbinccfg,vs_rab_failestabps_rnl,
			vs_rab_failestabps_srbreset,vs_rab_failestabps_tnl,vs_rab_failestabps_ulce_cong,vs_rab_failestabps_uliubband_cong,vs_rab_failestabps_ulpower_cong,vs_rab_failestabps_unsp,
			vs_rab_failestabps_uufail,vs_rab_failestabps_uunoreply			
	
			  FROM umts_kpi.vw_accessibility_rnc_rate,umts_kpi.accessibility_fails_rnc
			WHERE vw_accessibility_rnc_rate.rnc = umts_kpi.accessibility_fails_rnc.rnc
			AND vw_accessibility_rnc_rate.datetime = umts_kpi.accessibility_fails_rnc.datetime
			and vw_accessibility_rnc_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_accessibility_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function region_accessibility($node_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"SELECT week, datetime, region, rrc_service, fails_rrc_service, rrc_signaling, 
       fails_rrc_signaling, s1sig, fails_s1sig, e_rab, fails_e_rab, 
       call_setup, csfb, fails_csfb
		FROM lte_kpi.vw_accessibility_region_rate_hourly
			WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	

function region_retainability($node_query,$inidate,$findate){
	$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"SELECT week, datetime, region, service_drop
  FROM lte_kpi.vw_retainability_region_rate_hourly
			WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function cell_retainability($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_retainability_rate
			WHERE vw_retainability_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_retainability_rate.rnc = '".$rnc_query."'
			AND vw_retainability_rate.cellid = '".$cellid_query."'			
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function region_mobility($node_query,$inidate,$findate){
		$query = $this->db->query(
		"SELECT week, datetime, region, intra_freq_hoo_out, inter_freq_hoo_out, 
       handover_in, iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, 
       retention_4g
		FROM lte_kpi.vw_mobility_region_rate_hourly
			WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function cell_mobility($rnc_query,$cellid_query,$inidate,$findate){
	$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_mobility_rate
			WHERE vw_mobility_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_mobility_rate.rnc = '".$rnc_query."'
			AND vw_mobility_rate.cellid = '".$cellid_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function region_coverage($node_query,$inidate,$findate){
		$query = $this->db->query(
		"SELECT week, datetime, region, intra_freq_hoo_out, inter_freq_hoo_out, 
       handover_in, iratho_l2c, iratho_l2w, iratho_l2g, iratho_l2t, 
       retention_4g
		FROM lte_kpi.vw_mobility_region_rate_hourly
			WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	


function region_service_integrity($node_query,$inidate,$findate){
		$query = $this->db->query(
		"SELECT week, datetime, region, round((cell_downlink_avg_thp/1024)::numeric,2) as cell_downlink_avg_thp, round((cell_uplink_avg_thp/1024)::numeric,2) as cell_uplink_avg_thp, 
       rb_cell_downlink_avg_thp, rb_cell_uplink_avg_thp
  FROM lte_kpi.vw_service_integrity_region_rate_hourly
		WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}

function cell_service_integrity($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"SELECT * FROM umts_kpi.service_integrity
		WHERE service_integrity.datetime between '".$inidate."' and '".$findate." 23:30:00'
		AND service_integrity.rnc = '".$rnc_query."'
		AND service_integrity.cellid = '".$cellid_query."'		
		order by datetime"
		);
			
	return $query->result();
	}		
	
function rnc_availability($rnc_query,$inidate,$findate){
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_availability_rnc_rate
			WHERE vw_availability_rnc_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_availability_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}

function region_availability($node_query,$inidate,$findate){
		$query = $this->db->query(
		"SELECT week, datetime, region, availability
  FROM lte_kpi.vw_availability_region_rate_hourly
		WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND region = '".$node_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function cell_availability($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.availability
			WHERE availability.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND availability.rnc = '".$rnc_query."'
			AND availability.cellid = '".$cellid_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}		

	function celltraffic($rnc_query,$cellid_query,$inidate,$findate){
		$query = $this->db->query(
		"select datetime, rnc, cellname, cellid, ((hsdpa_data*(1024*1024)))::real as hsdpa_data, ((hsupa_data*(1024*1024)))::real as hsupa_data, ((ps_r99_ul)*(1024))::real as ps_r99_ul, ((ps_r99_dl)*(1024))::real as ps_r99_dl, 
       voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, 
       hsdpa_users, hsupa_users, ps_nonhs_users from umts_kpi.traffic
	   WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
		AND rnc = '".$rnc_query."'
		AND cellid = '".$cellid_query."'
		ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
	
	function rnctraffic($rnc_query,$inidate,$findate){
		$query = $this->db->query(
		"select rnc, datetime, gp, ((hsdpa_data*(1024*1024)))::real as hsdpa_data, ((hsupa_data*(1024*1024)))::real as hsupa_data, ((ps_r99_ul)*(1024))::real as ps_r99_ul, ((ps_r99_dl)*(1024))::real as ps_r99_dl, 
       voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, 
       hsdpa_users, hsupa_users, ps_nonhs_users from umts_kpi.traffic_rnc
		WHERE datetime between '".$inidate."' and '".$findate." 23:30:00'
		AND rnc = '".$rnc_query."'
		ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function rnc_nqi($rnc_query,$inidate,$findate){
	$inidate = date('Y-m-d', strtotime($inidate.' -30 day'));
		$query = $this->db->query(
		"SELECT week, date, region, rnc, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, 
       qdr_ps, throughput, availability, retention_cs, retention_ps, 
       hsdpa_users_ratio, nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_rnc
  WHERE umts_kpi.vw_nqi_daily_rnc.date between '".$inidate."' and '".$findate."'
  AND umts_kpi.vw_nqi_daily_rnc.rnc = '".$rnc_query."'
  ORDER BY date"
		);
			
	return $query->result();
	}	
	
	
	function clusterkpi($cluster_query){
		$query = $this->db->query(
		"SELECT datetime, cluster, 
		acc_rrc as acc_rrc,
		acc_cs as acc_cs, 
		eff_hsdpa as eff_hsdpa, 
		eff_f2h as eff_f2h, 
		acc_hsdpa as acc_hsdpa,
		acc_hsdpa_f2h as acc_hsdpa_f2h,
		drop_cs as drop_cs, 
		drop_ps as drop_ps,
		retention_cs as retention_cs, 
		retention_ps as retention_ps, 
		unavailability as unavailability,
		fails_acc_rrc, fails_acc_cs, fails_drop_cs, fails_drop_ps 
		FROM vw_accessibility_rate
			WHERE cluster = '".$cluster_query."';");
			
	return $query->result();
	}
	function cidadekpi($cidade_query){
		$query = $this->db->query(
		"SELECT datetime, cidade, 
		acc_rrc as acc_rrc,
		acc_cs as acc_cs, 
		eff_hsdpa as eff_hsdpa, 
		eff_f2h as eff_f2h, 
		acc_hsdpa as acc_hsdpa,
		acc_hsdpa_f2h as acc_hsdpa_f2h,
		drop_cs as drop_cs, 
		drop_ps as drop_ps,
		retention_cs as retention_cs, 
		retention_ps as retention_ps, 
		unavailability as unavailability,
		fails_acc_rrc, fails_acc_cs, fails_drop_cs, fails_drop_ps 
		FROM vw_accessibility_rate
			WHERE cidade = '".$cidade_query."';");

	return $query->result();
	}

	function rnc_main_kpis($node,$findate,$timeagg,$reportnetype){
	if($timeagg == "weekly"){
		$inidate = date('Y-m-d', strtotime($findate.' -7 day'));
		$period = 'date';
		$time =  ' 23:30:00';
	} elseif ($timeagg == "daily"){
		$inidate = date('Y-m-d', strtotime($findate.' -7 day'));
		$period = 'date';
		$time = '';		
	} elseif ($timeagg == "monthly"){
		$inidate = $findate;
		$period = 'week';
		$time = '';
	}

	if($reportnetype == "cidade"){
		$nodeid_main_kpis = 'ibge';
		$nodeid_fails = 'ibge';
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$node = $cidade_info[0]->ibge;		
		} 
		elseif ($reportnetype == "cluster"){
		$nodeid_main_kpis = 'cluster_id';
		$nodeid_fails = 'cluster_id';	
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$node = $cluster_info[0]->cluster_id;			
		}
		elseif ($reportnetype == "rnc"){
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'rnc';
		}		
		else {
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'node';
		}	
	
		$query = $this->db->query(
		"select m.week,
m.date as datetime, m.node, 
COALESCE(rrc_service,100) as rrc_service, 
COALESCE(fails_rrc_service,0) as fails_rrc_service,
COALESCE(rrc_signaling,100) as rrc_signaling,
COALESCE(fails_rrc_signaling,0) as fails_rrc_signaling,
COALESCE(s1sig,100) as s1sig,
COALESCE(fails_s1sig,0) as fails_s1sig,
COALESCE(e_rab,100) as e_rab,
COALESCE(fails_e_rab,0) as fails_e_rab,
COALESCE(call_setup,100) as call_setup,
COALESCE(csfb,100) as csfb,
COALESCE(fails_csfb,0) as fails_csfb,
COALESCE(availability,100) as availability,
COALESCE(intra_freq_hoo_out,100) as intra_freq_hoo_out,
COALESCE(inter_freq_hoo_out,100) as inter_freq_hoo_out,
COALESCE(handover_in,100) as handover_in,
COALESCE(iratho_l2c,100) as iratho_l2c,
COALESCE(iratho_l2w,100) as iratho_l2w,
COALESCE(iratho_l2g,100) as iratho_l2g,
COALESCE(iratho_l2t,100) as iratho_l2t,
COALESCE(retention_4g,100) as retention_4g,
COALESCE(service_drop,100) as service_drop,
COALESCE(cell_downlink_avg_thp,100) as cell_downlink_avg_thp,
COALESCE(cell_uplink_avg_thp,100) as cell_uplink_avg_thp,
COALESCE(rb_cell_downlink_avg_thp,100) as rb_cell_downlink_avg_thp,
COALESCE(rb_cell_uplink_avg_thp,100) as rb_cell_uplink_avg_thp,
COALESCE(downlink_traffic_volume,0) as downlink_traffic_volume,
COALESCE(uplink_traffic_volume,0) as uplink_traffic_volume,
COALESCE(average_user_volume,0) as average_user_volume,
COALESCE(rb_utilization_dl,100) as rb_utilization_dl,
COALESCE(rrc_signaling_ul,100) as rrc_signaling_ul,
COALESCE(rb_preschedule_rb_urul,100) as rb_preschedule_rb_urul
	FROM lte_kpi.vw_main_kpis_".$reportnetype."_rate_hourly m 
	where m.".$period." between '".$inidate."' and '".$findate.$time."'
	AND m.".$nodeid_main_kpis." = '".$node."'
	ORDER BY m.date;"
		);
			
	return $query->result();
	}
	
}