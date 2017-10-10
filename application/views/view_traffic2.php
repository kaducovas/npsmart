	<?php 
		foreach($result as $row){
			#$rnc = $row->rnc;
			#$cellname =  $row->cellname;
			#$cellid = $row->cellid;
			$datetime[] = $row->datetime;
			$hsdpa_data[] = $row->hsdpa_data;
			$hsupa_data[] = $row->hsupa_data;
			$ps_r99_ul[] = $row->ps_r99_ul;
			$ps_r99_dl[] = $row->ps_r99_dl;
			$voice_traffic_dl[] = $row->voice_traffic_dl;
			$voice_traffic_ul[] = $row->voice_traffic_ul;
			$voice_erlangs_num[] = $row->voice_erlangs_num;
			$voice_erlangs_den[] = $row->voice_erlangs_den;
			$hsdpa_users[] = $row->hsdpa_users;
			$hsupa_users[] = $row->hsupa_users;
			$ps_nonhs_users[] = $row->ps_nonhs_users;
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
			
///////////////////////////////////////////////////////////DL DATA/////////////////////////////////////////////		
	var dl_data = new Highcharts.Chart({

        chart: {
			renderTo: 'dl_data',
            zoomType: 'x'
        },
        title: {
            text: 'DL Data Volume'
        },
       /// subtitle: {
        ///    text: document.ontouchstart === undefined ?
         ///           'Click and drag in the plot area to zoom in' :
          ///          'Pinch the chart to zoom in'
       /// },
        xAxis: {
			categories: [<?php echo join($datetime, ',') ?>]
        },
        yAxis: {
            title: {
                text: 'DL Data Volume'
            },
			min:0
        },
        legend: {
            enabled: true,
			layout: 'horizontal',
			align: 'left',
			verticalAlign: 'top',
			floating: true,
			borderWidth: 0
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },
		
        series: [{
            type: 'area',
            name: 'HSDPA Data Volume',
            ///pointInterval: 24 * 3600 * 1000,
           /// pointStart: Date.UTC(2013, 0, 1),
            data: [<?php echo join($hsdpa_data, ',') ?>]
			},
			{
            type: 'area',
            name: 'R99 DL Data Volume',
            data: [<?php echo join($ps_r99_dl, ',') ?>]
			}
			
			]
    });	
	
	
///////////////////////////////////////////////////////////UL DATA/////////////////////////////////////////////		
	
	var ul_data = new Highcharts.Chart({

        chart: {
			renderTo: 'ul_data',
            zoomType: 'x'
        },
        title: {
            text: 'UL Data Volume'
        },
       /// subtitle: {
        ///    text: document.ontouchstart === undefined ?
         ///           'Click and drag in the plot area to zoom in' :
          ///          'Pinch the chart to zoom in'
       /// },
        xAxis: {
			categories: [<?php echo join($datetime, ',') ?>]
        },
        yAxis: {
            title: {
                text: 'UL Data Volume'
            },
			min:0
        },
        legend: {
            enabled: true,
			layout: 'horizontal',
			align: 'left',
			verticalAlign: 'top',
			floating: true,
			borderWidth: 0
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },
		
        series: [{
            type: 'area',
            name: 'HSUPA Data Volume',
            ///pointInterval: 24 * 3600 * 1000,
           /// pointStart: Date.UTC(2013, 0, 1),
            data: [<?php echo join($hsupa_data, ',') ?>]
			},
			{
            type: 'area',
            name: 'R99 UL Data Volume',
            data: [<?php echo join($ps_r99_ul, ',') ?>]
			}
			
			]
    });

///////////////////////////////////////////////////////////HSDPA USERS/////////////////////////////////////////////		
	
	var hsdpa_users = new Highcharts.Chart({

        chart: {
			renderTo: 'hsdpa_users',
            zoomType: 'x'
        },
        title: {
            text: 'HSDPA Users'
        },
       /// subtitle: {
        ///    text: document.ontouchstart === undefined ?
         ///           'Click and drag in the plot area to zoom in' :
          ///          'Pinch the chart to zoom in'
       /// },
        xAxis: {
			categories: [<?php echo join($datetime, ',') ?>]
        },
        yAxis: {
            title: {
                text: 'HSDPA Users'
            },
			min:0
        },
        legend: {
            enabled: true,
			layout: 'horizontal',
			align: 'left',
			verticalAlign: 'top',
			floating: true,
			borderWidth: 0
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },
		
        series: [{
            type: 'area',
            name: 'HSDPA Users',
            ///pointInterval: 24 * 3600 * 1000,
           /// pointStart: Date.UTC(2013, 0, 1),
            data: [<?php echo join($hsdpa_users, ',') ?>]
			}
			
			]
    });
	
///////////////////////////////////////////////////////////HSUPA USERS/////////////////////////////////////////////		
	
	var hsupa_users = new Highcharts.Chart({

        chart: {
			renderTo: 'hsupa_users',
            zoomType: 'x'
        },
        title: {
            text: 'HSUPA Users'
        },
       /// subtitle: {
        ///    text: document.ontouchstart === undefined ?
         ///           'Click and drag in the plot area to zoom in' :
          ///          'Pinch the chart to zoom in'
       /// },
        xAxis: {
			categories: [<?php echo join($datetime, ',') ?>]
        },
        yAxis: {
            title: {
                text: 'HSUPA Users'
            },
			min:0
        },
        legend: {
            enabled: true,
			layout: 'horizontal',
			align: 'left',
			verticalAlign: 'top',
			floating: true,
			borderWidth: 0
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },
		
        series: [{
            type: 'area',
            name: 'HSUPA Users',
            ///pointInterval: 24 * 3600 * 1000,
           /// pointStart: Date.UTC(2013, 0, 1),
            data: [<?php echo join($hsupa_users, ',') ?>]
			}
			
			]
    });	

	
});


});


</script>