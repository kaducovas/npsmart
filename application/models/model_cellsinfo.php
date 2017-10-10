<?php 

class Model_cellsinfo extends CI_Model{
	function rncs(){
		$query = $this->db->query(
		"select distinct rnc as node from umts_control.cells_db order by rnc;");

	return $query->result();
	}
	
	function regional(){
		$query = $this->db->query(
		"select distinct region as node from umts_control.cells_database order by region;");

	return $query->result();
	}
	
	function regional_lte(){
		$query = $this->db->query(
		"select distinct region as node from lte_control.cells order by region;");

	return $query->result();
	}
	
	function regional_gsm(){
		$query = $this->db->query(
		"SELECT DISTINCT regional as node FROM gsm_control.cells_db ORDER BY regional;");

	return $query->result();
	}

	function ufs_gsm(){
		$query = $this->db->query(
		"select distinct uf as node from gsm_control.cells_db order by uf;");

	return $query->result();
	}
	
	function bsc(){
		$query = $this->db->query(
		"SELECT DISTINCT bsc as node FROM gsm_control.cells_db ORDER BY bsc;");

	return $query->result();
	}
	
	function bts(){
		$query = $this->db->query(
		"SELECT DISTINCT bts as node FROM gsm_control.cells_db ORDER BY bts;");

	return $query->result();
	}
	
	function cidades(){
		$query = $this->db->query(
		#"select distinct cidade as node, ibge from umts_control.cells_database where cidade is not null order by cidade;");
		"SELECT DISTINCT concat(cidade,' - ',uf) as node, ibge FROM umts_control.cells_db where cidade is not null order by node;");
	return $query->result();
	}
	
	function cidades_lte(){
		$query = $this->db->query(
		"SELECT DISTINCT concat(cidade,' - ',uf) as node, ibge FROM lte_control.cells where cidade is not null order by node;");

	return $query->result();
	}	
	
	function cidades_gsm(){
		$query = $this->db->query(
		"SELECT DISTINCT concat(cidade,' - ',uf) as node, ibge FROM gsm_control.cells_db WHERE not cidade is null ORDER BY node;");

	return $query->result();
	}
	
	function clusters(){
		$query = $this->db->query(
		"select distinct cluster as node from umts_control.cells_database order by cluster;");

	return $query->result();
	}

	function custom(){
		$query = $this->db->query(
		"select distinct cluster as node from umts_control.claro_cluster where user_created = true;");

	return $query->result();
	}	
	
	
	function clusters_lte(){
		$query = $this->db->query(
		"select distinct cluster as node from LTE_control.claro_cluster order by node;");

	return $query->result();
	}	
	
	function ufs(){
		$query = $this->db->query(
		"select distinct substring(cluster,1,2) as node from umts_control.cells_database where cluster is not null order by substring(cluster,1,2);");

	return $query->result();
	}
	
	function ufs_lte(){
		$query = $this->db->query(
		"select distinct uf as node from lte_control.cells order by uf;");

	return $query->result();
	}

	function enodebs(){
		$query = $this->db->query(
		#"SELECT distinct get_enodeb_name(main_kpis_lte_daily.enodeb,'enodeb') as node FROM lte_kpi.main_kpis_lte_daily WHERE date = (select max(date) FROM lte_control.log_daily)::date ORDER BY get_enodeb_name(main_kpis_lte_daily.enodeb,'enodeb');");
		"SELECT distinct site as node from lte_control.cells order by node;");
	return $query->result();
	}
	
	function find_cellid_from_enodebs($node){
		$query = $this->db->query(
		"select site,cellid from lte_control.cells where cell = '".$node."';");

	return $query->result();
	}	
	
	function nodebs(){
		$query = $this->db->query(
		"SELECT distinct nodebname_norm as node from umts_control.cells_database ORDER by nodebname_norm;");
		#"SELECT distinct get_nodeb_name(main_kpis_daily.cellname, 'cell'::text) AS node FROM umts_kpi.main_kpis_daily WHERE date = (select max(date) FROM umts_control.log_daily)::date ORDER BY get_nodeb_name(main_kpis_daily.cellname, 'cell'::text);");
		#		"SELECT distinct nodebname as node FROM umts_configuration.ucellsetup ORDER BY node;;");

	return $query->result();
	}
	
