			<?php 
		
		foreach($result as $row){
			$rnc = $row->rnc;
			$cellname =  $row->cellname;
			$date = $row->datetime;
			$data[] = $row->vs_tp_ue_0;
			$data[] = $row->vs_tp_ue_1;
			$data[] = $row->vs_tp_ue_2;
			$data[] = $row->vs_tp_ue_3;
			$data[] = $row->vs_tp_ue_4; 
			$data[] = $row->vs_tp_ue_5;
			$data[] = $row->vs_tp_ue_6_9; 
			$data[] = $row->vs_tp_ue_10_15;
			$data[] = $row->vs_tp_ue_16_25;
			$data[] = $row->vs_tp_ue_26_35; 
			$data[] = $row->vs_tp_ue_36_55; 
			$data[] = $row->vs_tp_ue_more55;	
		}
		?>
	<script>
$(function () {
    $('#body').highcharts({
        chart: {
            type: 'column'
        },
		title: {
            text: 'TP Samples'
        },

        subtitle: {
            text: '<?php echo "<b>RNC:</b> ".$rnc. " - <b>Cellname: </b>".$cellname. " - <b>Date: </b>".$date;?>'
        },


        xAxis: {
            categories: ['0-234m', '234m-468m', '468m-702m', '702m-936m', '936m-1.1km', '1.1km-1.4km', '1.4km-2.3km', '2.3km-3.7km', '3.7km-6.1km', '6.1km-8.4km', '8.4km-13km', '13km-47km']
        },

		yAxis: {
			title: {
				text: "# TP Samples"
			}
        },
		
        series: [{
			name: "Propagation Delay",
			color: "#0000FF",
            data: [<?php echo join($data, ',') ?>],
        }]
    });
});
</script>	