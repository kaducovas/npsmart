	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$acc_cs[] = $row->acc_cs;
		$availability[] = $row->availability;
		$retainability_cs[] = $row->retainability_cs;
		$smp_5[] = $row->smp_5;
		$smp_7[] = $row->smp_7;
		$smp_8[] = $row->smp_8;
		$smp_9[] = $row->smp_9;
		$sdcch_traffic[] = $row->sdcch_traffic;
		$tch_traffic_fr[] = $row->tch_traffic_fr;
		$tch_traffic_hr[] = $row->tch_traffic_hr;
		$smp_5_ericsson[] = $row->smp_5_ericsson;
		$smp_7_ericsson[] = $row->smp_7_ericsson;
		$smp_8_ericsson[] = $row->smp_8_ericsson;
		$smp_9_ericsson[] = $row->smp_9_ericsson;
		$smp_5_nokia[] = $row->smp_5_nokia;
		$smp_7_nokia[] = $row->smp_7_nokia;
		$smp_8_nokia[] = $row->smp_8_nokia;
		$smp_9_nokia[] = $row->smp_9_nokia;
		$smp_5_siemens[] = $row->smp_5_siemens;
		$smp_7_siemens[] = $row->smp_7_siemens;
		$smp_8_siemens[] = $row->smp_8_siemens;
		$smp_9_siemens[] = $row->smp_9_siemens;
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
		var acc = new Highcharts.Chart({
		chart: {
				renderTo: 'acc',
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
					//exporting: { 
					
					exporting: {
						enabled: true,
					// buttons: {
						   // contextButton: {
							   // menuItems: [{
								   // textKey: 'downloadXLS',
								   // onclick: function () {
									   // this.downloadXLS();
								   // }
							   // }, {
								   // textKey: 'downloadCSV',
								   // onclick: function () {
									   // this.downloadCSV();
								   // }
							   // }]
						   // }
							// }
       },
					//},
					title: {
						text: '<b>Accessibility</b>',// - ' + node,
					//	 floating: true,
						x: -20, //center
						//y: 0
					},
					subtitle: {
						text: '<i>' + node + '</i>',
						x: -20
					},
					xAxis: {
						categories: [<?php echo join($date, ',') ?>],
						///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
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
					
					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// // alert(node.substring(0, 3));
								// // if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } 
								// //	else {
									// // //alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								
								// //var date = date[event.point.x];
								// //alert(kpi + date + node);
								// //alert(reportagg);
									// // alert(kpi + ' clicked\n' + ' ' + node + ' ' +
									  // // 'Alt: ' + event.altKey + '\n' +
									  // // 'Control: ' + event.ctrlKey + '\n'+
									  // // 'Shift: ' + event.shifkKey + '\n'+
									  // // 'Datetime: ' + date[event.point.x]);
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'CS Acc',
						data: [<?php echo join($acc_cs, ',') ?>]
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
						
							// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
						
							series: [{
								name: 'Availability',
								data: [<?php echo join($availability, ',') ?>]
							}
													
							]							
				});
				
//////////////////////////////////////////////////////////////////////////////////////////RETAINABILITY CS//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var retainability_cs = new Highcharts.Chart({
				chart: {
						renderTo: 'retainability_cs',
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
								text: '<b>Retainability CS</b>',// - ' + node,
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
						
							// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
						
							series: [{
								name: 'Retainability CS',
								data: [<?php echo join($retainability_cs, ',') ?>]
							}
													
							]							
				});
				
/////////////////////////////////////////////////////////////////////////////////////////////////////SMP_5//////////////////////////

		var smp_5 = new Highcharts.Chart({
		chart: {
				renderTo: 'smp_5',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy'
				,
				//backgroundColor: {
                //linearGradient: [0, 0, 500, 500],
                //stops: [
                //    [0, 'rgb(255, 255, 255)'],
               //     [1, 'rgb(200, 200, 255)']
              //  ]
            //}
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
						text: '<b>SMP 5</b>',// - ' + node,
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
						//min: 99.4,
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

					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'SMP 5 Huawei',
						data: [<?php echo join($smp_5, ',') ?>]
					},
					{
						name: 'SMP 5 Ericsson',
						data: [<?php echo join($smp_5_ericsson, ',') ?>]
					},
					{
						name: 'SMP 5 Nokia',
						data: [<?php echo join($smp_5_nokia, ',') ?>]
					},
					{
						name: 'SMP 5 Siemens',
						data: [<?php echo join($smp_5_siemens, ',') ?>]
					}
					]							
		});
