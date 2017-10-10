	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$rrc_service[] = $row->rrc_service;
		$fails_rrc_service[] = $row->fails_rrc_service;
		$rrc_signaling[] = $row->rrc_signaling;
		$fails_rrc_signaling[] = $row->fails_rrc_signaling;
		$s1sig[] = $row->s1sig;
		$fails_s1sig[] = $row->fails_s1sig;
		$e_rab[] = $row->e_rab;
		$fails_e_rab[] = $row->fails_e_rab;
		$call_setup[] = $row->call_setup;
		$csfb[] = $row->csfb;
		$fails_csfb[] = $row->fails_csfb;
		$availability[] = $row->availability;
		$intra_freq_hoo_out[] = $row->intra_freq_hoo_out;
		$inter_freq_hoo_out[] = $row->inter_freq_hoo_out;
		$handover_in[] = $row->handover_in;
		$iratho_l2c[] = $row->iratho_l2c;
		$iratho_l2w[] = $row->iratho_l2w;
		$iratho_l2g[] = $row->iratho_l2g;
		$iratho_l2t[] = $row->iratho_l2t;
		$retention_4g[] = $row->retention_4g;
		$service_drop[] = $row->service_drop;
		$cell_downlink_avg_thp[] = $row->cell_downlink_avg_thp;
		$cell_uplink_avg_thp[] = $row->cell_uplink_avg_thp;
		$rb_cell_downlink_avg_thp[] = $row->rb_cell_downlink_avg_thp;
		$rb_cell_uplink_avg_thp[] = $row->rb_cell_uplink_avg_thp;
		$downlink_traffic_volume[] = $row->downlink_traffic_volume;
		$uplink_traffic_volume[] = $row->uplink_traffic_volume;
		$average_user_volume[] = $row->average_user_volume;
		$rb_utilization_dl[] = $row->rb_utilization_dl;
		$rrc_signaling_ul[] = $row->rrc_signaling_ul;
		$rb_preschedule_rb_urul[] = $row->rb_preschedule_rb_urul;
		}	
				 
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($rrc_service, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		 function tonull($n)
		{
			if($n == ''){
				$n = 0;
				#return $n;				
			}
				return $n;
		}
		$downlink_traffic_volume = array_map("tonull", $downlink_traffic_volume);
		$uplink_traffic_volume = array_map("tonull", $uplink_traffic_volume);
		$average_user_volume = array_map("tonull", $average_user_volume);
		$availability = array_map("tonull", $availability);

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
	
////////////////////////////////////////////////////Accessibility//////////////////////////////////////////////////////////////////	
$(function () {
    var chart;
    $(document).ready(function() {

		var traffic = new Highcharts.Chart({
				chart: {
						renderTo: 'traffic',
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
								text: '<b>Traffic</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
							},
							yAxis: {
								//max: 100,
								///min: 0,
								title: {
									text: 'GB'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: 'GB',
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
								name: 'DL',
								data: [<?php echo join($downlink_traffic_volume, ',') ?>]
							},
							{
								name: 'UL',
								data: [<?php echo join($uplink_traffic_volume, ',') ?>]
							}													
							]							
				});
				
//////////////////////////////////////////////////////////////////////////////////////////USERS//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var users = new Highcharts.Chart({
				chart: {
						renderTo: 'users',
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
								text: '<b>Users</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
							},
							yAxis: {
								//max: 100,
								min: 0,
								title: {
									text: 'Users'
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: ' Users',
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
								name: 'Users',
								data: [<?php echo join($average_user_volume, ',') ?>]
							}						
							]							
				});				

//////////////////////////////////////////////////////////////////////////////////////////THROUGHPUT//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var thp = new Highcharts.Chart({
				chart: {
						renderTo: 'thp',
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
								text: '<b>Throughput</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
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
							text: 'Mbps',
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
							text: 'Mbps',
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
								//alert('oi');	
								// Log to console
								var regions = ["CO", "PRSC", "NE", "BASE","ES","MG"];
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(node.substring(0, 3));
								
								if ($.inArray(node, regions) > -1) {
									document.getElementById('node').value = node;
									document.getElementById('date').value = date[event.point.x];
									document.getElementById('kpi').value = this.name;
									document.wcform.submit();
								} else {
									alert("NPSmart current release does not support.")
								}

								}
							}
						}
					},
						series: [{
					///	showInLegend: false,
						name: 'DL THP',
								data: [<?php echo join($cell_downlink_avg_thp, ',') ?>]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			           name: 'UL THP',
						color: 'rgba(0, 255, 0, 0.8)',

						yAxis: 1,
						data: [<?php echo join($cell_uplink_avg_thp, ',') ?>]
			        }
					]							
				});
				
//////////////////////////////////////////////////////////////////////////////////////////Utilization//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var utilization = new Highcharts.Chart({
				chart: {
						renderTo: 'utilization',
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
								text: '<b>Utilization</b>',// - ' + node,
							//	 floating: true,
								x: -20, //center
								//y: 0
							},
							subtitle: {
								text: '<i>' + node + '</i>',
								x: -20
							},
							xAxis: {
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
							},
							yAxis: {
								//max: 100,
								min: 0,
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
								//alert('oi');	
								// Log to console
								var regions = ["CO", "PRSC", "NE", "BASE","ES","MG"];
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(node.substring(0, 3));
								
								// if ($.inArray(node, regions) > -1) {
									// document.getElementById('node').value = node;
									// document.getElementById('date').value = date[event.point.x];
									// document.getElementById('kpi').value = this.name;
									// document.wcform.submit();
								// } else {
									alert("NPSmart current release does not support.")
								// }

								}
							}
						}
					},
						
							series: [{
								name: 'RB Utilization DL',
								data: [<?php echo join($rb_utilization_dl, ',') ?>]
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
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
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
								//alert('oi');	
								// Log to console
								var regions = ["CO", "PRSC", "NE", "BASE","ES","MG"];
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(node.substring(0, 3));
								
								if ($.inArray(node, regions) > -1) {
									document.getElementById('node').value = node;
									document.getElementById('date').value = date[event.point.x];
									document.getElementById('kpi').value = this.name;
									document.wcform.submit();
								} else {
									alert("NPSmart current release does not support.")
								}

								}
							}
						}
					},							
							series: [{
								name: 'Intra Freq Out',
								data: [<?php echo join($intra_freq_hoo_out, ',') ?>]
							},
							{
								name: 'Inter Freq Out',
								data: [<?php echo join($inter_freq_hoo_out, ',') ?>]
							},
							{
								name: 'HO In',
								data: [<?php echo join($handover_in, ',') ?>]
							},
							{
								name: 'IRAT LTE to WCDMA',
								data: [<?php echo join($iratho_l2w, ',') ?>]
							},
							{
								name: 'IRAT LTE to GSM',
								data: [<?php echo join($iratho_l2g, ',') ?>]
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
								categories: [<?php echo join($date, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
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
								//alert('oi');	
								// Log to console
								var regions = ["CO", "PRSC", "NE", "BASE","ES","MG"];
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								//alert(node.substring(0, 3));
								
								// if ($.inArray(node, regions) > -1) {
									// document.getElementById('node').value = node;
									// document.getElementById('date').value = date[event.point.x];
									// document.getElementById('kpi').value = this.name;
									// document.wcform.submit();
								// } else {
									alert("NPSmart current release does not support.")
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
				