	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$acc_rrc[] = $row->acc_rrc;
		$acc_cs[] = $row->acc_cs;
		$acc_ps[] = $row->acc_ps;
		$acc_hsdpa[] = $row->acc_hsdpa;
		$acc_hsdpa_f2h[] = $row->acc_hsdpa_f2h;
		$drop_cs[] = $row->drop_cs;
		$drop_ps[] = $row->drop_ps;
		$drop_hsdpa[] = $row->drop_hsdpa;
		$drop_hsupa[] = $row->drop_hsupa;	
		$sho_succ_rate[] = $row->sho_succ_rate;
		$soft_hand_succ_rate[] = $row->soft_hand_succ_rate;
		$hho_intra_freq_succ_rate[] = $row->hho_intra_freq_succ_rate;
		$cs_hho_intra_freq_rate[] = $row->cs_hho_intra_freq_rate;
		$ps_hho_intra_freq_succ_rate[] = $row->ps_hho_intra_freq_succ_rate;
		$hho_inter_freq_succ_rate[] = $row->hho_inter_freq_succ_rate;	
		$iratho_cs_succ_rate[] = $row->iratho_cs_succ_rate;
		$iratho_ps_succ_rate[] = $row->iratho_ps_succ_rate;
		$retention_cs_succ_rate[] = $row->retention_cs_succ_rate;
		$retention_ps_succ_rate[] = $row->retention_ps_succ_rate;	
		$sho_over[] = $row->sho_over;
		$rtwp[] = $row->rtwp;
		$availability[] = $row->availability;
		$data_hsdpa[] = $row->data_hsdpa;
		$data_hsupa[] = $row->data_hsupa;
		$ps_r99_ul[] = $row->ps_r99_ul;
		$ps_r99_dl[] = $row->ps_r99_dl;
		$voice_traffic_dl[] = $row->voice_traffic_dl;
		$voice_traffic_ul[] = $row->voice_traffic_ul;
		$hsdpa_users[] = $row->hsdpa_users;
		$hsupa_users[] = $row->hsupa_users;
		$dch_users[] = $row->dch_users;
		$pch_users[] = $row->pch_users;
		$fach_users[] = $row->fach_users;
		$ps_nonhs_users[] = $row->ps_nonhs_users;
		$thp_hsdpa[] = $row->thp_hsdpa;
		$thp_hsupa[] = $row->thp_hsupa;
		}	
		
			
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		 function tonull($n)
		{
			if($n == ''){
				$n = 0;
				#return $n;				
			}
				return $n;
		}
		$dch_users = array_map("tonull", $dch_users);
		$pch_users = array_map("tonull", $pch_users);
		$fach_users = array_map("tonull", $fach_users);
		$data_hsdpa = array_map("tonull", $data_hsdpa);
		$data_hsupa = array_map("tonull", $data_hsupa);
		$ps_r99_ul = array_map("tonull", $ps_r99_ul);
		$ps_r99_dl = array_map("tonull", $ps_r99_dl);
		$hsdpa_users = array_map("tonull", $hsdpa_users);
		$hsupa_users = array_map("tonull", $hsupa_users);
		$ps_nonhs_users = array_map("tonull", $ps_nonhs_users);
		$thp_hsdpa = array_map("tonull", $thp_hsdpa);
		$thp_hsupa = array_map("tonull", $thp_hsupa);
		$rtwp = array_map("tonull", $rtwp);
		$availability = array_map("tonull", $availability);
		
		// print_r(array_keys($thp_hsdpa, 0));
		// echo "<br><br>";
		// print_r($thp_hsdpa);
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}
var node = "<?php echo $node; ?>";
//alert(node);
var date = <?php echo json_encode($date); ?>;	

var date = JSON.parse("[" + date + "]");
///alert(datetime[0]);


////////////////////////////////////////EXPORTING THING////////////////////////////////////////////

/**
 * Create a global getSVG method that takes an array of charts as an argument
 */
Highcharts.getSVG = function(charts) {
    var svgArr = [],
        top = 0,
        width = 0;

    $.each(charts, function(i, chart) {
        var svg = chart.getSVG();
        svg = svg.replace('<svg', '<g transform="translate(0,' + top + ')" ');
        svg = svg.replace('</svg>', '</g>');

        top += chart.chartHeight;
        width = Math.max(width, chart.chartWidth);

        svgArr.push(svg);
    });

    return '<svg height="'+ top +'" width="' + width + '" version="1.1" xmlns="http://www.w3.org/2000/svg">' + svgArr.join('') + '</svg>';
};

