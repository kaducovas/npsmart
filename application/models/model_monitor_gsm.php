<?php 

class Model_monitor_gsm extends CI_Model{
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
		"select *
			  FROM umts_kpi.vw_main_kpis_rnc_rate_hourly where datetime between '".$inidate."' and '".$findate."'
			AND node = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
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
		} elseif ($reportnetype == "cluster"){
		$nodeid_main_kpis = 'cluster_id';
		$nodeid_fails = 'cluster_id';	
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$node = $cluster_info[0]->cluster_id;			
		}
		elseif ($reportnetype == "rnc"){
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'rnc';
		}		else {
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'node';
		}	
	
		$query = $this->db->query(
		"select m.week,
 m.date as datetime, m.node, 
acc_rrc, 
fails_acc_rrc, 
eff_cs, 
fails_acc_cs, 
COALESCE(acc_cs,100) as acc_cs, 
COALESCE(eff_ps,0) as eff_ps, 
COALESCE(fails_acc_ps,0) as fails_acc_ps, 
COALESCE(acc_ps,100) AS acc_ps, 
COALESCE(eff_hsdpa,0) AS eff_hsdpa, 
COALESCE(fails_acc_hsdpa,0) AS fails_acc_hsdpa, 
COALESCE(eff_f2h,0) AS eff_f2h, 
COALESCE(fails_f2h,0) AS fails_f2h, 
COALESCE(acc_hsdpa,100) AS acc_hsdpa, 
COALESCE(acc_hsdpa_f2h,100) AS acc_hsdpa_f2h, 
COALESCE(drop_cs,100) AS drop_cs, 
COALESCE(fails_drop_cs,0) AS fails_drop_cs, 
COALESCE(drop_ps,100) AS drop_ps, 
COALESCE(fails_drop_ps,0) AS fails_drop_ps, 
COALESCE(drop_hsdpa,0) AS drop_hsdpa, 
COALESCE(fails_drop_hsdpa,0) AS fails_drop_hsdpa, 
COALESCE(drop_hsupa,0) AS drop_hsupa, 
COALESCE(fails_drop_hsupa,0) AS fails_drop_hsupa, 
COALESCE(sho_succ_rate,100) AS sho_succ_rate, 
COALESCE(soft_hand_succ_rate,100) AS soft_hand_succ_rate, 
COALESCE(hho_intra_freq_succ_rate,100) AS hho_intra_freq_succ_rate, 
COALESCE(cs_hho_intra_freq_rate,100) AS cs_hho_intra_freq_rate, 
COALESCE(ps_hho_intra_freq_succ_rate,100) AS ps_hho_intra_freq_succ_rate, 
COALESCE(hho_inter_freq_succ_rate,100) AS hho_inter_freq_succ_rate, 
COALESCE(iratho_cs_succ_rate,100) AS iratho_cs_succ_rate, 
COALESCE(iratho_ps_succ_rate,100) AS iratho_ps_succ_rate,
COALESCE(retention_cs_succ_rate,100) AS retention_cs_succ_rate,
COALESCE(retention_ps_succ_rate,100) AS retention_ps_succ_rate,
COALESCE(sho_over,0) AS sho_over,
COALESCE(rtwp,-98) AS rtwp,
COALESCE(availability,100) AS availability,
COALESCE(data_hsdpa,0) AS data_hsdpa,
COALESCE(data_hsupa,0) AS data_hsupa,
COALESCE(ps_r99_ul,0) AS ps_r99_ul,
COALESCE(ps_r99_dl,0) AS ps_r99_dl,
COALESCE(voice_traffic_dl,0) AS voice_traffic_dl,
COALESCE(voice_traffic_ul,0) AS voice_traffic_ul,
COALESCE(voice_erlangs_num,0) AS voice_erlangs_num,
COALESCE(voice_erlangs_den,0) AS voice_erlangs_den,
COALESCE(hsdpa_users,0) AS hsdpa_users,
COALESCE(hsupa_users,0) AS hsupa_users,
COALESCE(dch_users,0) AS dch_users,
COALESCE(pch_users,0) AS pch_users,
COALESCE(fach_users,0) AS fach_users,
COALESCE(ps_nonhs_users,0) AS ps_nonhs_users,
COALESCE(thp_hsdpa,0) AS thp_hsdpa,
COALESCE(thp_hsupa,0) AS thp_hsupa
	   ,COALESCE(vs_rrc_rej_sum,0) AS vs_rrc_rej_sum,
COALESCE(vs_rrc_failconnestab_cong,0) AS vs_rrc_failconnestab_cong, 
COALESCE(vs_rrc_rej_code_cong,0) AS vs_rrc_rej_code_cong,
COALESCE(vs_rrc_rej_rl_fail,0) AS vs_rrc_rej_rl_fail,
COALESCE(vs_rrc_rej_tnl_fail,0) AS vs_rrc_rej_tnl_fail,  
COALESCE(vs_rab_failestabcs_unsp,0) AS vs_rab_failestabcs_unsp, 
COALESCE(vs_rab_failestabcs_code_cong,0) AS vs_rab_failestabcs_code_cong,
COALESCE(vs_rab_failestabps_unsp,0) AS vs_rab_failestabps_unsp,
COALESCE(vs_rab_failestabps_code_cong,0) AS vs_rab_failestabps_code_cong,
COALESCE(vs_rrc_rej_redir_intrarat,0) AS vs_rrc_rej_redir_intrarat,
COALESCE(vs_rrc_rej_redir_interrat,0) AS vs_rrc_rej_redir_interrat, 
COALESCE(vs_rab_failestabcs_cong,0) AS vs_rab_failestabcs_cong,
COALESCE(vs_rab_failestabcs_rnl,0) AS vs_rab_failestabcs_rnl,
COALESCE(vs_rab_failestabcs_tnl,0) AS vs_rab_failestabcs_tnl, 
COALESCE(vs_rab_failestabps_rnl,0) AS vs_rab_failestabps_rnl,
COALESCE(vs_rab_failestabps_tnl,0) AS vs_rab_failestabps_tnl,
COALESCE(vs_rrc_failconnestab_noreply,0) AS vs_rrc_failconnestab_noreply, 
COALESCE(vs_rrc_rej_ulce_cong,0) AS vs_rrc_rej_ulce_cong,
COALESCE(vs_rrc_rej_dlce_cong,0) AS vs_rrc_rej_dlce_cong,
COALESCE(vs_rab_failestabcs_ulce_cong,0) AS vs_rab_failestabcs_ulce_cong, 
COALESCE(vs_rab_failestabcs_dlce_cong,0) AS vs_rab_failestabcs_dlce_cong,
COALESCE(vs_rab_failestabps_ulce_cong,0) AS vs_rab_failestabps_ulce_cong,
COALESCE(vs_rab_failestabps_dlce_cong,0) AS vs_rab_failestabps_dlce_cong, 
COALESCE(vs_rrc_rej_uliubband_cong,0) AS vs_rrc_rej_uliubband_cong,
COALESCE(vs_rrc_rej_dliubband_cong,0) AS vs_rrc_rej_dliubband_cong,
COALESCE(vs_rab_failestabcs_dliubband_cong,0) AS vs_rab_failestabcs_dliubband_cong, 
COALESCE(vs_rab_failestabcs_uliubband_cong,0) AS vs_rab_failestabcs_uliubband_cong,
COALESCE(vs_rab_failestabps_dliubband_cong,0) AS vs_rab_failestabps_dliubband_cong, 
COALESCE(vs_rab_failestabps_uliubband_cong,0) AS vs_rab_failestabps_uliubband_cong,
COALESCE(vs_rab_failestabcs_rbinccfg,0) AS vs_rab_failestabcs_rbinccfg, 
COALESCE(vs_rab_failestabcs_rbcfgunsup,0) AS vs_rab_failestabcs_rbcfgunsup,
COALESCE(vs_rab_failestabcs_phychfail,0) AS vs_rab_failestabcs_phychfail, 
COALESCE(vs_rab_failestabcs_uunoreply,0) AS vs_rab_failestabcs_uunoreply,
COALESCE(vs_rab_failestabps_rbinccfg,0) AS vs_rab_failestabps_rbinccfg,
COALESCE(vs_rab_failestabps_rbcfgunsupp,0) AS vs_rab_failestabps_rbcfgunsupp, 
COALESCE(vs_rab_failestabps_phychfail,0) AS vs_rab_failestabps_phychfail,
COALESCE(vs_rab_failestabps_uunoreply,0) AS vs_rab_failestabps_uunoreply,
COALESCE(vs_rrc_rej_ulpower_cong,0) AS vs_rrc_rej_ulpower_cong, 
COALESCE(vs_rrc_rej_dlpower_cong,0) AS vs_rrc_rej_dlpower_cong,
COALESCE(vs_rab_failestabcs_ulpower_cong,0) AS vs_rab_failestabcs_ulpower_cong,
COALESCE(vs_rab_failestabcs_dlpower_cong,0) AS vs_rab_failestabcs_dlpower_cong, 
COALESCE(vs_rab_failestabps_ulpower_cong,0) AS vs_rab_failestabps_ulpower_cong,
COALESCE(vs_rab_failestabps_dlpower_cong,0) AS vs_rab_failestabps_dlpower_cong, 
COALESCE(vs_rrc_rej_redir_service,0) AS vs_rrc_rej_redir_service,
COALESCE(vs_rab_failestabcs_iubfail,0) AS vs_rab_failestabcs_iubfail,
COALESCE(vs_rab_failestabcs_uufail,0) As vs_rab_failestabcs_uufail, 
COALESCE(vs_rab_failestabps_iubfail,0) as vs_rab_failestabps_iubfail,
COALESCE(vs_rab_failestabps_uufail,0) as vs_rab_failestabps_uufail,
COALESCE(vs_rab_failestabps_cong,0) as vs_rab_failestabps_cong, 
COALESCE(vs_rrc_rej_redir_dist,0) as vs_rrc_rej_redir_dist,
COALESCE(vs_rab_failestabps_srbreset,0) as vs_rab_failestabps_srbreset,
COALESCE(vs_rab_failestabps_cellupd,0) as vs_rab_failestabps_cellupd, 
COALESCE(vs_rab_failestabps_hsupauser_cong,0) as vs_rab_failestabps_hsupauser_cong,
COALESCE(vs_rab_failestabps_hsdpauser_cong,0) as vs_rab_failestabps_hsdpauser_cong, 
COALESCE(vs_rrc_rej_redir_dist_intrarat,0) as vs_rrc_rej_redir_dist_intrarat,
COALESCE(vs_rrc_rej_nodebresunavail,0) as vs_rrc_rej_nodebresunavail
			  FROM umts_kpi.vw_main_kpis_".$reportnetype."_rate_hourly m left join umts_kpi.fails_".$reportnetype." f on m.date=f.datetime and m.".$nodeid_main_kpis."=f.".$nodeid_fails." where m.".$period." between '".$inidate."' and '".$findate.$time."'
			AND m.".$nodeid_main_kpis." = '".$node."'
			ORDER BY m.date;"
		);
			
	return $query->result();
	}

	function custom_main_kpis($node,$findate,$timeagg,$reportnetype){
		$inidate = date('Y-m-d', strtotime($findate.' -7 day'));
		$period = 'date';
		$time = '';		
		$timeagg = 'daily';	
		
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$node = $cluster_info[0]->cluster_id;
	
		$query = $this->db->query(
		"select m.week,
 m.date as datetime, m.node, 
acc_rrc, 
fails_acc_rrc, 
eff_cs, 
fails_acc_cs, 
COALESCE(acc_cs,100) as acc_cs, 
COALESCE(eff_ps,0) as eff_ps, 
COALESCE(fails_acc_ps,0) as fails_acc_ps, 
COALESCE(acc_ps,100) AS acc_ps, 
COALESCE(eff_hsdpa,0) AS eff_hsdpa, 
COALESCE(fails_acc_hsdpa,0) AS fails_acc_hsdpa, 
COALESCE(eff_f2h,0) AS eff_f2h, 
COALESCE(fails_f2h,0) AS fails_f2h, 
COALESCE(acc_hsdpa,100) AS acc_hsdpa, 
COALESCE(acc_hsdpa_f2h,100) AS acc_hsdpa_f2h, 
COALESCE(drop_cs,100) AS drop_cs, 
COALESCE(fails_drop_cs,0) AS fails_drop_cs, 
COALESCE(drop_ps,100) AS drop_ps, 
COALESCE(fails_drop_ps,0) AS fails_drop_ps, 
COALESCE(drop_hsdpa,0) AS drop_hsdpa, 
COALESCE(fails_drop_hsdpa,0) AS fails_drop_hsdpa, 
COALESCE(drop_hsupa,0) AS drop_hsupa, 
COALESCE(fails_drop_hsupa,0) AS fails_drop_hsupa, 
COALESCE(sho_succ_rate,100) AS sho_succ_rate, 
COALESCE(soft_hand_succ_rate,100) AS soft_hand_succ_rate, 
COALESCE(hho_intra_freq_succ_rate,100) AS hho_intra_freq_succ_rate, 
COALESCE(cs_hho_intra_freq_rate,100) AS cs_hho_intra_freq_rate, 
COALESCE(ps_hho_intra_freq_succ_rate,100) AS ps_hho_intra_freq_succ_rate, 
COALESCE(hho_inter_freq_succ_rate,100) AS hho_inter_freq_succ_rate, 
COALESCE(iratho_cs_succ_rate,100) AS iratho_cs_succ_rate, 
COALESCE(iratho_ps_succ_rate,100) AS iratho_ps_succ_rate,
COALESCE(retention_cs_succ_rate,100) AS retention_cs_succ_rate,
COALESCE(retention_ps_succ_rate,100) AS retention_ps_succ_rate,
COALESCE(sho_over,0) AS sho_over,
COALESCE(rtwp,-98) AS rtwp,
COALESCE(availability,100) AS availability,
COALESCE(data_hsdpa,0) AS data_hsdpa,
COALESCE(data_hsupa,0) AS data_hsupa,
COALESCE(ps_r99_ul,0) AS ps_r99_ul,
COALESCE(ps_r99_dl,0) AS ps_r99_dl,
COALESCE(voice_traffic_dl,0) AS voice_traffic_dl,
COALESCE(voice_traffic_ul,0) AS voice_traffic_ul,
COALESCE(voice_erlangs_num,0) AS voice_erlangs_num,
COALESCE(voice_erlangs_den,0) AS voice_erlangs_den,
COALESCE(hsdpa_users,0) AS hsdpa_users,
COALESCE(hsupa_users,0) AS hsupa_users,
COALESCE(dch_users,0) AS dch_users,
COALESCE(pch_users,0) AS pch_users,
COALESCE(fach_users,0) AS fach_users,
COALESCE(ps_nonhs_users,0) AS ps_nonhs_users,
COALESCE(thp_hsdpa,0) AS thp_hsdpa,
COALESCE(thp_hsupa,0) AS thp_hsupa
	   ,COALESCE(vs_rrc_rej_sum,0) AS vs_rrc_rej_sum,
COALESCE(vs_rrc_failconnestab_cong,0) AS vs_rrc_failconnestab_cong, 
COALESCE(vs_rrc_rej_code_cong,0) AS vs_rrc_rej_code_cong,
COALESCE(vs_rrc_rej_rl_fail,0) AS vs_rrc_rej_rl_fail,
COALESCE(vs_rrc_rej_tnl_fail,0) AS vs_rrc_rej_tnl_fail,  
COALESCE(vs_rab_failestabcs_unsp,0) AS vs_rab_failestabcs_unsp, 
COALESCE(vs_rab_failestabcs_code_cong,0) AS vs_rab_failestabcs_code_cong,
COALESCE(vs_rab_failestabps_unsp,0) AS vs_rab_failestabps_unsp,
COALESCE(vs_rab_failestabps_code_cong,0) AS vs_rab_failestabps_code_cong,
COALESCE(vs_rrc_rej_redir_intrarat,0) AS vs_rrc_rej_redir_intrarat,
COALESCE(vs_rrc_rej_redir_interrat,0) AS vs_rrc_rej_redir_interrat, 
COALESCE(vs_rab_failestabcs_cong,0) AS vs_rab_failestabcs_cong,
COALESCE(vs_rab_failestabcs_rnl,0) AS vs_rab_failestabcs_rnl,
COALESCE(vs_rab_failestabcs_tnl,0) AS vs_rab_failestabcs_tnl, 
COALESCE(vs_rab_failestabps_rnl,0) AS vs_rab_failestabps_rnl,
COALESCE(vs_rab_failestabps_tnl,0) AS vs_rab_failestabps_tnl,
COALESCE(vs_rrc_failconnestab_noreply,0) AS vs_rrc_failconnestab_noreply, 
COALESCE(vs_rrc_rej_ulce_cong,0) AS vs_rrc_rej_ulce_cong,
COALESCE(vs_rrc_rej_dlce_cong,0) AS vs_rrc_rej_dlce_cong,
COALESCE(vs_rab_failestabcs_ulce_cong,0) AS vs_rab_failestabcs_ulce_cong, 
COALESCE(vs_rab_failestabcs_dlce_cong,0) AS vs_rab_failestabcs_dlce_cong,
COALESCE(vs_rab_failestabps_ulce_cong,0) AS vs_rab_failestabps_ulce_cong,
COALESCE(vs_rab_failestabps_dlce_cong,0) AS vs_rab_failestabps_dlce_cong, 
COALESCE(vs_rrc_rej_uliubband_cong,0) AS vs_rrc_rej_uliubband_cong,
COALESCE(vs_rrc_rej_dliubband_cong,0) AS vs_rrc_rej_dliubband_cong,
COALESCE(vs_rab_failestabcs_dliubband_cong,0) AS vs_rab_failestabcs_dliubband_cong, 
COALESCE(vs_rab_failestabcs_uliubband_cong,0) AS vs_rab_failestabcs_uliubband_cong,
COALESCE(vs_rab_failestabps_dliubband_cong,0) AS vs_rab_failestabps_dliubband_cong, 
COALESCE(vs_rab_failestabps_uliubband_cong,0) AS vs_rab_failestabps_uliubband_cong,
COALESCE(vs_rab_failestabcs_rbinccfg,0) AS vs_rab_failestabcs_rbinccfg, 
COALESCE(vs_rab_failestabcs_rbcfgunsup,0) AS vs_rab_failestabcs_rbcfgunsup,
COALESCE(vs_rab_failestabcs_phychfail,0) AS vs_rab_failestabcs_phychfail, 
COALESCE(vs_rab_failestabcs_uunoreply,0) AS vs_rab_failestabcs_uunoreply,
COALESCE(vs_rab_failestabps_rbinccfg,0) AS vs_rab_failestabps_rbinccfg,
COALESCE(vs_rab_failestabps_rbcfgunsupp,0) AS vs_rab_failestabps_rbcfgunsupp, 
COALESCE(vs_rab_failestabps_phychfail,0) AS vs_rab_failestabps_phychfail,
COALESCE(vs_rab_failestabps_uunoreply,0) AS vs_rab_failestabps_uunoreply,
COALESCE(vs_rrc_rej_ulpower_cong,0) AS vs_rrc_rej_ulpower_cong, 
COALESCE(vs_rrc_rej_dlpower_cong,0) AS vs_rrc_rej_dlpower_cong,
COALESCE(vs_rab_failestabcs_ulpower_cong,0) AS vs_rab_failestabcs_ulpower_cong,
COALESCE(vs_rab_failestabcs_dlpower_cong,0) AS vs_rab_failestabcs_dlpower_cong, 
COALESCE(vs_rab_failestabps_ulpower_cong,0) AS vs_rab_failestabps_ulpower_cong,
COALESCE(vs_rab_failestabps_dlpower_cong,0) AS vs_rab_failestabps_dlpower_cong, 
COALESCE(vs_rrc_rej_redir_service,0) AS vs_rrc_rej_redir_service,
COALESCE(vs_rab_failestabcs_iubfail,0) AS vs_rab_failestabcs_iubfail,
COALESCE(vs_rab_failestabcs_uufail,0) As vs_rab_failestabcs_uufail, 
COALESCE(vs_rab_failestabps_iubfail,0) as vs_rab_failestabps_iubfail,
COALESCE(vs_rab_failestabps_uufail,0) as vs_rab_failestabps_uufail,
COALESCE(vs_rab_failestabps_cong,0) as vs_rab_failestabps_cong, 
COALESCE(vs_rrc_rej_redir_dist,0) as vs_rrc_rej_redir_dist,
COALESCE(vs_rab_failestabps_srbreset,0) as vs_rab_failestabps_srbreset,
COALESCE(vs_rab_failestabps_cellupd,0) as vs_rab_failestabps_cellupd, 
COALESCE(vs_rab_failestabps_hsupauser_cong,0) as vs_rab_failestabps_hsupauser_cong,
COALESCE(vs_rab_failestabps_hsdpauser_cong,0) as vs_rab_failestabps_hsdpauser_cong, 
COALESCE(vs_rrc_rej_redir_dist_intrarat,0) as vs_rrc_rej_redir_dist_intrarat,
COALESCE(vs_rrc_rej_nodebresunavail,0) as vs_rrc_rej_nodebresunavail
			  FROM umts_kpi.vw_main_kpis_cluster_rate_hourly m left join umts_kpi.fails_cluster f 
			  on m.date=f.datetime and m.cluster_id = f.cluster_id 
			  where m.".$period." between '".$inidate."' and '".$findate.$time."'
			 and m.cluster_id = ".$node."
			ORDER BY m.date;"
		);
			
	return $query->result();
	}
	
	function cell_main_kpis($node,$findate,$timeagg,$reportnetype){
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
		$this->load->model('model_worstcells');
		$cell_array = $this->model_worstcells->find_cellid($node);
		$cellid = $cell_array[0]->cellid;
		$rnc = $cell_array[0]->rncname;
	
		$query = $this->db->query(
		"select m.week,
 m.date as datetime, m.node, 
acc_rrc, 
fails_acc_rrc, 
eff_cs, 
fails_acc_cs, 
COALESCE(acc_cs,100) as acc_cs, 
COALESCE(eff_ps,0) as eff_ps, 
COALESCE(fails_acc_ps,0) as fails_acc_ps, 
COALESCE(acc_ps,100) AS acc_ps, 
COALESCE(eff_hsdpa,0) AS eff_hsdpa, 
COALESCE(fails_acc_hsdpa,0) AS fails_acc_hsdpa, 
COALESCE(eff_f2h,0) AS eff_f2h, 
COALESCE(fails_f2h,0) AS fails_f2h, 
COALESCE(acc_hsdpa,100) AS acc_hsdpa, 
COALESCE(acc_hsdpa_f2h,100) AS acc_hsdpa_f2h, 
COALESCE(drop_cs,100) AS drop_cs, 
COALESCE(fails_drop_cs,0) AS fails_drop_cs, 
COALESCE(drop_ps,100) AS drop_ps, 
COALESCE(fails_drop_ps,0) AS fails_drop_ps, 
COALESCE(drop_hsdpa,0) AS drop_hsdpa, 
COALESCE(fails_drop_hsdpa,0) AS fails_drop_hsdpa, 
COALESCE(drop_hsupa,0) AS drop_hsupa, 
COALESCE(fails_drop_hsupa,0) AS fails_drop_hsupa, 
COALESCE(sho_succ_rate,100) AS sho_succ_rate, 
COALESCE(soft_hand_succ_rate,100) AS soft_hand_succ_rate, 
COALESCE(hho_intra_freq_succ_rate,100) AS hho_intra_freq_succ_rate, 
COALESCE(cs_hho_intra_freq_rate,100) AS cs_hho_intra_freq_rate, 
COALESCE(ps_hho_intra_freq_succ_rate,100) AS ps_hho_intra_freq_succ_rate, 
COALESCE(hho_inter_freq_succ_rate,100) AS hho_inter_freq_succ_rate, 
COALESCE(iratho_cs_succ_rate,100) AS iratho_cs_succ_rate, 
COALESCE(iratho_ps_succ_rate,100) AS iratho_ps_succ_rate,
COALESCE(retention_cs_succ_rate,100) AS retention_cs_succ_rate,
COALESCE(retention_ps_succ_rate,100) AS retention_ps_succ_rate,
COALESCE(sho_over,0) AS sho_over,
COALESCE(rtwp,-98) AS rtwp,
COALESCE(availability,100) AS availability,
COALESCE(data_hsdpa,0) AS data_hsdpa,
COALESCE(data_hsupa,0) AS data_hsupa,
COALESCE(ps_r99_ul,0) AS ps_r99_ul,
COALESCE(ps_r99_dl,0) AS ps_r99_dl,
COALESCE(voice_traffic_dl,0) AS voice_traffic_dl,
COALESCE(voice_traffic_ul,0) AS voice_traffic_ul,
COALESCE(voice_erlangs_num,0) AS voice_erlangs_num,
COALESCE(voice_erlangs_den,0) AS voice_erlangs_den,
COALESCE(hsdpa_users,0) AS hsdpa_users,
COALESCE(hsupa_users,0) AS hsupa_users,
COALESCE(dch_users,0) AS dch_users,
COALESCE(pch_users,0) AS pch_users,
COALESCE(fach_users,0) AS fach_users,
COALESCE(ps_nonhs_users,0) AS ps_nonhs_users,
COALESCE(thp_hsdpa,0) AS thp_hsdpa,
COALESCE(thp_hsupa,0) AS thp_hsupa
	   ,COALESCE(vs_rrc_rej_sum,0) AS vs_rrc_rej_sum,
COALESCE(vs_rrc_failconnestab_cong,0) AS vs_rrc_failconnestab_cong, 
COALESCE(vs_rrc_rej_code_cong,0) AS vs_rrc_rej_code_cong,
COALESCE(vs_rrc_rej_rl_fail,0) AS vs_rrc_rej_rl_fail,
COALESCE(vs_rrc_rej_tnl_fail,0) AS vs_rrc_rej_tnl_fail,  
COALESCE(vs_rab_failestabcs_unsp,0) AS vs_rab_failestabcs_unsp, 
COALESCE(vs_rab_failestabcs_code_cong,0) AS vs_rab_failestabcs_code_cong,
COALESCE(vs_rab_failestabps_unsp,0) AS vs_rab_failestabps_unsp,
COALESCE(vs_rab_failestabps_code_cong,0) AS vs_rab_failestabps_code_cong,
COALESCE(vs_rrc_rej_redir_intrarat,0) AS vs_rrc_rej_redir_intrarat,
COALESCE(vs_rrc_rej_redir_interrat,0) AS vs_rrc_rej_redir_interrat, 
COALESCE(vs_rab_failestabcs_cong,0) AS vs_rab_failestabcs_cong,
COALESCE(vs_rab_failestabcs_rnl,0) AS vs_rab_failestabcs_rnl,
COALESCE(vs_rab_failestabcs_tnl,0) AS vs_rab_failestabcs_tnl, 
COALESCE(vs_rab_failestabps_rnl,0) AS vs_rab_failestabps_rnl,
COALESCE(vs_rab_failestabps_tnl,0) AS vs_rab_failestabps_tnl,
COALESCE(vs_rrc_failconnestab_noreply,0) AS vs_rrc_failconnestab_noreply, 
COALESCE(vs_rrc_rej_ulce_cong,0) AS vs_rrc_rej_ulce_cong,
COALESCE(vs_rrc_rej_dlce_cong,0) AS vs_rrc_rej_dlce_cong,
COALESCE(vs_rab_failestabcs_ulce_cong,0) AS vs_rab_failestabcs_ulce_cong, 
COALESCE(vs_rab_failestabcs_dlce_cong,0) AS vs_rab_failestabcs_dlce_cong,
COALESCE(vs_rab_failestabps_ulce_cong,0) AS vs_rab_failestabps_ulce_cong,
COALESCE(vs_rab_failestabps_dlce_cong,0) AS vs_rab_failestabps_dlce_cong, 
COALESCE(vs_rrc_rej_uliubband_cong,0) AS vs_rrc_rej_uliubband_cong,
COALESCE(vs_rrc_rej_dliubband_cong,0) AS vs_rrc_rej_dliubband_cong,
COALESCE(vs_rab_failestabcs_dliubband_cong,0) AS vs_rab_failestabcs_dliubband_cong, 
COALESCE(vs_rab_failestabcs_uliubband_cong,0) AS vs_rab_failestabcs_uliubband_cong,
COALESCE(vs_rab_failestabps_dliubband_cong,0) AS vs_rab_failestabps_dliubband_cong, 
COALESCE(vs_rab_failestabps_uliubband_cong,0) AS vs_rab_failestabps_uliubband_cong,
COALESCE(vs_rab_failestabcs_rbinccfg,0) AS vs_rab_failestabcs_rbinccfg, 
COALESCE(vs_rab_failestabcs_rbcfgunsup,0) AS vs_rab_failestabcs_rbcfgunsup,
COALESCE(vs_rab_failestabcs_phychfail,0) AS vs_rab_failestabcs_phychfail, 
COALESCE(vs_rab_failestabcs_uunoreply,0) AS vs_rab_failestabcs_uunoreply,
COALESCE(vs_rab_failestabps_rbinccfg,0) AS vs_rab_failestabps_rbinccfg,
COALESCE(vs_rab_failestabps_rbcfgunsupp,0) AS vs_rab_failestabps_rbcfgunsupp, 
COALESCE(vs_rab_failestabps_phychfail,0) AS vs_rab_failestabps_phychfail,
COALESCE(vs_rab_failestabps_uunoreply,0) AS vs_rab_failestabps_uunoreply,
COALESCE(vs_rrc_rej_ulpower_cong,0) AS vs_rrc_rej_ulpower_cong, 
COALESCE(vs_rrc_rej_dlpower_cong,0) AS vs_rrc_rej_dlpower_cong,
COALESCE(vs_rab_failestabcs_ulpower_cong,0) AS vs_rab_failestabcs_ulpower_cong,
COALESCE(vs_rab_failestabcs_dlpower_cong,0) AS vs_rab_failestabcs_dlpower_cong, 
COALESCE(vs_rab_failestabps_ulpower_cong,0) AS vs_rab_failestabps_ulpower_cong,
COALESCE(vs_rab_failestabps_dlpower_cong,0) AS vs_rab_failestabps_dlpower_cong, 
COALESCE(vs_rrc_rej_redir_service,0) AS vs_rrc_rej_redir_service,
COALESCE(vs_rab_failestabcs_iubfail,0) AS vs_rab_failestabcs_iubfail,
COALESCE(vs_rab_failestabcs_uufail,0) As vs_rab_failestabcs_uufail, 
COALESCE(vs_rab_failestabps_iubfail,0) as vs_rab_failestabps_iubfail,
COALESCE(vs_rab_failestabps_uufail,0) as vs_rab_failestabps_uufail,
COALESCE(vs_rab_failestabps_cong,0) as vs_rab_failestabps_cong, 
COALESCE(vs_rrc_rej_redir_dist,0) as vs_rrc_rej_redir_dist,
COALESCE(vs_rab_failestabps_srbreset,0) as vs_rab_failestabps_srbreset,
COALESCE(vs_rab_failestabps_cellupd,0) as vs_rab_failestabps_cellupd, 
COALESCE(vs_rab_failestabps_hsupauser_cong,0) as vs_rab_failestabps_hsupauser_cong,
COALESCE(vs_rab_failestabps_hsdpauser_cong,0) as vs_rab_failestabps_hsdpauser_cong, 
COALESCE(vs_rrc_rej_redir_dist_intrarat,0) as vs_rrc_rej_redir_dist_intrarat,
COALESCE(vs_rrc_rej_nodebresunavail,0) as vs_rrc_rej_nodebresunavail
			  FROM umts_kpi.vw_main_kpis_".$reportnetype."_rate_hourly m left join umts_kpi.fails_".$reportnetype." f 
			  on m.date=f.datetime and m.rnc = f.rnc and m.cellid = f.cellid
			  where m.".$period." between '".$inidate."' and '".$findate.$time."'
			 and m.rnc = '".$rnc."'
			and m.cellid = ".$cellid."
			ORDER BY m.date;"
		);
			
	return $query->result();
	}	
	
	function node_nqi($node,$findate,$timeagg,$reportnetype){
	if($timeagg == "weekly"){
		$inidate = date('Y-m-d', strtotime($findate.' -30 day'));
		$period = 'date';
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
		} elseif ($reportnetype == "cluster"){
		$nodeid_main_kpis = 'cluster_id';
		$nodeid_fails = 'cluster_id';	
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$node = $cluster_info[0]->cluster_id;			
		}
		elseif ($reportnetype == "rnc"){
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'rnc';
		}		else {
			$nodeid_main_kpis = 'node';
			$nodeid_fails = 'node';
		}	
  
		$query = $this->db->query(
		"SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, 
       qdr_ps, throughput, availability, retention_cs, retention_ps, 
       hsdpa_users_ratio, nqi_cs, nqi_ps, nqi_ps_f2h
		FROM umts_kpi.vw_nqi_daily_".$reportnetype." where ".$period." between '".$inidate."' and '".$findate."'
		AND date_part('year'::text, date - '2 days'::interval) = 2016
			AND ".$nodeid_main_kpis." = '".$node."'
			ORDER BY date;"
		);
			
	return $query->result();
	}		
	
