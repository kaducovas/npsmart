	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$vs_lc_ulcreditused_mean[] = $row->vs_lc_ulcreditused_mean;
		$vs_hsupa_ue_mean_tti10ms[] = $row->vs_hsupa_ue_mean_tti10ms;
		$vs_hsupa_ue_mean_tti2ms[] = $row->vs_hsupa_ue_mean_tti2ms;
		$vs_nodeb_ulcreditused_mean[] = $row->vs_nodeb_ulcreditused_mean;
		$vs_paging1_succ1_idle_realtime_cell[] = $row->vs_paging1_succ1_idle_realtime_cell;
		$vs_utran_attpaging1[] = $row->vs_utran_attpaging1;
		$vs_paging1_att1_idle_nonerealtime_cell[] = $row->vs_paging1_att1_idle_nonerealtime_cell;
		$vs_paging1_att1_idle_realtime_cell[] = $row->vs_paging1_att1_idle_realtime_cell;
		$vs_utran_paging1_att_idle_ps[] = $row->vs_utran_paging1_att_idle_ps;
		$vs_paging1_succ1_idle_nonerealtime_cell[] = $row->vs_paging1_succ1_idle_nonerealtime_cell;
		$vs_rrc_paging1_loss_pchcong_cell[] = $row->vs_rrc_paging1_loss_pchcong_cell;
		$vs_utran_paging1_att_idle_cs[] = $row->vs_utran_paging1_att_idle_cs;
		$vs_hsdpa_dyncfgatt_longcqi[] = $row->vs_hsdpa_dyncfgatt_longcqi;
		$vs_meanulactualpowerload[] = $row->vs_meanulactualpowerload;
		$vs_backgroundnoise_mean[] = $row->vs_backgroundnoise_mean;
		$vs_hsdpa_dyncfgatt_shortcqi[] = $row->vs_hsdpa_dyncfgatt_shortcqi;
		}	 
			
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
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
		
	///////////////////////////////////hsupa vs tti////////////////////////////////////////////////		
var graph1 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph1',
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
						text: 'HSUPA TTI X UL Credit',
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
						//max: 100,
						labels: {
							format: '{value}',
					
						},
						title: {
							//text: 'Kbps',
					
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}, { // Secondary yAxis
						title: {
							//text: 'Kbps',
				
						},
						labels: {
						///	format: '{value}%',
				
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
						}
					},
					
					series: [{
					///	showInLegend: false,
						name: 'HSUPA TTI 10ms',
						data: [<?php echo join($vs_hsupa_ue_mean_tti10ms, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'HSUPA TTI 10ms',
						data: [<?php echo join($vs_hsupa_ue_mean_tti2ms, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
			            name: 'ULCredit (without CE Overb)',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($vs_nodeb_ulcreditused_mean, ',') ?>]
			        }
					,{
			            name: 'NodeB.ULCreditUsed',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($vs_lc_ulcreditused_mean, ',') ?>]
			        }					
					]							
		});

		
	///////////////////////////////////LOAD////////////////////////////////////////////////		
var graph2 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph2',
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
						text: 'Load X BGN',
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
						//max: 100,
						labels: {
							format: '{value}',
					
						},
						title: {
							//text: 'Kbps',
					
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}, { // Secondary yAxis
						title: {
							//text: 'Kbps',
				
						},
						labels: {
						///	format: '{value}%',
				
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
						}
					},
					
					series: [{
					///	showInLegend: false,
						name: 'Backgroung Noise',
						data: [<?php echo join($vs_backgroundnoise_mean, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					
					,{
			            name: 'UL Power Load(%)',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($vs_meanulactualpowerload, ',') ?>]
			        }			
					]							
		});
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////CQI FEEDBACK//////////////////////////

		var graph3 = new Highcharts.Chart({
		chart: {
				renderTo: 'graph3',
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
						text: '<b>HSDPA CQI Feedback</b>',// - ' + node,
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
							//text: '%'
						},
						//{  },
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
						
					},
					tooltip: {
					//valueSuffix: '%',
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
						}
					},
						 
					series: [{
						name: 'HSDPA.DynCfgAtt.ShortCQI',
						data: [<?php echo join($vs_hsdpa_dyncfgatt_shortcqi, ',') ?>]
					},
					{
			            name: 'HSDPA.DynCfgAtt.LongCQI',
						data: [<?php echo join($vs_hsdpa_dyncfgatt_longcqi, ',') ?>]
			         }
											
					]							
		});
		
