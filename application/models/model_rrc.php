<?php 

class Teste extends CI_Model{
	function query($rnc_query,$cellid_query){
		$query = $this->db->query("SELECT rnc, cellname, cellid, datetime, gp, rrc_efc_num, rrc_efc_den, 
       cs_rab_acc_num, cs_rab_acc_den, cs_acc_num, cs_acc_den, ps_rab_acc_num, 
       ps_rab_acc_den, ps_acc_num, ps_acc_den, hs_acc_num, hs_acc_den
  FROM umts_kpi.accessibility
where rnc = '".$rnc_query."'
AND CELLID = ".$cellid_query);  

	  return $query->result();

	}
}


  ;

