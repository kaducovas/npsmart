<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
$(document).ready( function () {
  $('#table2').DataTable( {
    "bPaginate": true,
	processing: true,
	"aaSorting": [],
	"bInfo": false,
	"pageLength": 45
  } );
} );

var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>

<!--<form action="/npsmart/umts/worstcells" name="wcform" method="post">
<input type="hidden" id="rnc" name="rnc" value="" />
<input type="hidden" id="date" name="wcdate" value="" />
<input type="hidden" id="kpi" name="kpi" value="" />
</form>

<form action="/npsmart/umts/weeklyworstcells" name="weekwcform" method="post">
<input type="hidden" id="node" name="node" value="" />
<input type="hidden" id="week" name="week" value="" />
<input type="hidden" id="weeklykpi" name="kpi" value="" />
</form>-->


<div align="left">
<a target="_blank" class="link" href="/npsmart/output/baseline_nok.csv">Download MML</a>
</div>
<table id="table_id" class="cell-border stripe compact hover" border="1 solid black" cellspacing="0" width="100%">
    <thead>
        <tr>
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">MO</font></th>
  <?php 
		 $nodes = $baseline_by_mo[0]->nodes;
		 $node = explode(",", $nodes);	
		 $count = count($node);
			
 for ($i = 0; $i < $count; $i++) {
	 echo "<th bgcolor='#fd0e07'><div><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$node[$i]."</font></div></th>"; 
 }
 ?>
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Total</font></th>
	</tr>
	</thead>
	<tbody>		

	<?php
	$bad = "#FFA500";	
	#$good = "#009900";
	$good = "#008000";
	$yellow = "#FFFF00";
	$title = "#fd0e07";
	#$yellow = "#E9AB17";
	
//onclick='selected(this)'
$contador = 0;
foreach($baseline_by_mo as $row){		
	// $overshooters = $row->overshooters;
	// $array_0 = array_fill(0, 2, 0);	
	// #$array_0 = array_fill(0, 3, 0);	
	// $array_overshooters = explode(",", $overshooters);	
	// $array_overshooters = array_merge($array_overshooters, $array_0);

	// $non_overshooters = $row->non_overshooters;
	// $array_0 = array_fill(0, 2, 0);	
	// $array_non_overshooters = explode(",", $non_overshooters);	
	// $array_non_overshooters = array_merge($array_non_overshooters, $array_0);

	// $cells = $row->cells;
	// $array_0 = array_fill(0, 2, 0);		
	// $array_cells = explode(",", $cells);	
	// $array_cells = array_merge($array_cells, $array_0);

	// $overshooters_portion = $row->overshooters_portion;
	// $array_0 = array_fill(0, 2, 0);		
	// $array_overshooters_portion = explode(",", $overshooters_portion);	
	// $array_overshooters_portion = array_merge($array_overshooters_portion, $array_0);
	
	// $non_overshooters_portion = $row->non_overshooters_portion;
	// $array_0 = array_fill(0, 2, 0);		
	// $array_non_overshooters_portion = explode(",", $non_overshooters_portion);
	// $array_non_overshooters_portion = array_merge($array_non_overshooters_portion, $array_0);
	
	// $score = $row->score;
	// $array_0 = array_fill(0, 2, 0);		
	// $array_score = explode(",", $score);
	// $array_score = array_merge($array_score, $array_0);
	
			 echo "<tr>";		
			 echo "<td value='".$row->mo."'><a id='".$row->mo."' onclick='selectne(this)' class='node' value='".$row->mo."'>".$row->mo."</a></td>";
			 #echo "<td>".$row->node."</td>";	
$allnodes = $baseline_by_mo[0]->nodes;
$allnodes_array = explode(",", $allnodes);	
$key = array_search('green', $allnodes_array); 

$avg_discrepancies = $row->avg_discrepancies;
$total_discrepancies = $row->total_discrepancies;
$discrepancies = $row->discrepancies;
$nodes = $row->nodes;
$discrepancies_array = explode(",", $discrepancies);	
$nodes_array = explode(",", $nodes);
#$discrepancies[] = $baseline_by_mo[$contador]->discrepancies;

$count_allnodes = count($allnodes_array);
$count = count($discrepancies_array);
$contador = 0;
	for ($i = 0; $i < $count_allnodes; $i++) {
		for ($j = 0; $j < $count; $j++) {
			if($nodes_array[$j] == $allnodes_array[$i]){
				echo "<td bgcolor='".($discrepancies_array[$j] ==0?$good:($discrepancies_array[$j] < $avg_discrepancies?$yellow:$bad))."'>".$discrepancies_array[$j]."</td>";
				#echo "<td bgcolor='".($discrepancies_array[$j] >= $avg_discrepancies?$bad:($discrepancies_array[$j] > 0?$yellow:$good))."'>".$discrepancies_array[$j]."</td>";
#			 	echo "<td onclick='wcweek(this)'><font color='".($array_overshooters[1] >= 0?$good:$bad)."'>".$array_overshooters[1]."</font></td>";
				#$i++;
				break;
				}
				$contador = $contador +1; 
			}
				if($contador == $count){
				echo "<td>-</td>";	
				}
				$contador = 0;
		
	}
echo "<td bgcolor='".($total_discrepancies ==0?$good:($total_discrepancies < $avg_discrepancies?$yellow:$bad))."'>".$total_discrepancies."</td>";
	echo "</tr>";
		}
	?>
	
	</tbody>
</table>

</div>

<br><br>
<div id="content" class="baseline_content"><div id="container" class="baseline_chart"></div></div>
<div class="baseline_content"><div id="container" class="baseline_charts">
<table id="table2" class="cell-border stripe hover" border="1 solid black" cellspacing="0" width="100%">
    <thead>
        <tr>
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Region</font></th>
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
			<!--<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">#Elements</font></th>-->
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Discrepancies</font></th>
			<th rowspan="1" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">%</font></th>
		</tr>
	</thead>
	<tbody>		
	
<?php
foreach($baseline_by_rnc as $row){
	echo "<tr>";
	echo "<td>".$row->region."</td>";
	echo "<td>".$row->node."</td>";
#	echo "<td>".$row->n_of_elements."</td>";
	echo "<td>".$row->discrepancies."</td>";
	echo "<td>".$row->percentage."</td>";
	echo "</tr>";
}	
?>
</tbody>
</table>
</div><div>
<!--<div id="content" class="chart_content_large"><div id="acc" class="chart1"></div></div>-->
</body>
</html>