/////////////////////////////////////////////////////////////////////////////////////////////////////Paging attempts//////////////////////////

		var graph4 = new Highcharts.Chart({
		chart: {
				renderTo: 'graph4',
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
						text: '<b>Paging Attempts</b>',// - ' + node,
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
							//text: '%'
						},
						//{  },
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
						
					},
					tooltip: {
					//valueSuffix: '%',
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
						}
					},
					series: [{
						name: 'AttPaging1',
						data: [<?php echo join($vs_utran_attpaging1, ',') ?>]
					},
					{
						name: 'Paging1.Att.Idle.PS',
						data: [<?php echo join($vs_utran_paging1_att_idle_ps, ',') ?>]
					},
					{
			            name: 'Paging1.Att.Idle.CS',
						data: [<?php echo join($vs_utran_paging1_att_idle_cs, ',') ?>]
			         }
											
					]							
		});		
		
///////////////////////////////////Idle Paging NRT////////////////////////////////////////////////		
var graph5 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph5',
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
						text: 'Idle Paging NRT',
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
						//max: 100,
						labels: {
							format: '{value}',
					
						},
						title: {
							//text: 'Kbps',
					
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}, { // Secondary yAxis
						title: {
							//text: 'Kbps',
				
						},
						labels: {
						///	format: '{value}%',
				
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
						}
					},
					  
					series: [{
					///	showInLegend: false,
						name: 'Paging1.Succ.Idle.NRT',
						data: [<?php echo join($vs_paging1_succ1_idle_nonerealtime_cell, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					},
					{
					///	showInLegend: false,
						name: 'Paging1.Att.Idle.NRT',
						data: [<?php echo join($vs_paging1_att1_idle_nonerealtime_cell, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					
					,{
			            name: 'Paging1.Loss',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($vs_rrc_paging1_loss_pchcong_cell, ',') ?>]
			        }			
					]							
		});		
		
///////////////////////////////////Idle Paging RT////////////////////////////////////////////////		
var graph6 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph6',
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
						text: 'Idle Paging RT',
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
						//max: 100,
						labels: {
							format: '{value}',
					
						},
						title: {
							//text: 'Kbps',
					
						},
						
						plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
					}, { // Secondary yAxis
						title: {
							//text: 'Kbps',
				
						},
						labels: {
						///	format: '{value}%',
				
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
						}
					},
					   
					series: [{
					///	showInLegend: false,
						name: 'Paging1.Succ.Idle.RT',
						data: [<?php echo join($vs_paging1_succ1_idle_realtime_cell, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					},
					{
					///	showInLegend: false,
						name: 'Paging1.Att.Idle.RT',
						data: [<?php echo join($vs_paging1_att1_idle_realtime_cell, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					
					,{
			            name: 'Paging1.Loss.PCHCong',
						//type: 'column',
						color: 'rgba(0, 255, 0, 0.8)',
						///borderColor:'#C80000',
						///borderColor:'rgba(0, 255, 0)',

						yAxis: 1,
			            ///data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
						data: [<?php echo join($vs_rrc_paging1_loss_pchcong_cell, ',') ?>]
			        }			
					]							
		});		

//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#export').click(function() {
    Highcharts.exportCharts([graph1,graph2,graph3,graph4,graph5,graph6]);
});		
  });	


  });
  


    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				
				