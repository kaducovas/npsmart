	<?php 
		foreach($result as $row){
			#$rnc = $row->rnc;
			#$cellname =  $row->cellname;
			#$cellid = $row->cellid;
			$datetime[] = $row->datetime;
			$acc_rrc[] = $row->acc_rrc;	
			$acc_cs[] = $row->acc_cs;	
			$eff_hsdpa[] = $row->eff_hsdpa;	
			$eff_f2h[] = $row->eff_f2h;	
			$acc_hsdpa[] = $row->acc_hsdpa;	
			$acc_hsdpa_f2h[] = $row->acc_hsdpa_f2h;	
			$drop_cs[] = $row->drop_cs;	
			$drop_ps[] = $row->drop_ps;	
			$retention_cs[] = $row->retention_cs;	
			$retention_ps[] = $row->retention_ps;	
			$unavailability[] = $row->unavailability;
			$fails_acc_rrc[] = $row->fails_acc_rrc;
			$fails_acc_cs[] = $row->fails_acc_cs;
			$fails_drop_cs[] = $row->fails_drop_cs;
			$fails_drop_ps[] = $row->fails_drop_ps;
 			
		}
		array_walk($datetime, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}

var datetime = <?php echo json_encode($datetime); ?>;	

var datetime = JSON.parse("[" + datetime + "]");
///alert(datetime[0]);	
$(function () {
    var chart;
    $(document).ready(function() {
	
///////////////////////////////////////////////////////////ACCESSIBILITY RRC/////////////////////////////////////////////	
		var acc_rrc = new Highcharts.Chart({
		chart: {
				renderTo: 'acc_rrc',
				alignTicks:false,
				zoomType: 'x'		
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
						text: 'RRC Accessibility',
						x: -20 //center
					},
					///subtitle: {
					///	text: 'RNC= '.$rnc,
					///	x: -20
				///	},
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
							text: 'RRC Fails',
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
						align: 'left',
						verticalAlign: 'top',
						floating: true,
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
						name: 'RRC Accessibility',
						data: [<?php echo join($acc_rrc, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'RRC Fails',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($fails_acc_rrc, ',') ?>]
			        }
					]							
		});
		
///////////////////////////////////////////////////////////ACCESSIBILITY CS/////////////////////////////////////////////		
	
		var acc_cs = new Highcharts.Chart({
		chart: {
				renderTo: 'acc_cs',
				alignTicks:false,
				zoomType: 'x'		
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
					///subtitle: {
					///	text: 'RNC= '.$rnc,
				///		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						max: 100,
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'horizontal',
						align: 'left',
						verticalAlign: 'top',
						floating: true,
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'CS Accessibility',
						data: [<?php echo join($acc_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});
		
		

///////////////////////////////////////////////////////////ACCESSIBILITY HSDPA/////////////////////////////////////////////		
	
		var acc_hsdpa = new Highcharts.Chart({
		chart: {
				renderTo: 'acc_hsdpa',
				zoomType: 'xy'		
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
						text: 'HS Accessibility',
						x: -20 //center
					},
					///subtitle: {
					///	text: 'RNC= '.$rnc,
					///	x: -20
					///},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						max: 100,
						///min: 0,
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'horizontal',
						align: 'left',
						verticalAlign: 'top',
						floating: true,
						borderWidth: 0
					},
					series: [{
						///showInLegend: false,
						name: 'HS Acc',
						data: [<?php echo join($acc_hsdpa, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'HS Acc(F2H)',
			        ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($acc_hsdpa_f2h, ',') ?>]
			        },
					{
			            name: 'F2H SR',
			        ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($eff_f2h, ',') ?>]
			        },
					{
			            name: 'HSDPA SR',
			        ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($eff_hsdpa, ',') ?>]
			        }
					]							
		});


///////////////////////////////////////////////////////////DROP CS/////////////////////////////////////////////	
		var drop_cs = new Highcharts.Chart({
		chart: {
				renderTo: 'drop_cs',
				zoomType: 'x'		
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
						text: 'DROP CS',
						x: -20 //center
					},
				///	subtitle: {
					///	text: 'RNC= '.$rnc,
				///		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'horizontal',
						align: 'left',
						verticalAlign: 'top',
						floating: true,
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'DROP CS',
						data: [<?php echo join($drop_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});

///////////////////////////////////////////////////////////DROP PS/////////////////////////////////////////////	
		var drop_ps = new Highcharts.Chart({
		chart: {
				renderTo: 'drop_ps',
				zoomType: 'x'		
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
						text: 'DROP PS',
						x: -20 //center
					},
				///	subtitle: {
					///	text: 'RNC= '.$rnc,
				//		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'horizontal',
						align: 'left',
						verticalAlign: 'top',
						floating: true,
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'DROP PS',
						data: [<?php echo join($drop_ps, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});		
		
///////////////////////////////////////////////////////////RETENTION CS/////////////////////////////////////////////	
		var retention_cs = new Highcharts.Chart({
		chart: {
				renderTo: 'retention_cs',
				zoomType: 'x'		
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
						text: 'CS 3G Retention',
						x: -20 //center
					},
				///	subtitle: {
					///	text: 'RNC= '.$rnc,
				///		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						max: 100,
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'CS 3G Retention',
						data: [<?php echo join($retention_cs, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});		
		
///////////////////////////////////////////////////////////RETENTION PS/////////////////////////////////////////////	
		var retention_ps = new Highcharts.Chart({
		chart: {
				renderTo: 'retention_ps',
				zoomType: 'x'		
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
						text: 'PS 3G Retention',
						x: -20 //center
					},
				///	subtitle: {
					///	text: 'RNC= '.$rnc,
				///		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						max: 100,
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'PS 3G Retention',
						data: [<?php echo join($retention_ps, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});		

///////////////////////////////////////////////////////////UNAVAILABILITY/////////////////////////////////////////////	
		var unavailability = new Highcharts.Chart({
		chart: {
				renderTo: 'unavailability',
				zoomType: 'x'		
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
						text: 'Unavailability',
						x: -20 //center
					},
				///	subtitle: {
					///	text: 'RNC= '.$rnc,
				///		x: -20
				///	},
					xAxis: {
						categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},
					yAxis: {
						max: 100,
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
						valueSuffix: '%'
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						showInLegend: false,
						name: 'Unavailability',
						data: [<?php echo join($unavailability, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
			//		,{
			//            name: 'New York',
			//            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			//			data: [<?php echo join($acc_hsdpa, ',') ?>]
			//        }
					]							
		});		
		
		
		
		
    });
	
    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
	//    $('.chart_content').bind('dblclick', function () {
    //    var $this = $(this);
    //    $this.toggleClass('modal');
    //    $('.chart1', $this).highcharts().reflow();
   // });	
	
   });
</script>