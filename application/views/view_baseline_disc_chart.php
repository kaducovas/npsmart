<!--<div id="container" style="width: 1100px; height: 900px; margin: 0 auto"></div>-->
	<?php 

	foreach($ne_discrepancies as $row){

	$date[] = $row->baseline_date;
	$discrepancies[] = $row->discrepancies;
	#$date[$row->node] = $row->baseline_date;
	#$discrepancies[$row->node] = $row->discrepancies;
	#$discrepancies[$row->node] = $row->discrepancies;
}	
//echo $reportmoname;
if ($reportmoname) {
	$title = 'Parameter Check: '.$reportmoname;
}
else {
	$title = 'Parameter Check';
}
			
		 array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
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
var tema = "<?php echo $title; ?>";

var date = <?php echo json_encode($date); ?>;	

var date = JSON.parse("[" + date + "]");

//alert(node);

	///////////////////////////////////START charts////////////////////////////////////////////////
$(function () {
    
    window.chart = new Highcharts.Chart({
        
        chart: {
            renderTo: 'container',
          
        },
        
        title: {
            text: tema,
        },
   
		subtitle: {
			text: reportnename,
			//x: -20
		},   

    
        xAxis: {
			categories: [<?php echo join($date, ',') ?>],
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
            type: 'line',
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
				