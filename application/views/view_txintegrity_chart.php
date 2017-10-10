	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$vs_ippath_ping_meanlost[] = $row->vs_ippath_ping_meanlost;
		$vs_ippath_ping_meanjitter[] = $row->vs_ippath_ping_meanjitter;
		$vs_ippath_ping_meandelay[] = $row->vs_ippath_ping_meandelay;
		$vs_ippool_adjnode_ping_meanlost[] = $row->vs_ippool_adjnode_ping_meanlost;
		$vs_ippool_adjnode_ping_meanjitter[] = $row->vs_ippool_adjnode_ping_meanjitter;
		$vs_ippool_adjnode_ping_meandelay[] = $row->vs_ippool_adjnode_ping_meandelay;
		$vs_ippath_ping_maxlost[] = $row->vs_ippath_ping_maxlost;
		$vs_ippath_ping_maxjitter[] = $row->vs_ippath_ping_maxjitter;
		$vs_ippath_ping_maxdelay[] = $row->vs_ippath_ping_maxdelay;
		$vs_ippool_adjnode_ping_maxlost[] = $row->vs_ippool_adjnode_ping_maxlost;
		$vs_ippool_adjnode_ping_maxjitter[] = $row->vs_ippool_adjnode_ping_maxjitter;
		$vs_ippool_adjnode_ping_maxdelay[] = $row->vs_ippool_adjnode_ping_maxdelay;
		}	        	
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		
		function tonull($n)
		{
			if($n == ''){
				$n = 0;
				#return $n;				
			}
				return $n;
		}
		$vs_ippath_ping_meanlost = array_map("tonull", $vs_ippath_ping_meanlost);
		$vs_ippath_ping_meanjitter = array_map("tonull", $vs_ippath_ping_meanjitter);
		$vs_ippath_ping_meandelay = array_map("tonull", $vs_ippath_ping_meandelay);
		$vs_ippool_adjnode_ping_meanlost = array_map("tonull", $vs_ippool_adjnode_ping_meanlost);
		$vs_ippool_adjnode_ping_meanjitter = array_map("tonull", $vs_ippool_adjnode_ping_meanjitter);
		$vs_ippool_adjnode_ping_meandelay = array_map("tonull", $vs_ippool_adjnode_ping_meandelay);
		$vs_ippath_ping_maxlost = array_map("tonull", $vs_ippath_ping_maxlost);
		$vs_ippath_ping_maxjitter = array_map("tonull", $vs_ippath_ping_maxjitter);
		$vs_ippath_ping_maxdelay = array_map("tonull", $vs_ippath_ping_maxdelay);
		$vs_ippool_adjnode_ping_maxlost = array_map("tonull", $vs_ippool_adjnode_ping_maxlost);
		$vs_ippool_adjnode_ping_maxjitter = array_map("tonull", $vs_ippool_adjnode_ping_maxjitter);
		$vs_ippool_adjnode_ping_maxdelay = array_map("tonull", $vs_ippool_adjnode_ping_maxdelay);
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
		
	///////////////////////////////////IPPATH LOSS////////////////////////////////////////////////		
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
						text: 'IPPATH Loss (BSC6900)',
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
						name: 'IPPATH Ping Mean Lost',
						data: [<?php echo join($vs_ippath_ping_meanlost, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPATH Ping Max Lost',
						data: [<?php echo join($vs_ippath_ping_maxlost, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}		
					]							
		});
		
	///////////////////////////////////IPPOOL LOSS////////////////////////////////////////////////		
var graph1 = new Highcharts.Chart({
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
						text: 'IPPOOL Loss (BSC6910)',
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
						name: 'IPPOOL Ping Mean Lost',
						data: [<?php echo join($vs_ippool_adjnode_ping_meanlost, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPOOL Ping Max Lost',
						data: [<?php echo join($vs_ippool_adjnode_ping_maxlost, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}		
					]							
		});		

		
	///////////////////////////////////IPPATH JITTER////////////////////////////////////////////////		
var graph2 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph3',
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
						text: 'IPPATH Jitter (BSC6900)',
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
						name: 'IPPATH Ping Mean Jitter',
						data: [<?php echo join($vs_ippath_ping_meanjitter, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPATH Ping Max Jitter',
						data: [<?php echo join($vs_ippath_ping_maxjitter, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}		
					]							
		});
		
	///////////////////////////////////IPPATH JITTER////////////////////////////////////////////////		
var graph2 = new Highcharts.Chart({
				chart: {
						renderTo: 'graph4',
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
						text: 'IPPOOL Jitter (BSC6910)',
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
						name: 'IPPOOL Ping Mean Jitter',
						data: [<?php echo join($vs_ippool_adjnode_ping_meanjitter, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPOOL Ping Max Jitter',
						data: [<?php echo join($vs_ippool_adjnode_ping_maxjitter, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}		
					]							
		});		
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////IPPATH DELAY//////////////////////////

		var graph3 = new Highcharts.Chart({
		chart: {
				renderTo: 'graph5',
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
						text: 'IPPATH Delay (BSC6900)',// - ' + node,
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
					///	showInLegend: false,
						name: 'IPPATH Ping Mean Delay',
						data: [<?php echo join($vs_ippath_ping_meandelay, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPATH Ping Max Delay',
						data: [<?php echo join($vs_ippath_ping_maxdelay, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}		
					]							
		});
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////IPPOOL DELAY//////////////////////////

		var graph3 = new Highcharts.Chart({
		chart: {
				renderTo: 'graph6',
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
						text: 'IPPOOL Delay (BSC6910)',// - ' + node,
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
					///	showInLegend: false,
						name: 'IPPOOL Ping Mean Delay',
						data: [<?php echo join($vs_ippool_adjnode_ping_meandelay, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
					}
					,{
					///	showInLegend: false,
						name: 'IPPOOL Ping Max Delay',
						data: [<?php echo join($vs_ippool_adjnode_ping_maxdelay, ',') ?>]///[7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
						///data: JSON.parse("[" + acc_rrc + "]")
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
				