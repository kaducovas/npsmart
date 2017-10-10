	<?php 
	foreach($dash_histogram as $row){
		$week[] = $row->week;
		$node = $row->node;
		$range[] = $row->range;
		$dlpower_count[] = $row->dlpower_count;
		$code_count[] = $row->code_count;
		$fach_count[] = $row->fach_count;
		$rach_count[] = $row->rach_count;
		$dlce_count[] = $row->dlce_count;
		$ulce_count[] = $row->ulce_count;
		$pch_count[] = $row->pch_count;
		$cnbap_count[] = $row->cnbap_count;
		$vs_rrc_rej_dlpower_cong[] = $row->vs_rrc_rej_dlpower_cong;
		$vs_rab_failestabcs_dlpower_cong[] = $row->vs_rab_failestabcs_dlpower_cong;
		$vs_rab_failestabps_dlpower_cong[] = $row->vs_rab_failestabps_dlpower_cong;
		$vs_rrc_rej_code_cong[] = $row->vs_rrc_rej_code_cong;
		$vs_rab_failestabcs_code_cong[] = $row->vs_rab_failestabcs_code_cong;
		$vs_rab_failestabps_code_cong[] = $row->vs_rab_failestabps_code_cong;		
		$vs_fach_ccch_cong_time[] = $row->vs_fach_ccch_cong_time;		
		$vs_fach_dcch_cong_time[] = $row->vs_fach_dcch_cong_time;		
		$vs_fach_dtch_cong_time[] = $row->vs_fach_dtch_cong_time;		
		$vs_rrc_rej_dlce_cong[] = $row->vs_rrc_rej_dlce_cong;		
		$vs_rab_failestabcs_dlce_cong[] = $row->vs_rab_failestabcs_dlce_cong;		
		$vs_rab_failestabps_dlce_cong[] = $row->vs_rab_failestabps_dlce_cong;		
		$vs_rrc_rej_ulce_cong[] = $row->vs_rrc_rej_ulce_cong;		
		$vs_rab_failestabcs_ulce_cong[] = $row->vs_rab_failestabcs_ulce_cong;		
		$vs_rab_failestabps_ulce_cong[] = $row->vs_rab_failestabps_ulce_cong;		
		$vs_rrc_paging1_loss_pchcong_cell[] = $row->vs_rrc_paging1_loss_pchcong_cell;		
		$vs_rrc_rej_rl_fail[] = $row->vs_rrc_rej_rl_fail;		
		}	
		array_walk($range, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}
var node = "<?php echo $node; ?>";

var range = <?php echo json_encode($range); ?>;	

