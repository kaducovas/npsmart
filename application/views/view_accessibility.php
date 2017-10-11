	<?php 
		foreach($result as $row){
			#$rnc = $row->rnc;
			#$cellname =  $row->cellname;
			#outracoisa$cellid = $row->cellid;
			###adicioneeeeeeei
			$datetime[] = $row->datetime;
			$acc_rrc[] = $row->acc_rrc;	
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
			$vs_rrc_rej_code_cong[] = $row->vs_rrc_rej_code_cong;
			$vs_rrc_rej_dlce_cong[] = $row->vs_rrc_rej_dlce_cong;
			$vs_rrc_rej_dliubband_cong[] = $row->vs_rrc_rej_dliubband_cong;
			$vs_rrc_rej_dlpower_cong[] = $row->vs_rrc_rej_dlpower_cong;
			$vs_rrc_rej_nodebresunavail[] = $row->vs_rrc_rej_nodebresunavail;
			$vs_rrc_rej_redir_dist[] = $row->vs_rrc_rej_redir_dist;
			$vs_rrc_rej_redir_dist_intrarat[] = $row->vs_rrc_rej_redir_dist_intrarat;
			$vs_rrc_rej_redir_interrat[] = $row->vs_rrc_rej_redir_interrat;
			$vs_rrc_rej_redir_intrarat[] = $row->vs_rrc_rej_redir_intrarat;
			$vs_rrc_rej_redir_service[] = $row->vs_rrc_rej_redir_service;
			$vs_rrc_rej_rl_fail[] = $row->vs_rrc_rej_rl_fail;
			$vs_rrc_rej_sum[] = $row->vs_rrc_rej_sum;
			$vs_rrc_rej_tnl_fail[] = $row->vs_rrc_rej_tnl_fail;
			$vs_rrc_rej_ulce_cong[] = $row->vs_rrc_rej_ulce_cong;
			$vs_rrc_rej_uliubband_cong[] = $row->vs_rrc_rej_uliubband_cong;
			$vs_rrc_rej_ulpower_cong[] = $row->vs_rrc_rej_ulpower_cong;
			$vs_rrc_failconnestab_noreply[] = $row->vs_rrc_failconnestab_noreply;
			$vs_rrc_failconnestab_cong[] = $row->vs_rrc_failconnestab_cong;
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
			 $vs_rab_failestabps_cellupd[] = $row->vs_rab_failestabps_cellupd;
			 $vs_rab_failestabps_code_cong[] = $row->vs_rab_failestabps_code_cong;
			 $vs_rab_failestabps_cong[] = $row->vs_rab_failestabps_cong;
			 $vs_rab_failestabps_dlce_cong[] = $row->vs_rab_failestabps_dlce_cong;
			 $vs_rab_failestabps_dliubband_cong[] = $row->vs_rab_failestabps_dliubband_cong;
			 $vs_rab_failestabps_dlpower_cong[] = $row->vs_rab_failestabps_dlpower_cong;
			 $vs_rab_failestabps_hsdpauser_cong[] = $row->vs_rab_failestabps_hsdpauser_cong;
			 $vs_rab_failestabps_hsupauser_cong[] = $row->vs_rab_failestabps_hsupauser_cong;
			 $vs_rab_failestabps_iubfail[] = $row->vs_rab_failestabps_iubfail;
			 $vs_rab_failestabps_phychfail[] = $row->vs_rab_failestabps_phychfail;
			 $vs_rab_failestabps_rbcfgunsupp[] = $row->vs_rab_failestabps_rbcfgunsupp;
			 $vs_rab_failestabps_rbinccfg[] = $row->vs_rab_failestabps_rbinccfg;
			 $vs_rab_failestabps_rnl[] = $row->vs_rab_failestabps_rnl;
			 $vs_rab_failestabps_srbreset[] = $row->vs_rab_failestabps_srbreset;
			 $vs_rab_failestabps_tnl[] = $row->vs_rab_failestabps_tnl;
			 $vs_rab_failestabps_ulce_cong[] = $row->vs_rab_failestabps_ulce_cong;
			 $vs_rab_failestabps_uliubband_cong[] = $row->vs_rab_failestabps_uliubband_cong;
			 $vs_rab_failestabps_ulpower_cong[] = $row->vs_rab_failestabps_ulpower_cong;
			 $vs_rab_failestabps_unsp[] = $row->vs_rab_failestabps_unsp;
			 $vs_rab_failestabps_uufail[] = $row->vs_rab_failestabps_uufail;
			 $vs_rab_failestabps_uunoreply[] = $row->vs_rab_failestabps_uunoreply;
			


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
		
///////////////////////////////////////////////////////////FAILS RRC/////////////////////////////////////////////		
	
		var fails_rrc = new Highcharts.Chart({
		chart: {
				renderTo: 'fails_rrc',
				alignTicks:false,
				//backgroundColor:'transparent',
				zoomType: 'xy'//,
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
						text: 'RRC Fails',
					//	 floating: true,
						x: -20, //center
						y: 0
					},
					///subtitle: {
					///	text: 'RNC= '.$rnc,
					///	x: -20
					///},
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
					legend: {
						layout: 'horizontal',
						align: 'left',
						verticalAlign: 'top',
						floating: true,
						borderWidth: 0
					},
					series: [{
						name: 'Code Congestion',
						data: [<?php echo join($vs_rrc_rej_code_cong, ',') ?>]
					},
					{
			            name: 'DLPower Congestion',
						data: [<?php echo join($vs_rrc_rej_dlpower_cong, ',') ?>]
			        },
					{
			            name: 'ULPower Congestion',
						data: [<?php echo join($vs_rrc_rej_ulpower_cong, ',') ?>]
			        },
					{
			            name: 'DLCE Congestion',
						data: [<?php echo join($vs_rrc_rej_dlce_cong, ',') ?>]
			        },
					{
			            name: 'ULCE Congestion',
						data: [<?php echo join($vs_rrc_rej_ulce_cong, ',') ?>]
			        },
					
					{
			            name: 'DLIUBBAND Congestion',
						data: [<?php echo join($vs_rrc_rej_dliubband_cong, ',') ?>]
			        },
					
					{
			            name: 'ULIUBBAND Congestion',
						data: [<?php echo join($vs_rrc_rej_uliubband_cong, ',') ?>]
			        },
					
					{
			            name: 'No Reply',
						data: [<?php echo join($vs_rrc_failconnestab_noreply, ',') ?>]
			        },	
					{
			            name: 'NodeB Resource Unavailable',
						data: [<?php echo join($vs_rrc_rej_nodebresunavail, ',') ?>]
			        },	
					{
			            name: 'RL Fail',
						data: [<?php echo join($vs_rrc_rej_rl_fail, ',') ?>]
			        }
											
					]							
		});			
// ///////////////////////////////////////////////////////////ACCESSIBILITY CS/////////////////////////////////////////////		
		// var acc_cs = new Highcharts.Chart({
				// chart: {
						// renderTo: 'acc_cs',
						// alignTicks:false,
						// zoomType: 'x'//,
						// //borderWidth: 2						
								// ///type: 'line',
								// ///height: 195		
						// },
							// credits: {
							   // enabled: false
							// },		
							// exporting: { 
							// enabled: true 
							// },
							// title: {
								// text: 'CS Accessibility',
								// x: -20 //center
							// },
							// ///subtitle: {
							// ///	text: 'RNC= '.$rnc,
							// ///	x: -20
						// ///	},
							// xAxis: {
								// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
							// },

							// yAxis: [{ // Primary yAxis
								// max: 100,
								// labels: {
									// format: '{value}%',
							// ///		style: {
							// ///			color: Highcharts.getOptions().colors[1]
							// ///		}
								// },
								// title: {
								// ///	text: '',
							// ///		style: {
							// ///			color: Highcharts.getOptions().colors[1]
							// ///		}
								// },
								
								// plotLines: [{
										// value: 0,
										// width: 1,
										// color: '#808080'
									// }]
							// }, { // Secondary yAxis
								// title: {
									// text: 'RAB CS Fails',
						// ///			style: {
						// ///				color: Highcharts.getOptions().colors[0]
						// ///			}
								// },
								// labels: {
								// ///	format: '{value}%',
						// ///			style: {
						// ///				color: Highcharts.getOptions().colors[0]
						// ///			}
								// },
								// opposite: true
							// }],
						// tooltip: {
							// shared: true
						// },
							
							// legend: {
								// layout: 'horizontal',
								// align: 'left',
								// verticalAlign: 'top',
								// floating: true,
								// borderWidth: 0
							// },
							
							// plotOptions: {
								// series: {
									// cursor: 'pointer',
									// events: {
										// click: function(e) {
										// // Log to console
											// alert(this.name + ' clicked\n' +
											  // 'Alt: ' + event.altKey + '\n' +
											  // 'Control: ' + event.ctrlKey + '\n'+
											  // 'Shift: ' + event.shifkKey + '\n'+
											  // 'Datetime: ' + datetime[event.point.x]);
										// }
									// }
								// }
							// },
							
							// series: [//{
							// ///	showInLegend: false,
							// //	name: 'RRC Accessibility',
							// //	data: [<?php echo join($acc_rrc, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
								// ///data: JSON.parse("[" + acc_rrc + "]")
							// ///},
							// {
								// name: 'CS Accessibility',
							// ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
								// data: [<?php echo join($acc_cs, ',') ?>]
							// },
							// {
								// name: 'RAB CS SR',
							// ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
								// data: [<?php echo join($eff_cs, ',') ?>]
							// },
							
							// {
								// name: 'RAB CS Fails',
								// type: 'column',
								// color: 'rgba(0, 255, 0, 0.8)',
								// ///borderColor:'#C80000',
								// ///borderColor:'rgba(0, 255, 0)',

								// yAxis: 1,
								// ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
								// data: [<?php echo join($fails_acc_cs, ',') ?>]
							// }
							// ]							
				// });	
// ///////////////////////////////////////////////////////////FAILS CS/////////////////////////////////////////////		
	
		// var fails_cs = new Highcharts.Chart({
		// chart: {
				// renderTo: 'fails_cs',
				// alignTicks:false,
				// backgroundColor:'transparent',
				// zoomType: 'xy'//,
				// //borderWidth: 2		
						// ///type: 'line',
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'CS Fails',
					// //	 floating: true,
						// x: -20, //center
						// y: 0
					// },
					// ///subtitle: {
					// ///	text: 'RNC= '.$rnc,
					// ///	x: -20
					// ///},
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },
					// yAxis: {
						// ///max: 100,
						// min: 0,
						// title: {
							// //text: 'Temperature (°C)'
						// },
						// //{  },
						// plotLines: [{
							// value: 0,
							// width: 1,
							// color: '#808080'
						// }]
						
					// },
					// tooltip: {
					// ///	valueSuffix: '%'
					// shared: true
					// },
					// legend: {
						// layout: 'horizontal',
						// align: 'left',
						// verticalAlign: 'top',
						// floating: true,
						// borderWidth: 0
					// },		
					
					// series: [{
						// name: 'Code Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_code_cong, ',') ?>]
					// },
					// {
			            // name: 'DLPower Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_dlpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULPower Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_ulpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'DLCE Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_dlce_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULCE Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_ulce_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'DLIUBBAND Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_dliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'ULIUBBAND Congestion',
						// data: [<?php echo join($vs_rab_failestabcs_uliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'IUB Fail',
						// data: [<?php echo join($vs_rab_failestabcs_iubfail, ',') ?>]
			        // },	
					// {
			            // name: 'PhyCh Fail',
						// data: [<?php echo join($vs_rab_failestabcs_phychfail, ',') ?>]
			        // },	
					// {
			            // name: 'RNL Fail',
						// data: [<?php echo join($vs_rab_failestabcs_rnl, ',') ?>]
			        // }
											
					// ]							
		// });					