// function rnc_accessibility($rnc_query,$inidate,$findate){
		// $inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		// $query = $this->db->query(
		// "select vw_accessibility_rnc_rate.rnc, vw_accessibility_rnc_rate.datetime, 
			// acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
			// fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h,
			// vs_rrc_rej_code_cong,vs_rrc_rej_dlce_cong,vs_rrc_rej_dliubband_cong,vs_rrc_rej_dlpower_cong,vs_rrc_rej_nodebresunavail,
			// vs_rrc_rej_redir_dist,vs_rrc_rej_redir_dist_intrarat,vs_rrc_rej_redir_interrat,vs_rrc_rej_redir_intrarat,vs_rrc_rej_redir_service,
			// vs_rrc_rej_rl_fail,vs_rrc_rej_sum,vs_rrc_rej_tnl_fail,vs_rrc_rej_ulce_cong,vs_rrc_rej_uliubband_cong,vs_rrc_rej_ulpower_cong,vs_rrc_failconnestab_noreply,vs_rrc_failconnestab_cong,
			// vs_rab_failestabcs_code_cong,vs_rab_failestabcs_cong,vs_rab_failestabcs_dlce_cong,vs_rab_failestabcs_dliubband_cong,vs_rab_failestabcs_dlpower_cong,vs_rab_failestabcs_iubfail,
			// vs_rab_failestabcs_phychfail,vs_rab_failestabcs_rbcfgunsup,vs_rab_failestabcs_rbinccfg,vs_rab_failestabcs_rnl,vs_rab_failestabcs_tnl,vs_rab_failestabcs_ulce_cong,
			// vs_rab_failestabcs_uliubband_cong,vs_rab_failestabcs_ulpower_cong,vs_rab_failestabcs_unsp,vs_rab_failestabcs_uufail,vs_rab_failestabcs_uunoreply,vs_rab_failestabps_cellupd,
			// vs_rab_failestabps_code_cong,vs_rab_failestabps_cong,vs_rab_failestabps_dlce_cong,vs_rab_failestabps_dliubband_cong,vs_rab_failestabps_dlpower_cong,vs_rab_failestabps_hsdpauser_cong,
			// vs_rab_failestabps_hsupauser_cong,vs_rab_failestabps_iubfail,vs_rab_failestabps_phychfail,vs_rab_failestabps_rbcfgunsupp,vs_rab_failestabps_rbinccfg,vs_rab_failestabps_rnl,
			// vs_rab_failestabps_srbreset,vs_rab_failestabps_tnl,vs_rab_failestabps_ulce_cong,vs_rab_failestabps_uliubband_cong,vs_rab_failestabps_ulpower_cong,vs_rab_failestabps_unsp,
			// vs_rab_failestabps_uufail,vs_rab_failestabps_uunoreply			
	
			  // FROM umts_kpi.vw_accessibility_rnc_rate,umts_kpi.accessibility_fails_rnc
			// WHERE vw_accessibility_rnc_rate.rnc = umts_kpi.accessibility_fails_rnc.rnc
			// AND vw_accessibility_rnc_rate.datetime = umts_kpi.accessibility_fails_rnc.datetime
			// and vw_accessibility_rnc_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			// AND vw_accessibility_rnc_rate.rnc = '".$rnc_query."'
			// ORDER BY datetime;"
		// );
			
	// return $query->result();
	// }