/**
 * Create a global exportCharts method that takes an array of charts as an argument,
 * and exporting options as the second argument
 */
Highcharts.exportCharts = function(charts, options) {
    var form
        svg = Highcharts.getSVG(charts);

    // merge the options
    options = Highcharts.merge(Highcharts.getOptions().exporting, options);

    // create the form
    form = Highcharts.createElement('form', {
        method: 'post',
        action: options.url
    }, {
        display: 'none'
    }, document.body);

    // add the values
    Highcharts.each(['filename', 'type', 'width', 'svg'], function(name) {
        Highcharts.createElement('input', {
            type: 'hidden',
            name: name,
            value: {
                filename: options.filename || 'npsmart-export',
                type: 'application/pdf',//options.type,
                width: '2000px',//options.width,
                svg: svg
            }[name]
        }, null, form);
    });
    //console.log(svg); return;
    // submit
    form.submit();

    // clean up
    form.parentNode.removeChild(form);
};
	///////////////////////////////////START charts////////////////////////////////////////////////
$(function () {
    var chart;
    $(document).ready(function() {


//////////////////////////////////////////////////////////////////////////////////////////THROUGHPUT//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		var thp = new Highcharts.Chart({
				chart: {
						renderTo: 'thp',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
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
						categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]					
					},

					yAxis: [{ // Primary yAxis
						//max: 100,
						labels: {
							format: '{value}',
					///		style: {
					///			color: Highcharts.getOptions().colors[1]
					///		}
						},
						title: {
							text: 'Kbps',
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
							text: 'Kbps',
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
								click: function( event ) {
								// Log to console
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(reportagg);
								//alert(node.substring(0, 3));
								//if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
								// } else {
									// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// }
								}
							}
						}
					},
					
					series: [{
					///	showInLegend: false,
						name: 'HSDPA THP',
						data: [<?php echo join($thp_hsdpa, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'HSUPA THP',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($thp_hsupa, ',') ?>]
			        }
					]							
		});

//////////////////////////////////////////////////////////////////////////////////////////RETENTION//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var retention = new Highcharts.Chart({
				chart: {
						renderTo: 'retention',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
						,
					//	backgroundColor: {
					//    linearGradient: [0, 0, 500, 500],
					//    stops: [
					//        [0, 'rgb(255, 255, 255)'],
					//        [1, 'rgb(200, 200, 255)']
					//    ]
				   // }
						//borderWidth: 2		
								///type: 'line',
								///height: 195		
						},
						//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
							credits: {
							   enabled: false
							},		
							exporting: { 
							enabled: true 
							},
							title: {
								text: '<b>3G Retention</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]
								},
							yAxis: {
								max: 100,
								///min: 0,
								title: {
									text: '%'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: '%',
							shared: false
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
										click: function( event ) {
										// Log to console
										var kpi = this.name;
										kpi = kpi.toLowerCase();
										kpi = kpi.trim();
										var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
										//alert(node.substring(0, 3));
										//if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
										// } else {
											// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
										// }
										}
									}
								}
							},
							
							series: [{
								name: 'CS Retention',
								data: [<?php echo join($retention_cs_succ_rate, ',') ?>]
							},
							{
								name: 'PS Retention',
								data: [<?php echo join($retention_ps_succ_rate, ',') ?>]
							}													
							]							
				});

//////////////////////////////////////////////////////////////////////////////////////////HANDOVER//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var handover = new Highcharts.Chart({
				chart: {
						renderTo: 'handover',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
						,
					//	backgroundColor: {
					//    linearGradient: [0, 0, 500, 500],
					//    stops: [
					//        [0, 'rgb(255, 255, 255)'],
					//        [1, 'rgb(200, 200, 255)']
					//    ]
				   // }
						//borderWidth: 2		
								///type: 'line',
								///height: 195		
						},
						//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
							credits: {
							   enabled: false
							},		
							exporting: { 
							enabled: true 
							},
							title: {
								text: '<b>Handover</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]
								},
							yAxis: {
								max: 100,
								///min: 0,
								title: {
									text: '%'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: '%',
							shared: false
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
										click: function( event ) {
										// Log to console
										var kpi = this.name;
										kpi = kpi.toLowerCase();
										kpi = kpi.trim();
										var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
										//alert(node.substring(0, 3));
										//if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
										// } else {
											// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
										// }
										}
									}
								}
							},							
							series: [{
								name: 'Soft HO',
								data: [<?php echo join($soft_hand_succ_rate, ',') ?>]
							},
						//	{
							//	name: 'HHO Intra Freq',
							//	data: [<?php echo join($hho_intra_freq_succ_rate, ',') ?>]
							//},
							{
								name: 'CS HHO Intra Freq',
								data: [<?php echo join($cs_hho_intra_freq_rate, ',') ?>]
							},
							{
								name: 'PS HHO Intra Freq',
								data: [<?php echo join($ps_hho_intra_freq_succ_rate, ',') ?>]
							},
							{
								name: 'HHO Inter Freq',
								data: [<?php echo join($hho_inter_freq_succ_rate, ',') ?>]
							},
							{
								name: 'IRATHO CS',
								data: [<?php echo join($iratho_cs_succ_rate, ',') ?>]
							},
							{
								name: 'IRATHO PS',
								data: [<?php echo join($iratho_ps_succ_rate, ',') ?>]
							}
										
							]							
				});