	function nodebs_cells_db(){
		$query = $this->db->query(
		"select distinct nodeb as node from umts_control.cells_database order by nodeb;");

	return $query->result();
	}	
	
	function cells(){
		$query = $this->db->query(
		"select distinct cellname as node from umts_configuration.ucellsetup order by cellname;");

	return $query->result();
	}	

	function mos(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'umts_configuration' and table_name not in ('parameters') and table_name not like '%history%' order by table_name;");

	return $query->result();
	}
	
	function nodeb_mos(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'umts_nodeb_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}

	function nodeb_mo(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'nodeb_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}	
	
	function enodeb_mo(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'enodeb_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}

	function sran_mo(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'sran_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}		
	
	function adjnode(){
		$query = $this->db->query(
		"select distinct name as node from umts_configuration.adjnode order by name;");

	return $query->result();
	}

	function find_cidade_info_lte($cidade){
			$query = $this->db->query(
			"select distinct ibge,uf from lte_control.cells where cidade = split_part('".$cidade."',' - ',1) AND uf = split_part('".$cidade."',' - ',2);");

		return $query->result();
		}	
	
	function find_cidade_info($cidade){
			$query = $this->db->query(
			#"select distinct ibge,uf from umts_control.cells_database where cidade = '".$cidade."' and ibge not in (4117602);");
			"select distinct ibge,uf from umts_control.cells_db where cidade = split_part('".$cidade."',' - ',1) AND uf = split_part('".$cidade."',' - ',2);");
		return $query->result();
		}
		
	function find_cidade_info_gsm($cidade){
			$query = $this->db->query(
			"select distinct ibge,uf from gsm_control.cells_db where cidade = split_part('".$cidade."',' - ',1) AND uf = split_part('".$cidade."',' - ',2);");

		return $query->result();
		}

	function find_cluster_info($cluster){
			$query = $this->db->query(
			"SELECT cluster_id, uf FROM umts_control.claro_cluster where cluster = '".$cluster."';");

		return $query->result();
		}

	function find_cluster_info_lte($cluster){
			$query = $this->db->query(
			"SELECT cluster_id, uf FROM lte_control.claro_cluster where cluster = '".$cluster."';");

		return $query->result();
		}
		
	function find_nodeb_from_cell($cell){
			$query = $this->db->query(
			"SELECT nodeb FROM umts_control.cells_database where cell = '".$cell."';");

		return $query->result();
		}
	function find_enodeb_from_cell($cell){
			$query = $this->db->query(
			"SELECT site FROM lte_control.cells where cell = '".$cell."' limit 1;");

		return $query->result();
		}

	function find_max_datetime_from_main_kpis(){
			$query = $this->db->query(
			"select max(datetime) as datetime from umts_kpi.main_kpis_cluster;");

		return $query->result();
		}

	function find_max_datetime_from_main_kpis_lte(){
			$query = $this->db->query(
			"select max(datetime) as datetime from lte_kpi.main_kpis_lte_cluster;");

		return $query->result();
		}		
		
		
	function find_cellid($cellname){
		$query = $this->db->query(
		"select cellid,rnc from umts_control.cells_database where cell = '".$cellname."';");

	return $query->result();
	}			

	function reference_date($node){
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		if($node == 'NETWORK'){
			$filter = "'ATAE','40','15'";
		}
		elseif (in_array($node, $regions)) {
			switch ($node) {
				case 'CO':
					$filter = "'ATAE','15'";
					break;
				case 'PRSC':
					$filter = "'ATAE'";
					break;
				case 'NE':
					$filter = "'40'";
					break;
				case 'BASE':
					$filter = "'40'";
					break;
				case 'ES':
					$filter = "'ATAE'";
					break;
				case 'MG':
					$filter = "'15'";
					break;	
			}
		}
		elseif(substr($node,0,3) == 'RNC'){
			$query = $this->db->query(
				"select partition from umts_control.reference_network where name = '".$node."';");
			$ossip = $query->row(0)->partition;
			
			if($ossip == '10.119.90.15'){
				$filter = "'15'";
			} elseif($ossip == '10.119.90.40'){
				$filter = "'40'";
			} elseif($ossip == '10.123.246.22' || $ossip == '10.123.246.23'){
				$filter = "'ATAE'";
			}
		} else {
			$filter = "'ATAE','40','15'";
		}
	
		$query = $this->db->query(
		"select max(datetime)::date from umts_control.log_kpi;");
#		"select max(datetime)::date from umts_control.log_kpi WHERE oss in (".$filter.");");
		#"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
		if ($query->num_rows() > 0){
			$return = $query->row(0)->max;
		 } 
		if($return == ""){
			$query = $this->db->query(
			"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
			#$referencedate = date("Y-m-d");
			#$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			#return $referencedate;
			$return = $query->row(0)->max;
		}
		return $return;
	}

	// function reference_date_lte($node){	
	// $query = $this->db->query(
		// "select max(datetime)::date from lte_control.log_kpi;");
		// #"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
		// if ($query->num_rows() > 0){
			// $return = $query->row(0)->max;
		 // } 
		// if($return == ""){
			// $query = $this->db->query(
			// "select max(date) from lte_control.log_daily;");
			// #$referencedate = date("Y-m-d");
			// #$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			// #return $referencedate;
			// $return = $query->row(0)->max;
		// }
	// }
	function reference_date_lte($node){	
		$query = $this->db->query(
		"select max(datetime)::date from lte_control.log_kpi;");
		#"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
		if ($query->num_rows() > 0){
			$return = $query->row(0)->max;
		 } 
		if($return == ""){
			$query = $this->db->query(
			"select max(date) from lte_control.log_daily;");
			#$referencedate = date("Y-m-d");
			#$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			#return $referencedate;
			$return = $query->row(0)->max;
		}
		return $return;
	}	
	
	function reference_date_gsm($node){
		$query = $this->db->query(
		"select max(datetime)::date from lte_control.log_kpi;");
		#"select max(date) from gsm_control.log_daily WHERE oss in (".$filter.");");
		if ($query->num_rows() > 0){
			$return = $query->row(0)->max;
		 } 
		if($return == ""){
			$query = $this->db->query(
			"select max(date) from gsm_control.log_daily;");
			#$referencedate = date("Y-m-d");
			#$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
			#return $referencedate;
			$return = $query->row(0)->max;
		}
		return $return;
	}
	
function reference_date_daily($node){
		$regions = array("CO", "PRSC", "NE", "BASE","ES","MG");
		if($node == 'NETWORK'){
			$filter = "'ATAE','15'";
		}
		elseif (in_array($node, $regions)) {
			switch ($node) {
				case 'CO':
					$filter = "'ATAE','15'";
					break;
				case 'PRSC':
					$filter = "'ATAE'";
					break;
				case 'NE':
					$filter = "'40'";
					break;
				case 'BASE':
					$filter = "'40'";
					break;
				case 'ES':
					$filter = "'ATAE'";
					break;
				case 'MG':
					$filter = "'15'";
					break;	
			}
		}
		elseif(substr($node,0,3) == 'RNC'){
			$query = $this->db->query(
				"select partition from umts_control.reference_network where name = '".$node."';");
			$ossip = $query->row(0)->partition;
			
			if($ossip == '10.119.90.15'){
				$filter = "'15'";
			} elseif($ossip == '10.119.90.40'){
				$filter = "'40'";
			} elseif($ossip == '10.123.246.22' || $ossip == '10.123.246.23'){
				$filter = "'ATAE'";
			}
		} else {
			$filter = "'ATAE','15'";
		}
	
		$query = $this->db->query(
		"select min(date) date from (select max(date) date,oss from umts_control.log_daily WHERE oss in (".$filter.") group by oss) t;");
		#"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
		#$referencedate = date("Y-m-d");
		#$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
		#return $referencedate;
		$return = $query->row(0)->date;
		return $return;
	}	
	
function reference_date_($node){
			
		$query = $this->db->query(
		"select max(date) date from umts_control.log_daily;");
		$return = $query->row(0)->date;
		return $return;
	}	
	
}