<?php 

class Model_mainkpis_gsm extends CI_Model{
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
			 "SELECT *,'network'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_network_rate_monthly where month = ".$monthnum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM umts_kpi.vw_main_kpis_region_rate_monthly 
			   where month = ".$monthnum."
			   and node != 'UNKNOWN'
			   order by sortcol,month, node
	;");

	return $query->result();
	}

	function network_weekly_report($weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_network_rate_weekly where week = ".$weeknum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM gsm_kpi.vw_main_kpis_region_rate_weekly 
			   where week = ".$weeknum."
			   and node != 'UNKNOWN'
			   order by sortcol,week, node
	;");

	return $query->result();
	}
	
	function region_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_monthly
	  where month = ".$monthnum." and region = '".$node."'
	union
	SELECT month, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_region_rate_monthly
	  where month = ".$monthnum." and node = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}	
	
	function region_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"	
		SELECT week, node,'bsc'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_bsc_rate_weekly
	  where week = ".$weeknum." and region = '".$node."'
	union
	SELECT week, node,'region'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_region_rate_weekly
	  where week = ".$weeknum." and node = '".$node."'
	  order by week, node
	;");

		return $query->result();
		}
	
	function rnc_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_monthly
	  where month = ".$monthnum." and 
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
	SELECT month, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_region_rate_monthly
	  where month = ".$monthnum." and 
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
		order by month, node
	;");

		return $query->result();
		}	
		
	function bsc_weekly_report_bscinput($node,$weeknum){
		$weeknum = $weeknum;
			$query = $this->db->query(
			"	
		SELECT week, node,'bsc'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_bsc_rate_weekly
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
	SELECT week, node,'region'::text as type, acc_cs, round((retainability_cs)::numeric,2), availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_region_rate_weekly
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

	function uf_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$node."'
	union
	SELECT month, concat(node,' - ',uf) as node,'cidade'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_cidade_rate_monthly
	  where month = ".$monthnum." and uf = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}
		
	function cidade_monthly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$uf."'
	union
	SELECT month, concat(node,' - ',uf) as node,'cidade'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_cidade_rate_monthly
	  where month = ".$monthnum." and uf = '".$uf."'
	  order by month, node
	;");

		return $query->result();
		}

	function cluster_monthly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;	
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'uf'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_uf_rate_monthly
	  where month = ".$monthnum." and node = '".$uf."'
	union
	SELECT month, node,'cluster'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_cluster_rate_monthly
	  where month = ".$monthnum." and uf = '".$uf."'
	  order by month, node
	;");

		return $query->result();
		}

	function nodeb_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'nodeb'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_nodeb_rate_monthly
	  where month = ".$monthnum." 
	  and node = '".$node."'
	union
	SELECT month, node,'cell'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_cell_rate_monthly
	  where month = ".$monthnum." 
	  and nodebname = '".$node."'
	  order by month, node
	;");

		return $query->result();
		}

	function cell_monthly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$monthnum = $date->format("m");
			$query = $this->db->query(
			"	
		SELECT month, node,'nodeb'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_nodeb_rate_monthly
	  where month = ".$monthnum." 
	  and node = left('".$node."',8)
	union
	SELECT month, node,'cell'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_cell_rate_monthly
	  where month = ".$monthnum." 
	  and nodebname = left('".$node."',8)
	  order by month, node
	;");

		return $query->result();
		}		
		
