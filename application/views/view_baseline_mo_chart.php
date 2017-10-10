<!--<div id="container" style="width: 1100px; height: 900px; margin: 0 auto"></div>-->
	<?php 

	foreach($parameters_mo as $row){

	$mo = $row->mo;
	$parameter[] = $row->parameter;
	$discrepancies[] = $row->discrepancies;
}	
	
	// foreach($node_daily_report as $row){
		// $date[] = $row->date;
		// $node = $row->node;
		// $acc_rrc[] = $row->acc_rrc;
		// $acc_cs[] = $row->acc_cs;
		// $acc_ps[] = $row->acc_ps;
		// $acc_hsdpa[] = $row->acc_hsdpa;
		// $acc_hsdpa_f2h[] = $row->acc_hsdpa_f2h;
		// $drop_cs[] = $row->drop_cs;
		// $drop_ps[] = $row->drop_ps;
		// $drop_hsdpa[] = $row->drop_hsdpa;
		// $drop_hsupa[] = $row->drop_hsupa;	
		// $sho_succ_rate[] = $row->sho_succ_rate;
		// $soft_hand_succ_rate[] = $row->soft_hand_succ_rate;
		// $hho_intra_freq_succ_rate[] = $row->hho_intra_freq_succ_rate;
		// $cs_hho_intra_freq_rate[] = $row->cs_hho_intra_freq_rate;
		// $ps_hho_intra_freq_succ_rate[] = $row->ps_hho_intra_freq_succ_rate;
		// $hho_inter_freq_succ_rate[] = $row->hho_inter_freq_succ_rate;	
		// $iratho_cs_succ_rate[] = $row->iratho_cs_succ_rate;
		// $iratho_ps_succ_rate[] = $row->iratho_ps_succ_rate;
		// $retention_cs_succ_rate[] = $row->retention_cs_succ_rate;
		// $retention_ps_succ_rate[] = $row->retention_ps_succ_rate;	
		// $sho_over[] = $row->sho_over;
		// $rtwp[] = $row->rtwp;
		// $availability[] = $row->availability;
		// $data_hsdpa[] = $row->data_hsdpa;
		// $data_hsupa[] = $row->data_hsupa;
		// $ps_r99_ul[] = $row->ps_r99_ul;
		// $ps_r99_dl[] = $row->ps_r99_dl;
		// $voice_traffic_dl[] = $row->voice_traffic_dl;
		// $voice_traffic_ul[] = $row->voice_traffic_ul;
		// $hsdpa_users[] = $row->hsdpa_users;
		// $hsupa_users[] = $row->hsupa_users;
		// $dch_users[] = $row->dch_users;
		// $pch_users[] = $row->pch_users;
		// $fach_users[] = $row->fach_users;
		// $ps_nonhs_users[] = $row->ps_nonhs_users;
		// $thp_hsdpa[] = $row->thp_hsdpa;
		// $thp_hsupa[] = $row->thp_hsupa;
		// }	
		
			
		// array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		// //echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		
		// //echo "<br><br>";
		// //echo join($acc_rrc, ',');
		// #echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		 // function tonull($n)
		// {
			// if($n == ''){
				// $n = 0;
				// #return $n;				
			// }
				// return $n;
		// }
		// $dch_users = array_map("tonull", $dch_users);
		// $pch_users = array_map("tonull", $pch_users);
		// $fach_users = array_map("tonull", $fach_users);
		// $data_hsdpa = array_map("tonull", $data_hsdpa);
		// $data_hsupa = array_map("tonull", $data_hsupa);
		// $ps_r99_ul = array_map("tonull", $ps_r99_ul);
		// $ps_r99_dl = array_map("tonull", $ps_r99_dl);
		// $hsdpa_users = array_map("tonull", $hsdpa_users);
		// $hsupa_users = array_map("tonull", $hsupa_users);
		// $ps_nonhs_users = array_map("tonull", $ps_nonhs_users);
		// $thp_hsdpa = array_map("tonull", $thp_hsdpa);
		// $thp_hsupa = array_map("tonull", $thp_hsupa);
		// $rtwp = array_map("tonull", $rtwp);
		// $availability = array_map("tonull", $availability);
		
		// // print_r(array_keys($thp_hsdpa, 0));
		// // echo "<br><br>";
		// // print_r($thp_hsdpa);
		?>
		
<script>
var mo = "<?php echo $mo; ?>";
//alert(node);
var parameter = <?php echo json_encode($parameter); ?>;

	///////////////////////////////////START charts////////////////////////////////////////////////
$(function () {
    
    window.chart = new Highcharts.Chart({
        
        chart: {
            renderTo: 'acc',
          
        },
        
        title: {
            text: mo
        },
   
		subtitle: {
			text: reportnename,
			//x: -20
		},   

    
        xAxis: {
				categories: <?php echo json_encode($parameter); ?>,
				// labels: {autoRotation:false, 
						  // style: {
							  // textOverflow: 'none',
							  // fontSize: '20px',
							 // fontFamily: 'Calibri'
						  // }},
				tickInterval: 1,
				//gridLineColor: '#808080',
    
                  labels: {
					   rotation: -0,
            style: {
                //color: '#525151',
                font: '12px Calilbri',
                fontWeight: 'bold'
            },
            formatter: function () {
                return this.value;
            }
        },
        },

// yAxis: [{
		// max:100,
		// reversed: Boolean,
        // gridLineColor: '#808080',
        // lineColor: '#808080',
        // minorGridLineColor: '#808080',
        // tickColor: '#808080',
        // plotLines: [{
            // color: '#808080'
        // }],
        // labels: {
            // style: {
                // color: '#1700fc',
                // font: '16px Calilbri',
                // fontWeight: 'bold'
            // },
            // formatter: function () {
                // return this.value;
            // }
        // },
        // title: {
            // text: null
        // }
    // }],  

  
        // yAxis: {
            // //min: 95,
            // max:100,
			// reversed: Boolean,
			// // labels: {autoRotation:false, 
			// // style: {
				// // textOverflow: 'none',
				// // fontSize: '16px',
				// // fontFamily: 'Calibri'
				// // }},
			
        // },
        
  plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    
        series: [{
            type: 'column',
            name: 'Discrepanciess',
			//color:'red',
            data: [<?php echo join($discrepancies, ',') ?>],
            //pointPlacement: 'between'
        }],
		dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    });
});
</script>				
				