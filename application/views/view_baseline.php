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
<?php
if ($reportmoname) {
echo "<div id='content'><div id='acc'></div></div>";
}
?>
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
			<th style='display:none;'rowspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Type</font></th>
  <?php 
		 $mos = $baseline_by_mo[0]->mo;
		 $mo = explode(",", $mos);	
		 $count = count($mo);
			
 for ($i = 0; $i < $count; $i++) {
	 echo "<th bgcolor='#fd0e07'><div class='vrt'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'><a style= 'color:WHITE' onclick='selectmobaseline(this)'>".$mo[$i]."</a></font></div></th>"; 
 }
 ?>
 			<th rowspan="1" bgcolor="#fd0e07"><div class='vrt'><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">Total</font></div></th>

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
	
			 echo "<tr>";		
					echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><a id='".$row->node."' onclick='selectne_baseline(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";
$allnodes = $baseline_by_mo[0]->mo;
$allnodes_array = explode(",", $allnodes);	
//$key = array_search('green', $allnodes_array); 

$avg_discrepancies = $row->avg_discrepancies;
$total_discrepancies = $row->total_discrepancies;
$discrepancies = $row->discrepancies;
$nodes = $row->mo;
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

<br><br>
</tbody>
</table>
<!--<div><div id='discrepancies_daily'></div></div>-->
<div id="content" class="chart_content_large"><div id="container" class="chart1"></div></div>
</body>
</html>