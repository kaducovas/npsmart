	<?php 
	foreach($triage_chart as $row){
	    $week[] = $row->week;
		$node = $row->node;
		$analysis[] = $row->analysis;
		$cap[] = $row->cap;
		$imp[] = $row->imp;
		$normal[] = $row->normal;
		$omr[] = $row->omr;
		$otm[] = $row->otm;
		$rf[] = $row->rf;
		$tx_omr[] = $row->tx_omr;
		}	
		?>
<script>
week = new Array(4);
week[0] = "<?php echo $week[0]; ?>";
week[1] = "<?php echo $week[1]; ?>";
week[2] = "<?php echo $week[2]; ?>";
week[3] = "<?php echo $week[3]; ?>";

var node = "<?php echo $node; ?>";

analysis = new Array(4);
analysis[0] = <?php echo $analysis[0]; ?>;
analysis[1] = <?php echo $analysis[1]; ?>;
analysis[2] = <?php echo $analysis[2]; ?>;
analysis[3] = <?php echo $analysis[3]; ?>;

cap = new Array(4);
cap[0] = <?php echo $cap[0]; ?>;
cap[1] = <?php echo $cap[1]; ?>;
cap[2] = <?php echo $cap[2]; ?>;
cap[3] = <?php echo $cap[3]; ?>;

imp = new Array(4);
imp[0] = <?php echo $imp[0]; ?>;
imp[1] = <?php echo $imp[1]; ?>;
imp[2] = <?php echo $imp[2]; ?>;
imp[3] = <?php echo $imp[3]; ?>;

normal = new Array(4);
normal[0] = <?php echo $normal[0]; ?>;
normal[1] = <?php echo $normal[1]; ?>;
normal[2] = <?php echo $normal[2]; ?>;
normal[3] = <?php echo $normal[3]; ?>;

omr = new Array(4);
omr[0] = <?php echo $omr[0]; ?>;
omr[1] = <?php echo $omr[1]; ?>;
omr[2] = <?php echo $omr[2]; ?>;
omr[3] = <?php echo $omr[3]; ?>;

otm = new Array(4);
otm[0] = <?php echo $otm[0]; ?>;
otm[1] = <?php echo $otm[1]; ?>;
otm[2] = <?php echo $otm[2]; ?>;
otm[3] = <?php echo $otm[3]; ?>;

rf = new Array(4);
rf[0] = <?php echo $rf[0]; ?>;
rf[1] = <?php echo $rf[1]; ?>;
rf[2] = <?php echo $rf[2]; ?>;
rf[3] = <?php echo $rf[3]; ?>;

tx_omr = new Array(4);
tx_omr[0] = <?php echo $tx_omr[0]; ?>;
tx_omr[1] = <?php echo $tx_omr[1]; ?>;
tx_omr[2] = <?php echo $tx_omr[2]; ?>;
tx_omr[3] = <?php echo $tx_omr[3]; ?>;
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
		var overview = new Highcharts.chart({
   colors: ['#A4A4A4', '#B23AEE', '#66CDAA', '#2E9AFE', '#EEDC82', '#FE642E', '#104E8B',
      '#32CD32', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
		renderTo: 'overview',
		type: 'pie',
		options3d: {
            enabled: true,
            alpha: 45,
        },
		backgroundColor: "#F8F8F8"
      },
 
    title: {
        text: "<b>W"+week[0]+" TRIAGE</b>",
		style: {
         fontSize: '23px'
      }
    },

	subtitle: {
	 text: '<i>'+node+'</i>',
	 style: {
         textTransform: 'uppercase',
         fontSize: '15px'
      }
	},
credits: {
					   enabled: false
					},			
	 tooltip: {
        pointFormat: '',
							series: {
							cursor: 'pointer',
							events: {
								click: function( event ) {
								var kpi = this.name;
								kpi = kpi.toLowerCase();
								kpi = kpi.trim();
								var strkpi = kpi.replace(/(^\s+|\s+$)/g, '');
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
	
    plotOptions: {
      pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
            enabled: true,
            format: '{point.name}'
            }
    },
	},
	
    series: [
	{	type: 'pie',
        name: 'W'+week[0],
        data:[['ANALYSIS '+analysis[0]+'%', analysis[0]],
		['OMR '+omr[0]+'%', omr[0]],
		['TX/OMR '+tx_omr[0]+'%', tx_omr[0]],
		['OTM '+otm[0]+'%', otm[0]],
        ['CAP '+cap[0]+'%', cap[0]],
		['PLAN/ENG RF '+rf[0]+'%', rf[0]],
        ['IMP '+imp[0]+'%', imp[0]],
        ['NORMAL '+normal[0]+'%', normal[0]]]
    }, 
	]
});

//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#export').click(function() {
    Highcharts.exportCharts([overview]);
});		
  });	


  });

    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				
				