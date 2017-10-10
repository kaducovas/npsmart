	<?php 
	foreach($chart_weekly as $row){
	    $week[] = $row->week;
		$rf_health_index[] = $row->rf_health_index;
		$baseline[] = $row->baseline;
		$throughput[] = $row->throughput;
		$retention_3g[] = $row->retention_3g;
		$ps_call_completion[] = $row->ps_call_completion;
		$cs_call_completion[] = $row->cs_call_completion;
		$availability[] = $row->availability;
		$hardware_nodeb[] = $row->hardware_nodeb;
		$air_interface_ul[] = $row->air_interface_ul;
		$air_interface_dl[] = $row-> air_interface_dl;	
		$sho_overhead[] = $row-> sho_overhead;
		$overshooters[] = $row-> overshooters;
		$cpich_power_ratio[] = $row-> cpich_power_ratio;
		$worst_aging_factor[] = $row-> worst_aging_factor;
		$traffic_load[] = $row-> traffic_load;
		$process_tools[] = $row-> process_tools;
		$node = $row->node;
		}	
				 
		?>
		
<script>
///	for (i = 0; i < cars.length; i++) { 
///    text += cars[i] + "<br>";
///}
var node = "<?php echo $node; ?>";

week = new Array(4);
week[0] = "<?php echo $week[0]; ?>";
week[1] = "<?php echo $week[1]; ?>";
week[2] = "<?php echo $week[2] ?>";
week[3] = "<?php echo $week[3]; ?>";

rf_health_index = new Array(4);
rf_health_index[0] = <?php echo $rf_health_index[0]; ?>;
rf_health_index[1] = <?php echo $rf_health_index[1]; ?>;
rf_health_index[2] = <?php echo $rf_health_index[2] ?>;
rf_health_index[3] = <?php echo $rf_health_index[3]; ?>;

baseline = new Array(4);
baseline[0] = <?php echo $baseline[0]; ?>;
baseline[1] = <?php echo $baseline[1]; ?>;
baseline[2] = <?php echo $baseline[2]; ?>;
baseline[3] = <?php echo $baseline[3]; ?>;

throughput = new Array(4);
throughput[0] = <?php echo $throughput[0]; ?>;
throughput[1] = <?php echo $throughput[1]; ?>;
throughput[2] = <?php echo $throughput[2]; ?>;
throughput[3] = <?php echo $throughput[3]; ?>;

retention_3g = new Array(4);
retention_3g[0] = <?php echo $retention_3g[0]; ?>;
retention_3g[1] = <?php echo $retention_3g[1]; ?>;
retention_3g[2] = <?php echo $retention_3g[2]; ?>;
retention_3g[3] = <?php echo $retention_3g[3]; ?>;

ps_call_completion = new Array(4);
ps_call_completion[0] = <?php echo $ps_call_completion[0]; ?>;
ps_call_completion[1] = <?php echo $ps_call_completion[1]; ?>;
ps_call_completion[2] = <?php echo $ps_call_completion[2]; ?>;
ps_call_completion[3] = <?php echo $ps_call_completion[3]; ?>;

cs_call_completion = new Array(4);
cs_call_completion[0] = <?php echo $cs_call_completion[0]; ?>;
cs_call_completion[1] = <?php echo $cs_call_completion[1]; ?>;
cs_call_completion[2] = <?php echo $cs_call_completion[2]; ?>;
cs_call_completion[3] = <?php echo $cs_call_completion[3]; ?>;

availability = new Array(4);
availability[0] = <?php echo $availability[0]; ?>;
availability[1] = <?php echo $availability[1]; ?>;
availability[2] = <?php echo $availability[2]; ?>;
availability[3] = <?php echo $availability[3]; ?>;

hardware_nodeb = new Array(4);
hardware_nodeb[0] = <?php echo $hardware_nodeb[0]; ?>;
hardware_nodeb[1] = <?php echo $hardware_nodeb[1]; ?>;
hardware_nodeb[2] = <?php echo $hardware_nodeb[2]; ?>;
hardware_nodeb[3] = <?php echo $hardware_nodeb[3]; ?>;

air_interface_ul = new Array(4);
air_interface_ul[0] = <?php echo $air_interface_ul[0]; ?>;
air_interface_ul[1] = <?php echo $air_interface_ul[1]; ?>;
air_interface_ul[2] = <?php echo $air_interface_ul[2]; ?>;
air_interface_ul[3] = <?php echo $air_interface_ul[3]; ?>;

air_interface_dl = new Array(4);
air_interface_dl[0] = <?php echo $air_interface_dl[0]; ?>;	
air_interface_dl[1] = <?php echo $air_interface_dl[1]; ?>;	
air_interface_dl[2] = <?php echo $air_interface_dl[2]; ?>;	
air_interface_dl[3] = <?php echo $air_interface_dl[3]; ?>;	

sho_overhead = new Array(4);
sho_overhead[0] = <?php echo $sho_overhead[0]; ?>;
sho_overhead[1] = <?php echo $sho_overhead[1]; ?>;
sho_overhead[2] = <?php echo $sho_overhead[2]; ?>;
sho_overhead[3] = <?php echo $sho_overhead[3]; ?>;

overshooters = new Array(4);
overshooters[0] = <?php echo $overshooters[0]; ?>;
overshooters[1] = <?php echo $overshooters[1]; ?>;
overshooters[2] = <?php echo $overshooters[2]; ?>;
overshooters[3] = <?php echo $overshooters[3]; ?>;

