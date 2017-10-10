	<?php 
		foreach($result as $row){
		$date[] = $row->date;
		$node = $row->node;
		$qda_cs[] = $row->qda_cs;
		$qda_ps[] = $row->qda_ps;
		$qda_ps_f2h[] = $row->qda_ps_f2h;
		$qdr_cs[] = $row->qdr_cs;
		$qdr_ps[] = $row->qdr_ps;
		$throughput[] = $row->throughput;
		$availability[] = $row->availability;
		$retention_cs[] = $row->retention_cs;
		$retention_ps[] = $row->retention_ps;
		$hsdpa_users_ratio[] = $row->hsdpa_users_ratio;
		$nqi_cs[] = $row->nqi_cs;
		$nqi_ps[] = $row->nqi_ps;
		$nqi_ps_f2h[] = $row->nqi_ps_f2h;
			
		}
		#echo $cellid;
		#echo $cellname;
		#echo $node;
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($eff_cs, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}
var node = "<?php echo $ne; ?>";
var datetime = <?php echo json_encode($date); ?>;	

var datetime = JSON.parse("[" + datetime + "]");
///alert(datetime[0]);	
$(function () {
    var chart;
    $(document).ready(function() {
	
///////////////////////////////////////////////////////////Availability/////////////////////////////////////////////	
		var acc_rrc = new Highcharts.Chart({
		chart: {
				renderTo: 'wcchart1',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'x'//,
				//borderWidth: 2
						///type: 'line',
						///height: 195		
				},
					credits: {
					   enabled: false
					},		
					exporting: { 
					enabled: true 
					},
					title: {
						text: 'Throughput',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						max: 100,
						labels: {
							format: '{value}%',
					///		style: {
					///			color: Highcharts.getOptions().colors[1]
					///		}
						},
						title: {
						///	text: '',
					///		style: {
					///			color: Highcharts.getOptions().colors[1]
					///		}
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}],
				tooltip: {
					shared: true
				},
					
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false,
						borderWidth: 0
					},
					
					plotOptions: {
						series: {
							cursor: 'pointer',
							events: {
								click: function(e) {
								// Log to console
									alert(this.name + ' clicked\n' +
									  'Alt: ' + event.altKey + '\n' +
									  'Control: ' + event.ctrlKey + '\n'+
									  'Shift: ' + event.shifkKey + '\n'+
									  'Datetime: ' + datetime[event.point.x]);
								}
							}
						}
					},
					
					series: [{
					///	showInLegend: false,
						name: 'Throughput HSDPA',
						data: [<?php echo join($throughput, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					]							
		});


    // $('.chart_content').bind('dblclick', function () {
        // var $this = $(this);
        // $this.toggleClass('modal');
        // $('.chart1', $this).highcharts().reflow();
    // });	
	});
   });
</script>