var range = JSON.parse("[" + range + "]");
///alert(datetime[0]);	
$(function () {
    var chart;
    $(document).ready(function() {
		Highcharts.setOptions({
    	colors: ['green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'yellow', 'yellow', 'yellow', 'yellow', 'red', 'red', 'red', 'red', 'red', 'red', 'red']
	
});
		var dlpower = new Highcharts.Chart({
		chart: {
				renderTo: 'dlpower',
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
						text: 'Non-HS Power Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'DL Power Cong',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'RRC DL Power Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_rej_dlpower_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#666699',
						name: 'RAB CS DL Power Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabcs_dlpower_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#993300',
						name: 'RAB PS DL Power Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabps_dlpower_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}					
					,{
			            name: '#Cells',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($dlpower_count, ',') ?>]
						
			        }
					]							
		});

/////////////////////////////////////////////////////////////////////////////////////////////////////code//////////////////////////

		var code = new Highcharts.Chart({
		chart: {
				renderTo: 'code',
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
						text: 'Non-HS Code Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'Code Cong',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'RRC Code Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_rej_code_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#666699',
						name: 'RAB CS Code Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabcs_code_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#993300',
						name: 'RAB PS Code Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabps_code_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}					
					,{
			            name: '#Cells',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',


			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($code_count, ',') ?>]
			        }
					]							
		});
		

/////////////////////////////////////////////////////////////////////////////////////////////////////fach//////////////////////////

		var fach = new Highcharts.Chart({
		chart: {
				renderTo: 'fach',
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
						text: 'FACH Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'FACH Cong',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'FACH CCCH Cong Time',
						yAxis: 1,
						data: [<?php echo join($vs_fach_ccch_cong_time, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#666699',
						name: 'FACH DCCH Cong Time',
						yAxis: 1,
						data: [<?php echo join($vs_fach_dcch_cong_time, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
						name: 'FACH DTCH Cong Time',
						color: '#993300',
						yAxis: 1,
						data: [<?php echo join($vs_fach_dtch_cong_time, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}					
					,{
			            name: '#Cells',
						type: 'column',
						//color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						//
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($fach_count, ',') ?>]
						
			        }
					]							
		});

    series: [{
            type: 'coloredline',
            data: [{
                    y: 200,
                    segmentColor: 'red'
            },{
                    y: 210,
                    segmentColor: 'red'
            },{
                    y: 210,
                    segmentColor: 'red'
            },{
                    y: 100,
                    segmentColor: 'green'
            }, {
                    y: 100,
                    segmentColor: 'red'
            }]
    }]
/////////////////////////////////////////////////////////////////////////////////////////////////////rach//////////////////////////

		var rach = new Highcharts.Chart({
		chart: {
				renderTo: 'rach',
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
						text: 'RACH Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'RACH Cong',
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
							colorByPoint: true,
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
			            name: '#Cells',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						//yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($rach_count, ',') ?>]
			        }
					]							
		});


/////////////////////////////////////////////////////////////////////////////////////////////////////dlce//////////////////////////

		var dlce = new Highcharts.Chart({
		chart: {
				renderTo: 'dlce',
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
						text: 'DLCE Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'DLCE Cong',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'RRC DLCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_rej_dlce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#666699',
						name: 'RAB CS DLCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabcs_dlce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#993300',
						name: 'RAB PS DLCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabps_dlce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}					
					,{
			            name: '#Cells',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($dlce_count, ',') ?>]
			        }
					]							
		});


/////////////////////////////////////////////////////////////////////////////////////////////////////ulce//////////////////////////

		var ulce = new Highcharts.Chart({
		chart: {
				renderTo: 'ulce',
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
						text: 'ULCE Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'ULCE Cong',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'RRC ULCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_rej_ulce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#666699',
						name: 'RAB CS ULCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabcs_ulce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
					colorByPoint: false,
					color: '#993300',
						name: 'RAB PS ULCE Cong',
						yAxis: 1,
						data: [<?php echo join($vs_rab_failestabps_ulce_cong, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}					
					,{
			            name: '#Cells',
						type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($ulce_count, ',') ?>]
			        }
					]							
		});

/////////////////////////////////////////////////////////////////////////////////////////////////////pch//////////////////////////

		var code = new Highcharts.Chart({
		chart: {
				renderTo: 'pch',
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
						text: 'PCH Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'Paging Loss',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'Paging Loss',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_paging1_loss_pchcong_cell, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}				
					,{
			            name: '#Cells',
						type: 'column',
						colors: ['green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'yellow', 'yellow', 'yellow', 'yellow', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red'],
						//color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',


			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($pch_count, ',') ?>]
			        }
					]							
		});		

/////////////////////////////////////////////////////////////////////////////////////////////////////pch//////////////////////////

		var code = new Highcharts.Chart({
		chart: {
				renderTo: 'cnbap',
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
						text: 'CNBAP Utilization',
						x: -20 //center
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($range, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value} ',
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
							text: 'RL Fail',
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
							colorByPoint: true,
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
					colorByPoint: false,
					color: '#058DC7',
						name: 'Paging Loss',
						yAxis: 1,
						data: [<?php echo join($vs_rrc_rej_rl_fail, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}				
					,{
			            name: '#Cells',
						type: 'column',
						colors: ['green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'yellow', 'yellow', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'red'],
						//color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',


			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($cnbap_count, ',') ?>]
			        }
					]							
		});			
		
//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
  });	
	

  });
    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				
				