function uf_weekly_report($node,$weeknum){
			 $query = $this->db->query(
			 "SELECT *,'uf'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_uf_rate_weekly where week = ".$weeknum." and node = '".$node."'
  order by sortcol,week, node
	;");

	return $query->result();
	}

function cidade_weekly_report($node,$weeknum){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$weeknum = $weeknum;
		$query = $this->db->query(
			 "SELECT *,'uf'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_uf_rate_weekly where week = ".$weeknum." and node = '".$uf."'
	  UNION
	  SELECT week, concat(node,' - ',uf) as node, acc_cs, retainability_cs, availability, 
       smp_5, smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,'cidade'::text as type,2 as sortcol 
  FROM gsm_kpi.vw_main_kpis_cidade_rate_weekly
  where week = ".$weeknum." and uf = '".$uf."'
  order by sortcol,week, node
	;");

	return $query->result();
	}

function cluster_weekly_report($node,$weeknum){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$weeknum = $weeknum;
		$query = $this->db->query(
			 "SELECT *,'uf'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_uf_rate_weekly where week = ".$weeknum." and node = '".$uf."'
	  UNION
	  SELECT week, node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
       acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, fails_acc_hsdpa, 
       eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h, drop_cs, fails_drop_cs, 
       drop_ps, fails_drop_ps, drop_hsdpa, fails_drop_hsdpa, drop_hsupa, 
       fails_drop_hsupa, sho_succ_rate, soft_hand_succ_rate, hho_intra_freq_succ_rate, 
       cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, 
       iratho_cs_succ_rate, iratho_ps_succ_rate, retention_cs_succ_rate, 
       retention_ps_succ_rate, sho_over, rtwp, availability, data_hsdpa, 
       data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, voice_traffic_ul, 
       voice_erlangs_num, voice_erlangs_den, hsdpa_users, hsupa_users, 
       ps_nonhs_users, dch_users, pch_users, fach_users, thp_hsdpa, 
       thp_hsupa,'cluster'::text as type,2 as sortcol 
  FROM umts_kpi.vw_main_kpis_cluster_rate_weekly
  where week = ".$weeknum." and uf = '".$uf."'
  order by sortcol,week, node
	;");

	return $query->result();
	}		
		
function bts_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'bts'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_bts_rate_weekly where week = ".$weeknum."
			 and node = '".$node."'
	  UNION
				SELECT week, region, bsc,node, acc_cs, round((retainability_cs::numeric),2), 
       availability, smp_5, smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, 
       tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,'cell'::text as type,2 as sortcol
	  FROM gsm_kpi.vw_main_kpis_cell_rate_weekly
			   where week = ".$weeknum."
			   and bts = '".$node."'
			   order by sortcol,week, node
	;");

	return $query->result();
	}

function cell_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'bts'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_bts_rate_weekly where week = ".$weeknum."
			 and node = CASE WHEN char_length('".$node."') > 8 THEN right(get_nodeb_name('".$node."', 'cell'::text), 7)
            ELSE get_nodeb_name('".$node."', 'cell'::text) END
	  UNION
				SELECT week, region, bts,node, acc_cs, round((retainability_cs::numeric),2), 
       availability, smp_5, smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, 
       tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,'cell'::text as type,2 as sortcol
	  FROM gsm_kpi.vw_main_kpis_cell_rate_weekly
			   where week = ".$weeknum."
			   and bts = CASE WHEN char_length('".$node."') > 8 THEN right(get_nodeb_name('".$node."', 'cell'::text), 7)
            ELSE get_nodeb_name('".$node."', 'cell'::text) END
			   order by sortcol,week, node
	;");

	return $query->result();
	}	

// function cidade_weekly_report($node,$weeknum){
		// $weeknum = $weeknum;
			// $query = $this->db->query(
			// "SELECT * FROM umts_kpi.cidade_weekly_report
	  // where week = ".$weeknum." 
	  // and node = '".$node."'
	  // order by week, node
	// ;");

		// return $query->result();
		// }	
		
	function network_weekly_report_graph($reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_network_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' order by week
	;");	

	return $query->result();
	}
	
	function uf_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_uf_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and node = '".$node."'
  order by week
	;");	

	return $query->result();
	}

	function cidade_weekly_report_graph($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$ibge = $cidade_info[0]->ibge;		
		
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, concat(node,' - ',uf) as node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cidade_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and ibge = '".$ibge."'
  order by week
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
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cluster_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and cluster_id = '".$cluster_id."'
  order by week
	;");	

	return $query->result();
	}

	function nodeb_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_nodeb_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and node = '".$node."'
  order by week
	;");	

	return $query->result();
	}

	function cell_weekly_report_graph($node,$reportdate){	
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cell_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and node = '".$node."'
  order by week
	;");	

	return $query->result();
	}	
	
	function region_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_region_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and node = '".$node."'
  order by week
	;");	

	return $query->result();
	}

	function rnc_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_rnc_rate_weekly 
  WHERE week between '".$strweek."' and '".$endweek."' 
  and node = '".$node."'
  order by week
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
			 "SELECT week, date, node, acc_cs, retainability_cs, availability, smp_5,
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_network_rate_daily 
  WHERE date between '".$inidate."' and '".$findate."'
  ORDER by date
	;");

	return $query->result();
	}

