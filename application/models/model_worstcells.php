<?php 

class Model_worstcells extends CI_Model{
	function cells(){
		$query = $this->db->query(
		"select * from umts_control.cells order by rnc,cellname;");

	return $query->result();
	}

	function find_cellid($cellname){
		$query = $this->db->query(
		"select cellid,rncname from umts_configuration.ucellsetup where cellname = '".$cellname."';");

	return $query->result();
	}	

	
	function rncwc($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
	
if($reportnetype == 'custom'){
	$rank = "worst_cells_main_kpis_event_rank_hourly";
	$fails = "worst_cells_main_kpis_event_fails_hourly";
	$reportnetype = 'cluster';
} else{
		if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}
}	


	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*node_kpi::numeric,2) as kpi_node_rate,round(100*new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");
	 // "select rank,date,r.node,r.cellname,r.cellid,round(100*r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
// round(100*node_kpi::numeric,2) as node_kpi,round(100*new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impacts
// from
// (select * from umts_kpi.worst_cells_main_kpis_rank('rnc', '"$kpi"', '"$findate"', '"$rnc_query"')) r
// inner join (select * from umts_kpi.worst_cells_main_kpis_fails('rnc', '"$kpi"', '"$findate"', '"$rnc_query"')) f 
// on r.node = f.node and r.cellid = f.cellid
// order by rank");
		 // "SELECT umts_kpi.worst_cells_rnc_".$family.".date,umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, t.cellname,
// round((100*COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1))::numeric,2) as kpi_cell_rate, 
// cell_fails, round(100*impact::numeric,2) as impact,round((100*COALESCE(rnc_kpi_num / NULLIF(rnc_kpi_den, 0), 1))::numeric,2) as kpi_rnc_rate,
// round(100*new_rnc_kpi::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   // FROM umts_kpi.worst_cells_rnc_".$family.",--umts_configuration.ucellsetup,
	   // (SELECT umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid,cellname,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".date::text, ',' order by date) as dates,
			// STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_rnc_".$family.".cell_kpi_num / NULLIF(umts_kpi.worst_cells_rnc_".$family.".cell_kpi_den, 0), 1))::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".cell_fails::text,',' order by date) AS daily_cell_fails,
			// STRING_AGG(round((100*umts_kpi.worst_cells_rnc_".$family.".impact)::numeric,2)::text, ',' order by date) as daily_impact
			// FROM umts_kpi.worst_cells_rnc_".$family." inner join umts_configuration.ucellsetup
			// on umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".date between '".$inidate."' and '".$findate."'
			// and kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// group by umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, cellname
			// ) as t
			// -- where umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// -- and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".rnc= t.rnc
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= t.cellid
			// and umts_kpi.worst_cells_rnc_".$family.".kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".date = '".$findate."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// order by umts_kpi.worst_cells_rnc_".$family.".date, cell_fails desc
			
			// ");
			// //--ORDER BY (regexp_split_to_array(t.dates, E','))[7]::timestamp without time zone DESC,
			// //--(regexp_split_to_array(daily_cell_fails, E','))[7]::integer DESC;
	 return $query->result();
	 }

	function rncwc_event($kpi,$reportnename,$reportnetype){
		$this->load->model('model_cellsinfo');
		$max_date = $this->model_cellsinfo->find_max_datetime_from_main_kpis();
		$reportdate = $max_date[0]->datetime;	
		$timeagg = "daily";
		
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_event_rank_hourly";
		$fails = "worst_cells_main_kpis_event_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*node_kpi::numeric,2) as kpi_node_rate,round(100*new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");

	 return $query->result();
	 }	 
	 
	function rncwcalt($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
if($reportnetype == 'custom'){
	$rank = "worst_cells_main_kpis_event_rank_hourly";
	$fails = "worst_cells_main_kpis_event_fails_hourly";
	$reportnetype = 'cluster';
} else{
	
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}
}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*node_kpi::numeric,2) as kpi_node_rate,round(100*new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");
	 // $query = $this->db->query(
		 // "SELECT umts_kpi.worst_cells_rnc_".$family.".date,umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, t.cellname,
// round(100*cell_kpi::numeric,2) as kpi_cell_rate, 
// cell_fails, round(100*impact::numeric,2) as impact,round(100*rnc_kpi::numeric,2) as kpi_rnc_rate,
// round(100*new_rnc_kpi::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   // FROM umts_kpi.worst_cells_rnc_".$family.",--umts_configuration.ucellsetup,
	   // (SELECT umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid,cellname,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".date::text, ',' order by date) as dates,
			// STRING_AGG(round(100*cell_kpi::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".cell_fails::text,',' order by date) AS daily_cell_fails,
			// STRING_AGG(round((100*umts_kpi.worst_cells_rnc_".$family.".impact)::numeric,2)::text, ',' order by date) as daily_impact
			// FROM umts_kpi.worst_cells_rnc_".$family." inner join umts_configuration.ucellsetup
			// on umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".date between '".$inidate."' and '".$findate."'
			// and kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// group by umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, cellname
			// ) as t
			// -- where umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// -- and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".rnc= t.rnc
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= t.cellid
			// and umts_kpi.worst_cells_rnc_".$family.".kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".date = '".$findate."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// order by umts_kpi.worst_cells_rnc_".$family.".date, cell_fails desc
			
			// ");
			//--ORDER BY (regexp_split_to_array(t.dates, E','))[7]::timestamp without time zone DESC,
			//--(regexp_split_to_array(daily_cell_fails, E','))[7]::integer DESC;
	 return $query->result();
	 }	 
	 

	function rncwc_retainability($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
if($reportnetype == 'custom'){
	$rank = "worst_cells_main_kpis_event_rank_hourly";
	$fails = "worst_cells_main_kpis_event_fails_hourly";
	$reportnetype = 'cluster';
} else{		
		
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}
}
	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*(1-r.cell_kpi)::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*node_kpi::numeric,2) as kpi_node_rate,round(100*(1-new_node_kpi)::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");
	 // $query = $this->db->query(
		 // "SELECT umts_kpi.worst_cells_rnc_".$family.".date,umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, t.cellname,
// round((100*(1::real - COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1)))::numeric,2) as kpi_cell_rate, 
// cell_fails, round(100*impact::numeric,2) as impact,round((100*(1::real - COALESCE(rnc_kpi_num / NULLIF(rnc_kpi_den, 0), 1)))::numeric,2) as kpi_rnc_rate,
// round(100*(1::real - new_rnc_kpi)::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   // FROM umts_kpi.worst_cells_rnc_".$family.",--umts_configuration.ucellsetup,
	   // (SELECT umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid,cellname,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".date::text, ',' order by date) as dates,
			// STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_rnc_".$family.".cell_kpi_num / NULLIF(umts_kpi.worst_cells_rnc_".$family.".cell_kpi_den, 0), 1))::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".cell_fails::text,',' order by date) AS daily_cell_fails,
			// STRING_AGG(round((100*umts_kpi.worst_cells_rnc_".$family.".impact)::numeric,2)::text, ',' order by date) as daily_impact
			// FROM umts_kpi.worst_cells_rnc_".$family." inner join umts_configuration.ucellsetup
			// on umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".date between '".$inidate."' and '".$findate."'
			// and kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// group by umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, cellname
			// ) as t
			// -- where umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// -- and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".rnc= t.rnc
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= t.cellid
			// and umts_kpi.worst_cells_rnc_".$family.".kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".date = '".$findate."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// order by umts_kpi.worst_cells_rnc_".$family.".date, cell_fails desc
			
			// ");
			//--ORDER BY (regexp_split_to_array(t.dates, E','))[7]::timestamp without time zone DESC,
			//--(regexp_split_to_array(daily_cell_fails, E','))[7]::integer DESC;
	 return $query->result();
	 }

	function rncwc_retainability_event($kpi,$reportnename,$reportnetype){
		$this->load->model('model_cellsinfo');
		$max_date = $this->model_cellsinfo->find_max_datetime_from_main_kpis();
		$reportdate = $max_date[0]->datetime;	
		$timeagg = "daily";
		
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_event_rank_hourly";
		$fails = "worst_cells_main_kpis_event_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*(1-r.cell_kpi)::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*(1-node_kpi)::numeric,2) as kpi_node_rate,round(100*(1-new_node_kpi)::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");

	 return $query->result();
	 }	 
	 
		function rncacckpi($rnc_query,$inidate,$findate){
		$query = $this->db->query(
		"select * from vw_accessibility_rnc_rate 
		WHERE rnc = '".$rnc_query."'
		ORDER BY datetime;"
		);
			
	return $query->result();
	}
	
	

	function rncwcalt2($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(node_kpi::numeric,2) as kpi_node_rate,round(new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");
	 // $query = $this->db->query(
		 // "SELECT umts_kpi.worst_cells_rnc_".$family.".date,umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, t.cellname,
// round(COALESCE(cell_kpi,0::REAL)::numeric,2) as kpi_cell_rate, 
// --cell_fails, 
// --round(100*impact::numeric,2) as impact,
// round(rnc_kpi::numeric,2) as kpi_rnc_rate,
// round(new_rnc_kpi::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate--,
// --t.daily_cell_fails,t.daily_impact	 
	   // FROM umts_kpi.worst_cells_rnc_".$family.",--umts_configuration.ucellsetup,
	   // (SELECT umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid,cellname,
			// STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".date::text, ',' order by date) as dates,
			// STRING_AGG(round(COALESCE(cell_kpi,0::REAL)::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate--,
			// --STRING_AGG(umts_kpi.worst_cells_rnc_".$family.".cell_fails::text,',' order by date) AS daily_cell_fails,
			// --STRING_AGG(round((100*umts_kpi.worst_cells_rnc_".$family.".impact)::numeric,2)::text, ',' order by date) as daily_impact
			// FROM umts_kpi.worst_cells_rnc_".$family." inner join umts_configuration.ucellsetup
			// on umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".date between '".$inidate."' and '".$findate."'
			// and kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// group by umts_kpi.worst_cells_rnc_".$family.".rnc, umts_kpi.worst_cells_rnc_".$family.".cellid, cellname
			// ) as t
			// -- where umts_kpi.worst_cells_rnc_".$family.".rnc= umts_configuration.ucellsetup.rncname
			// -- and umts_kpi.worst_cells_rnc_".$family.".cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_rnc_".$family.".rnc= t.rnc
			// and umts_kpi.worst_cells_rnc_".$family.".cellid= t.cellid
			// and umts_kpi.worst_cells_rnc_".$family.".kpi = '".$kpi."'
			// and umts_kpi.worst_cells_rnc_".$family.".date = '".$findate."'
			// and umts_kpi.worst_cells_rnc_".$family.".rnc = '".$rnc_query."'
			// order by umts_kpi.worst_cells_rnc_".$family.".date, rank--cell_fails desc			
			// ");

	 return $query->result();
	 }	
	 
	function rncwcalt2_event($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(node_kpi::numeric,2) as kpi_node_rate,round(new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");

	 return $query->result();
	 }	 

	function rncwc_nqi($kpi,$reportnename,$reportdate,$reportnetype,$timeagg){
	if($timeagg == "weekly"){
		$rank = "worst_cells_main_kpis_rank_daily";
		$fails = "worst_cells_main_kpis_fails_daily";
	} elseif ($timeagg == "daily"){
		$rank = "worst_cells_main_kpis_rank_hourly";
		$fails = "worst_cells_main_kpis_fails_hourly";
	} elseif ($timeagg == "monthly"){
		$rank = "worst_cells_main_kpis_rank_weekly";
		$fails = "worst_cells_main_kpis_fails_weekly";
	}

	 $query = $this->db->query(
"select rank,date,r.node,r.cellname,r.cellid,round(100*r.cell_kpi::numeric,2) as kpi_cell_rate,r.cell_fails,round(100*r.impact::numeric,2) as impact,
 round(100*node_kpi::numeric,2) as kpi_node_rate,round(100*new_node_kpi::numeric,2) as new_node_kpi,dates,kpis as daily_kpi_cell_rate,fails as daily_cell_fails,impacts as daily_impact
 from
 (select * from umts_kpi.".$rank."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) r
 inner join (select * from umts_kpi.".$fails."('".$reportnetype."', '".$kpi."', '".$reportdate."', '".$reportnename."')) f 
 on r.rncname = f.rncname and r.cellid = f.cellid
 order by rank");
	 return $query->result();
	 }	 
	 
	 // function rncwc_nqi($kpi,$rnc_query,$family,$inidate,$findate){

	 // $query = $this->db->query(
		 // "SELECT umts_kpi.worst_cells_".$family."_rnc.date,umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid, t.cellname,
// round((100*COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1))::numeric,2) as kpi_cell_rate, 
// cell_fails, round(100*impact::numeric,2) as impact,round((100*COALESCE(rnc_kpi_num / NULLIF(rnc_kpi_den, 0), 1))::numeric,2) as kpi_rnc_rate,
// round(100*new_rnc_kpi::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   // FROM umts_kpi.worst_cells_".$family."_rnc,--umts_configuration.ucellsetup,
	   // (SELECT umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid,cellname,
			// STRING_AGG(umts_kpi.worst_cells_".$family."_rnc.date::text, ',' order by date) as dates,
			// STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_".$family."_rnc.cell_kpi_num / NULLIF(umts_kpi.worst_cells_".$family."_rnc.cell_kpi_den, 0), 1))::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate,
			// STRING_AGG(umts_kpi.worst_cells_".$family."_rnc.cell_fails::text,',' order by date) AS daily_cell_fails,
			// STRING_AGG(round((100*umts_kpi.worst_cells_".$family."_rnc.impact)::numeric,2)::text, ',' order by date) as daily_impact
			// FROM umts_kpi.worst_cells_".$family."_rnc inner join umts_configuration.ucellsetup
			// on umts_kpi.worst_cells_".$family."_rnc.rnc= umts_configuration.ucellsetup.rncname
			// and umts_kpi.worst_cells_".$family."_rnc.cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_".$family."_rnc.date between '".$inidate."' and '".$findate."'
			// and kpi = '".$kpi."'
			// and umts_kpi.worst_cells_".$family."_rnc.rnc = '".$rnc_query."'
			// group by umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid, cellname
			// ) as t
			// -- where umts_kpi.worst_cells_".$family."_rnc.rnc= umts_configuration.ucellsetup.rncname
			// -- and umts_kpi.worst_cells_".$family."_rnc.cellid= umts_configuration.ucellsetup.cellid
			// where umts_kpi.worst_cells_".$family."_rnc.rnc= t.rnc
			// and umts_kpi.worst_cells_".$family."_rnc.cellid= t.cellid
			// and umts_kpi.worst_cells_".$family."_rnc.kpi = '".$kpi."'
			// and umts_kpi.worst_cells_".$family."_rnc.date = '".$findate."'
			// and umts_kpi.worst_cells_".$family."_rnc.rnc = '".$rnc_query."'
			// order by umts_kpi.worst_cells_".$family."_rnc.date, cell_fails desc
			// ");

	 // return $query->result();
	 // }
	 
	 function rncwc_nqi_retention($kpi,$rnc_query,$family,$inidate,$findate){

	 $query = $this->db->query(
		 "SELECT umts_kpi.worst_cells_".$family."_rnc.date,umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid, t.cellname,
round((100*(1::real - COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1)))::numeric,2) as kpi_cell_rate, 
cell_fails, round(100*impact::numeric,2) as impact,round((100*(1::real - COALESCE(rnc_kpi_num / NULLIF(rnc_kpi_den, 0), 1)))::numeric,2) as kpi_rnc_rate,
round(100*(1::real - new_rnc_kpi)::numeric,2) as new_rnc_kpi,t.dates,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   FROM umts_kpi.worst_cells_".$family."_rnc,--umts_configuration.ucellsetup,
	   (SELECT umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid,cellname,
			STRING_AGG(umts_kpi.worst_cells_".$family."_rnc.date::text, ',' order by date) as dates,
			STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_".$family."_rnc.cell_kpi_num / NULLIF(umts_kpi.worst_cells_".$family."_rnc.cell_kpi_den, 0), 1))::numeric,2)::text,',' order by date) AS daily_kpi_cell_rate,
			STRING_AGG(umts_kpi.worst_cells_".$family."_rnc.cell_fails::text,',' order by date) AS daily_cell_fails,
			STRING_AGG(round((100*umts_kpi.worst_cells_".$family."_rnc.impact)::numeric,2)::text, ',' order by date) as daily_impact
			FROM umts_kpi.worst_cells_".$family."_rnc inner join umts_configuration.ucellsetup
			on umts_kpi.worst_cells_".$family."_rnc.rnc= umts_configuration.ucellsetup.rncname
			and umts_kpi.worst_cells_".$family."_rnc.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_rnc.date between '".$inidate."' and '".$findate."'
			and kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_rnc.rnc = '".$rnc_query."'
			group by umts_kpi.worst_cells_".$family."_rnc.rnc, umts_kpi.worst_cells_".$family."_rnc.cellid, cellname
			) as t
			-- where umts_kpi.worst_cells_".$family."_rnc.rnc= umts_configuration.ucellsetup.rncname
			-- and umts_kpi.worst_cells_".$family."_rnc.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_rnc.rnc= t.rnc
			and umts_kpi.worst_cells_".$family."_rnc.cellid= t.cellid
			and umts_kpi.worst_cells_".$family."_rnc.kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_rnc.date = '".$findate."'
			and umts_kpi.worst_cells_".$family."_rnc.rnc = '".$rnc_query."'
			order by umts_kpi.worst_cells_".$family."_rnc.date, cell_fails desc
			");

	 return $query->result();
	 }

 function regionwc_weekly_nqi($kpi,$node_query,$family,$iniweek,$finweek){
	$iniweek = $finweek - 4;
	 $query = $this->db->query(
		 "SELECT umts_kpi.worst_cells_".$family."_region_weekly.week,umts_kpi.worst_cells_".$family."_region_weekly.region,umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid, t.cellname,
round((100*COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1))::numeric,2) as kpi_cell_rate, 
cell_fails, round(100*impact::numeric,2) as impact,round((100*COALESCE(region_kpi_num / NULLIF(region_kpi_den, 0), 1))::numeric,2) as kpi_region_rate,
round(100*new_region_kpi::numeric,2) as new_region_kpi,t.weeks,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   FROM umts_kpi.worst_cells_".$family."_region_weekly,--umts_configuration.ucellsetup,
	   (SELECT umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid,cellname,
			STRING_AGG(umts_kpi.worst_cells_".$family."_region_weekly.week::text, ',' order by week) as weeks,
			STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_".$family."_region_weekly.cell_kpi_num / NULLIF(umts_kpi.worst_cells_".$family."_region_weekly.cell_kpi_den, 0), 1))::numeric,2)::text,',' order by week) AS daily_kpi_cell_rate,
			STRING_AGG(umts_kpi.worst_cells_".$family."_region_weekly.cell_fails::text,',' order by week) AS daily_cell_fails,
			STRING_AGG(round((100*umts_kpi.worst_cells_".$family."_region_weekly.impact)::numeric,2)::text, ',' order by week) as daily_impact
			FROM umts_kpi.worst_cells_".$family."_region_weekly inner join umts_configuration.ucellsetup
			on umts_kpi.worst_cells_".$family."_region_weekly.rnc= umts_configuration.ucellsetup.rncname
			and umts_kpi.worst_cells_".$family."_region_weekly.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_region_weekly.week between ".$iniweek." and ".$finweek."
			and kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_region_weekly.region = '".$node_query."'
			group by umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid, cellname
			) as t
			-- where umts_kpi.worst_cells_".$family."_region_weekly.rnc= umts_configuration.ucellsetup.rncname
			-- and umts_kpi.worst_cells_".$family."_region_weekly.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_region_weekly.rnc= t.rnc
			and umts_kpi.worst_cells_".$family."_region_weekly.cellid= t.cellid
			and umts_kpi.worst_cells_".$family."_region_weekly.kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_region_weekly.week = ".$finweek."
			and umts_kpi.worst_cells_".$family."_region_weekly.region = '".$node_query."'
			order by umts_kpi.worst_cells_".$family."_region_weekly.week, cell_fails desc
			");

	 return $query->result();
	 }	

 function regionwc_weekly_nqi_retention($kpi,$node_query,$family,$iniweek,$finweek){
	$iniweek = $finweek - 4;
	 $query = $this->db->query(
		 "SELECT umts_kpi.worst_cells_".$family."_region_weekly.week,umts_kpi.worst_cells_".$family."_region_weekly.region,umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid, t.cellname,
round((100*(1::real - COALESCE(cell_kpi_num / NULLIF(cell_kpi_den, 0), 1)))::numeric,2) as kpi_cell_rate,
cell_fails, round(100*impact::numeric,2) as impact,round((100*(1::real - COALESCE(region_kpi_num / NULLIF(region_kpi_den, 0), 1)))::numeric,2) as kpi_region_rate,
round(100*(1::real - new_region_kpi)::numeric,2) as new_region_kpi,t.weeks,t.daily_kpi_cell_rate,t.daily_cell_fails,t.daily_impact	 
	   FROM umts_kpi.worst_cells_".$family."_region_weekly,--umts_configuration.ucellsetup,
	   (SELECT umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid,cellname,
			STRING_AGG(umts_kpi.worst_cells_".$family."_region_weekly.week::text, ',' order by week) as weeks,
			STRING_AGG(round((100*COALESCE(umts_kpi.worst_cells_".$family."_region_weekly.cell_kpi_num / NULLIF(umts_kpi.worst_cells_".$family."_region_weekly.cell_kpi_den, 0), 1))::numeric,2)::text,',' order by week) AS daily_kpi_cell_rate,
			STRING_AGG(umts_kpi.worst_cells_".$family."_region_weekly.cell_fails::text,',' order by week) AS daily_cell_fails,
			STRING_AGG(round((100*umts_kpi.worst_cells_".$family."_region_weekly.impact)::numeric,2)::text, ',' order by week) as daily_impact
			FROM umts_kpi.worst_cells_".$family."_region_weekly inner join umts_configuration.ucellsetup
			on umts_kpi.worst_cells_".$family."_region_weekly.rnc= umts_configuration.ucellsetup.rncname
			and umts_kpi.worst_cells_".$family."_region_weekly.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_region_weekly.week between ".$iniweek." and ".$finweek."
			and kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_region_weekly.region = '".$node_query."'
			group by umts_kpi.worst_cells_".$family."_region_weekly.rnc, umts_kpi.worst_cells_".$family."_region_weekly.cellid, cellname
			) as t
			-- where umts_kpi.worst_cells_".$family."_region_weekly.rnc= umts_configuration.ucellsetup.rncname
			-- and umts_kpi.worst_cells_".$family."_region_weekly.cellid= umts_configuration.ucellsetup.cellid
			where umts_kpi.worst_cells_".$family."_region_weekly.rnc= t.rnc
			and umts_kpi.worst_cells_".$family."_region_weekly.cellid= t.cellid
			and umts_kpi.worst_cells_".$family."_region_weekly.kpi = '".$kpi."'
			and umts_kpi.worst_cells_".$family."_region_weekly.week = ".$finweek."
			and umts_kpi.worst_cells_".$family."_region_weekly.region = '".$node_query."'
			order by umts_kpi.worst_cells_".$family."_region_weekly.week, cell_fails desc
			");

	 return $query->result();
	 }		 
	
		function rncaccrrc($rnc_query,$inidate,$findate){
		$query = $this->db->query(
		"select vw_accessibility_rnc_rate.rnc, vw_accessibility_rnc_rate.datetime, 
			acc_rrc, fails_acc_rrc, eff_cs, fails_acc_cs, acc_cs, eff_ps, fails_acc_ps, acc_ps, eff_hsdpa, 
			fails_acc_hsdpa, eff_f2h, fails_f2h, acc_hsdpa, acc_hsdpa_f2h,
			vs_rrc_rej_code_cong,vs_rrc_rej_dlce_cong,vs_rrc_rej_dliubband_cong,vs_rrc_rej_dlpower_cong,vs_rrc_rej_nodebresunavail,
			vs_rrc_rej_redir_dist,vs_rrc_rej_redir_dist_intrarat,vs_rrc_rej_redir_interrat,vs_rrc_rej_redir_intrarat,vs_rrc_rej_redir_service,
			vs_rrc_rej_rl_fail,vs_rrc_rej_sum,vs_rrc_rej_tnl_fail,vs_rrc_rej_ulce_cong,vs_rrc_rej_uliubband_cong,vs_rrc_rej_ulpower_cong,vs_rrc_failconnestab_noreply,vs_rrc_failconnestab_cong
			  FROM umts_kpi.vw_accessibility_rnc_rate,umts_kpi.accessibility_fails_rnc
			WHERE vw_accessibility_rnc_rate.rnc = umts_kpi.accessibility_fails_rnc.rnc
			AND vw_accessibility_rnc_rate.datetime = umts_kpi.accessibility_fails_rnc.datetime
			and vw_accessibility_rnc_rate.datetime between '".$inidate."' and '".$findate." 23:30:00'
			AND vw_accessibility_rnc_rate.rnc = '".$rnc_query."'
			ORDER BY datetime;"
		);
			
	return $query->result();
	}

		
}