<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div width="100%">

	<form action="/npsmart/umts/worstcells" name="wcform" method="post">
		<input type="hidden" id="wcreportnename" name="reportnename" value="" />
		<input type="hidden" id="wcreportrnc" name="reportrnc" value="" />
		<input type="hidden" id="wctimeagg" name="timeagg" value="" />
		<input type="hidden" id="wcreportdate" name="reportdate" value="" />
		<input type="hidden" id="wckpi" name="kpi" value="" />

		<!--<form action="/npsmart/umts/worstcells" name="wcform" method="post">
		<input type="hidden" id="rnc" name="rnc" value="" />
		<input type="hidden" id="date" name="wcdate" value="" />
		<input type="hidden" id="kpi" name="kpi" value="" />-->
	</form>

	<form action="/npsmart/umts/weeklyworstcells" name="weekwcform" method="post">
		<input type="hidden" id="node" name="node" value="" />
		<input type="hidden" id="week" name="week" value="" />
		<input type="hidden" id="weeklykpi" name="kpi" value="" />
	</form>

	<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="60%">

		<thead>
			<tr>
				<th rowspan="2" bgcolor="#436260"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>
				<th style='display:none;'rowspan="2" bgcolor="#3b5998"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>			
				<th colspan="4" bgcolor="#436260"><font color="#FFFFFF" style="font-size:20pt'">UNBALANCE SECTORS</font></th>
			</tr>
			<tr>				
				<?php 
					// foreach($unbalance_weekly as $row){
					// $weeks = $row->weeks;
					// }
					$weeks = $unbalance_weekly[0]->weeks;
					$week = explode(",", $weeks);		
 
					if (isset($monthnum))
					{
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]; 

						echo "<th bgcolor='#638885><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week[3]]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week[2]]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week[1]]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week[0]]."</font></th>";						
					}
					elseif (isset($weeknum))
					{
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week[3]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week[2]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week[1]."</font></th>";
						echo "<th bgcolor='#638885'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week[0]."</font></th>";
					}
				?>
						</tr>			
		</thead>
	
		<tbody>	

			<?php
			$bad2 = "#FF7272";
			$good2 = "#B1D38D";
			$bad = "#FF0000";
			$good = "#92D050";
			$orange = "#FAA20A";
			$yellow = "yellow";
			$yellow2 = "#FCFA87";
			$title = "#2D4543";	
				foreach($unbalance_weekly as $row)
				{		

					$azimuth_no = $row->azimuth_no;
					$array_0 = array_fill(0, 3, 0);	
					$array_azimuth_no = explode(",", $azimuth_no);	
					$array_azimuth_no = array_merge($array_azimuth_no, $array_0);								
				
					echo "<tr>";		
					echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_azimuth_no[3]."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_azimuth_no[2]."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_azimuth_no[1]."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_azimuth_no[0]."</font></td>";


					echo "</tr>";						
					
				}
				
			?>
	
		</tbody>
	</table>
</div>
<br>
<div id="content" class="chart_content_large"><div id="acc" class="chart1"></div></div>
<br>
</body>
</html>