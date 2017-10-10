<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="/js/themes/gray.js"></script>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
  .ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 200px;
  }
  </style>
 <style type="text/css">

 body {
    /* background-color: #E0E0E3; */ 
}
 
.main {
    width: 100%;
	height:400px;
	clear:both;
	text-align:center;
}

.ne{
	float:left;
	margin-left:5%;
}

.chart {
    
    max-width: 100%;
    height: 300px;
	clear:both;
    
}

.chart1 {
    
    max-width: 100%;

    height: 300px;
	clear:both;
    
}

.modal {
    width: 1400px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
	right: 0;
	text-align: center;

    background: rgba(0, 0, 0, 0.7);
}
.modal .chart {
    min-width: 300px;
    max-width: 90%;
	height: 90%;
	
}
.modal .chart1 {
    min-width: 300px;
    max-width: 98%;
	height: 100%;	
}

#result {
	text-align: right;
	color: gray;
	min-height: 2em;
}
#table-sparkline {
	margin: 0 auto;
    border-collapse: collapse;
}
th {
    font-weight: bold;
    text-align: center;
}

td {
    text-align: center;
}

td, th {
    padding: 5px;
    border-bottom: 1px solid silver;
    height: 20px;
}

thead th {
    border-top: 2px solid gray;
    border-bottom: 2px solid gray;
	
}
.highcharts-tooltip>span {
	background: white;
	border: 1px solid silver;
	border-radius: 3px;
	box-shadow: 1px 1px 2px #888;
	padding: 8px;
}

</style>
</head>
<?php 
	#	foreach($wc as $row){
	#		$rnc = $row->rnc;
#			$cellname[] = $row->cellname;
#			$cellid[] = $row->cellid;
#			$kpi_cell_rate[] = $row->kpi_cell_rate;
#			$fails_cell[] = $row->fails_cell;
#			$impact[] = $row->impact;
#			$kpi_rnc_rate[] = $row->kpi_rnc_rate;
#			$new_rnc_kpi[] = $row->new_rnc_kpi;
#			$dates[] = $row->dates;
#			$daily_kpi_cell_rate[] = $row->daily_kpi_cell_rate;
#			$daily_fails_cell[] = $row->daily_fails_cell;
#			$daily_impact[] = $row->daily_impact;
			
			#echo join($daily_fails_cell, ',') ;
		#$a ="oi";
		#echo ($row->kpi_cell_rate >= 98.5 ? "a" :"b" );
		#if ($row->kpi_cell_rate >= 98.5) {echo "a";}
		#else {
	#		echo "b";
#		}
#		}
#		array_walk($dates, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime		

		#	array_walk($datetime, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
		//echo "RNC= ".$rnc.", cellname= ".$cellname.", cellid= ".$cellid."<br><br>";
		//echo join($datetime, ',');
		//echo "<br><br>";
		//echo join($acc_rrc, ',');
		#echo '<span size="4" color="#E0E0E3">'.$ne.'</span>';
		?>
<script>