// ///////////////////////////////////////////////////////////ACCESSIBILITY PS/////////////////////////////////////////////		
		// var acc_ps = new Highcharts.Chart({
						// chart: {
								// renderTo: 'acc_ps',
								// alignTicks:false,
								// zoomType: 'x'//,
								// //borderWidth: 2		
										// ///type: 'line',
										// ///height: 195		
								// },
									// credits: {
									   // enabled: false
									// },		
									// exporting: { 
									// enabled: true 
									// },
									// title: {
										// text: 'PS Accessibility',
										// x: -20 //center
									// },
									// ///subtitle: {
									// ///	text: 'RNC= '.$rnc,
									// ///	x: -20
								// ///	},
									// xAxis: {
										// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
									// },

									// yAxis: [{ // Primary yAxis
										// max: 100,
										// labels: {
											// format: '{value}%',
									// ///		style: {
									// ///			color: Highcharts.getOptions().colors[1]
									// ///		}
										// },
										// title: {
										// ///	text: '',
									// ///		style: {
									// ///			color: Highcharts.getOptions().colors[1]
									// ///		}
										// },
										
										// plotLines: [{
												// value: 0,
												// width: 1,
												// color: '#808080'
											// }]
									// }, { // Secondary yAxis
										// title: {
											// text: 'RAB PS Fails',
								// ///			style: {
								// ///				color: Highcharts.getOptions().colors[0]
								// ///			}
										// },
										// labels: {
										// ///	format: '{value}%',
								// ///			style: {
								// ///				color: Highcharts.getOptions().colors[0]
								// ///			}
										// },
										// opposite: true
									// }],
								// tooltip: {
									// shared: true
								// },
									
									// legend: {
										// layout: 'horizontal',
										// align: 'left',
										// verticalAlign: 'top',
										// floating: true,
										// borderWidth: 0
									// },
									
									// plotOptions: {
										// series: {
											// cursor: 'pointer',
											// events: {
												// click: function(e) {
												// // Log to console
													// alert(this.name + ' clicked\n' +
													  // 'Alt: ' + event.altKey + '\n' +
													  // 'Control: ' + event.ctrlKey + '\n'+
													  // 'Shift: ' + event.shifkKey + '\n'+
													  // 'Datetime: ' + datetime[event.point.x]);
												// }
											// }
										// }
									// },
									
									// series: [///{
									// ///	showInLegend: false,
									// ///	name: 'RRC Accessibility',
									// ///	data: [<?php echo join($acc_rrc, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
										// ///data: JSON.parse("[" + acc_rrc + "]")
									// ///},
									// {
										// name: 'PS Accessibility',
									// ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
										// data: [<?php echo join($acc_ps, ',') ?>]
									// },
									// {
										// name: 'RAB PS SR',
									// ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
										// data: [<?php echo join($eff_ps, ',') ?>]
									// },
									
									// {
										// name: 'RAB PS Fails',
										// type: 'column',
										// color: 'rgba(0, 255, 0, 0.8)',
										// ///borderColor:'#C80000',
										// ///borderColor:'rgba(0, 255, 0)',

										// yAxis: 1,
										// ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
										// data: [<?php echo join($fails_acc_ps, ',') ?>]
									// }
									// ]							
						// });			
		
