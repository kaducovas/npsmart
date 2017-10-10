	<?php 
	foreach($node_daily_report as $row){
		$date[] = $row->date;
		$node = $row->node;
		$qda_cs[] = $row->qda_cs;
		$qda_ps[] = $row->qda_ps;
		$qda_ps_f2h[] = $row->qda_ps_f2h;
		$qdr_cs[] = $row->qdr_cs;
		$qdr_ps[] = $row->qdr_ps;
		$throughput[] = $row->throughput;
		$availability[] = $row->availability;
		$retention_cs[] = $row->retention_cs;
		$retention_ps[] = $row->retention_ps;
		$hsdpa_users_ratio[] = $row->hsdpa_users_ratio;
		$nqi_cs[] = $row->nqi_cs;
		$nqi_ps[] = $row->nqi_ps;
		$nqi_ps_f2h[] = $row->nqi_ps_f2h;
		}	
				 
		array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
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
					resetZoomButton: {
        position: {
            align: 'left', // right by default
            verticalAlign: 'top', 
            x: 10,
            y: 10
        },
        relativeTo: 'chart'
    }},
				//	colors: ['#000099', '#CC0000', '#006600', '#FFCC00', '#D9CDB6'],
					credits: {
					   enabled: false
					},		
					exporting: { 
					enabled: true 
					},
					title: {
						text: '<b>NQI CS</b>',// - ' + node,
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
								// Log to console
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// alert(node.substring(0, 3));
								// if (node.substring(0, 3) == 'RNC' && reportagg == 'weekly') {
									document.getElementById('wcreportnename').value = node;
									document.getElementById('wcreportnetype').value = reportnetype;
									document.getElementById('wctimeagg').value = reportagg;
									document.getElementById('wcreportdate').value = date[event.point.x];
									document.getElementById('wckpi').value = this.name;
									document.wcform.submit();
								}
							}
						}
					},	
					// plotOptions: {
						// series: {
							// cursor: 'pointer',
							// events: {
								// click: function( event ) {
								// // Log to console
								// var kpis = ["QDA CS", "QDR CS","3G-Retention CS", "Weighted-Availability"];
								// var regions = ["CO", "PRSC", "NE", "BASE","ES","MG"];								
								// var kpi = this.name;
								// kpi = kpi.toLowerCase();
								// kpi = kpi.trim();
								// var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
								// //alert(node.substring(0, 3));
								
								// if (node.substring(0, 3) == 'RNC' && $.inArray(this.name, kpis) > -1) {
									// //alert(node);
									// document.getElementById('rnc').value = node;
									// document.getElementById('date').value = date[event.point.x];
									// document.getElementById('kpi').value = this.name;
									// document.wcform.submit();
								// } else if ($.inArray(node, regions) > -1) {
									// document.getElementById('node').value = node;
									// document.getElementById('week').value = date[event.point.x];
									// document.getElementById('weeklykpi').value = this.name;
									// document.weekwcform.submit();
								// } 
								
								// else {
									// alert("NPSmart current release does not support Worst Cells for the selected aggregation.")
								// }								
								
								// }
							// }
						// }
					// },
					
					series: [{
						name: 'QDA CS',
						data: [<?php echo join($qda_cs, ',') ?>]
					},
					{
			            name: 'QDR CS',
						data: [<?php echo join($qdr_cs, ',') ?>]
			        },
					{
			            name: '3G-Retention CS',
						data: [<?php echo join($retention_cs, ',') ?>]
			        },
					{
			            name: 'Weighted-Availability',
						data: [<?php echo join($availability, ',') ?>]
			        },
					{
			            name: 'NQI CS',
						data: [<?php echo join($nqi_cs, ',') ?>]
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
				