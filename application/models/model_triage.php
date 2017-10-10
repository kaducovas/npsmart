<?php 

class Model_triage extends CI_Model{
	// function cells(){
		// $query = $this->db->query(
		// "select * from umts_control.cells order by rnc,cellname;");

	// return $query->result();
	// }

	function triage_network_chart($reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, 'NETWORK' as node, 'network'::text as type,
round(COALESCE(100*analysis::double precision/NULLIF(total::double precision,0),0)::numeric,2) as analysis,
round(COALESCE(100*cap::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap,
round(COALESCE(100*imp::double precision/NULLIF(total::double precision,0),0)::numeric,2) as imp,
round(COALESCE(100*normal::double precision/NULLIF(total::double precision,0),0)::numeric,2) as normal,
round(COALESCE(100*omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr,
round(COALESCE(100*otm::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm,
round(COALESCE(100*rf::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf,
round(COALESCE(100*tx_omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr,
round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_nok,
100 - round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_ok,
round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_nok,
100 - round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_ok,
round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_nok,
100 - round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_ok,
round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_nok,
100 - round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_ok,
round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_nok,
100 - round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_ok,
round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_nok,
100 - round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_ok,
round(COALESCE(100*rtwp_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as rtwp_nok,
round(COALESCE(100*ee_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as ee_nok,
round(COALESCE(100*no_overshooter_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as no_overshooter_nok,
round(COALESCE(100*parameter_check_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as parameter_check_nok
FROM
(SELECT year, week,
count(*) FILTER (where area = 'ANALYSIS') OVER (PARTITION BY year,week) as analysis,
count(*) FILTER (where area = 'CAP') OVER (PARTITION BY year,week) as cap,
count(*) FILTER (where area = 'IMP') OVER (PARTITION BY year,week) as imp,
count(*) FILTER (where area = 'NORMAL') OVER (PARTITION BY year,week) as normal,
count(*) FILTER (where area = 'OMR') OVER (PARTITION BY year,week) as omr,
count(*) FILTER (where area = 'OTM') OVER (PARTITION BY year,week) as otm,
count(*) FILTER (where area = 'PLAN/ENG RF') OVER (PARTITION BY year,week) as rf,
count(*) FILTER (where area = 'TX/OMR') OVER (PARTITION BY year,week) as tx_omr,
count(*) FILTER (where otm = 'NOK') OVER (PARTITION BY year,week) as otm_nok,
count(*) FILTER (where kpi = 'NOK') OVER (PARTITION BY year,week) as kpi_nok,
count(*) FILTER (where omr = 'NOK') OVER (PARTITION BY year,week) as omr_nok,
count(*) FILTER (where 'TX/OMR' = 'NOK') OVER (PARTITION BY year,week) as tx_omr_nok,
count(*) FILTER (where capacity = 'NOK') OVER (PARTITION BY year,week) as cap_nok,
count(*) FILTER (where 'PLAN/ENG RF' = 'NOK') OVER (PARTITION BY year,week) as rf_nok,
count(*) FILTER (where rtwp_check = 'NOK') OVER (PARTITION BY year,week) as rtwp_nok,
count(*) FILTER (where ee_balanced = 'NOK') OVER (PARTITION BY year,week) as ee_nok,
count(*) FILTER (where no_overshooter = 'NOK') OVER (PARTITION BY year,week) as no_overshooter_nok,
count(*) FILTER (where parameter_check = 'NOK') OVER (PARTITION BY year,week) as parameter_check_nok,
count(*) OVER (PARTITION BY year,week) as total
FROM umts_kpi.triage)f
where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
group by year,week,analysis,cap,imp,normal,omr,otm,rf,tx_omr,otm_nok,kpi_nok,omr_nok,tx_omr_nok,cap_nok,rf_nok,rtwp_nok,ee_nok,no_overshooter_nok,parameter_check_nok,total
order by week desc, node
;");

	return $query->result();

	}
	function triage_region_chart($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region as node, 'region'::text as type,
round(COALESCE(100*analysis::double precision/NULLIF(total::double precision,0),0)::numeric,2) as analysis,
round(COALESCE(100*cap::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap,
round(COALESCE(100*imp::double precision/NULLIF(total::double precision,0),0)::numeric,2) as imp,
round(COALESCE(100*normal::double precision/NULLIF(total::double precision,0),0)::numeric,2) as normal,
round(COALESCE(100*omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr,
round(COALESCE(100*otm::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm,
round(COALESCE(100*rf::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf,
round(COALESCE(100*tx_omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr,
round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_nok,
100 - round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_ok,
round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_nok,
100 - round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_ok,
round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_nok,
100 - round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_ok,
round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_nok,
100 - round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_ok,
round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_nok,
100 - round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_ok,
round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_nok,
100 - round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_ok,
round(COALESCE(100*rtwp_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as rtwp_nok,
round(COALESCE(100*ee_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as ee_nok,
round(COALESCE(100*no_overshooter_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as no_overshooter_nok,
round(COALESCE(100*parameter_check_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as parameter_check_nok
FROM
(SELECT year, week, region,
count(*) FILTER (where area = 'ANALYSIS') OVER (PARTITION BY year,week,region) as analysis,
count(*) FILTER (where area = 'CAP') OVER (PARTITION BY year,week,region) as cap,
count(*) FILTER (where area = 'IMP') OVER (PARTITION BY year,week,region) as imp,
count(*) FILTER (where area = 'NORMAL') OVER (PARTITION BY year,week,region) as normal,
count(*) FILTER (where area = 'OMR') OVER (PARTITION BY year,week,region) as omr,
count(*) FILTER (where area = 'OTM') OVER (PARTITION BY year,week,region) as otm,
count(*) FILTER (where area = 'PLAN/ENG RF') OVER (PARTITION BY year,week,region) as rf,
count(*) FILTER (where area = 'TX/OMR') OVER (PARTITION BY year,week,region) as tx_omr,
count(*) FILTER (where otm = 'NOK') OVER (PARTITION BY year,week,region) as otm_nok,
count(*) FILTER (where kpi = 'NOK') OVER (PARTITION BY year,week,region) as kpi_nok,
count(*) FILTER (where omr = 'NOK') OVER (PARTITION BY year,week,region) as omr_nok,
count(*) FILTER (where 'TX/OMR' = 'NOK') OVER (PARTITION BY year,week,region) as tx_omr_nok,
count(*) FILTER (where capacity = 'NOK') OVER (PARTITION BY year,week,region) as cap_nok,
count(*) FILTER (where 'PLAN/ENG RF' = 'NOK') OVER (PARTITION BY year,week,region) as rf_nok,
count(*) FILTER (where rtwp_check = 'NOK') OVER (PARTITION BY year,week,region) as rtwp_nok,
count(*) FILTER (where ee_balanced = 'NOK') OVER (PARTITION BY year,week,region) as ee_nok,
count(*) FILTER (where no_overshooter = 'NOK') OVER (PARTITION BY year,week,region) as no_overshooter_nok,
count(*) FILTER (where parameter_check = 'NOK') OVER (PARTITION BY year,week,region) as parameter_check_nok,
count(*) OVER (PARTITION BY year,week,region) as total
FROM umts_kpi.triage)f
where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
and region = '".$node."'
group by year,week,region,analysis,cap,imp,normal,omr,otm,rf,tx_omr,otm_nok,kpi_nok,omr_nok,tx_omr_nok,cap_nok,rf_nok,rtwp_nok,ee_nok,no_overshooter_nok,parameter_check_nok,total
order by week desc, node
;");

	return $query->result();

	}

	function triage_rnc_chart($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc as node, 'rnc'::text as type,
round(COALESCE(100*analysis::double precision/NULLIF(total::double precision,0),0)::numeric,2) as analysis,
round(COALESCE(100*cap::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap,
round(COALESCE(100*imp::double precision/NULLIF(total::double precision,0),0)::numeric,2) as imp,
round(COALESCE(100*normal::double precision/NULLIF(total::double precision,0),0)::numeric,2) as normal,
round(COALESCE(100*omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr,
round(COALESCE(100*otm::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm,
round(COALESCE(100*rf::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf,
round(COALESCE(100*tx_omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr,
round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_nok,
100 - round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_ok,
round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_nok,
100 - round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_ok,
round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_nok,
100 - round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_ok,
round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_nok,
100 - round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_ok,
round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_nok,
100 - round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_ok,
round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_nok,
100 - round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_ok,
round(COALESCE(100*rtwp_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as rtwp_nok,
round(COALESCE(100*ee_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as ee_nok,
round(COALESCE(100*no_overshooter_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as no_overshooter_nok,
round(COALESCE(100*parameter_check_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as parameter_check_nok
FROM
(SELECT year, week, region, rnc,
count(*) FILTER (where area = 'ANALYSIS') OVER (PARTITION BY year,week,region,rnc) as analysis,
count(*) FILTER (where area = 'CAP') OVER (PARTITION BY year,week,region,rnc) as cap,
count(*) FILTER (where area = 'IMP') OVER (PARTITION BY year,week,region,rnc) as imp,
count(*) FILTER (where area = 'NORMAL') OVER (PARTITION BY year,week,region,rnc) as normal,
count(*) FILTER (where area = 'OMR') OVER (PARTITION BY year,week,region,rnc) as omr,
count(*) FILTER (where area = 'OTM') OVER (PARTITION BY year,week,region,rnc) as otm,
count(*) FILTER (where area = 'PLAN/ENG RF') OVER (PARTITION BY year,week,region,rnc) as rf,
count(*) FILTER (where area = 'TX/OMR') OVER (PARTITION BY year,week,region,rnc) as tx_omr,
count(*) FILTER (where otm = 'NOK') OVER (PARTITION BY year,week,region,rnc) as otm_nok,
count(*) FILTER (where kpi = 'NOK') OVER (PARTITION BY year,week,region,rnc) as kpi_nok,
count(*) FILTER (where omr = 'NOK') OVER (PARTITION BY year,week,region,rnc) as omr_nok,
count(*) FILTER (where 'TX/OMR' = 'NOK') OVER (PARTITION BY year,week,region,rnc) as tx_omr_nok,
count(*) FILTER (where capacity = 'NOK') OVER (PARTITION BY year,week,region,rnc) as cap_nok,
count(*) FILTER (where 'PLAN/ENG RF' = 'NOK') OVER (PARTITION BY year,week,region,rnc) as rf_nok,
count(*) FILTER (where rtwp_check = 'NOK') OVER (PARTITION BY year,week,region,rnc) as rtwp_nok,
count(*) FILTER (where ee_balanced = 'NOK') OVER (PARTITION BY year,week,region,rnc) as ee_nok,
count(*) FILTER (where no_overshooter = 'NOK') OVER (PARTITION BY year,week,region,rnc) as no_overshooter_nok,
count(*) FILTER (where parameter_check = 'NOK') OVER (PARTITION BY year,week,region,rnc) as parameter_check_nok,
count(*) OVER (PARTITION BY year,week,region,rnc) as total
FROM umts_kpi.triage)f
where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
and rnc = '".$node."'
group by year,week,region,rnc,analysis,cap,imp,normal,omr,otm,rf,tx_omr,otm_nok,kpi_nok,omr_nok,tx_omr_nok,cap_nok,rf_nok,rtwp_nok,ee_nok,no_overshooter_nok,parameter_check_nok,total
order by week desc, node
;");

	return $query->result();

	}	
	function triage_nodeb_chart($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc, nodebname as node, 'nodeb'::text as type,
round(COALESCE(100*analysis::double precision/NULLIF(total::double precision,0),0)::numeric,2) as analysis,
round(COALESCE(100*cap::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap,
round(COALESCE(100*imp::double precision/NULLIF(total::double precision,0),0)::numeric,2) as imp,
round(COALESCE(100*normal::double precision/NULLIF(total::double precision,0),0)::numeric,2) as normal,
round(COALESCE(100*omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr,
round(COALESCE(100*otm::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm,
round(COALESCE(100*rf::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf,
round(COALESCE(100*tx_omr::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr,
round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_nok,
100 - round(COALESCE(100*otm_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as otm_ok,
round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_nok,
100 - round(COALESCE(100*kpi_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as kpi_ok,
round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_nok,
100 - round(COALESCE(100*omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as omr_ok,
round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_nok,
100 - round(COALESCE(100*tx_omr_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as tx_omr_ok,
round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_nok,
100 - round(COALESCE(100*cap_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as cap_ok,
round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_nok,
100 - round(COALESCE(100*rf_nok::double precision/NULLIF(total::double precision,0),0)::numeric,2) as rf_ok,
round(COALESCE(100*rtwp_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as rtwp_nok,
round(COALESCE(100*ee_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as ee_nok,
round(COALESCE(100*no_overshooter_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as no_overshooter_nok,
round(COALESCE(100*parameter_check_nok::double precision/NULLIF(otm_nok::double precision,0),0)::numeric,2) as parameter_check_nok
FROM
(SELECT year, week, region, rnc, nodebname,
count(*) FILTER (where area = 'ANALYSIS') OVER (PARTITION BY year,week,region,rnc,nodebname) as analysis,
count(*) FILTER (where area = 'CAP') OVER (PARTITION BY year,week,region,rnc,nodebname) as cap,
count(*) FILTER (where area = 'IMP') OVER (PARTITION BY year,week,region,rnc,nodebname) as imp,
count(*) FILTER (where area = 'NORMAL') OVER (PARTITION BY year,week,region,rnc,nodebname) as normal,
count(*) FILTER (where area = 'OMR') OVER (PARTITION BY year,week,region,rnc,nodebname) as omr,
count(*) FILTER (where area = 'OTM') OVER (PARTITION BY year,week,region,rnc,nodebname) as otm,
count(*) FILTER (where area = 'PLAN/ENG RF') OVER (PARTITION BY year,week,region,rnc,nodebname) as rf,
count(*) FILTER (where area = 'TX/OMR') OVER (PARTITION BY year,week,region,rnc,nodebname) as tx_omr,
count(*) FILTER (where otm = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as otm_nok,
count(*) FILTER (where kpi = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as kpi_nok,
count(*) FILTER (where omr = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as omr_nok,
count(*) FILTER (where 'TX/OMR' = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as tx_omr_nok,
count(*) FILTER (where capacity = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as cap_nok,
count(*) FILTER (where 'PLAN/ENG RF' = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as rf_nok,
count(*) FILTER (where rtwp_check = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as rtwp_nok,
count(*) FILTER (where ee_balanced = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as ee_nok,
count(*) FILTER (where no_overshooter = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as no_overshooter_nok,
count(*) FILTER (where parameter_check = 'NOK') OVER (PARTITION BY year,week,region,rnc,nodebname) as parameter_check_nok,
count(*) OVER (PARTITION BY year,week,region,rnc,nodebname) as total
FROM umts_kpi.triage)f
where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
and nodebname = '".$node."'
group by year,week,region,rnc,nodebname,analysis,cap,imp,normal,omr,otm,rf,tx_omr,otm_nok,kpi_nok,omr_nok,tx_omr_nok,cap_nok,rf_nok,rtwp_nok,ee_nok,no_overshooter_nok,parameter_check_nok,total
order by week desc, node
;");
	return $query->result();

}

	function triage_network($reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc, nodebname as nodeb, node, 'NETWORK'::text as type, 

round(qda_cs,2) as qda_cs, round(qda_hs,2) as qda_hs, round(qdr_cs,2) as qdr_cs, 
       round(qdr_ps,2) as qdr_ps, round(throughput,2) as throughput, round(availability,2) as availability, 
	   round(retention_cs,2) as retention_cs, round(retention_ps,2) as retention_ps, 
	   round(hsdpa_users_ratio,2) as hsdpa_users_ratio, 
	   round(rtwp,2) as rtwp, round(nqi_cs,2) as nqi_cs, round(nqi_hs,2) as nqi_hs, 
	   kpi, 
	   
	   wbbp_total, status_availability, 
       uncleared_alarms, note_omr, 
	   omr, 
	   
	   tx_type, ping_meandelay, ping_meanjitter, 
       ping_meanlost, vs_iub_flowctrol_dl_dropnum_lgcport1, vs_iub_flowctrol_ul_dropnum_lgcport1, 
       vs_iub_flowctrol_dl_congtime_lgcport1, vs_iub_flowctrol_ul_congtime_lgcport1, 
       atm_dl_utilization, atm_ul_utilization, tx_integrity, note_tx_omr, 
       tx_omr, 
	   
	   rtwp_check, ee_balanced, no_overshooter, covered_sites_count, 
       covered_sites, parameter_check, mo_out, 
	   otm, 
	   
	   ee, load, code_utilization, 
       dlpower_utilization, user_fach_utilization, rach_utilization, 
       pch_utilization, cnbap_utilization, dlce_utilization, ulce_utilization, 
       capacity, 
	   
	   board_found, status_board, np_action_found, np_solution, 
       note_rf, 
	   plan_eng_rf, 
	   
	   area

		FROM umts_kpi.triage
	where (year,week) in ((".$yearnum4.",".$weeknum4."))
	order by nodebname, region, rnc, node
;");

	return $query->result();

	}

	function triage_region($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc, nodebname as nodeb, node, 'NETWORK'::text as type, 

round(qda_cs,2) as qda_cs, round(qda_hs,2) as qda_hs, round(qdr_cs,2) as qdr_cs, 
       round(qdr_ps,2) as qdr_ps, round(throughput,2) as throughput, round(availability,2) as availability, 
	   round(retention_cs,2) as retention_cs, round(retention_ps,2) as retention_ps, 
	   round(hsdpa_users_ratio,2) as hsdpa_users_ratio, 
	   round(rtwp,2) as rtwp, round(nqi_cs,2) as nqi_cs, round(nqi_hs,2) as nqi_hs, 
	   kpi, 
	   
	   wbbp_total, status_availability, 
       uncleared_alarms, note_omr, 
	   omr, 
	   
	   tx_type, ping_meandelay, ping_meanjitter, 
       ping_meanlost, vs_iub_flowctrol_dl_dropnum_lgcport1, vs_iub_flowctrol_ul_dropnum_lgcport1, 
       vs_iub_flowctrol_dl_congtime_lgcport1, vs_iub_flowctrol_ul_congtime_lgcport1, 
       atm_dl_utilization, atm_ul_utilization, tx_integrity, note_tx_omr, 
       tx_omr, 
	   
	   rtwp_check, ee_balanced, no_overshooter, covered_sites_count, 
       covered_sites, parameter_check, mo_out, 
	   otm, 
	   
	   ee, load, code_utilization, 
       dlpower_utilization, user_fach_utilization, rach_utilization, 
       pch_utilization, cnbap_utilization, dlce_utilization, ulce_utilization, 
       capacity, 
	   
	   board_found, status_board, np_action_found, np_solution, 
       note_rf, 
	   plan_eng_rf, 
	   
	   area

		FROM umts_kpi.triage
	where (year,week) in ((".$yearnum4.",".$weeknum4."))
	and region = '".$node."'
	order by nodebname, region, rnc, node
;");

	return $query->result();

	}	
	
	function triage_rnc($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc, nodebname as nodeb, node, 'NETWORK'::text as type,

round(qda_cs,2) as qda_cs, round(qda_hs,2) as qda_hs, round(qdr_cs,2) as qdr_cs, 
       round(qdr_ps,2) as qdr_ps, round(throughput,2) as throughput, round(availability,2) as availability, 
	   round(retention_cs,2) as retention_cs, round(retention_ps,2) as retention_ps, 
	   round(hsdpa_users_ratio,2) as hsdpa_users_ratio, 
	   round(rtwp,2) as rtwp, round(nqi_cs,2) as nqi_cs, round(nqi_hs,2) as nqi_hs, 
	   kpi, 
	   
	   wbbp_total, status_availability, 
       uncleared_alarms, note_omr, 
	   omr, 
	   
	   tx_type, ping_meandelay, ping_meanjitter, 
       ping_meanlost, vs_iub_flowctrol_dl_dropnum_lgcport1, vs_iub_flowctrol_ul_dropnum_lgcport1, 
       vs_iub_flowctrol_dl_congtime_lgcport1, vs_iub_flowctrol_ul_congtime_lgcport1, 
       atm_dl_utilization, atm_ul_utilization, tx_integrity, note_tx_omr, 
       tx_omr, 
	   
	   rtwp_check, ee_balanced, no_overshooter, covered_sites_count, 
       covered_sites, parameter_check, mo_out, 
	   otm, 
	   
	   ee, load, code_utilization, 
       dlpower_utilization, user_fach_utilization, rach_utilization, 
       pch_utilization, cnbap_utilization, dlce_utilization, ulce_utilization, 
       capacity, 
	   
	   board_found, status_board, np_action_found, np_solution, 
       note_rf, 
	   plan_eng_rf, 
	   
	   area

		FROM umts_kpi.triage
	where (year,week) in ((".$yearnum4.",".$weeknum4."))
	and rnc = '".$node."'
	order by nodebname, region, rnc, node
;");

	return $query->result();

	}

	function triage_nodeb($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));		
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
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
SELECT year, week, region, rnc, nodebname as nodeb, node, 'NETWORK'::text as type, 

round(qda_cs,2) as qda_cs, round(qda_hs,2) as qda_hs, round(qdr_cs,2) as qdr_cs, 
       round(qdr_ps,2) as qdr_ps, round(throughput,2) as throughput, round(availability,2) as availability, 
	   round(retention_cs,2) as retention_cs, round(retention_ps,2) as retention_ps, 
	   round(hsdpa_users_ratio,2) as hsdpa_users_ratio, 
	   round(rtwp,2) as rtwp, round(nqi_cs,2) as nqi_cs, round(nqi_hs,2) as nqi_hs, 
	   kpi, 
	   
	   wbbp_total, status_availability, 
       uncleared_alarms, note_omr, 
	   omr, 
	   
	   tx_type, ping_meandelay, ping_meanjitter, 
       ping_meanlost, vs_iub_flowctrol_dl_dropnum_lgcport1, vs_iub_flowctrol_ul_dropnum_lgcport1, 
       vs_iub_flowctrol_dl_congtime_lgcport1, vs_iub_flowctrol_ul_congtime_lgcport1, 
       atm_dl_utilization, atm_ul_utilization, tx_integrity, note_tx_omr, 
       tx_omr, 
	   
	   rtwp_check, ee_balanced, no_overshooter, covered_sites_count, 
       covered_sites, parameter_check, mo_out, 
	   otm, 
	   
	   ee, load, code_utilization, 
       dlpower_utilization, user_fach_utilization, rach_utilization, 
       pch_utilization, cnbap_utilization, dlce_utilization, ulce_utilization, 
       capacity, 
	   
	   board_found, status_board, np_action_found, np_solution, 
       note_rf, 
	   plan_eng_rf, 
	   
	   area
		FROM umts_kpi.triage
	where (year,week) in ((".$yearnum4.",".$weeknum4."))
	and nodebname = '".$node."'
	order by nodebname, region, rnc, node
;");

	return $query->result();

	}		
	
}