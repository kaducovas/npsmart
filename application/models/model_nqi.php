<?php 

class Model_nqi extends CI_Model{
	// function cells(){
		// $query = $this->db->query(
		// "select * from umts_control.cells order by rnc,cellname;");

	// return $query->result();
	// }

	function nqi_monthly_network($reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (SELECT 1 as sortcol, node, 'network'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_network
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by node
		UNION
		SELECT 2 as sortcol, node, 'region'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_region
		where node not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}
	
	function nqi_weekly_network($reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		$query = $this->db->query(
		"
		select * from (SELECT 1 as sortcol, node, 'network'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_network
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by node
		UNION
		SELECT 2 as sortcol, node, 'region'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_region
		where node not in ('UNKNOWN')
		and  (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}

	function nqi_monthly_region($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");	
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (SELECT 2 as sortcol, node, 'rnc'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_rnc
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and region = '".$node."'
		group by node
		UNION
		SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_region
		where node not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = '".$node."'
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}
	
	function nqi_weekly_region($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		$query = $this->db->query(
		"
		select * from (SELECT 2 as sortcol, node, 'rnc'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_rnc
where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = '".$node."'
		group by node
		UNION
		SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_region
		where node not in ('UNKNOWN')
and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = '".$node."'
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}

	function nqi_monthly_rnc($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");		
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (SELECT 2 as sortcol, node, 'rnc'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_rnc
where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
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
		group by node
		UNION
		SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_region
		where node not in ('UNKNOWN')
and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
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
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}
	
	function nqi_weekly_rnc($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}			
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		$query = $this->db->query(
		"
		select * from (SELECT 2 as sortcol, node, 'rnc'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_rnc
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by node
		UNION
		SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_region
		where node not in ('UNKNOWN')
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = 
		CASE
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN substring('".$node."', 4, 2) = 'BA'::text THEN 'BASE'::text
			WHEN substring('".$node."', 4, 2) = 'MG'::text THEN 'MG'::text
			WHEN substring('".$node."', 4, 2) = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN substring('".$node."', 4, 2) = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}		

	function nqi_monthly_uf($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}				
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (select * from (SELECT 1 as sortcol, node, 'uf'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_uf
where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = '".$node."'
		group by node
		UNION
		SELECT 2 as sortcol, concat(node,' - ',uf) as node, 'cidade'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_cidade_2
		where node not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and uf = '".$node."'
		group by node,uf) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}	
	
	function nqi_weekly_uf($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}				
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		$query = $this->db->query(
		"
		select * from (SELECT 1 as sortcol, node, 'uf'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_uf
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = '".$node."'
		group by node
		UNION
		SELECT 2 as sortcol, concat(node,' - ',uf) as node, 'cidade'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_cidade_2
		where node not in ('UNKNOWN')
		and uf = '".$node."'
	and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and year in (2016,2017)
		group by node,uf) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real
;");

	return $query->result();
	}

	function nqi_monthly_cidade($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}		
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;		
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");		
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (SELECT 1 as sortcol, node, 'uf'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_uf
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = '".$uf."'
		group by node
		UNION
		SELECT 2 as sortcol, concat(node,' - ',uf) as node, 'cidade'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_cidade_2
		where node not in ('UNKNOWN')
and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and uf = '".$uf."'
		group by node,uf) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real 
;");

	return $query->result();
	}	
	
function nqi_weekly_cidade($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}	
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		
		$query = $this->db->query(
			"
			select * from (SELECT 1 as sortcol, node, 'uf'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_uf_2
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = '".$uf."'
		group by node
		UNION
		SELECT 2 as sortcol, concat(node,' - ',uf) as node, 'cidade'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_cidade_2
		where node not in ('UNKNOWN')
		and uf = '".$uf."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by node, uf) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real 
	;");

		return $query->result();
		}

	function nqi_monthly_cluster($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}
		
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;		
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");		
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		select * from (SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_region
where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = 
		CASE
			WHEN '".$uf."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN '".$uf."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$uf."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$uf."' = 'MG'::text THEN 'MG'::text
			WHEN '".$uf."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$uf."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cluster'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_cluster_2
		where node not in ('UNKNOWN')
and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and user_created = false
		and region = 
		CASE
			WHEN '".$uf."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN '".$uf."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$uf."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$uf."' = 'MG'::text THEN 'MG'::text
			WHEN '".$uf."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$uf."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 		
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real 
;");

	return $query->result();
	}
		
function nqi_weekly_cluster($node,$reportdate,$nekpi){
		if($nekpi == 'nqihs'){
			$order = 'nqi_ps_f2h';
		} elseif ($nekpi == 'nqics'){
			$order = 'nqi_cs';
		}	
	
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		$query = $this->db->query(
			"
			select * from (SELECT 1 as sortcol, node, 'region'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_region
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and year in (2016,2017)
		and node = 
		CASE
			WHEN '".$uf."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN '".$uf."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$uf."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$uf."' = 'MG'::text THEN 'MG'::text
			WHEN '".$uf."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$uf."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cluster'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_cluster_2
		where node not in ('UNKNOWN')
		and user_created = false
		and region = 
		CASE
			WHEN '".$uf."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text]) THEN 'CO'::text
			WHEN '".$uf."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$uf."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$uf."' = 'MG'::text THEN 'MG'::text
			WHEN '".$uf."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$uf."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 		
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and year in (2016,2017)
		group by node) t
		order by sortcol,
		(regexp_split_to_array(".$order."::TEXT, E','))[4]::real 
	;");

		return $query->result();
		}

	function nqi_monthly_nodeb($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");	
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		SELECT 1 as sortcol, node, 'nodeb'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_nodeb
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = '".$node."'
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cell'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_cell
		where node not in ('UNKNOWN')
and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and nodeb = '".$node."'
		group by node
		order by sortcol,node
;");

	return $query->result();
	}		
		
function nqi_weekly_nodeb($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		
		$query = $this->db->query(
			"
			SELECT 1 as sortcol, node, 'nodeb'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_nodeb
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = '".$node."'
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cell'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_cell
		where node not in ('UNKNOWN')
		and nodeb = '".$node."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by node
		order by sortcol,node
	;");

		return $query->result();
		}

	function nqi_monthly_cell($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$nodeb_info = $this->model_cellsinfo->find_nodeb_from_cell($node);
		$nodeb = $nodeb_info[0]->nodeb;		
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
#		$date = new DateTime($reportdate);
#		$monthnum = $date->format("m");		
		$query = $this->db->query(
		"
		SELECT 1 as sortcol, node, 'nodeb'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_nodeb
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and node = '".$nodeb."'
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cell'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,month) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,month) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,month) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(throughput::text, ',' order by year,month) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,month) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,month) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,month) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,month) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,month) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,month) AS nqi_cs
		FROM umts_kpi.vw_nqi_monthly_cell
		where node not in ('UNKNOWN')
and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and nodeb = '".$nodeb."'
		group by node
		order by sortcol,node
;");

	return $query->result();
	}		
		
function nqi_weekly_cell($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$nodeb_info = $this->model_cellsinfo->find_nodeb_from_cell($node);
		$nodeb = $nodeb_info[0]->nodeb;
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($reportdate);
		$weeknum1= $date1->format("W");
		$weeknum2= $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		$query = $this->db->query(
			"
			SELECT 1 as sortcol, node, 'nodeb'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_nodeb
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and node = '".$nodeb."'
		group by node
		UNION
		SELECT 2 as sortcol, node, 'cell'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda_ps_f2h::text, ',' order by year,week) AS qda_ps_f2h,
STRING_AGG(qdr_ps::text, ',' order by year,week) AS qdr_ps,
STRING_AGG(retention_ps::text, ',' order by year,week) AS retention_ps,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(throughput::text, ',' order by year,week) AS throughput,
STRING_AGG(hsdpa_users_ratio::text, ',' order by year,week) AS hsdpa_users_ratio,
STRING_AGG(nqi_ps_f2h::text, ',' order by year,week) AS nqi_ps_f2h,
STRING_AGG(qda_cs::text, ',' order by year,week) AS qda_cs,
STRING_AGG(qdr_cs::text, ',' order by year,week) AS qdr_cs,
STRING_AGG(retention_cs::text, ',' order by year,week) AS retention_cs,
STRING_AGG(nqi_cs::text, ',' order by year,week) AS nqi_cs
		FROM umts_kpi.vw_nqi_weekly_cell
		where node not in ('UNKNOWN')
		and nodeb = '".$nodeb."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and year in (2016,2017)
		group by node
		order by sortcol,node
	;");

		return $query->result();
		}		
		

// function nqi_weekly_rnc(){
		// $query = $this->db->query(
		// "SELECT rnc as node, 
// STRING_AGG(week::text, ',' order by week) AS weeks,
// STRING_AGG(qda_ps_f2h::text, ',' order by week) AS qda_ps_f2h,
// STRING_AGG(qdr_ps::text, ',' order by week) AS qdr_ps,
// STRING_AGG(retention_ps::text, ',' order by week) AS retention_ps,
// STRING_AGG(availability::text, ',' order by week) AS availability,
// STRING_AGG(throughput::text, ',' order by week) AS throughput,
// STRING_AGG(hsdpa_users_ratio::text, ',' order by week) AS hsdpa_users_ratio,
// STRING_AGG(nqi_ps_f2h::text, ',' order by week) AS nqi_ps_f2h
		// FROM vw_nqi_weekly_rnc
		// where rnc not in ('RNCRJT2')
		// and rnc like '%MG%'
		// group by rnc
		// order by rnc

// ;");

	// return $query->result();
	// }		
	function network_weekly_report_graph($reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_network
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."') 
  order by year,week
	;");	

	return $query->result();
	}
	
	function network_daily_report($reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_network
  WHERE date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}

	function region_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_region
 		 WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and node = '".$node."'
  order by year,week
	;");	

	return $query->result();
	}	
	
	function region_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_region
  WHERE date between '".$inidate."' and '".$findate."'
  and node = '".$node."'
  order by date
	;");	

	return $query->result();
	}

	function rnc_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_rnc
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and node = '".$node."'
  order by year,week
	;");	

	return $query->result();
	}	
	
	function rnc_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_rnc
  WHERE date between '".$inidate."' and '".$findate."'
  and node = '".$node."'
  order by date
	;");	

	return $query->result();
	}

	function uf_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");		
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_uf
		 WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and node = '".$node."'
  order by week
	;");	

	return $query->result();
	}	
	
	function nqi_daily_uf($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_uf
  WHERE date between '".$inidate."' and '".$findate."'
  and node = '".$node."'
  order by date
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
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");		
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, concat(node,' - ',uf) as node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_cidade_2
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and ibge = '".$ibge."'
  order by week
	;");	

	return $query->result();
	}	
	
	function nqi_daily_cidade($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info($node);
		$ibge = $cidade_info[0]->ibge;		
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, concat(node,' - ',uf) as node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_cidade_2
  WHERE date between '".$inidate."' and '".$findate."'
  and ibge = '".$ibge."'
  order by date
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
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");		
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_cluster_2
		 WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."') 
  and cluster_id = '".$cluster_id."'
  order by week
	;");	

	return $query->result();
	}	
	
	function nqi_daily_cluster($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cluster_info = $this->model_cellsinfo->find_cluster_info($node);
		$cluster_id = $cluster_info[0]->cluster_id;
		$uf = $cluster_info[0]->uf;		
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_cluster_2
  WHERE date between '".$inidate."' and '".$findate."'
  and cluster_id = '".$cluster_id."'
  order by date
	;");	

	return $query->result();
	}

	function nodeb_weekly_report_graph($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");		
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_nodeb
		 WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."') 
and node = '".$node."'
  order by year,week
	;");	

	return $query->result();
	}	
	
	function nqi_daily_nodeb($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_nodeb
  WHERE date between '".$inidate."' and '".$findate."'
  and node = '".$node."'
  order by date
	;");	

	return $query->result();
	}

	function cell_weekly_report_graph($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cell_array = $this->model_cellsinfo->find_cellid($node);
		$cellid = $cell_array[0]->cellid;
		$rnc = $cell_array[0]->rnc;
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");		
		// echo $strweek;
		// echo $endweek;
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week as date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_weekly_cell
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and rnc = '".$rnc."'
  and cellid = ".$cellid."
  order by year,week
	;");	

	return $query->result();
	}
	
	function nqi_daily_cell($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cell_array = $this->model_cellsinfo->find_cellid($node);
		$cellid = $cell_array[0]->cellid;
		$rnc = $cell_array[0]->rnc;
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, node, gp, qda_cs, qda_ps, qda_ps_f2h, qdr_cs, qdr_ps, 
       throughput, availability, retention_cs, retention_ps, hsdpa_users_ratio, 
       nqi_cs, nqi_ps, nqi_ps_f2h
  FROM umts_kpi.vw_nqi_daily_cell
  WHERE date between '".$inidate."' and '".$findate."'
  and rnc = '".$rnc."'
  and cellid = ".$cellid."
  order by date
	;");	

	return $query->result();
	}	
		
}