// ///////////////////////////////////////////////////////////FAILS PS/////////////////////////////////////////////		
	
		// var fails_ps = new Highcharts.Chart({
		// chart: {
				// renderTo: 'fails_ps',
				// alignTicks:false,
				// backgroundColor:'transparent',
				// zoomType: 'xy'//,
				// //borderWidth: 2		
						// ///type: 'line',
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'PS Fails',
					// //	 floating: true,
						// x: -20, //center
						// y: 0
					// },
					// ///subtitle: {
					// ///	text: 'RNC= '.$rnc,
					// ///	x: -20
					// ///},
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },
					// yAxis: {
						// ///max: 100,
						// min: 0,
						// title: {
							// //text: 'Temperature (°C)'
						// },
						// //{  },
						// plotLines: [{
							// value: 0,
							// width: 1,
							// color: '#808080'
						// }]
						
					// },
					// tooltip: {
					// ///	valueSuffix: '%'
					// shared: true
					// },
					// legend: {
						// layout: 'horizontal',
						// align: 'left',
						// verticalAlign: 'top',
						// floating: true,
						// borderWidth: 0
					// },				
					// series: [{
						// name: 'Code Congestion',
						// data: [<?php echo join($vs_rab_failestabps_code_cong, ',') ?>]
					// },
					// {
			            // name: 'DLPower Congestion',
						// data: [<?php echo join($vs_rab_failestabps_dlpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULPower Congestion',
						// data: [<?php echo join($vs_rab_failestabps_ulpower_cong, ',') ?>]
			        // },
					// {
			            // name: 'DLCE Congestion',
						// data: [<?php echo join($vs_rab_failestabps_dlce_cong, ',') ?>]
			        // },
					// {
			            // name: 'ULCE Congestion',
						// data: [<?php echo join($vs_rab_failestabps_ulce_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'DLIUBBAND Congestion',
						// data: [<?php echo join($vs_rab_failestabps_dliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'ULIUBBAND Congestion',
						// data: [<?php echo join($vs_rab_failestabps_uliubband_cong, ',') ?>]
			        // },
					
					// {
			            // name: 'IUB Fail',
						// data: [<?php echo join($vs_rab_failestabps_iubfail, ',') ?>]
			        // },	
					// {
			            // name: 'PhyCh Fail',
						// data: [<?php echo join($vs_rab_failestabps_phychfail, ',') ?>]
			        // },	
					// {
			            // name: 'RNL Fail',
						// data: [<?php echo join($vs_rab_failestabps_rnl, ',') ?>]
			        // }
											
					// ]							
		// });			
