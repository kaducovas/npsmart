	<?php 	
	foreach($overshooters_count as $row){
		#$weeks = $row->weeks;	
		$node[] = $row->node;
		$overshooters_portions = explode(",", $row->overshooters_portion);
		$non_overshooters_portions = explode(",", $row->non_overshooters_portion);
		#print_r($week);
		
		for($i=0;$i<3;$i++){	
			#echo($semana);
			#$semana = $week[$i];
			#print_r($semana);
			if(isset($overshooters_portions[$i])){
				${'W'.$i.'_overshooter'}[] = $overshooters_portions[$i];
				${'W'.$i.'_non_overshooter'}[] = $non_overshooters_portions[$i];
				#$overshooter[$semana] = $overshooters_portions[$i];
				#$non_overshooter[$semana] = $non_overshooters_portions[$i];
			} 
			else {
				${'W'.$i.'_overshooter'}[] = 0;
				${'W'.$i.'_non_overshooter'}[] = 0;
				#$overshooter[$semana] = 0;
				#$non_overshooter[$semana] = 0;
			}
			#$semana = $semana +1;
		}
		
		//$weekindex = (count($week) -1);
		
		// for ($i = 0; $i <= $weekindex; $i++) {
			// $overshooter[] = $overshooters_portions[$i];
			// $non_overshooter[] = $non_overshooters_portions[$i];	 
		 // }
		 $weeks = $overshooters_count[0]->weeks;
		 $week = explode(",", $weeks);

		 // $minweek = min($week);
		// $semana = $minweek;	
		// for($i=0;$i<4;$i++){	
				// ${'W'.$i.'_overshooter'}[] = $overshooter[$semana];
				// ${'W'.$i.'_non_overshooter'}[] = $non_overshooters_portions[$semana];
				// $overshooter[$semana] = $overshooters_portions[$semana];
				// $non_overshooter[$semana] = $non_overshooters_portions[$semana];
				// $semana = $semana +1;
		// }
}		 
		// $W0_overshooter[] = $overshooters_portions[0];
		// $W1_overshooter[] = $overshooters_portions[1];
		// $W2_overshooter[] = $overshooters_portions[2];
		// $W3_overshooter[] = $overshooters_portions[3];
		// $W0_non_overshooter[] = $non_overshooters_portions[0];
		// $W1_non_overshooter[] = $non_overshooters_portions[1];
		// $W2_non_overshooter[] = $non_overshooters_portions[2];
		// $W3_non_overshooter[] = $non_overshooters_portions[3];
				 
		//array_walk($date, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
		
<script>
var week0 = "<?php echo "W".$week[0]; ?>";
var week1 = "<?php echo "W".$week[1]; ?>";
var week2 = "<?php echo "W".$week[2]; ?>";
//var week3 = "<?php #echo "W".$week[3]; ?>";
var node = <?php echo json_encode($node); ?>;	

