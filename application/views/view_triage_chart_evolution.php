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
		var evolution = new Highcharts.chart({
			
	colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
      '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
	
    chart: {
		renderTo: 'evolution',
		type: 'column',
		 backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#2a2a2b'],
            [1, '#3e3e40']
         ]
      },
      style: {
         fontFamily: '\'Unica One\', sans-serif'
      },
      plotBorderColor: '#606063'
    },
    title: {
        text: '<b>Triage Weekly Evolution</b>',
		style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
    },
	
	subtitle: {
	 text: '<i>'+node+'</i>',
	 style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '15px'
      }
	},
	credits: {
					   enabled: false
					},		
    xAxis: {
        categories: ['ANALYSIS','OMR','TX/OMR','OTM','CAP','PLAN/ENG RF', 'IMP','NORMAL'],
        crosshair: true,
		 gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
    },
    yAxis: {
        min: 0,
		gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         },
		formatter: function () {
        return this.value + '%';
        }    
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
		 text: '% of classification',
         style: {
            color: '#A0A0A3'
         }
      }
    },
    tooltip: {
        headerFormat: '<span style="font-size:12px"><b>{point.key}</b></span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0"><b>{series.name}: </b></td>' +
            '<td style="padding:0"><b>{point.y:.2f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true,
		backgroundColor: 'silver',
      style: {
         color: 'black'
      }
    },
    plotOptions: {
        column: {
            pointPadding: 0.1,
            borderWidth: 0
        },
	
	series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
	  
    },
	
  legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },
	
    series: [
	{
        name: 'W'+week[3],
        data: [analysis[3],omr[3],tx_omr[3],otm[3],cap[3],rf[3],imp[3],normal[3]]
    }, 
	{
        name: 'W'+week[2],
        data: [analysis[2],omr[2],tx_omr[2],otm[2],cap[2],rf[2],imp[2],normal[2]]
    }, 
	{
        name: 'W'+week[1],
        data: [analysis[1],omr[1],tx_omr[1],otm[1],cap[1],rf[1],imp[1],normal[1]]
    }, 
	{
        name: 'W'+week[0],
        data: [analysis[0],omr[0],tx_omr[0],otm[0],cap[0],rf[0],imp[0],normal[0]]
    }, 
	]
});

//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('#export').click(function() {
    Highcharts.exportCharts([evolution]);
});		
  });	


  });

    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				