//////////////////////////////////////////////////////////////////////////////////////////SHO OVERHEAD//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var sho_overhead = new Highcharts.Chart({
				chart: {
						renderTo: 'sho_overhead',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
						,
					//	backgroundColor: {
					//    linearGradient: [0, 0, 500, 500],
					//    stops: [
					//        [0, 'rgb(255, 255, 255)'],
					//        [1, 'rgb(200, 200, 255)']
					//    ]
				   // }
						//borderWidth: 2		
								///type: 'line',
								///height: 195		
						},
						//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
							credits: {
							   enabled: false
							},		
							exporting: { 
							enabled: true 
							},
							title: {
								text: '<b>Soft Handover Overhead</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]
								},
							yAxis: {
								//max: 100,
								///min: 0,
								title: {
									text: '%'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: '%',
							shared: false
							},
							legend: {
								layout: 'horizontal',
								align: 'center',
								verticalAlign: 'bottom',
								floating: false,
								borderWidth: 0
							},				
							series: [{
								name: 'SHO Overhead',
								data: [<?php echo join($sho_over, ',') ?>]
							}
										
							]							
				});				
				
//////////////////////////////////////////////////////////////////////////////////////////AVAILABILITY//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var availability = new Highcharts.Chart({
				chart: {
						renderTo: 'availability',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
						,
					//	backgroundColor: {
					//    linearGradient: [0, 0, 500, 500],
					//    stops: [
					//        [0, 'rgb(255, 255, 255)'],
					//        [1, 'rgb(200, 200, 255)']
					//    ]
				   // }
						//borderWidth: 2		
								///type: 'line',
								///height: 195		
						},
						//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
							credits: {
							   enabled: false
							},		
							exporting: { 
							enabled: true 
							},
							title: {
								text: '<b>Availability</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]
								},
							yAxis: {
								max: 100,
								///min: 0,
								title: {
									text: '%'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: '%',
							shared: false
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
								click: function( event ) {
								// Log to console
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(node.substring(0, 3));
								//if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
								// } else {
									// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// }
								}
							}
						}
					},
						
							series: [{
								name: 'Availability',
								data: [<?php echo join($availability, ',') ?>]
							}
													
							]							
				});

//////////////////////////////////////////////////////////////////////////////////////////RTWP//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var rtwp = new Highcharts.Chart({
				chart: {
						renderTo: 'rtwp',
						alignTicks:false,
						//backgroundColor:'transparent',
						zoomType: 'xy'
						,
					//	backgroundColor: {
					//    linearGradient: [0, 0, 500, 500],
					//    stops: [
					//        [0, 'rgb(255, 255, 255)'],
					//        [1, 'rgb(200, 200, 255)']
					//    ]
				   // }
						//borderWidth: 2		
								///type: 'line',
								///height: 195		
						},
						//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
							credits: {
							   enabled: false
							},		
							exporting: { 
							enabled: true 
							},
							title: {
								text: '<b>RTWP</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>],///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					plotLines: [{
								color: '#FF0000',
								width: 2,
								//value: 247
							}]
								},
							yAxis: {
								//max: 100,
								///min: 0,
								title: {
									text: 'dBm'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: 'dBm',
							shared: false
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
										click: function( event ) {
										// Log to console
										var kpi = this.name;
										kpi = kpi.toLowerCase();
										kpi = kpi.trim();
										var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
										//alert(node.substring(0, 3));
										//if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
										// } else {
											// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
										// }
										}
									}
								}
							},
							
							series: [{
								name: 'RTWP',
								data: [<?php echo join($rtwp, ',') ?>]
							}
													
							]							
				});

//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#export').click(function() {
    Highcharts.exportCharts([acc,drop,traffic,users,thp,retention,handover,sho_overhead,availability,rtwp]);
});		
  });	


  });
  


    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				
				