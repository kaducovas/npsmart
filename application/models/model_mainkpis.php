<?php 

class Model_mainkpis extends CI_Model{
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

	function region_weekly_report($weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_network_rate_weekly where week = ".$weeknum."
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM umts_kpi.vw_main_kpis_region_rate_weekly 
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
	
	function rnc_weekly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$endyear = $date->format("o");
			$query = $this->db->query(
			"	
		SELECT week, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_weekly
	    WHERE (year,week) = ('".$endyear."','".$endweek."')  
	  and region = '".$node."'
	union
	SELECT week, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_region_rate_weekly
	    WHERE (year,week) = ('".$endyear."','".$endweek."') 
	  and node = '".$node."'
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
		
	function rnc_weekly_report_rncinput($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$endyear = $date->format("o");
			$query = $this->db->query(
			"	
		SELECT week, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_weekly
	  WHERE (year,week) = ('".$endyear."','".$endweek."') 
	  and region = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
	union
	SELECT week, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_region_rate_weekly
	  	  WHERE (year,week) = ('".$endyear."','".$endweek."') 
	  and node = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
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
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
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
			 "SELECT *,'uf'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_uf_rate_weekly where week = ".$weeknum." and node = '".$node."'
	  UNION
	  SELECT year,week, concat(node,' - ',uf) as node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
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
       thp_hsupa,'cidade'::text as type,2 as sortcol 
  FROM umts_kpi.vw_main_kpis_cidade_rate_weekly
  where week = ".$weeknum." and uf = '".$node."'
  order by sortcol,week, node
	;");

	return $query->result();
	}

function cidade_weekly_report($node,$weeknum){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$weeknum = $weeknum;
		$query = $this->db->query(
			 "SELECT *,'uf'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_uf_rate_weekly where week = ".$weeknum." and node = '".$uf."'
	  UNION
	  SELECT year,week, concat(node,' - ',uf) as node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
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
       thp_hsupa,'cidade'::text as type,2 as sortcol 
  FROM umts_kpi.vw_main_kpis_cidade_rate_weekly
  where week = ".$weeknum." and uf = '".$uf."'
  order by sortcol,week, node
	;");

	return $query->result();
	}

function user_cluster_weekly_report_dash($node,$weeknum){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$weeknum = $weeknum;
		$query = $this->db->query(
			 "SELECT year,week, node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
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
       thp_hsupa,'custom'::text as type,1 as sortcol 
  FROM umts_kpi.vw_main_kpis_cluster_rate_weekly_2
  where week = ".$weeknum." and cluster_id = '".$cluster_id."'
  order by week,sortcol, node
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
	  SELECT year,week, node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
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
		
function nodeb_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'nodeb'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_nodeb_rate_weekly where week = ".$weeknum."
			 and node = '".$node."'
	  UNION
				SELECT week, region, rnc,node, acc_rrc, fails_acc_rrc, 
		   eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
		   fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, fails_drop_cs, drop_ps, fails_drop_ps, drop_hsdpa, fails_drop_hsdpa, 
		   drop_hsupa, fails_drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, dch_users, pch_users, fach_users, 
		   thp_hsdpa, thp_hsupa,'cell'::text as type,2 as sortcol
	  FROM umts_kpi.vw_main_kpis_cell_rate_weekly
			   where week = ".$weeknum."
			   and nodebname = '".$node."'
			   order by sortcol,week, node
	;");

	return $query->result();
	}

function cell_weekly_report($node,$weeknum){
		$weeknum = $weeknum;
			 $query = $this->db->query(
			 "SELECT *,'nodeb'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_nodeb_rate_weekly where week = ".$weeknum."
			 and node = left('".$node."',8)
	  UNION
				SELECT week, region, rnc,node, acc_rrc, fails_acc_rrc, 
		   eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
		   fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, fails_drop_cs, drop_ps, fails_drop_ps, drop_hsdpa, fails_drop_hsdpa, 
		   drop_hsupa, fails_drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users, ps_nonhs_users, dch_users, pch_users, fach_users, 
		   thp_hsdpa, thp_hsupa,'cell'::text as type,2 as sortcol
	  FROM umts_kpi.vw_main_kpis_cell_rate_weekly
			   where week = ".$weeknum."
			   and nodebname = left('".$node."',8)
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
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -270 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");
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
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and week not in (53)
  order by year,week
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
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_uf_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}

	function cidade_weekly_report_graph($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;		
		
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
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
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
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
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cluster_rate_weekly 
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
	;");	

	return $query->result();
	}

	function nodeb_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
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
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
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
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cell_rate_weekly 
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
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
			 "SELECT week as date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_region_rate_weekly 
  WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
  order by year,week
  
	;");	

	return $query->result();
	}

	function rnc_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear= $strdate->format("o");
		$endyear = $date->format("o");		
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
WHERE (year,week) between ('".$stryear."','".$strweek."') and ('".$endyear."','".$endweek."') 
  and node = '".$node."'
order by year,week
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
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_network_rate_daily 
  WHERE date between '".$inidate."' and '".$findate."'
  and date not in ('2017-03-03','2017-03-10')
  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
  order by date
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
			 "select * from umts_kpi.vw_main_kpis_region_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
	order by date,node
	;");	

	return $query->result();
	}
	
	function uf_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.vw_main_kpis_uf_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
	order by date,node
	;");	

	return $query->result();
	}

	function cidade_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select  week, date, uf, ibge, concat(node,' - ',uf) as node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
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
       thp_hsupa from umts_kpi.vw_main_kpis_cidade_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and ibge = ".$ibge."
	and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
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
			 "select * from umts_kpi.vw_main_kpis_cluster_rate_daily_2
	where date between '".$inidate."' and '".$findate."' 
	and cluster_id = ".$cluster_id."
  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 	
	order by date,node
	;");	

	return $query->result();
	}	
	
	function nodeb_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -60 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.vw_main_kpis_nodeb_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
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
			 "select * from umts_kpi.vw_main_kpis_cell_rate_daily
	where date between '".$inidate."' and '".$findate."' 
	and node = '".$node."'
	  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
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
	
	function region_daily_report_dash($reportdate){
			 $query = $this->db->query(
			 "SELECT *,'network'::text as type,1 as sortcol from umts_kpi.vw_main_kpis_network_rate_daily where date = '".$reportdate."'
	  UNION
			SELECT *,'region'::text as type,2 as sortcol 
			   FROM umts_kpi.vw_main_kpis_region_rate_daily 
			   where date = '".$reportdate."'
			   and node != 'UNKNOWN'
			   order by sortcol,date, node
	;");

	return $query->result();
	}
	
	function rnc_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
		   acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
		   soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
		   ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
		   iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
		   sho_over, rtwp, availability, data_hsdpa, data_hsupa, ps_r99_ul, 
		   ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
		   voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
		   thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_daily
	  where date = '".$reportdate."' and region = '".$node."'
	union
	SELECT week, date, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_region_rate_daily
	  where date = '".$reportdate."' and node = '".$node."'
	  order by date, node
	;");

		return $query->result();
		}
		
	function uf_daily_report_dash($node,$reportdate){
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
	  where date = '".$reportdate."' and node = '".$node."'
	union
	SELECT week, date, concat(node,' - ',uf) as node,'cidade'::text as type,2 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cidade_rate_daily
	  where date = '".$reportdate."' and uf = '".$node."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}

	function cidade_daily_report_dash($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$uf = $cidade_info[0]->uf;		
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
	SELECT week, date, concat(node,' - ',uf) as node,'cidade'::text as type,2 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cidade_rate_daily
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
	SELECT week, date, node,'custom'::text as type,2 as sortcol, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cluster_rate_hourly_2
	  where date = '".$reportdate."' and cluster_id = '".$cluster_id."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}		
		
	function nodeb_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'nodeb'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
		   acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
		   soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
		   ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
		   iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
		   sho_over, rtwp, availability, data_hsdpa, data_hsupa, ps_r99_ul, 
		   ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
		   voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
		   thp_hsdpa, thp_hsupa,1 as sortcol
	  FROM umts_kpi.vw_main_kpis_nodeb_rate_daily_2
	  where date = '".$reportdate."' and node = '".$node."'
	union
	SELECT week, date, node,'cell'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa,2 as sortcol
  FROM umts_kpi.vw_main_kpis_cell_rate_daily_2
	  where date = '".$reportdate."' and nodeb = '".$node."'
	  order by date,sortcol, node
	;");

		return $query->result();
		}	

	function cell_daily_report_dash($node,$reportdate){
			$query = $this->db->query(
			"	
	SELECT week, date, node,'nodeb'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
		   acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
		   soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
		   ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
		   iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
		   sho_over, rtwp, availability, data_hsdpa, data_hsupa, ps_r99_ul, 
		   ps_r99_dl, voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
		   voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
		   thp_hsdpa, thp_hsupa,1 as sortcol
	  FROM umts_kpi.vw_main_kpis_nodeb_rate_daily_2
	  where date = '".$reportdate."' and node = left('".$node."',8)
	union
	SELECT week, date, node,'cell'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, thp_hsdpa, thp_hsupa,2 as sortcol
  FROM umts_kpi.vw_main_kpis_cell_rate_daily_2
	  where date = '".$reportdate."' and nodeb = left('".$node."',8)
	  order by date,sortcol, node
	;");

		return $query->result();
		}			
		
	function rnc_daily_report_rncinput_dash($node,$reportdate){
			$query = $this->db->query(
			"	
		SELECT week, date, node,'rnc'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_rnc_rate_daily
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
	SELECT week, date, node,'region'::text as type, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
		   drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
		   hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
		   hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
		   retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
		   availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
		   voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
		   hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
	  FROM umts_kpi.vw_main_kpis_region_rate_daily
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
			 "select * from umts_kpi.vw_main_kpis_rnc_rate_daily
where date between '".$inidate."' and '".$findate."'
and node = '".$node."'
  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
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
			 "SELECT week, date, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, acc_hsdpa_f2h, 
       drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, soft_hand_succ_rate, 
       hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, 
       hho_inter_freq_succ_rate, iratho_cs_succ_rate, iratho_ps_succ_rate, 
       retention_cs_succ_rate, retention_ps_succ_rate, sho_over, rtwp, 
       availability, data_hsdpa, data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, 
       voice_traffic_ul, voice_erlangs_num, voice_erlangs_den, hsdpa_users, 
       hsupa_users,dch_users, pch_users,fach_users, ps_nonhs_users, thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_network_rate_hourly
  WHERE date::date between '".$inidate."' and '".$findate."'
  and rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
  order by date
	;");		
		return $query->result();
	}

	function region_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select * from umts_kpi.vw_main_kpis_region_rate_hourly
	where date::date between '".$inidate."' and '".$findate."' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  and iratho_cs_succ_rate > 0
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
			 "select * from umts_kpi.vw_main_kpis_uf_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
	and node = '".$node."'
	order by date,node
	;");	

	return $query->result();
	}	

	function cidade_hourly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -7 day'));
		$findate = date('Y-m-d', strtotime($daterange));	
			 $query = $this->db->query(
			 "select week, date, uf, ibge, concat(node,' - ',uf) as node, acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, 
       acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, fails_acc_hsdpa, 
       eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h, drop_cs, fails_drop_cs, 
       drop_ps, fails_drop_ps, drop_hsdpa, fails_drop_hsdpa, drop_hsupa, 
       fails_drop_hsupa, sho_succ_rate, soft_hand_succ_rate, hho_intra_freq_succ_rate, 
       cs_hho_intra_freq_rate, ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, 
       iratho_cs_succ_rate, iratho_ps_succ_rate, retention_cs_succ_rate, 
       retention_ps_succ_rate, sho_over, rtwp, availability, data_hsdpa, 
       data_hsupa, ps_r99_ul, ps_r99_dl, voice_traffic_dl, voice_traffic_ul, 
       voice_erlangs_num, voice_erlangs_den, hsdpa_users, hsupa_users, 
       dch_users, pch_users, fach_users, ps_nonhs_users, thp_hsdpa, 
       thp_hsupa from umts_kpi.vw_main_kpis_cidade_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
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
  	and date >= '2017-05-24'
	and cluster_id = '".$cluster_id."'
	order by date,node
	;");	

	return $query->result();
	}	
	
	function cluster_hourly_report_last($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;

			 $query = $this->db->query(
			 "select *,'cluster'::text as type from umts_kpi.vw_main_kpis_cluster_rate_hourly
  	where cluster_id = '".$cluster_id."'
	and date = '".$reportdate."'
	order by date,node
	;");	

	return $query->result();
	}	
	
	function rnc_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -15 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
       acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
       soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
       ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
       iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
       sho_over, rtwp, availability, 
	round((data_hsdpa / 1024::real)::numeric, 2) AS data_hsdpa,
    round((data_hsupa / 1024::real)::numeric, 2) AS data_hsupa,
    round((ps_r99_ul / (1024 * 1024)::real)::numeric, 2) AS ps_r99_ul,
    round((ps_r99_dl / (1024 * 1024)::real)::numeric, 2) AS ps_r99_dl,
	voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
       voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
       thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_rnc_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
  and node = '".$node."'
  order by date,node
	;");	

	return $query->result();
	}
	
	function nodeb_hourly_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -20 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
       acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
       soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
       ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
       iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
       sho_over, rtwp, availability, 
	round((data_hsdpa)::numeric, 2) AS data_hsdpa,
    round((data_hsupa)::numeric, 2) AS data_hsupa,
    round((ps_r99_ul / (1024)::real)::numeric, 2) AS ps_r99_ul,
    round((ps_r99_dl / (1024)::real)::numeric, 2) AS ps_r99_dl,
	voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
       voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
       thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_nodeb_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00' 
	and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0  
  and node = '".$node."'
  order by date,node
	;");	

	return $query->result();
	}	
	
	function cell_hourly_report($node,$reportdate){
	$this->load->model('model_worstcells');
		$cell_array = $this->model_worstcells->find_cellid($node);
		$cellid = $cell_array[0]->cellid;
		$rnc = $cell_array[0]->rncname;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -20 day'));
		$findate = date('Y-m-d', strtotime($daterange));
			 $query = $this->db->query(
			 "SELECT week, date, region, node, acc_rrc, acc_cs, acc_ps, acc_hsdpa, 
       acc_hsdpa_f2h, drop_cs, drop_ps, drop_hsdpa, drop_hsupa, sho_succ_rate, 
       soft_hand_succ_rate, hho_intra_freq_succ_rate, cs_hho_intra_freq_rate, 
       ps_hho_intra_freq_succ_rate, hho_inter_freq_succ_rate, iratho_cs_succ_rate, 
       iratho_ps_succ_rate, retention_cs_succ_rate, retention_ps_succ_rate, 
       sho_over, rtwp, availability, 
	round((data_hsdpa)::numeric, 2) AS data_hsdpa,
    round((data_hsupa)::numeric, 2) AS data_hsupa,
    round((ps_r99_ul / (1024)::real)::numeric, 2) AS ps_r99_ul,
    round((ps_r99_dl / (1024)::real)::numeric, 2) AS ps_r99_dl,
	voice_traffic_dl, voice_traffic_ul, voice_erlangs_num, 
       voice_erlangs_den, hsdpa_users, hsupa_users, ps_nonhs_users, dch_users, pch_users,fach_users, 
       thp_hsdpa, thp_hsupa
  FROM umts_kpi.vw_main_kpis_cell_rate_hourly
	where date between '".$inidate."' and '".$findate." 23:30:00'
and	rtwp < 0 and drop_ps > 0 and thp_hsupa > 0 
  and rnc = '".$rnc."'
  and cellid = ".$cellid."
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
and main_kpis_daily.date >='2017-04-18'
   
GROUP BY 	
	date_part('week'::text, main_kpis_daily.date::date + '1 day'::interval),
	main_kpis_daily.date
ORDER BY main_kpis_daily.date
	;");	
	return $query->result();
	}	
	
}
