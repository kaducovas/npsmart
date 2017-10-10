	<?php 
	foreach($overshooters_count as $row){
		$week = explode(",", $row->weeks);	
		$overshooters_portions = explode(",", $row->overshooters_portion);
		$non_overshooters_portions = explode(",", $row->non_overshooters_portion);
		
		$weekindex = (count($week) -1);
		
		for ($i = 0; $i <= $weekindex; $i++) {
			$overshooter[] = $overshooters_portions[$i];
			$non_overshooter[] = $non_overshooters_portions[$i];	 
		 }			
		}	
				 
		//array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
		
<script>



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
				type: 'column'
			},
			credits: {
				enabled: false
			},		
			exporting: {
				enabled: true 
			},
			title: {
				text: 'Overshooters'
			},
			xAxis: {
				categories: [{
					name: "BASE",
						categories: ["W11", "W12", "W13"]
							}, {
					name: "CO",
						categories: ["W11", "W12", "W13"]
						}, {
					name: "ES",
						categories: ["W11", "W12", "W13"]
						} , {
					name: "MG",
						categories: ["W11", "W12", "W13"]
						} , {
					name: "NE",
						categories: ["W11", "W12", "W13"]
						}, {
					name: "PRSC",
						categories: ["W11", "W12", "W13"]
						}
						]
					},
			yAxis: {
				max: 100,
				title: {
					//text: 'Total fruit consumption'
				},
				stackLabels: {
					enabled: true,
					style: {
						fontWeight: 'bold',
						color: 'white'
						//color: (Highcharts.theme && Highcharts.theme.textColor) || 'white'
					}
				}
			},
			legend: {
				align: 'center',
				//x: -30,
				verticalAlign: 'bottom',
				//y: 25,
				floating: false,
				backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				borderColor: '#CCC',
				borderWidth: 1,
				shadow: false
			},
			
			tooltip: {
				  pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: 'white',
						//color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style: {
							//textShadow: '0 0 3px black'
						}
					}
				},
				series: {
					//y:-30//,
					//pointWidth: 50,
					//pointPadding: 0,
					//groupPadding: 0.2,
					grouping: true
				}
			},
			series: [{
				name: 'Overshooters',
				color:'red',
				data: [<?php echo join($overshooter, ',') ?>]
			}, {
				name: 'Non-Overshooters',
				color:'green',
				data: [<?php echo join($non_overshooter, ',') ?>]
			}]
		});
	});
			
	});						
	
//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
  


    $('.chart_content').bind('dblclick', function () {
        var $this = $(this);
        $this.toggleClass('modal');
        $('.chart1', $this).highcharts().reflow();
    });	
	
</script>				
				