// ///////////////////////////////////////////////////////////ACCESSIBILITY HSDPA/////////////////////////////////////////////		
	
		// var acc_hsdpa = new Highcharts.Chart({
		// chart: {
				// renderTo: 'acc_hsdpa',
				// zoomType: 'xy'//,
				// //borderWidth: 2		
						// ///type: 'line',
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'HS Accessibility',
						// x: -20 //center
					// },
					// ///subtitle: {
					// ///	text: 'RNC= '.$rnc,
					// ///	x: -20
					// ///},
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },
					// yAxis: {
						// max: 100,
						// ///min: 0,
						// title: {
							// //text: 'Temperature (°C)'
						// },
						// //{  },
						// plotLines: [{
							// value: 0,
							// width: 1,
							// color: '#808080'
						// }]
						
					// },
					// tooltip: {
						// valueSuffix: '%'
					// },
					// legend: {
						// layout: 'horizontal',
						// align: 'left',
						// verticalAlign: 'top',
						// floating: true,
						// borderWidth: 0
					// },
					// series: [{
						// ///showInLegend: false,
						// name: 'HS Acc',
						// data: [<?php echo join($acc_hsdpa, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						// ///data: JSON.parse("[" + acc_rrc + "]")
					// }
					// ,{
			            // name: 'HS Acc(F2H)',
			        // ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						// data: [<?php echo join($acc_hsdpa_f2h, ',') ?>]
			        // },
					// {
			            // name: 'F2H SR',
			        // ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						// data: [<?php echo join($eff_f2h, ',') ?>]
			        // },
					// {
			            // name: 'HSDPA SR',
			        // ///    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						// data: [<?php echo join($eff_hsdpa, ',') ?>]
			        // }
					// ]							
		// });

