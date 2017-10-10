	<?php 
	foreach($unbalance_chart as $row){
	    $week[] = $row->week;
		$node[] = $row->node;
		$azimuth_no[] = $row->azimuth_no;
		}	
				 
		?>
<script>
week = new Array(4);
week[0] = "<?php echo $week[0]; ?>";
week[1] = "<?php echo $week[6]; ?>";
week[2] = "<?php echo $week[12]; ?>";
week[3] = "<?php echo $week[18]; ?>";
node = new Array(6);
node[0] = "<?php echo $node[0]; ?>";
node[1] = "<?php echo $node[1]; ?>";
node[2] = "<?php echo $node[2]; ?>";
node[3] = "<?php echo $node[3]; ?>";
node[4] = "<?php echo $node[4]; ?>";
node[5] = "<?php echo $node[5]; ?>";
azimuth_no = new Array(18);
azimuth_no[0] = <?php echo $azimuth_no[0]; ?>;
azimuth_no[1] = <?php echo $azimuth_no[1]; ?>;
azimuth_no[2] = <?php echo $azimuth_no[2]; ?>;
azimuth_no[3] = <?php echo $azimuth_no[3]; ?>;
azimuth_no[4] = <?php echo $azimuth_no[4]; ?>;
azimuth_no[5] = <?php echo $azimuth_no[5]; ?>;
azimuth_no[6] = <?php echo $azimuth_no[6]; ?>;
azimuth_no[7] = <?php echo $azimuth_no[7]; ?>;
azimuth_no[8] = <?php echo $azimuth_no[8]; ?>;
azimuth_no[9] = <?php echo $azimuth_no[9]; ?>;
azimuth_no[10] = <?php echo $azimuth_no[10]; ?>;
azimuth_no[11] = <?php echo $azimuth_no[11]; ?>;
azimuth_no[12] = <?php echo $azimuth_no[12]; ?>;
azimuth_no[13] = <?php echo $azimuth_no[13]; ?>;
azimuth_no[14] = <?php echo $azimuth_no[14]; ?>;
azimuth_no[15] = <?php echo $azimuth_no[15]; ?>;
azimuth_no[16] = <?php echo $azimuth_no[16]; ?>;
azimuth_no[17] = <?php echo $azimuth_no[17]; ?>;
azimuth_no[18] = <?php echo $azimuth_no[18]; ?>;
azimuth_no[19] = <?php echo $azimuth_no[19]; ?>;
azimuth_no[20] = <?php echo $azimuth_no[20]; ?>;
azimuth_no[21] = <?php echo $azimuth_no[21]; ?>;
azimuth_no[22] = <?php echo $azimuth_no[22]; ?>;
azimuth_no[23] = <?php echo $azimuth_no[23]; ?>;


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
			
	colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
      '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
	
    chart: {
		renderTo: 'acc',
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
        text: 'Unbalance Sectors',
		style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
    },
	credits: {
					   enabled: false
					},		
    xAxis: {
        categories: [
            node[0],
            node[1],
			node[2],
			node[3],
			node[4],
			node[5]
        ],
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
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
    },
    tooltip: {
        headerFormat: '<span style="font-size:12px"><b>{point.key}</b></span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0"><b>{series.name}: </b></td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
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
        name: 'W'+week[0],
        data: [azimuth_no[0],azimuth_no[1],azimuth_no[2],azimuth_no[3],azimuth_no[4],azimuth_no[5]]

    }, 
	{
        name: 'W'+week[1],
        data: [azimuth_no[6],azimuth_no[7],azimuth_no[8],azimuth_no[9],azimuth_no[10],azimuth_no[11]]

    },{
        name: 'W'+week[2],
        data: [azimuth_no[12],azimuth_no[13],azimuth_no[14],azimuth_no[15],azimuth_no[16],azimuth_no[17]]

    },{
        name: 'W'+week[3],
        data: [azimuth_no[18],azimuth_no[19],azimuth_no[20],azimuth_no[21],azimuth_no[22],azimuth_no[23]]

    },
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
				