//var node = JSON.parse("[" + node + "]");
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
///variavel do maluco
		var ugly = ['', week0, '', week1, '', week2, ''];
		//var ugly = ['', week0, '', week1, '', week2, '',week3, ''];
		
		cats = [];
		for (i = 0; i < node.length; i++) { 
			cats = cats.concat(ugly);
		}
		//var cats = ugly.concat(ugly).concat(ugly).concat(ugly).concat(ugly).concat(ugly);
		var zeroes = [];
		cats.forEach(function () {zeroes.push(0);}); 
	
		//var chart;
		//$(document).ready(function() {
			var options = {//new Highcharts.Chart({
				chart: {
				//renderTo: 'acc',
				type: 'column',
				zoomType: 'xy'
			},
			credits: {
				enabled: false
			},		
			exporting: {
				enabled: true 
			},
			title: {
				text: 'Overshooters',
				 style: {
							  textOverflow: 'none',
							  fontSize: '20px',
							 fontFamily: 'Calibri'
						  }
			},
			 xAxis: [
					  {
				categories: cats,
						  labels: {autoRotation:false, 
						  style: {
							  textOverflow: 'none',
							  fontSize: '16px',
							 fontFamily: 'Calibri'
						  }},
			   tickWidth: 0,
					},
							  {
						categories: node,
						labels: {autoRotation:false, 
						  style: {
							  textOverflow: 'none',
							  fontSize: '16px',
							 fontFamily: 'Calibri'
						  }},
									 lineColor:'#ffffff',
									tickWidth: 0,
								 
					}     ,
					 ],
				yAxis: {
					max: 100,
					labels: {autoRotation:false, 
						  style: {
							  textOverflow: 'none',
							  fontSize: '16px',
							 fontFamily: 'Calibri'
						  }},
					title: {
						//text: 'Total fruit consumption'
					},
					stackLabels: {
					enabled: false,
					style: {
						//fontWeight: 'bold',
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
				shadow: false,
				itemStyle: {
					fontSize: '20px',
					fontFamily: 'Calibri'
				}
			},
			
			// tooltip: {
				  // pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            // shared: true
			// },
			        tooltip: {
            formatter: function () {
        
                return '<b>' + this.x +  ' ' + this.series.options.stack +  '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
			
			plotOptions: {
				column: {
					stacking: 'normal',
					groupPadding: 0.10,
					 dataLabels: {
						 enabled: true,
						  //rotation: -90,
							color: '#FFFFFF',
						// //color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						 style: {
							 fontSize: '20px',
							 fontFamily: 'Calibri'
							// //textShadow: '0 0 3px black'
						 }
					 }
				},
				series: {
					//y:-30//,
					//pointWidth: 50,
					//pointPadding: 0,
					//groupPadding: 0.2,
					//grouping: true
				}
			},			
			
			
			series: [{
				name: 'Overshooters',
				color:'red',
				data: [<?php echo join($W0_overshooter, ',') ?>],
				stack: week0,
				xAxis:1,
				dataLabels: {
                //enabled: false
				color: '#FFFFFF',
				style: {
					fontSize: '12px',
					fontFamily: 'Calibri'
							// //textShadow: '0 0 3px black'
					}
			 }
			}, {
				name: 'Non-Overshooters',
				color:'green',
				data: [<?php echo join($W0_non_overshooter, ',') ?>],
				stack: week0,
				xAxis:1,
				dataLabels: {
                //enabled: true,
				  rotation: -90,
				  color: '#FFFFFF'
			 }
			},
			{
				name: 'Overshooters',
				color:'red',
				data: [<?php echo join($W1_overshooter, ',') ?>],
				stack: week1,
				showInLegend: false,
				xAxis:1,
				dataLabels: {
                //enabled: false
				color: '#FFFFFF',
				style: {
					fontSize: '12px',
					fontFamily: 'Calibri'
							// //textShadow: '0 0 3px black'
					}
			 }
			}, {
				name: 'Non-Overshooters',
				color:'green',
				data: [<?php echo join($W1_non_overshooter, ',') ?>],
				stack: week1,
				showInLegend: false,
				xAxis:1,
				dataLabels: {
                //enabled: true,
				  rotation: -90,
				  color: '#FFFFFF'
			 }
			},
			{
				name: 'Overshooters',
				color:'red',
				data: [<?php echo join($W2_overshooter, ',') ?>],
				stack: week2,
				showInLegend: false,
				xAxis:1,
				dataLabels: {
                //enabled: false
				color: '#FFFFFF',
				style: {
					fontSize: '12px',
					fontFamily: 'Calibri'
							// //textShadow: '0 0 3px black'
					}
			 }
			}, {
				name: 'Non-Overshooters',
				color:'green',
				data: [<?php echo join($W2_non_overshooter, ',') ?>],
				stack: week2,
				showInLegend: false,
				xAxis:1,
				dataLabels: {
                //enabled: true,
				  rotation: -90,
				  color: '#FFFFFF'
			 }
			},
// {
				// name: 'Overshooters',
				// color:'red',
				// data: [<?php #echo join($W3_overshooter, ',') ?>],
				// stack: week3,
				// showInLegend: false,
				// xAxis:1,
				// dataLabels: {
                // //enabled: false
				// color: '#FFFFFF',
				// style: {
					// fontSize: '12px',
					// fontFamily: 'Calibri'
							// // //textShadow: '0 0 3px black'
					// }
			 // }
			// }, {
				// name: 'Non-Overshooters',
				// color:'green',
				// data: [<?php #echo join($W3_non_overshooter, ',') ?>],
				// stack: week3,
				// showInLegend: false,
				// xAxis:1,
				// dataLabels: {
                // //enabled: true,
				  // rotation: -90,
				  // color: '#FFFFFF'
			 // }
			// },			
			{
            name: '',
            data: zeroes,
            showInLegend: false,
            stack: week1,
			 dataLabels: {
                enabled: false
			 }
        }
			
			]
			};
		//});
	//});
	
 var onLegendClick= function (event) {
	     	    		                	var myname = this.name;
	     	    		                	var myvis  = !this.visible;
	     	    		                	this.chart.series.forEach( function (elem) {
	     	    		                		if (elem.name == myname) {
	     	    		                			elem.setVisible(myvis);
	     	    		                		}
	     	    		                	});
	     	    		                	return false;
	     	    		                }
	     	    		            
    
    options.series.forEach(function (serie) {
        serie.events = { legendItemClick : onLegendClick} ;
    });	
	$('#acc').highcharts(options);
	
			
	});						
	
//////////////////////////////////////////////////////////////////////////////////////////FIM//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
  


    // $('.chart_content').bind('dblclick', function () {
        // var $this = $(this);
        // $this.toggleClass('modal');
        // $('.chart1', $this).highcharts().reflow();
    // });	
	
</script>				
				