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
							},{
								name: 'CS Accessibility',
							///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
								data: [<?php echo join($acc_cs, ',') ?>]
							},
							{
								name: 'RAB CS SR',
							///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
								data: [<?php echo join($eff_cs, ',') ?>]
							},
							
							{
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