//////////////////////////////////////////////////////////////////////////////////////////SMP_7//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var smp_7 = new Highcharts.Chart({
		chart: {
				renderTo: 'smp_7',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy'
				,
				//backgroundColor: {
                //linearGradient: [0, 0, 500, 500],
                //stops: [
                //    [0, 'rgb(255, 255, 255)'],
               //     [1, 'rgb(200, 200, 255)']
              //  ]
            //}
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
						text: '<b>SMP 7</b>',// - ' + node,
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
						//min: 99.4,
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

					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'SMP 7 Huawei',
						data: [<?php echo join($smp_7, ',') ?>]
					},
					{
						name: 'SMP 7 Ericsson',
						data: [<?php echo join($smp_7_ericsson, ',') ?>]
					},
					{
						name: 'SMP 7 Nokia',
						data: [<?php echo join($smp_7_nokia, ',') ?>]
					},
					{
						name: 'SMP 7 Siemens',
						data: [<?php echo join($smp_7_siemens, ',') ?>]
					}
					]						
		});
				
//////////////////////////////////////////////////////////////////////////////////////////SMP_8//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var smp_8 = new Highcharts.Chart({
		chart: {
				renderTo: 'smp_8',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy'
				,
				//backgroundColor: {
                //linearGradient: [0, 0, 500, 500],
                //stops: [
                //    [0, 'rgb(255, 255, 255)'],
               //     [1, 'rgb(200, 200, 255)']
              //  ]
            //}
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
						text: '<b>SMP 8</b>',// - ' + node,
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
						//min: 99.4,
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

					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'SMP 8 Huawei',
						data: [<?php echo join($smp_8, ',') ?>]
					},
					{
						name: 'SMP 8 Ericsson',
						data: [<?php echo join($smp_8_ericsson, ',') ?>]
					},
					{
						name: 'SMP 8 Nokia',
						data: [<?php echo join($smp_8_nokia, ',') ?>]
					},
					{
						name: 'SMP 8 Siemens',
						data: [<?php echo join($smp_8_siemens, ',') ?>]
					}
					]							
		});				

//////////////////////////////////////////////////////////////////////////////////////////SMP_9//////////////////////////////////////////////////////////////////////////////////////////////////////////////

		var smp_9 = new Highcharts.Chart({
		chart: {
				renderTo: 'smp_9',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy'
				,
				//backgroundColor: {
                //linearGradient: [0, 0, 500, 500],
                //stops: [
                //    [0, 'rgb(255, 255, 255)'],
               //     [1, 'rgb(200, 200, 255)']
              //  ]
            //}
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
						text: '<b>SMP 9</b>',// - ' + node,
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
						//min: 99.4,
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

					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								// //if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									// document.getElementById('wcreportnename').value = node;
									// document.getElementById('wcreportnetype').value = reportnetype;
									// document.getElementById('wctimeagg').value = reportagg;
									// document.getElementById('wcreportdate').value = date[event.point.x];
									// document.getElementById('wckpi').value = this.name;
									// document.wcform.submit();
								// // } else {
									// // alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// // }
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'SMP 9 Huawei',
						data: [<?php echo join($smp_9, ',') ?>]
					},
					{
						name: 'SMP 9 Ericsson',
						data: [<?php echo join($smp_9_ericsson, ',') ?>]
					},
					{
						name: 'SMP 9 Nokia',
						data: [<?php echo join($smp_9_nokia, ',') ?>]
					},
					{
						name: 'SMP 9 Siemens',
						data: [<?php echo join($smp_9_siemens, ',') ?>]
					}
					]							
		});				


//////////////////////////////////////////////////////////////////////////////////////////TRAFFIC//////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
									text: ''
								},
								//{  },
								plotLines: [{
									value: 0,
									width: 1,
									color: '#808080'
								}]
								
							},
							tooltip: {
							valueSuffix: '',
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
								name: 'SDCCH Traffic',
								data: [<?php echo join($sdcch_traffic, ',') ?>]
							},
							{
								name: 'TCH Traffic FR',
								data: [<?php echo join($tch_traffic_fr, ',') ?>]
							},
							{
								name: 'TCH Traffic HR',
								data: [<?php echo join($tch_traffic_hr, ',') ?>]
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
				