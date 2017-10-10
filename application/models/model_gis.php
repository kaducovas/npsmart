<?php 

class Model_gis extends CI_Model{
	 function cells(){
		 $query = $this->db->query(
		 "select cell as title, latitude as lat, longitude as lng, cluster as description from umts_control.cells 
		 --where CIDADE = 'CAMPO GRANDE'
		 order by rnc,cell;");

	 return $query->result();
	 }
	 
	 function search_nodeb(){
		 $query = $this->db->query(
		 "select distinct nodeb, latitude as lat, longitude as lon from umts_control.cells order by nodeb;");

	 return $query->result();
	 }

	 function show_coverage(){
		 $query = $this->db->query(
		 "select distinct nodeb, latitude as lat, longitude as lon from umts_control.cells order by nodeb;");

	 return $query->result();
	 }

	 function weekly_overshooters_count($reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
		$weeknum1= $date1->format("W");
		$weeknum2 = $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2 = $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		 $query = $this->db->query(
		 "select
			regional as node,
			string_agg(week::text, ',' order by week) as weeks, 
			string_agg(overshooters::text, ',' order by week) as overshooters,
			string_agg(cells::text, ',' order by week) as cells,
			string_agg(non_overshooters::text, ',' order by week) as non_overshooters,
			string_agg(overshooters_portion::text, ',' order by week) as overshooters_portion,
			string_agg(non_overshooters_portion::text, ',' order by week) as non_overshooters_portion,
			string_agg(score::text, ',' order by week) as score
			  FROM common_gis.weekly_overshooters_count_by_region
where (year,week) in ((".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
			group by regional
;");

	 return $query->result();
	 }	 
	 
	 function region_weekly_overshooters_count($node,$reportdate){
		$dayweek1 = date('Y-m-d', strtotime($reportdate.' -28 day'));	
		$dayweek2 = date('Y-m-d', strtotime($reportdate.' -21 day'));	
		$dayweek3 = date('Y-m-d', strtotime($reportdate.' -14 day'));	
		$dayweek4 = date('Y-m-d', strtotime($reportdate.' -7 day'));	
		$date1 = new DateTime($dayweek1);
		$date2 = new DateTime($dayweek2);
		$date3 = new DateTime($dayweek3);
		$date4 = new DateTime($dayweek4);
		$weeknum1= $date1->format("W");
		$weeknum2 = $date2->format("W");
		$weeknum3 = $date3->format("W");
		$weeknum4 = $date4->format("W");
		$yearnum1= $date1->format("o");
		$yearnum2 = $date2->format("o");
		$yearnum3 = $date3->format("o");
		$yearnum4 = $date4->format("o");		
		
		 $query = $this->db->query(
		 "SELECT 1 as sortcol,regional as node,
			string_agg(week::text, ',' order by week) as weeks, 
			string_agg(overshooters::text, ',' order by week) as overshooters,
			string_agg(cells::text, ',' order by week) as cells,
			string_agg(non_overshooters::text, ',' order by week) as non_overshooters,
			string_agg(overshooters_portion::text, ',' order by week) as overshooters_portion,
			string_agg(non_overshooters_portion::text, ',' order by week) as non_overshooters_portion,
			string_agg(score::text, ',' order by week) as score
			FROM common_gis.weekly_overshooters_count_by_region
			where regional = '".$node."'
			--and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
and (year,week) in ((".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
group by regional
			union 
			SELECT 2 as sortcol,rnc as node,
			string_agg(week::text, ',' order by week) as weeks, 
			string_agg(overshooters::text, ',' order by week) as overshooters,
			string_agg(cells::text, ',' order by week) as cells,
			string_agg(non_overshooters::text, ',' order by week) as non_overshooters,
			string_agg(overshooters_portion::text, ',' order by week) as overshooters_portion,
			string_agg(non_overshooters_portion::text, ',' order by week) as non_overshooters_portion,
			string_agg(score::text, ',' order by week) as score
			FROM common_gis.weekly_overshooters_count_by_rnc
			where region = '".$node."'
			--and (year,week) in ((".$yearnum1.",".$weeknum1."),(".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
and (year,week) in ((".$yearnum2.",".$weeknum2."),(".$yearnum3.",".$weeknum3."),(".$yearnum4.",".$weeknum4."))
group by rnc
order by sortcol,node
;");

	 return $query->result();
	 }	 	 
	 
}