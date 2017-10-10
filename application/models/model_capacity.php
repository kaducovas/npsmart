<?php 

class Model_capacity extends CI_Model{
	function cells(){
		$query = $this->db->query(
		"select * from umts_control.cells order by rnc,cellname;");

	return $query->result();
	}
	
	// function rnc_capacity_histogram($weeknum,$node){
			 // $query = $this->db->query(
			 // "SELECT week, regional, rnc as node, range, dlpower_count, code_count, fach_count, 
       // rach_count, dlce_count, ulce_count,pch_count,cnbap_count, vs_rrc_rej_dlpower_cong, 
       // vs_rab_failestabcs_dlpower_cong, vs_rab_failestabps_dlpower_cong, 
       // vs_rrc_rej_code_cong, vs_rab_failestabcs_code_cong, vs_rab_failestabps_code_cong, 
       // vs_fach_ccch_cong_time, vs_fach_dcch_cong_time, vs_fach_dtch_cong_time, 
       // vs_rrc_rej_dlce_cong, vs_rab_failestabcs_dlce_cong, vs_rab_failestabps_dlce_cong, 
       // vs_rrc_rej_ulce_cong, vs_rab_failestabcs_ulce_cong, vs_rab_failestabps_ulce_cong,vs_rrc_paging1_loss_pchcong_cell,vs_rrc_rej_rl_fail
  // FROM umts_capacity.vw_rnc_weekly_histogram
// where week = '".$weeknum."'
// and rnc = '".$node."'
// order by range asc
	// ;");

	// return $query->result();
	// }	

