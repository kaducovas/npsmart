<?php 

class Teste extends CI_Model{
	function query($rnc_query,$cellid_query){
		$query = $this->db->query("SELECT id, A.rnc, A.cellname, A.cellid, A.datetime, gp, 
       vs_tp_ue_0, vs_tp_ue_1,
       vs_tp_ue_2, vs_tp_ue_3, vs_tp_ue_4, 
       vs_tp_ue_5, vs_tp_ue_6_9, vs_tp_ue_10_15,
       vs_tp_ue_16_25, vs_tp_ue_26_35, 
       vs_tp_ue_36_55, vs_tp_ue_more55 
	  FROM stg_67109365 A, (select rnc, cellid, max(datetime) AS max_date
		FROM stg_67109365
		WHERE rnc='".$rnc_query."' and cellid = ".$cellid_query."
		group by rnc, cellid) B 
	  where A.rnc='".$rnc_query."' and A.cellid = ".$cellid_query."
	  AND A.datetime = B.max_date");
	  
/* 		$query = $this->db->query("SELECT id, rnc, cellname, cellid, datetime, gp, 
       vs_tp_ue_0, vs_tp_ue_1,
       vs_tp_ue_2, vs_tp_ue_3, vs_tp_ue_4, 
       vs_tp_ue_5, vs_tp_ue_6_9, vs_tp_ue_10_15,
       vs_tp_ue_16_25, vs_tp_ue_26_35, 
       vs_tp_ue_36_55, vs_tp_ue_more55 
	  FROM stg_67109365
	  where rnc='".$rnc_query."' and cellid = ".$cellid_query."
	   limit 1;"); */
	  return $query->result();
/* 		if($query -> num_rows() >= 1){
				RETURN $query=>result();
		} else {
			return false;
		}   */
	}
}