// ///////////////////////////////////////////////////////////FAILS HS/////////////////////////////////////////////		
	
		// var fails_hs = new Highcharts.Chart({
		// chart: {
				// renderTo: 'fails_hs',
				// alignTicks:false,
				// backgroundColor:'transparent',
				// zoomType: 'xy'//,
				// //borderWidth: 2		
						// ///type: 'line',
						// ///height: 195		
				// },
					// credits: {
					   // enabled: false
					// },		
					// exporting: { 
					// enabled: true 
					// },
					// title: {
						// text: 'HS Fails',
					// //	 floating: true,
						// x: -20, //center
						// y: 0
					// },
					// ///subtitle: {
					// ///	text: 'RNC= '.$rnc,
					// ///	x: -20
					// ///},
					// xAxis: {
						// categories: [<?php echo join($datetime, ',') ?>]///["2015-09-06 07:00:00","2015-09-06 07:30:00","2015-09-06 08:00:00","2015-09-06 08:30:00","2015-09-06 09:00:00","2015-09-06 09:30:00","2015-09-06 10:00:00","2015-09-06 10:30:00","2015-09-06 11:00:00","2015-09-06 11:30:00","2015-09-06 12:00:00","2015-09-06 12:30:00"]
					// },
					// yAxis: {
						// ///max: 100,
						// min: 0,
						// title: {
							// //text: 'Temperature (°C)'
						// },
						// //{  },
						// plotLines: [{
							// value: 0,
							// width: 1,
							// color: '#808080'
						// }]
						
					// },
					// tooltip: {
					// ///	valueSuffix: '%'
					// shared: true
					// },
					// legend: {
						// layout: 'horizontal',
						// align: 'left',
						// verticalAlign: 'top',
						// floating: true,
						// borderWidth: 0
					// },
		
					// series: [{
						// name: 'HSDPA User Congestion',
						// data: [<?php echo join($vs_rab_failestabps_hsdpauser_cong, ',') ?>]
					// },
					// {
			            // name: 'HSUPA User Congestion',
						// data: [<?php echo join($vs_rab_failestabps_hsupauser_cong, ',') ?>]
			        // }					
					// ]							
		// });				

  });

    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
   });
</script>