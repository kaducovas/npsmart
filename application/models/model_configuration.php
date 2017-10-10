<?php 
ini_set('memory_limit', '2048M');
class Model_configuration extends CI_Model{
	// function cells(){
		// $query = $this->db->query(
		// "select * from umts_control.cells order by rnc,cellname limit 3;");

	// return $query->result();
	// }

	function rnc_cfg(){
		$query = $this->db->query(
		"select * from umts_configuration.ucellsetup;");
		#"select * from umts_control.rnc_info;");

	return $query->result_array();
	}
	
}