function rnc_retainability($rnc_query,$inidate,$findate){
	$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_retainability_rnc_rate
			WHERE vw_retainability_rnc_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_retainability_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function cell_retainability($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_retainability_rate
			WHERE vw_retainability_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_retainability_rate.rnc = '".$rnc_query."'
			AND vw_retainability_rate.cellid = '".$cellid_query."'			
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function rnc_mobility($rnc_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_mobility_rnc_rate
			WHERE vw_mobility_rnc_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_mobility_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
function cell_mobility($rnc_query,$cellid_query,$inidate,$findate){
	$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_mobility_rate
			WHERE vw_mobility_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_mobility_rate.rnc = '".$rnc_query."'
			AND vw_mobility_rate.cellid = '".$cellid_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function rnc_coverage($rnc_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_coverage_rnc_rate
			WHERE vw_coverage_rnc_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_coverage_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function cell_coverage($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"select * FROM umts_kpi.coverage
			WHERE umts_kpi.coverage.datetime between '".$inidate."' and '".$findate."'
			AND umts_kpi.coverage.rnc = '".$rnc_query."'
			AND umts_kpi.coverage.cellid = '".$cellid_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	


function rnc_service_integrity($rnc_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"SELECT * FROM umts_kpi.service_integrity_rnc 
		WHERE service_integrity_rnc.datetime between '".$inidate."' and '".$findate."'
		AND service_integrity_rnc.rnc = '".$rnc_query."'
		order by datetime"
		);
			
	return $query->result();
	}

function cell_service_integrity($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"SELECT * FROM umts_kpi.service_integrity
		WHERE service_integrity.datetime between '".$inidate."' and '".$findate."'
		AND service_integrity.rnc = '".$rnc_query."'
		AND service_integrity.cellid = '".$cellid_query."'		
		order by datetime"
		);
			
	return $query->result();
	}		
	
function rnc_availability($rnc_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));	
		$query = $this->db->query(
		"select * FROM umts_kpi.vw_availability_rnc_rate
			WHERE vw_availability_rnc_rate.datetime between '".$inidate."' and '".$findate."'
			AND vw_availability_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}	
	
function cell_availability($rnc_query,$cellid_query,$inidate,$findate){
		$inidate = date('Y-m-d', strtotime($inidate.' -7 day'));
		$query = $this->db->query(
		"SELECT rnc, cellname, cellid, datetime, gp, 100 - unavailability AS availability, unavailtime
  FROM umts_kpi.availability
			WHERE availability.datetime between '".$inidate."' and '".$findate."'
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
		"SELECT week, date, region, rnc as node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, 
       qdr_ps, throughput, availability, retention_cs, retention_ps, 
       hsdpa_users_ratio, nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_rnc
  WHERE umts_kpi.vw_nqi_daily_rnc.date between '".$inidate."' and '".$findate."'
  AND umts_kpi.vw_nqi_daily_rnc.rnc = '".$rnc_query."'
  ORDER BY date"
		);
			
	return $query->result();
	}

function region_weekly_nqi($node_query,$iniweek,$finweek){
	$iniweek = $finweek - 4;
		$query = $this->db->query(
		"SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_region
  WHERE umts_kpi.vw_nqi_daily_region.week between ".$iniweek." and ".$finweek."
  AND umts_kpi.vw_nqi_daily_region.node = '".$node_query."'
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
}