cpich_power_ratio = new Array(4);
cpich_power_ratio[0] = <?php echo $cpich_power_ratio[0]; ?>;
cpich_power_ratio[1] = <?php echo $cpich_power_ratio[1]; ?>;
cpich_power_ratio[2] = <?php echo $cpich_power_ratio[2]; ?>;
cpich_power_ratio[3] = <?php echo $cpich_power_ratio[3]; ?>;

worst_aging_factor = new Array(4);
worst_aging_factor[0] = <?php echo $worst_aging_factor[0]; ?>;
worst_aging_factor[1] = <?php echo $worst_aging_factor[1]; ?>;
worst_aging_factor[2] = <?php echo $worst_aging_factor[2]; ?>;
worst_aging_factor[3] = <?php echo $worst_aging_factor[3]; ?>;

traffic_load = new Array(4);
traffic_load[0] = <?php echo $traffic_load[0]; ?>;
traffic_load[1] = <?php echo $traffic_load[1]; ?>;
traffic_load[2] = <?php echo $traffic_load[2]; ?>;
traffic_load[3] = <?php echo $traffic_load[3]; ?>;

process_tools = new Array(4);
process_tools[0] = <?php echo $process_tools[0]; ?>;
process_tools[1] = <?php echo $process_tools[1]; ?>;
process_tools[2] = <?php echo $process_tools[2]; ?>;
process_tools[3] = <?php echo $process_tools[3]; ?>;
//alert(node);
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
		var acc = new Highcharts.chart({
    chart: {
		renderTo: 'acc',
        polar: true
    },
	
	pane: {
        startAngle: 0,
        endAngle: 360
		
    },
    title: {
        text: '<b>RADAR CHART</b>'
    },
	
	subtitle: {
	 text: '<i>'+node+'</i>',
	},
credits: {
					   enabled: false
					},		
    xAxis: {
        categories: ['RF Health Index','SW Release & Features','Worst Aging Factor', 'Baseline (Consistency Check)','Throughput', 'Service Retention in 3G', 
	  'PS (Call Completion)', 'CS (Call Completion)','Availability','Traffic Load','Hardware (regionB: CE & Iub/RNC)','Air Interface UL (RTWP)', 'Air Interface DL (Codes & Power)',
	  'SHO Overhead','Overshooters','CPICH Power Ratio'],
		 labels: {
            style: {
                color: '#525151',
                font: '12px Calilbri',
                fontWeight: 'bold'
            }
			}
    },
    yAxis: {
 	    tickInterval: 1,
        max: 10,
		min:0,
		reversed: Boolean,		
        labels: {
            style: {
                color: '#525151',
    }}},
	
    // legend: {
        // enabled: false
    // },
	
 
    plotOptions: {
        column: {
		    pointPadding: 0,
            groupPadding: 0,
            stacking: 'normal',
			shadow: true,
			showInLegend: false,
			enableMouseTracking: false,
        },
    },
    series: [
		{
		type: 'column',
		color: '#91FF00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    }, 
	{
		type: 'column',
		color: '#91FF00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    }, 
	{
		type: 'column',
		color: '#ABFF00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#DAFF00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FFFC00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FFDA00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FF9A00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FF5E00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FF4400',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FF1E00',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
		type: 'column',
		color: '#FF0000',
        data: [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
    },{
	    type: 'line',
		color: '#000000',
        name: 'W'+week[0],
        data: [rf_health_index[0], process_tools[0], worst_aging_factor[0], baseline[0], throughput[0], 
		retention_3g[0], ps_call_completion[0], cs_call_completion[0], 
		availability[0], traffic_load[0], hardware_nodeb[0], air_interface_ul[0], air_interface_dl[0], 
		sho_overhead[0], overshooters[0], cpich_power_ratio[0]],
    },{
	    type: 'line',
		color: '#A901DB',
        name: 'W'+week[1],
        data: [rf_health_index[1], process_tools[1], worst_aging_factor[1], baseline[1], throughput[1], 
		retention_3g[1], ps_call_completion[1], cs_call_completion[1], 
		availability[1], traffic_load[1], hardware_nodeb[1], air_interface_ul[1], air_interface_dl[1], 
		sho_overhead[1], overshooters[1], cpich_power_ratio[1]],
    },{
	    type: 'line',
		color: '#FF0040',
        name: 'W'+week[2],
        data: [rf_health_index[2], process_tools[2], worst_aging_factor[2], baseline[2], throughput[2], 
		retention_3g[2], ps_call_completion[2], cs_call_completion[2], 
		availability[2], traffic_load[2], hardware_nodeb[2], air_interface_ul[2], air_interface_dl[2], 
		sho_overhead[2], overshooters[2], cpich_power_ratio[2]],
    },{
	    type: 'line',
		color: '#002FFF',
        name: 'W'+week[3],
        data: [rf_health_index[3], process_tools[3], worst_aging_factor[3], baseline[3], throughput[3], 
		retention_3g[3], ps_call_completion[3], cs_call_completion[3], 
		availability[3], traffic_load[3], hardware_nodeb[3], air_interface_ul[3], air_interface_dl[3], 
		sho_overhead[3], overshooters[3], cpich_power_ratio[3]],
    },]
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
				