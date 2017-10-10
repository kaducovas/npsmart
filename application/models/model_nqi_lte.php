<?php 

class Model_nqi_lte extends CI_Model{
	// function cells(){
		// $query = $this->db->query(
		// "select * from lte_control.cells order by rnc,cellname;");

	// return $query->result();
	// }
	
	
	function nqi_monthly_network($reportdate){
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
		
		$query = $this->db->query(
		"
		SELECT 1 as sortcol,'network'::text as type, node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_network
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by node
		UNION
		SELECT 2 as sortcol,'region'::text as type, region as node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_region
		where region not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by region
		order by sortcol,node
;");

	return $query->result();
	}
	
	function nqi_monthly_region($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($daymonth1);
		$date2 = new DateTime($daymonth2);
		$date3 = new DateTime($daymonth3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		
		$query = $this->db->query(
		"
		SELECT 2 as sortcol,'uf'::text as type, uf as node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_uf
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and region = '".$node."'
		group by uf
		UNION
		SELECT 1 as sortcol,'region'::text as type, region as node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_region
		where region not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and region = '".$node."'
		group by region
		order by sortcol,node
;");

	return $query->result();
	}

	function nqi_monthly_uf($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($daymonth1);
		$date2 = new DateTime($daymonth2);
		$date3 = new DateTime($daymonth3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		
		$query = $this->db->query(
		"
		SELECT 2 as sortcol,'uf'::text as type, uf as node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_uf
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by uf
		UNION
		SELECT 1 as sortcol,'region'::text as type, region as node, 
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_region
		where region not in ('UNKNOWN')
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by region
		order by sortcol,node
;");

	return $query->result();
	}

function nqi_monthly_cidade($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;
		$uf = $cidade_info[0]->uf;
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($daymonth1);
		$date2 = new DateTime($daymonth2);
		$date3 = new DateTime($daymonth3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		
		$query = $this->db->query(
			"
			select * from (SELECT 1 as sortcol, uf as node, 'uf'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_uf
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and uf = '".$uf."'
		group by uf
		UNION
		SELECT 2 as sortcol, concat(cidade,' - ',uf) as node, 'cidades'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_cidade
		where cidade not is null
		and uf = '".$uf."'
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by cidade,uf) t
		order by sortcol
		;");

		return $query->result();
		}

function nqi_monthly_enodeb($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($daymonth1);
		$date2 = new DateTime($daymonth2);
		$date3 = new DateTime($daymonth3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		
		$query = $this->db->query(
			"
			select * from (SELECT 1 as sortcol, enodeb as node, 'enodeb'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_enodeb
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and enodeb = '".$node."'
		group by enodeb
		UNION
		SELECT 2 as sortcol, cell as node, 'cell'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_cell
		where enodeb = '".$node."'
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by cell) t
		order by sortcol
		;");

		return $query->result();
		}
		
	
function nqi_monthly_cell($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -93 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -62 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -31 day'));	
		$date1 = new DateTime($daymonth1);
		$date2 = new DateTime($daymonth2);
		$date3 = new DateTime($daymonth3);
		$date4 = new DateTime($reportdate);
		$monthnum1= $date1->format("m");
		$monthnum2= $date2->format("m");
		$monthnum3 = $date3->format("m");
		$monthnum4 = $date4->format("m");
		$yearnum1= $date1->format("o");
		$yearnum2= $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");
		
		
		$query = $this->db->query(
			"
			select * from (SELECT 1 as sortcol, enodeb as node, 'enodeb'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_enodeb
		where (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		and enodeb = '".$node."'
		group by enodeb
		UNION
		SELECT 2 as sortcol, cell as node, 'cell'::text as type,
STRING_AGG(month::text, ',' order by year,month) AS months,
STRING_AGG(qda::text, ',' order by year,month) AS qda,
STRING_AGG(qdr::text, ',' order by year,month) AS qdr,
STRING_AGG(availability::text, ',' order by year,month) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,month) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,month) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,month) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,month) AS nqi
		FROM lte_kpi.vw_nqi_monthly_cell
		where cell = '".$node."'
		and (year,month) in ((".$yearnum1.",".$monthnum1."),(".$yearnum2.",".$monthnum2."),(".$yearnum3.",".$monthnum3."),(".$yearnum4.",".$monthnum4."))
		group by cell) t
		order by sortcol
		;");

		return $query->result();
		}

	function nqi_weekly_network($reportdate){
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
		SELECT 1 as sortcol,'network'::text as type, node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_network
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by node
		UNION
		SELECT 2 as sortcol,'region'::text as type, region as node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_region
		where region not in ('UNKNOWN')
		and  (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by region
		order by sortcol,node
;");

	return $query->result();
	}
	
	function nqi_weekly_region($node,$reportdate){
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
		SELECT 2 as sortcol,'uf'::text as type, uf as node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_uf
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = '".$node."'
		group by uf
		UNION
		SELECT 1 as sortcol,'region'::text as type, region as node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_region
		where region not in ('UNKNOWN')
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = '".$node."'
		group by region
		order by sortcol,node
;");

	return $query->result();
	}

	function nqi_weekly_uf($node,$reportdate){
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
		SELECT 2 as sortcol,'uf'::text as type, uf as node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_uf
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by uf
		UNION
		SELECT 1 as sortcol,'region'::text as type, region as node, 
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_region
		where region not in ('UNKNOWN')
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and region = 
		CASE
			WHEN '".$node."' = ANY (ARRAY['AC'::text, 'DF'::text, 'MS'::text, 'MT'::text, 'RO'::text, 'GO'::text,'TO'::text]) THEN 'CO'::text
			WHEN '".$node."' = ANY (ARRAY['AL'::text, 'CE'::text, 'PB'::text, 'PE'::text, 'PI'::text, 'RN'::text]) THEN 'NE'::text
			WHEN '".$node."' = 'BA'::text THEN 'BASE'::text
			WHEN '".$node."' = 'MG'::text THEN 'MG'::text
			WHEN '".$node."' = ANY (ARRAY['PR'::text, 'SC'::text]) THEN 'PRSC'::text
			WHEN '".$node."' = 'ES'::text THEN 'ES'::text
		ELSE 'UNKNOWN'::text
		END 
		group by region
		order by sortcol,node
;");

	return $query->result();
	}

function nqi_weekly_cidade($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
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
			select * from (SELECT 1 as sortcol, uf as node, 'uf'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_uf
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and uf = '".$uf."'
		group by uf
		UNION
		SELECT 2 as sortcol, concat(cidade,' - ',uf) as node, 'cidades'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_cidade
		where cidade not in ('UNKNOWN')
		and uf = '".$uf."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by cidade,uf) t
		order by sortcol
		;");

		return $query->result();
		}

function nqi_weekly_enodeb($node,$reportdate){
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
			select * from (SELECT 1 as sortcol, enodeb as node, 'enodeb'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_enodeb
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and enodeb = '".$node."'
		group by enodeb
		UNION
		SELECT 2 as sortcol, cell as node, 'cell'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_cell
		where enodeb = '".$node."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by cell) t
		order by sortcol
		;");

		return $query->result();
		}
		
	
function nqi_weekly_cell($node,$reportdate){
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
			select * from (SELECT 1 as sortcol, enodeb as node, 'enodeb'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_enodeb
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and enodeb = '".$node."'
		group by enodeb
		UNION
		SELECT 2 as sortcol, cell as node, 'cell'::text as type,
STRING_AGG(week::text, ',' order by year,week) AS weeks,
STRING_AGG(qda::text, ',' order by year,week) AS qda,
STRING_AGG(qdr::text, ',' order by year,week) AS qdr,
STRING_AGG(availability::text, ',' order by year,week) AS availability,
STRING_AGG(lte_retention::text, ',' order by year,week) AS lte_retention,
STRING_AGG(qde_dl::text, ',' order by year,week) AS qde_dl,
STRING_AGG(qde_ul::text, ',' order by year,week) AS qde_ul,
STRING_AGG(nqi::text, ',' order by year,week) AS nqi
		FROM lte_kpi.vw_nqi_weekly_cell
		where cell = '".$node."'
		and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		group by cell) t
		order by sortcol
		;");

		return $query->result();
		}

	function network_weekly_report_graph($reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi FROM lte_kpi.vw_nqi_weekly_network
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."') 
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
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, region as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_weekly_region
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and region = '".$node."'
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
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, uf as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_weekly_uf
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and uf = '".$node."'
  order by year,week
	;");	

	return $query->result();
	}		

	function cidade_weekly_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;		
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, concat(cidade,' - ',uf) as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_weekly_cidade
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and ibge = '".$ibge."'
  order by year,week
	;");	

	return $query->result();
	}

	function enodeb_weekly_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, enodeb as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_weekly_enodeb
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."')
  and enodeb = '".$node."'
  order by year,week
	;");	

	return $query->result();
	}	
	
		function cell_weeky_report($node,$reportdate){
		$date = new DateTime($reportdate);
		$endweek = $date->format("W");
		$strreportdate = date('Y-m-d', strtotime($reportdate.' -150 day'));
		$strdate = new DateTime($strreportdate);
		$strweek = $strdate->format("W");
		$stryear = $strdate->format("o");
		$endyear = $date->format("o");
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT year, week as date, cell as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_weekly_cell
  WHERE (year,week) between (".$stryear.",'".$strweek."') and (".$endyear.",'".$endweek."') 
  order by year,week
  and cell = '".$node."'
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
			 "SELECT * FROM lte_kpi.vw_nqi_daily_network
  WHERE date between '".$inidate."' and '".$findate."' order by date
	;");	

	return $query->result();
	}

	function region_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, region as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_daily_region
  WHERE date between '".$inidate."' and '".$findate."'
  and region = '".$node."'
  order by date
	;");	

	return $query->result();
	}

	function uf_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, uf as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_daily_uf
  WHERE date between '".$inidate."' and '".$findate."'
  and uf = '".$node."'
  order by date
	;");	

	return $query->result();
	}		

	function cidade_daily_report($node,$reportdate){
		$this->load->model('model_cellsinfo');
		$cidade_info = $this->model_cellsinfo->find_cidade_info_lte($node);
		$ibge = $cidade_info[0]->ibge;		
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, concat(cidade,' - ',uf) as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_daily_cidade
  WHERE date between '".$inidate."' and '".$findate."'
  and ibge = '".$ibge."'
  order by date
	;");	

	return $query->result();
	}

	function enodeb_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, enodeb as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_daily_enodeb
  WHERE date between '".$inidate."' and '".$findate."'
  and enodeb = '".$node."'
  order by date
	;");	

	return $query->result();
	}	
	
		function cell_daily_report($node,$reportdate){
		$daterange = $reportdate;
		$inidate = date('Y-m-d', strtotime($daterange.' -30 day'));
		$findate = date('Y-m-d', strtotime($daterange));
		#$weeknum_start = $weeknum -4;
			 $query = $this->db->query(
			 "SELECT week, date, cell as node, qda, qdr, availability, lte_retention, qde_dl, 
       qde_ul, nqi
  FROM lte_kpi.vw_nqi_daily_cell
  WHERE date between '".$inidate."' and '".$findate."'
  and cell = '".$node."'
  order by date
	;");	

	return $query->result();
	}		

}