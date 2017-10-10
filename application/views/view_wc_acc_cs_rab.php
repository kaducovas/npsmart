	<?php 
		foreach($result as $row){
			$node = $row->node;
			#$cellname =  $row->cellname;
			#$cellid = $row->cellid;
			$datetime[] = $row->datetime;
			$acc_rrc[] = $row->acc_rrc;	
			//echo $row->acc_rrc;
			$eff_cs[] = $row->eff_cs;	
			$acc_cs[] = $row->acc_cs;	
			$eff_ps[] = $row->eff_ps;	
			$acc_ps[] = $row->acc_ps;	
			$eff_hsdpa[] = $row->eff_hsdpa;	
			$eff_f2h[] = $row->eff_f2h;	
			$acc_hsdpa[] = $row->acc_hsdpa;	
			$acc_hsdpa_f2h[] = $row->acc_hsdpa_f2h;
			$fails_acc_rrc[] = $row->fails_acc_rrc;
			$fails_acc_cs[] = $row->fails_acc_cs;
			$fails_acc_ps[] = $row->fails_acc_ps;
			$fails_acc_hsdpa[] = $row->fails_acc_hsdpa;
			$fails_f2h[] = $row->fails_f2h;
			 $vs_rab_failestabcs_code_cong[] = $row->vs_rab_failestabcs_code_cong;
			 $vs_rab_failestabcs_cong[] = $row->vs_rab_failestabcs_cong;
			 $vs_rab_failestabcs_dlce_cong[] = $row->vs_rab_failestabcs_dlce_cong;
			 $vs_rab_failestabcs_dliubband_cong[] = $row->vs_rab_failestabcs_dliubband_cong;
			 $vs_rab_failestabcs_dlpower_cong[] = $row->vs_rab_failestabcs_dlpower_cong;
			 $vs_rab_failestabcs_iubfail[] = $row->vs_rab_failestabcs_iubfail;
			 $vs_rab_failestabcs_phychfail[] = $row->vs_rab_failestabcs_phychfail;
			 $vs_rab_failestabcs_rbcfgunsup[] = $row->vs_rab_failestabcs_rbcfgunsup;
			 $vs_rab_failestabcs_rbinccfg[] = $row->vs_rab_failestabcs_rbinccfg;
			 $vs_rab_failestabcs_rnl[] = $row->vs_rab_failestabcs_rnl;
			 $vs_rab_failestabcs_tnl[] = $row->vs_rab_failestabcs_tnl;
			 $vs_rab_failestabcs_ulce_cong[] = $row->vs_rab_failestabcs_ulce_cong;
			 $vs_rab_failestabcs_uliubband_cong[] = $row->vs_rab_failestabcs_uliubband_cong;
			 $vs_rab_failestabcs_ulpower_cong[] = $row->vs_rab_failestabcs_ulpower_cong;
			 $vs_rab_failestabcs_unsp[] = $row->vs_rab_failestabcs_unsp;
			 $vs_rab_failestabcs_uufail[] = $row->vs_rab_failestabcs_uufail;
			 $vs_rab_failestabcs_uunoreply[] = $row->vs_rab_failestabcs_uunoreply;
		}
		#echo $cellid;
		#echo $cellname;
		#echo $node;
		array_walk($datetime, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
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
var datetime = <?php echo json_encode($datetime); ?>;	

var datetime = JSON.parse("[" + datetime + "]");
///alert(datetime[0]);	
$(function () {
    var chart;
    $(document).ready(function() {
	
///////////////////////////////////////////////////////////ACCESSIBILITY RAB CS/////////////////////////////////////////////	
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
						text: 'CS Accessibility',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
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
					}, { // Secondary yAxis
						title: {
							text: 'RAB CS Fails',
				///			style: {
				///				color: Highcharts.getOptions().colors[0]
				///			}
						},
						labels: {
						///	format: '{value}%',
				///			style: {
				///				color: Highcharts.getOptions().colors[0]
				///			}
						},
						opposite: true
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
						name: 'CS Accessibility',
						data: [<?php echo join($acc_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'RAB CS Fails',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($fails_acc_cs, ',') ?>]
			        }
					]							
		});
		
///////////////////////////////////////////////////////////FAILS RRC/////////////////////////////////////////////		
	
		var fails_rrc = new Highcharts.Chart({
		chart: {
				renderTo: 'wcchart2',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy',
				//borderWidth: 2		
						type: 'column'//,
						///height: 195		
				},
					credits: {
					   enabled: false
					},		
					exporting: { 
					enabled: true 
					},
					title: {
						text: 'RAB CS Fails',
					//	 floating: true,
						x: -20, //center
						//y: 0
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						///max: 100,
						min: 0,
						title: {
							//text: 'Temperature (°C)'
						},
						//{  },
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
						
					},
					tooltip: {
					///	valueSuffix: '%'
					shared: true
					},
					plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false,
										color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
										style: {
											textShadow: '0 0 3px black'
										}
									}
								}
							},
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom',
						floating: false,
						borderWidth: 0
					},
								
					series: [{
						name: 'Code Congestion',
						data: [<?php echo join($vs_rab_failestabcs_code_cong, ',') ?>]
					},
					{
			            name: 'DLPower Congestion',
						data: [<?php echo join($vs_rab_failestabcs_dlpower_cong, ',') ?>]
			        },
					{
			            name: 'ULPower Congestion',
						data: [<?php echo join($vs_rab_failestabcs_ulpower_cong, ',') ?>]
			        },
					{
			            name: 'DLCE Congestion',
						data: [<?php echo join($vs_rab_failestabcs_dlce_cong, ',') ?>]
			        },
					{
			            name: 'ULCE Congestion',
						data: [<?php echo join($vs_rab_failestabcs_ulce_cong, ',') ?>]
			        },
					
					{
			            name: 'DLIUBBAND Congestion',
						data: [<?php echo join($vs_rab_failestabcs_dliubband_cong, ',') ?>]
			        },
					
					{
			            name: 'ULIUBBAND Congestion',
						data: [<?php echo join($vs_rab_failestabcs_uliubband_cong, ',') ?>]
			        },
					
					{
			            name: 'No Reply',
						data: [<?php echo join($vs_rab_failestabcs_uunoreply, ',') ?>]
			        },	
					{
			            name: 'Uu Fail',
						data: [<?php echo join($vs_rab_failestabcs_uufail, ',') ?>]
			        },	
					{
			            name: 'IUB Fail',
						data: [<?php echo join($vs_rab_failestabcs_iubfail, ',') ?>]
			        }
					,	
					{
			            name: 'RNL Fail',
						data: [<?php echo join($vs_rab_failestabcs_rnl, ',') ?>]
			        }
					,	
					{
			            name: 'TNL Fail',
						data: [<?php echo join($vs_rab_failestabcs_tnl, ',') ?>]
			        }
											
					]							
		});			

  });


    // $('.chart_content').bind('dblclick', function () {
        // var $this = $(this);
        // $this.toggleClass('modal');
        // $('.chart1', $this).highcharts().reflow();
    // });	
	
   });
</script>