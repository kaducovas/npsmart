<?php 

class Model_cellsinfo extends CI_Model{
	function rncs(){
		$query = $this->db->query(
		"select distinct rnc as node from umts_control.cells_database order by rnc;");

	return $query->result();
	}
	
	function regional(){
		$query = $this->db->query(
		"select distinct region as node from umts_control.cells_database order by region;");

	return $query->result();
	}
	
	function cidades(){
		$query = $this->db->query(
		"select distinct cidade as node, ibge from umts_control.cells_database where cidade is not null order by cidade;");

	return $query->result();
	}
	
	function cidades_lte(){
		$query = $this->db->query(
		"SELECT distinct cidade as node FROM lte_control.cells order by cidade;");

	return $query->result();
	}	
	
	function clusters(){
		$query = $this->db->query(
		"select distinct cluster as node from umts_control.cells_database order by cluster;");

	return $query->result();
	}
	
	function clusters_lte(){
		$query = $this->db->query(
		"select distinct clustername as node from lte_control.clusters order by clustername;");

	return $query->result();
	}	
	
	function ufs(){
		$query = $this->db->query(
		"select distinct substring(cluster,1,2) as node from umts_control.cells_database where cluster is not null order by substring(cluster,1,2);");

	return $query->result();
	}

	function enodebs(){
		$query = $this->db->query(
		"select distinct site as node from lte_control.cells order by site;");

	return $query->result();
	}
	
	function nodebs(){
		$query = $this->db->query(
		"select distinct nodebname as node from umts_configuration.ucellsetup order by nodebname;");

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
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'umts_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}
	
	function nodeb_mos(){
		$query = $this->db->query(
		"SELECT distinct table_name as mo FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'umts_nodeb_configuration' and table_name not in ('parameters') order by table_name;");

	return $query->result();
	}	
	
	function adjnode(){
		$query = $this->db->query(
		"select distinct name as node from umts_configuration.adjnode order by name;");

	return $query->result();
	}

	function find_cidade_info($cidade){
			$query = $this->db->query(
			"select distinct ibge,uf from umts_control.cells_database where cidade = '".$cidade."';");

		return $query->result();
		}

	function find_cluster_info($cluster){
			$query = $this->db->query(
			"SELECT cluster_id, uf FROM umts_control.claro_cluster where cluster = '".$cluster."';");

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
		"select max(datetime)::date from umts_control.log_kpi WHERE oss in (".$filter.");");
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
function reference_date_daily($node){
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
		"select min(date) date from (select max(date) date,oss from umts_control.log_daily WHERE oss in (".$filter.") group by oss) t;");
		#"select max(date) from umts_control.log_daily WHERE oss in (".$filter.");");
		#$referencedate = date("Y-m-d");
		#$referencedate = date('Y-m-d', strtotime($referencedate.' -1 day'));
		#return $referencedate;
		$return = $query->row(0)->date;
		return $return;
	}	
}