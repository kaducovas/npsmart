<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div id="container" class="main">


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
<a target="_blank" class="link" href="/npsmart/output/weekly_cell_overshooters.csv">Download Overshooters</a>
</div>
<table id="table_id" class="cell-border stripe compact hover" border="1 solid black" cellspacing="0" width="100%">
    <thead>
        <tr>
			<th rowspan="2" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Overshooters</font></th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Non-Overshooters</th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Cells</font></th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Overshooters (%)</font></th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Non-Overshooters (%)</font></th>
            <th colspan="3" bgcolor="#fd0e07"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Radar Score</font></th>
        </tr>
		<tr>
  <?php 
		 $weeks = $overshooters_count[0]->weeks;
		 $week = explode(",", $weeks);	
 
 for ($i = 1; $i <= 6; $i++) {
 echo "<th bgcolor='#fd0e07'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[0]."</font></th>";
 echo "<th bgcolor='#fd0e07'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[1]."</font></th>";
 echo "<th bgcolor='#fd0e07'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[2]."</font></th>";
 #echo "<th bgcolor='#fd0e07'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[3]."</font></th>";
 
 }
 ?>
        </tr>
	</thead>
	
	<tbody>		

	<?php
	$bad = "#FF0000";	
	#$good = "#009900";
	$good = "#000000";
	$yellow = "#FFFF00";
	$title = "#fd0e07";
	#$yellow = "#E9AB17";
	
//onclick='selected(this)'

foreach($overshooters_count as $row){		
	$overshooters = $row->overshooters;
	$array_0 = array_fill(0, 2, 0);	
	#$array_0 = array_fill(0, 3, 0);	
	$array_overshooters = explode(",", $overshooters);	
	$array_overshooters = array_merge($array_overshooters, $array_0);

	$non_overshooters = $row->non_overshooters;
	$array_0 = array_fill(0, 2, 0);	
	$array_non_overshooters = explode(",", $non_overshooters);	
	$array_non_overshooters = array_merge($array_non_overshooters, $array_0);

	$cells = $row->cells;
	$array_0 = array_fill(0, 2, 0);		
	$array_cells = explode(",", $cells);	
	$array_cells = array_merge($array_cells, $array_0);

	$overshooters_portion = $row->overshooters_portion;
	$array_0 = array_fill(0, 2, 0);		
	$array_overshooters_portion = explode(",", $overshooters_portion);	
	$array_overshooters_portion = array_merge($array_overshooters_portion, $array_0);
	
	$non_overshooters_portion = $row->non_overshooters_portion;
	$array_0 = array_fill(0, 2, 0);		
	$array_non_overshooters_portion = explode(",", $non_overshooters_portion);
	$array_non_overshooters_portion = array_merge($array_non_overshooters_portion, $array_0);
	
	$score = $row->score;
	$array_0 = array_fill(0, 2, 0);		
	$array_score = explode(",", $score);
	$array_score = array_merge($array_score, $array_0);
	
			 echo "<tr>";		
			 echo "<td value='".$row->node."'><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></td>";		
			 #echo "<td>".$row->node."</td>";		
			 echo "<td onclick='wcweek(this)'><font color='".($array_overshooters[0] >= 0?$good:$bad)."'>".$array_overshooters[0]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_overshooters[1] >= 0?$good:$bad)."'>".$array_overshooters[1]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_overshooters[2] >= 0?$good:$bad)."'>".$array_overshooters[2]."</font></td>";
			 #echo "<td onclick='wcweek(this)'><font color='".($array_overshooters[3] >= 0?$good:$bad)."'>".$array_overshooters[3]."</font></td>";

			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters[0] >= 0?$good:$bad)."'>".$array_non_overshooters[0]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters[1] >= 0?$good:$bad)."'>".$array_non_overshooters[1]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters[2] >= 0?$good:$bad)."'>".$array_non_overshooters[2]."</font></td>";
			 #echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters[3] >= 0?$good:$bad)."'>".$array_non_overshooters[3]."</font></td>";

			
			 echo "<td onclick='wcweek(this)'><font color='".($array_cells[0] >= 0?$good:$bad)."'>".$array_cells[0]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_cells[1] >= 0?$good:$bad)."'>".$array_cells[1]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_cells[2] >= 0?$good:$bad)."'>".$array_cells[2]."</font></td>";
			 #echo "<td onclick='wcweek(this)'><font color='".($array_cells[3] >= 0?$good:$bad)."'>".$array_cells[3]."</font></td>";
			
			 echo "<td><font color='".($array_overshooters_portion[0] >= 0?$good:$bad)."'>".$array_overshooters_portion[0]."%</font></td>";
			 echo "<td><font color='".($array_overshooters_portion[1] >= 0?$good:$bad)."'>".$array_overshooters_portion[1]."%</font></td>";
			 echo "<td><font color='".($array_overshooters_portion[2] >= 0?$good:$bad)."'>".$array_overshooters_portion[2]."%</font></td>";
			 #echo "<td><font color='".($array_overshooters_portion[3] >= 0?$good:$bad)."'>".$array_overshooters_portion[3]."%</font></td>";
					
			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters_portion[0] >= 0?$good:$bad)."'>".$array_non_overshooters_portion[0]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters_portion[1] >= 0?$good:$bad)."'>".$array_non_overshooters_portion[1]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters_portion[2] >= 0?$good:$bad)."'>".$array_non_overshooters_portion[2]."%</font></td>";
			 #echo "<td onclick='wcweek(this)'><font color='".($array_non_overshooters_portion[3] >= 0?$good:$bad)."'>".$array_non_overshooters_portion[3]."%</font></td>";

			 echo "<td onclick='wcweek(this)'><font color='".($array_score[0] >= 0?$good:$bad)."'>".$array_score[0]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_score[1] >= 0?$good:$bad)."'>".$array_score[1]."</font></td>";
			 echo "<td onclick='wcweek(this)'><font color='".($array_score[2] >= 0?$good:$bad)."'>".$array_score[2]."</font></td>";
			 #echo "<td onclick='wcweek(this)'><font color='".($array_score[3] >= 0?$good:$bad)."'>".$array_score[3]."</font></td>";
			 
			 echo "</tr>";			
			}
	?>
	
	</tbody>
</table>

</div>

<br><br>

<div id="content" class="chart_content_large"><div id="acc" class="chart1"></div></div>
</body>
</html>