	function rnc_capacity_histogram($yearnum,$weeknum,$node){
			 $query = $this->db->query(
			 "select distinct * from umts_capacity.vw_rnc_weekly_utilization_histogram
where year = '".$yearnum."'
and week = '".$weeknum."'
and node = '".$node."'
order by range asc

	;");

	return $query->result();
	}	
	
	// function region_capacity_histogram($weeknum,$node){
			 // $query = $this->db->query(
			 // "SELECT week, regional as node, range, dlpower_count, code_count, fach_count, 
       // rach_count, dlce_count, ulce_count,pch_count,cnbap_count, vs_rrc_rej_dlpower_cong, 
       // vs_rab_failestabcs_dlpower_cong, vs_rab_failestabps_dlpower_cong, 
       // vs_rrc_rej_code_cong, vs_rab_failestabcs_code_cong, vs_rab_failestabps_code_cong, 
       // vs_fach_ccch_cong_time, vs_fach_dcch_cong_time, vs_fach_dtch_cong_time, 
       // vs_rrc_rej_dlce_cong, vs_rab_failestabcs_dlce_cong, vs_rab_failestabps_dlce_cong, 
       // vs_rrc_rej_ulce_cong, vs_rab_failestabcs_ulce_cong, vs_rab_failestabps_ulce_cong,vs_rrc_paging1_loss_pchcong_cell,vs_rrc_rej_rl_fail
  // FROM umts_capacity.vw_region_weekly_histogram
// where week = '".$weeknum."'
// and regional = '".$node."'
// order by range asc
	// ;");

	// return $query->result();
	// }	
	
		function region_capacity_histogram($yearnum,$weeknum,$node){
			 $query = $this->db->query(
			 "
			 select distinct * from umts_capacity.vw_region_weekly_utilization_histogram
where year = '".$yearnum."'
and week = '".$weeknum."'
and node = '".$node."'
order by range asc
	;");

	return $query->result();
	}	

	function network_capacity_histogram($yearnum,$weeknum){
			 $query = $this->db->query(
			 "select distinct * from umts_capacity.vw_network_weekly_utilization_histogram
where year = '".$yearnum."'
and week = '".$weeknum."'
order by range asc
	;");

	return $query->result();
	}
	
	// function network_capacity_histogram($weeknum){
			 // $query = $this->db->query(
			 // "select distinct * from umts_capacity.vw_network_weekly_histogram
// where week = '".$weeknum."'
// order by range asc
	// ;");

	// return $query->result();
	// }

	
// function rnc_capacity_dash($weeknum,$node){
			 // $query = $this->db->query(
			 // "SELECT vw_dlpower_range_rnc.week, vw_dlpower_range_rnc.rnc as node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 2 as ordem
  // FROM umts_capacity.vw_dlpower_range_rnc
  // join umts_capacity.vw_code_range_rnc on vw_dlpower_range_rnc.week = vw_code_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_code_range_rnc.rnc
  // join umts_capacity.vw_fach_range_rnc on vw_dlpower_range_rnc.week = vw_fach_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_fach_range_rnc.rnc  
  // join umts_capacity.vw_rach_range_rnc on vw_dlpower_range_rnc.week = vw_rach_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_rach_range_rnc.rnc  
    // join umts_capacity.vw_dlce_range_rnc on vw_dlpower_range_rnc.week = vw_dlce_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_dlce_range_rnc.rnc
    // join umts_capacity.vw_ulce_range_rnc on vw_dlpower_range_rnc.week = vw_ulce_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_ulce_range_rnc.rnc
      // join umts_capacity.vw_cnbap_range_rnc on vw_dlpower_range_rnc.week = vw_cnbap_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_cnbap_range_rnc.rnc
      // join umts_capacity.vw_pch_range_rnc on vw_dlpower_range_rnc.week = vw_pch_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_pch_range_rnc.rnc  
  // where vw_dlpower_range_rnc.week = '".$weeknum."'
  // and vw_dlpower_range_rnc.regional = 
  // CASE
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			// WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END   
// union

  // SELECT vw_dlpower_range_region.week, vw_dlpower_range_region.regional as node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 1 as ordem
  // FROM umts_capacity.vw_dlpower_range_region
  // join umts_capacity.vw_code_range_region on vw_dlpower_range_region.week = vw_code_range_region.week
  // and vw_dlpower_range_region.regional= vw_code_range_region.regional
  // join umts_capacity.vw_fach_range_region on vw_dlpower_range_region.week = vw_fach_range_region.week
  // and vw_dlpower_range_region.regional= vw_fach_range_region.regional 
  // join umts_capacity.vw_rach_range_region on vw_dlpower_range_region.week = vw_rach_range_region.week
  // and vw_dlpower_range_region.regional= vw_rach_range_region.regional  
    // join umts_capacity.vw_dlce_range_region on vw_dlpower_range_region.week = vw_dlce_range_region.week
  // and vw_dlpower_range_region.regional= vw_dlce_range_region.regional
    // join umts_capacity.vw_ulce_range_region on vw_dlpower_range_region.week = vw_ulce_range_region.week
  // and vw_dlpower_range_region.regional= vw_ulce_range_region.regional
     // join umts_capacity.vw_cnbap_range_region on vw_dlpower_range_region.week = vw_cnbap_range_region.week
  // and vw_dlpower_range_region.regional= vw_cnbap_range_region.regional
     // join umts_capacity.vw_pch_range_region on vw_dlpower_range_region.week = vw_pch_range_region.week
  // and vw_dlpower_range_region.regional= vw_pch_range_region.regional  
// where vw_dlpower_range_region.week = '".$weeknum."'
  // and vw_dlpower_range_region.regional =
  // CASE
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			// WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			// WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			// WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			// WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		// ELSE 'UNKNOWN'::text
		// END 
  // order by ordem,node
	// ;");

	// return $query->result();
	// }

function rnc_capacity_dash($yearnum,$weeknum,$node){
			 $query = $this->db->query(
			 "
			 select *,1 as ordem from umts_capacity.vw_region_weekly_utilization_range 
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 and region = 
			 case
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END  
			 union 
			 select *,2 as ordem from umts_capacity.vw_rnc_weekly_utilization_range
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 and region = 
			 case
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END   
	order by ordem,node
	;");

	return $query->result();
	}		
	
// function region_capacity_dash($weeknum,$node){
			 // $query = $this->db->query(
			 // "SELECT vw_dlpower_range_rnc.week, vw_dlpower_range_rnc.rnc as node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 2 as ordem
  // FROM umts_capacity.vw_dlpower_range_rnc
  // join umts_capacity.vw_code_range_rnc on vw_dlpower_range_rnc.week = vw_code_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_code_range_rnc.rnc
  // join umts_capacity.vw_fach_range_rnc on vw_dlpower_range_rnc.week = vw_fach_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_fach_range_rnc.rnc  
  // join umts_capacity.vw_rach_range_rnc on vw_dlpower_range_rnc.week = vw_rach_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_rach_range_rnc.rnc  
    // join umts_capacity.vw_dlce_range_rnc on vw_dlpower_range_rnc.week = vw_dlce_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_dlce_range_rnc.rnc
    // join umts_capacity.vw_ulce_range_rnc on vw_dlpower_range_rnc.week = vw_ulce_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_ulce_range_rnc.rnc
    // join umts_capacity.vw_cnbap_range_rnc on vw_dlpower_range_rnc.week = vw_cnbap_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_cnbap_range_rnc.rnc
    // join umts_capacity.vw_pch_range_rnc on vw_dlpower_range_rnc.week = vw_pch_range_rnc.week
  // and vw_dlpower_range_rnc.rnc= vw_pch_range_rnc.rnc  
  // where vw_dlpower_range_rnc.week = '".$weeknum."'
  // and vw_dlpower_range_rnc.regional = '".$node."'
// union

  // SELECT vw_dlpower_range_region.week, vw_dlpower_range_region.regional as node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 1 as ordem
  // FROM umts_capacity.vw_dlpower_range_region
  // join umts_capacity.vw_code_range_region on vw_dlpower_range_region.week = vw_code_range_region.week
  // and vw_dlpower_range_region.regional= vw_code_range_region.regional
  // join umts_capacity.vw_fach_range_region on vw_dlpower_range_region.week = vw_fach_range_region.week
  // and vw_dlpower_range_region.regional= vw_fach_range_region.regional 
  // join umts_capacity.vw_rach_range_region on vw_dlpower_range_region.week = vw_rach_range_region.week
  // and vw_dlpower_range_region.regional= vw_rach_range_region.regional  
    // join umts_capacity.vw_dlce_range_region on vw_dlpower_range_region.week = vw_dlce_range_region.week
  // and vw_dlpower_range_region.regional= vw_dlce_range_region.regional
    // join umts_capacity.vw_ulce_range_region on vw_dlpower_range_region.week = vw_ulce_range_region.week
  // and vw_dlpower_range_region.regional= vw_ulce_range_region.regional
   // join umts_capacity.vw_cnbap_range_region on vw_dlpower_range_region.week = vw_cnbap_range_region.week
  // and vw_dlpower_range_region.regional= vw_cnbap_range_region.regional
   // join umts_capacity.vw_pch_range_region on vw_dlpower_range_region.week = vw_pch_range_region.week
  // and vw_dlpower_range_region.regional= vw_pch_range_region.regional  
// where vw_dlpower_range_region.week = '".$weeknum."'
  // and vw_dlpower_range_region.regional = '".$node."'
  // order by ordem,node
	// ;");

	// return $query->result();
	// }

function region_capacity_dash($yearnum,$weeknum,$node){
			 $query = $this->db->query(
			 "select *,1 as ordem from umts_capacity.vw_region_weekly_utilization_range 
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 and node = '".$node."'
			 union 
			 select *,2 as ordem from umts_capacity.vw_rnc_weekly_utilization_range
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 and region = '".$node."'
			 order by ordem,node;");

	return $query->result();
	}
	
	function network_capacity_dash($yearnum,$weeknum){
		$query = $this->db->query(
			 "select *,1 as ordem from umts_capacity.vw_network_weekly_utilization_range 
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 union 
			 select *,2 as ordem from umts_capacity.vw_region_weekly_utilization_range
			 where year = '".$yearnum."'
			 and week = '".$weeknum."'
			 order by ordem,node
			 	 ;");

	return $query->result();
	}	
	// function network_capacity_dash($weeknum){
			 // $query = $this->db->query(
			 // "SELECT vw_dlpower_range_network.week, vw_dlpower_range_network.node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 1 as ordem
  // FROM umts_capacity.vw_dlpower_range_network
  // join umts_capacity.vw_code_range_network on vw_dlpower_range_network.week = vw_code_range_network.week
  // and vw_dlpower_range_network.node= vw_code_range_network.node
  // join umts_capacity.vw_fach_range_network on vw_dlpower_range_network.week = vw_fach_range_network.week
  // and vw_dlpower_range_network.node= vw_fach_range_network.node  
  // join umts_capacity.vw_rach_range_network on vw_dlpower_range_network.week = vw_rach_range_network.week
  // and vw_dlpower_range_network.node= vw_rach_range_network.node  
    // join umts_capacity.vw_dlce_range_network on vw_dlpower_range_network.week = vw_dlce_range_network.week
  // and vw_dlpower_range_network.node= vw_dlce_range_network.node
    // join umts_capacity.vw_ulce_range_network on vw_dlpower_range_network.week = vw_ulce_range_network.week
  // and vw_dlpower_range_network.node= vw_ulce_range_network.node
   // join umts_capacity.vw_cnbap_range_network on vw_dlpower_range_network.week = vw_cnbap_range_network.week
  // and vw_dlpower_range_network.node = vw_cnbap_range_network.node
     // join umts_capacity.vw_pch_range_network on vw_dlpower_range_network.week = vw_pch_range_network.week
  // and vw_dlpower_range_network.node = vw_pch_range_network.node
  // where vw_dlpower_range_network.week = '".$weeknum."'
// union

  // SELECT vw_dlpower_range_region.week, vw_dlpower_range_region.regional as node, 
// dlpowerrange1, dlpowerrange2, dlpowerrange3,
// coderange1, coderange2, coderange3,
// fachrange1, fachrange2, fachrange3,
// rachrange1, rachrange2, rachrange3,
// dlcerange1, dlcerange2, dlcerange3,
// ulcerange1, ulcerange2, ulcerange3,
// cnbaprange1, cnbaprange2, cnbaprange3,
// pchrange1, pchrange2, pchrange3,
// 2 as ordem
  // FROM umts_capacity.vw_dlpower_range_region
  // join umts_capacity.vw_code_range_region on vw_dlpower_range_region.week = vw_code_range_region.week
  // and vw_dlpower_range_region.regional= vw_code_range_region.regional
  // join umts_capacity.vw_fach_range_region on vw_dlpower_range_region.week = vw_fach_range_region.week
  // and vw_dlpower_range_region.regional= vw_fach_range_region.regional 
  // join umts_capacity.vw_rach_range_region on vw_dlpower_range_region.week = vw_rach_range_region.week
  // and vw_dlpower_range_region.regional= vw_rach_range_region.regional  
    // join umts_capacity.vw_dlce_range_region on vw_dlpower_range_region.week = vw_dlce_range_region.week
  // and vw_dlpower_range_region.regional= vw_dlce_range_region.regional
    // join umts_capacity.vw_ulce_range_region on vw_dlpower_range_region.week = vw_ulce_range_region.week
  // and vw_dlpower_range_region.regional= vw_ulce_range_region.regional
   // join umts_capacity.vw_cnbap_range_region on vw_dlpower_range_region.week = vw_cnbap_range_region.week
  // and vw_dlpower_range_region.regional= vw_cnbap_range_region.regional
   // join umts_capacity.vw_pch_range_region on vw_dlpower_range_region.week = vw_pch_range_region.week
  // and vw_dlpower_range_region.regional= vw_pch_range_region.regional  
// where vw_dlpower_range_region.week = '".$weeknum."'
  // order by ordem,node
	// ;");

	// return $query->result();
	// }	
	
  
	
	
################################################################################################################################################################################################################################	
////WEEKLY################################

	function region_weekly_report($weeknum){
			 $query = $this->db->query(
			 "SELECT *,1 as sortcol from umts_kpi.network_weekly_report where week = ".$weeknum."
	  UNION
			SELECT week, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
			   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
			   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
			   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
			   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
			   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
			   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
			   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa,2 as sortcol 
			   FROM umts_kpi.region_weekly_report 
			   where week = ".$weeknum."
			   order by sortcol,week, node
	;");

	return $query->result();
	}
	
	
	function rnc_weekly_report($node,$weeknum){
			$query = $this->db->query(
			"	
		SELECT week, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.rnc_weekly_report
	  where week = ".$weeknum." and region = '".$node."'
	union
	SELECT week, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.region_weekly_report
	  where week = ".$weeknum." and node = '".$node."'
	  order by week, node
	;");

		return $query->result();
		}
		
		
	function rnc_weekly_report_rncinput($node,$weeknum){
			$query = $this->db->query(
			"	
		SELECT week, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.rnc_weekly_report
	  where week = ".$weeknum." and 
	  region = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.region_weekly_report
	  where week = ".$weeknum." and 
	  node = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		order by week, node
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
			 "SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.network_daily_report 
  WHERE date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}	
	
	function region_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.region_daily_report
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}
	
	function region_daily_report_dash($reportdate){
			 $query = $this->db->query(
			 "SELECT *,1 as sortcol from umts_kpi.network_daily_report where date = '".$reportdate."'
	  UNION
			SELECT week, date,node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
			   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
			   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
			   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
			   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
			   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
			   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
			   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa,2 as sortcol 
			   FROM umts_kpi.region_daily_report 
			   where date = '".$reportdate."'
			   order by sortcol,date, node
	;");

	return $query->result();
	}
	
	function rnc_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
		   acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
		   soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
		   ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
		   iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
		   sho_over, rtwp, availability, hsdpa_data, hsupa_data, ps_r99_ul, 
		   ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
		   voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, 
		   thp_hsdpa, thp_hsupa
	  FROM umts_kpi.rnc_daily_report
	  where date = '".$reportdate."' and region = '".$node."'
	union
	SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.region_daily_report
	  where date = '".$reportdate."' and node = '".$node."'
	  order by date, node
	;");

		return $query->result();
		}
		
	function rnc_daily_report_rncinput_dash($node,$reportdate){
			$query = $this->db->query(
			"	
		SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.rnc_daily_report
	  where date = '".$reportdate."' and 
	  region = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.region_daily_report
	  where date = '".$reportdate."' and 
	  node = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		order by date, node
	;");

		return $query->result();
		}			
	
	function rnc_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select * from umts_kpi.rnc_daily_report
where date between '".$inidate."' and '".$findate."'
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
			 "SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, hsdpa_data, hsupa_data, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.network_hourly_report
  WHERE date::date between '".$inidate."' and '".$findate."' order by date
	;");		
		return $query->result();
	}

	function region_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.region_hourly_report
	where date::date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}	
	
	function rnc_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, datetime as date, region, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
       acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
       soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
       ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
       iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
       sho_over, rtwp, availability, hsdpa_data, hsupa_data, ps_r99_ul, 
       ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
       voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, 
       thp_hsdpa, thp_hsupa
  FROM umts_kpi.rnc_hourly_report
	where datetime::date between '".$inidate."' and '".$findate."' 
  and node = '".$node."'
  order by datetime,node
	;");	

	return $query->result();
	}
}
