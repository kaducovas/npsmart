<?php 

class Model_unbalance extends CI_Model{
	// function cells(){
		// $query = $this->db->query(
		// "select * from umts_control.cells order by rnc,cellname;");

	// return $query->result();
	// }

	function unbalance_network($reportdate){
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
		"select node, 'region' as type,
STRING_AGG(week::text, ',' order by year,week desc) AS weeks,
STRING_AGG(azimuth_no::text, ',' order by year,week desc) AS azimuth_no
from
(select node, 'region' as type,
week, year, sum(no_nok) as azimuth_no
from
((select distinct azimuth,  nodeb, region as node, 1 as no_nok, year, week
from 
(select distinct azimuth, nodeb, region, balanced, year, week
FROM umts_kpi.load_ee 
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and balanced = 'NOK'
		group by region,azimuth, nodeb, balanced, year, week) t group by azimuth,  nodeb, region, year, week) 
union
(select distinct azimuth,  nodeb, region as node, 0 as no_nok, year, week
from 
(select distinct azimuth,  nodeb, region, balanced, year, week
FROM umts_kpi.load_ee 
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and balanced = 'OK'
		group by region,azimuth, nodeb, balanced, year, week) t group by azimuth, region, nodeb, year, week))
f group by node, week,year order by week, node) t group by node
;");

	return $query->result();

	}
			
			
	function unbalance_region($node,$reportdate){
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
		"select node, 'region'::text as type,
STRING_AGG(week::text, ',' order by year,week desc) AS weeks,
STRING_AGG(region::text, ',' order by year,week desc) AS region,
STRING_AGG(rnc::text, ',' order by year,week desc) AS rnc,
STRING_AGG(nodeb::text, ',' order by year,week desc) AS nodeb,
STRING_AGG(carrier::text, ',' order by year,week desc) AS carrier,
STRING_AGG(azimuth::text, ',' order by year,week desc) AS azimuth,
STRING_AGG(round(ee,2)::text, ',' order by year,week desc) AS ee,
STRING_AGG(round(load,2)::text, ',' order by year,week desc) AS load,
STRING_AGG(round(avg_ee,2)::text, ',' order by year,week desc) AS avg_ee,
STRING_AGG(balanced::text, ',' order by year,week desc) AS balanced,
STRING_AGG(highly_loaded_cell::text, ',' order by year,week desc) AS hl_cell
FROM umts_kpi.load_ee
		where (year,week) in ((".$yearnum4.",".$weeknum4."))
		and region = '".$node."'
		group by node
		order by nodeb,azimuth,carrier
;");

	return $query->result();

	}

	function unbalance_rnc($node,$reportdate){
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
		select node, 'rnc'::text as type,
STRING_AGG(week::text, ',' order by year,week desc) AS weeks,
STRING_AGG(region::text, ',' order by year,week desc) AS region,
STRING_AGG(rnc::text, ',' order by year,week desc) AS rnc,
STRING_AGG(nodeb::text, ',' order by year,week desc) AS nodeb,
STRING_AGG(carrier::text, ',' order by year,week desc) AS carrier,
STRING_AGG(azimuth::text, ',' order by year,week desc) AS azimuth,
STRING_AGG(round(ee,2)::text, ',' order by year,week desc) AS ee,
STRING_AGG(round(load,2)::text, ',' order by year,week desc) AS load,
STRING_AGG(round(avg_ee,2)::text, ',' order by year,week desc) AS avg_ee,
STRING_AGG(balanced::text, ',' order by year,week desc) AS balanced,
STRING_AGG(highly_loaded_cell::text, ',' order by year,week desc) AS hl_cell
FROM umts_kpi.load_ee
		where (year,week) in ((".$yearnum4.",".$weeknum4."))
		and rnc = '".$node."'
		group by node
		order by nodeb,azimuth,carrier
;");

	return $query->result();

	}

function unbalance_nodeb($node,$reportdate){
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
		select node, 'nodeb'::text as type,
STRING_AGG(week::text, ',' order by year,week desc) AS weeks,
STRING_AGG(region::text, ',' order by year,week desc) AS region,
STRING_AGG(rnc::text, ',' order by year,week desc) AS rnc,
STRING_AGG(nodeb::text, ',' order by year,week desc) AS nodeb,
STRING_AGG(carrier::text, ',' order by year,week desc) AS carrier,
STRING_AGG(azimuth::text, ',' order by year,week desc) AS azimuth,
STRING_AGG(round(ee,2)::text, ',' order by year,week desc) AS ee,
STRING_AGG(round(load,2)::text, ',' order by year,week desc) AS load,
STRING_AGG(round(avg_ee,2)::text, ',' order by year,week desc) AS avg_ee,
STRING_AGG(balanced::text, ',' order by year,week desc) AS balanced,
STRING_AGG(highly_loaded_cell::text, ',' order by year,week desc) AS hl_cell
FROM umts_kpi.load_ee
		where (year,week) in ((".$yearnum4.",".$weeknum4."))	
		and nodeb = '".$node."'
		group by node
		order by nodeb,azimuth,carrier
;");

	return $query->result();

	}

function unbalance_chart($reportdate){
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
		"select node, 'region' as type,
week, sum(no_nok) as azimuth_no
from
((select distinct azimuth,  nodeb, region as node, 1 as no_nok, year, week
from 
(select distinct azimuth, nodeb, region, balanced, year, week
FROM umts_kpi.load_ee 
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and balanced = 'NOK'
		group by region,azimuth, nodeb, balanced, year, week) t group by azimuth,  nodeb, region, year, week) 
union
(select distinct azimuth,  nodeb, region as node, 0 as no_nok, year, week
from 
(select distinct azimuth,  nodeb, region, balanced, year, week
FROM umts_kpi.load_ee 
		where (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
		and balanced = 'OK'
		group by region,azimuth, nodeb, balanced, year, week) t group by azimuth, region, nodeb, year, week))
f group by node, week order by week, node
;");

	return $query->result();

	}
			

}