$(function () {
    /**
     * Create a constructor for sparklines that takes some sensible defaults and merges in the individual
     * chart options. This function is also available from the jQuery plugin as $(element).highcharts('SparkLine').
     */
    Highcharts.SparkLine = function (options, callback) {
        var defaultOptions = {
            chart: {
                renderTo: (options.chart && options.chart.renderTo) || this,
                backgroundColor: null,
                borderWidth: 0,
                type: 'area',
                margin: [2, 0, 2, 0],
                width: 120,
                height: 20,
                style: {
                    overflow: 'visible'
                },
                skipClone: true
            },
            title: {
                text: ''
            },
            credits: {
                enabled: false
            },
            xAxis: {
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                startOnTick: false,
                endOnTick: false,
                tickPositions: []
            },
            yAxis: {
				///max: 90,
                endOnTick: false,
                startOnTick: false,
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                tickPositions: [0]
            },
            legend: {
                enabled: false
            },
            tooltip: {
                backgroundColor: null,
                borderWidth: 0,
                shadow: false,
                useHTML: true,
                hideDelay: 0,
                shared: true,
                padding: 0,
                positioner: function (w, h, point) {
                    return { x: point.plotX - w / 2, y: point.plotY - h};
                }
            },
            plotOptions: {
                series: {
                    animation: false,
                    lineWidth: 1,
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    marker: {
                        radius: 1,
                        states: {
                            hover: {
                                radius: 2
                            }
                        }
                    },
                    fillOpacity: 0.25
                },
                column: {
					color: "#910000",
                    negativeColor: '#910000',
                    borderColor: 'silver'
                }
            }
        };
        options = Highcharts.merge(defaultOptions, options);

        return new Highcharts.Chart(options, callback);
    };

    var start = +new Date(),
        $tds = $("td[data-sparkline]"),
        fullLen = $tds.length,
        n = 0;

    // Creating 153 sparkline charts is quite fast in modern browsers, but IE8 and mobile
    // can take some seconds, so we split the input into chunks and apply them in timeouts
    // in order avoid locking up the browser process and allow interaction.
    function doChunk() {
        var time = +new Date(),
            i,
            len = $tds.length,
            $td,
            stringdata,
            arr,
            data,
            chart;

        for (i = 0; i < len; i += 1) {
            $td = $($tds[i]);
            stringdata = $td.data('sparkline');
            arr = stringdata.split('; ');
            data = $.map(arr[0].split(', '), parseFloat);
            chart = {};

            if (arr[1]) {
                chart.type = arr[1];
            }
            $td.highcharts('SparkLine', {
                series: [{
                    data: data,
                    pointStart: 1
                }],
                tooltip: {
                   headerFormat: '<span style="font-size: 10px">' + $td.parent().find('th').html() + ', Q{point.x}:</span><br/>',
                    pointFormat: '<b>{point.y}</b>%'
                },
                chart: chart
            });

            n += 1;

            // If the process takes too much time, run a timeout to allow interaction with the browser
            if (new Date() - time > 500) {
                $tds.splice(0, i + 1);
                setTimeout(doChunk, 0);
                break;
            }

            // Print a feedback on the performance
            if (n === fullLen) {
                $('#result').html('Generated ' + fullLen + ' sparklines in ' + (new Date() - start) + ' ms');
            }
        }
    }
    doChunk();

});

</script> 


<body>
<div id="container" class="main">
	<form method="post" name="neform" accept-charset="utf-8" action="/npsmart/performance/monitor">
	<font size="4" color="#E0E0E3"><b>RNC: </b></font>
	<input id="rnc" type="text" name="rnc"/>
	<font size="4" color="#E0E0E3"><b>Site: </b></font> 
	<input id="sitename" type="text" name="site" />
	<font size="4" color="#E0E0E3"><b>Cell: </b></font> 
	<input id="cellname" type="text" name="cellid" />
	<font size="4" color="#E0E0E3"><b>Cluster: </b></font> 
	<input id="clustername" type="text" name="cluster" />
	<font size="4" color="#E0E0E3"><b>Cidade: </b></font> 
	<input id="cidadename" type="text" name="cidade" />
	<input type="button" name="mysubmit" value="Submit" onclick="document.getElementById('cellname').value = cellinfo[document.getElementById('cellname').value]; document.neform.submit();">
	
	<br><br>
	<span class="ne" style="color:#E0E0E3" text-align="left">
	<?php	
	if(isset($ne)){
		echo '<b>'.$level.'</b>: '.$ne;
		}
	?>
	</span>

	<br><br><br>
	</form>
	
<div id="result"></div>
<table id="table-sparkline">
    <thead>
        <tr>
            <th>Worst Cells</th>
            <th>KPI</th>
            <th>Daily KPI</th>
            <th>Fails</th>
            <th>Daily Fails</th>
            <th>Impact</th>
			<th>RNC KPI</th>
			<th>New RNC KPI</th>
            <th>Impact Per Day</th>
        </tr>
    </thead>
    <tbody id="tbody-sparkline">
	
	
	<?php
	$bad = "#FF0000";	
	$good = "#009900";
			foreach($wc as $row){
		
			echo "<tr><th>";
			echo $row->cellname."</th>";
			echo "<td><font color='".($row->kpi_cell_rate >= 98.5?$good:$bad)."'>".$row->kpi_cell_rate."%</font></td>";
			echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_kpi_cell_rate).'" />';
			echo "<td>".$row->fails_cell."</td>";			
			echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_fails_cell).'" />';
			echo "<td>".$row->impact."%</td>";
			echo "<td><font color='".($row->kpi_rnc_rate >= 98.5?$good:$bad)."'>".$row->kpi_rnc_rate."%</font></td>";
			echo "<td><font color='".($row->new_rnc_kpi >= 98.5?$good:$bad)."'>".$row->new_rnc_kpi."%</font></td>";
			echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_impact).' ; column" />';			
		#	echo '<td data-sparkline="-20, 90, -21, 74 ; column"/>';
			echo "</tr>";
			}
	?>
    </tbody>
</table>	
</div>		
</body>
</html>