function network_commercial_hour_report($reportdate){
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
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.network_commercial_hour_report 
  WHERE date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}		
	
	function region_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_region_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}
	
	function uf_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_uf_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}

	function cidade_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$ibge = $cidade_info[0]->ibge;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "SELECT week, date, region, uf, ibge,  concat(node,' - ',uf) as node, acc_cs, retainability_cs, 
       availability, smp_5, smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, 
       tch_traffic_hr, smp_5_ericsson, smp_5_nokia, smp_5_siemens, smp_7_ericsson, 
       smp_7_nokia, smp_7_siemens, smp_8_ericsson, smp_8_nokia, smp_8_siemens, 
       smp_9_ericsson, smp_9_nokia, smp_9_siemens from gsm_kpi.vw_main_kpis_cidade_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and ibge = ".$ibge."
	order by date,node
	;");	


	return $query->result();
	}

	function cluster_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.vw_main_kpis_cluster_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and cluster_id = ".$cluster_id."
  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 	
	order by date,node
	;");	

	return $query->result();
	}	
	
	function bts_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_bts_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}	

	function cell_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_cell_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}
	
	function region_commercial_hour_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.region_commercial_hour_report
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}	
	
	function network_daily_report_dash($reportdate){
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from gsm_kpi.vw_main_kpis_network_rate_daily where date = '".$reportdate."'
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM gsm_kpi.vw_main_kpis_region_rate_daily 
			   where date = '".$reportdate."'
			   and node != 'UNKNOWN'
			   order by sortcol,date, node
	;");

	return $query->result();
	}
	
	function region_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'bsc'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_bsc_rate_daily
	  where date = '".$reportdate."' and region = '".$node."'
	union
	SELECT week, date, node,'region'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_region_rate_daily
	  where date = '".$reportdate."' and node = '".$node."'
	  order by date, node
	;");

		return $query->result();
		}
		
	function uf_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'uf'::text as type,1 as sortcol, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_uf_rate_daily
	  where date = '".$reportdate."' and node = '".$node."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}

	function cidade_daily_report_dash($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$uf = $cidade_info[0]->uf;
			$query = $this->db->query(
			"	
	SELECT week, date, node,'uf'::text as type,1 as sortcol, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_uf_rate_daily
	  where date = '".$reportdate."' and node = '".$uf."'
	union
	SELECT week, date, concat(node,' - ',uf) as node, 'cidade'::text as type,2 as sortcol, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_cidade_rate_daily
	  where date = '".$reportdate."' and uf = '".$uf."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}

	function cluster_daily_report_dash($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
			$query = $this->db->query(
			"	
	SELECT week, date, node,'uf'::text as type,1 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
		   acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
		   soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
		   ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
		   iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
		   sho_over, rtwp, availability, data_hsdpa, data_hsupa, ps_r99_ul, 
		   ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
		   voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
		   thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_uf_rate_daily
	  where date = '".$reportdate."' and node = '".$uf."'
	union
	SELECT week, date, node,'cluster'::text as type,2 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cluster_rate_daily
	  where date = '".$reportdate."' and uf = '".$uf."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}

	function user_cluster_daily_report_dash($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
			$query = $this->db->query(
			"	
	SELECT week, date, node,'cluster'::text as type,2 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cluster_rate_hourly
	  where date = '".$reportdate."' and cluster_id = '".$cluster_id."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}		
		
	function bts_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'bts'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,1 as sortcol
	  FROM gsm_kpi.vw_main_kpis_bts_rate_daily
	  where date = '".$reportdate."' and node = '".$node."'
	union
	SELECT week, date, node,'cell'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,2 as sortcol
  FROM gsm_kpi.vw_main_kpis_cell_rate_daily
	  where date = '".$reportdate."' and bts = '".$node."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}	

	function cell_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'nodeb'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,1 as sortcol
	  FROM gsm_kpi.vw_main_kpis_nodeb_rate_daily_2
	  where date = '".$reportdate."' and node = left('".$node."',8)
	union
	SELECT week, date, node,'cell'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens,2 as sortcol
  FROM gsm_kpi.vw_main_kpis_cell_rate_daily
	  where date = '".$reportdate."' and bts = CASE
            WHEN char_length('".$node."') > 8 THEN right(get_nodeb_name('".$node."', 'cell'::text), 7)
            ELSE get_nodeb_name('".$node."', 'cell'::text)
        END
	  order by date,sortcol, node
	;");

		return $query->result();
		}			
		
	function bsc_daily_report_bscinput_dash($node,$reportdate){
			$query = $this->db->query(
			"	
		SELECT week, date, node,'rnc'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_bsc_rate_daily
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
	SELECT week, date, node,'region'::text as type, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
	  FROM gsm_kpi.vw_main_kpis_region_rate_daily
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
	
	function bsc_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_bsc_rate_daily
where date between '".$inidate."' and '".$findate."'
and node = '".$node."'
order by date,node	
	;");	

	return $query->result();
	}
	
	function rnc_commercial_hour_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "select * from umts_kpi.rnc_commercial_hour_report
where date between '".$inidate."' and '".$findate."'
and node = '".$node."'
order by date,node	
	;");	

	return $query->result();
	}	

	// function cidade_daily_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		// $findate = date('Y-m-d', strtotime($daterange));
			 // $query = $this->db->query(
			 // "select * from umts_kpi.cidade_daily_report
// where date between '".$inidate."' and '".$findate."'
// and node = '".$node."'
// order by date,node	
	// ;");	

	// return $query->result();
	// }

	// function cidade_daily_report_dash($node,$reportdate){
			 // $query = $this->db->query(
			 // "select * from umts_kpi.cidade_daily_report
// where date = '".$reportdate."'
// and node = '".$node."'
// order by date,node	
	// ;");	

	// return $query->result();
	// }	

/////////////////////////////////////////////HOURLY	
	
function network_hourly_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_network_rate_hourly
  WHERE date::date between '".$inidate."' and '".$findate."'
  order by date
	;");		
		return $query->result();
	}

	function region_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_region_rate_hourly
	where date::date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}

	function uf_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from gsm_kpi.vw_main_kpis_uf_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}	

	function cidade_hourly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_gsm($node);
		$ibge = $cidade_info[0]->ibge;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "SELECT week, date, region, uf, ibge, concat(node,' - ',uf) as node, acc_cs, retainability_cs, 
       availability, smp_5, smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, 
       tch_traffic_hr, smp_5_ericsson, smp_5_nokia, smp_5_siemens, smp_7_ericsson, 
       smp_7_nokia, smp_7_siemens, smp_8_ericsson, smp_8_nokia, smp_8_siemens, 
       smp_9_ericsson, smp_9_nokia, smp_9_siemens from gsm_kpi.vw_main_kpis_cidade_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and ibge = '".$ibge."'
	order by date,node
	;");	

	return $query->result();
	}

	function cluster_hourly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.vw_main_kpis_cluster_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
	and cluster_id = '".$cluster_id."'
	order by date,node
	;");	

	return $query->result();
	}	
	
	function bsc_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -21 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_bsc_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
  and node = '".$node."'
  order by date,node
	;");	

	return $query->result();
	}
	
	function bts_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -20 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_bts_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
  and node = '".$node."'
  order by date,node
	;");	

	return $query->result();
	}	
	
	function cell_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -20 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_cs, retainability_cs, availability, smp_5, 
       smp_7, smp_8, smp_9, sdcch_traffic, tch_traffic_fr, tch_traffic_hr,smp_5_ericsson,smp_5_nokia,smp_5_siemens, 
       smp_7_ericsson,smp_7_nokia,smp_7_siemens, smp_8_ericsson,smp_8_nokia,smp_8_siemens, 
	   smp_9_ericsson,smp_9_nokia,smp_9_siemens
  FROM gsm_kpi.vw_main_kpis_cell_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00'
  and cellname = '".$node."'
  order by date,node
	;");	

	return $query->result();
	}	
	
		// function cidade_hourly_report($node,$reportdate){
		// $daterange = $reportdate;
		// $inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		// $findate = date('Y-m-d', strtotime($daterange));
			 // $query = $this->db->query(
			 // "SELECT week, datetime as date, region, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
       // acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
       // soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
       // ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
       // iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
       // sho_over, rtwp, availability, data_hsdpa, data_hsupa, ps_r99_ul, 
       // ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
       // voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
       // thp_hsdpa, thp_hsupa
  // FROM umts_kpi.cidade_hourly_report
// where datetime::date between '".$inidate."' and '".$findate."'
// and node = '".$node."'
// order by datetime,node	
	// ;");	

	// return $query->result();
	// }
}
