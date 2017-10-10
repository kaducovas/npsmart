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

	<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="98%">

		<thead>
			<tr>
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>
				<th style='display:none;'rowspan="2" bgcolor="#436260"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>			
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">Region</font></th>
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">RNC</font></th>
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">NodeB</font></th>
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">Carrier</font></th>
				<th rowspan="2" bgcolor="#436260" width="10%"><font color="#FFFFFF" style="font-size:20pt'">Azimuth</font></th>
				<?php 
					// foreach($unbalance_weekly as $row){
					// $weeks = $row->weeks;
					// }
					$weeks = $unbalance_weekly[0]->weeks;
					$week = explode(",", $weeks);		
 
					if (isset($monthnum)){
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						echo "<th colspan='5' bgcolor='#436260' width='50%'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week[0]]."</font></th>";	
					}
					elseif (isset($weeknum)){
						echo "<th colspan='5' bgcolor='#436260' width='50%'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week[0]."</font></th>";
					}
				?>
				</tr>			
				<tr>
				<th colspan="1" bgcolor="#638885" width="5%"><font color="#FFFFFF" style="font-family: calibri; font-size:20pt'">EE</font></th>
				<th colspan="1" bgcolor="#638885" width="5%"><font color="#FFFFFF" style="font-family: calibri; font-size:20pt'">Avg EE</font></th>
				<th colspan="1" bgcolor="#638885" width="5%"><font color="#FFFFFF" style="font-family: calibri; font-size:20pt'">Load</font></th>			
				<th colspan="1" bgcolor="#638885" width="5%"><font color="#FFFFFF" style="font-family: calibri; font-size:20pt'">Balanced</font></th>							
				<th colspan="1" bgcolor="#638885" width="5%"><font color="#FFFFFF" style="font-family: calibri; font-size:20pt'">Highly Loaded Cell</font></th>
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
			$title = "#436260";	
				foreach($unbalance_weekly as $row)
				{	
					$region = $row->region;
					$array_0 = array_fill(0, 3, 0);	
					$array_region = explode(",", $region);	
					$array_region = array_merge($array_region, $array_0);

					$rnc = $row->rnc;
					$array_0 = array_fill(0, 3, 0);	
					$array_rnc = explode(",", $rnc);
					$array_rnc = array_merge($array_rnc, $array_0);	

					$nodeb = $row->nodeb;
					$array_0 = array_fill(0, 3, 0);	
					$array_nodeb = explode(",", $nodeb);
					$array_nodeb = array_merge($array_nodeb, $array_0);	

					$carrier = $row->carrier;
					$array_0 = array_fill(0, 3, 0);	
					$array_carrier = explode(",", $carrier);	
					$array_carrier = array_merge($array_carrier, $array_0);	

					$azimuth = $row->azimuth;
					$array_0 = array_fill(0, 3, 0);	
					$array_azimuth = explode(",", $azimuth); 
					$array_azimuth = array_merge($array_azimuth, $array_0);
					
					$ee = $row->ee;
					$array_0 = array_fill(0, 3, 0);	
					$array_ee = explode(",", $ee);
					$array_ee = array_merge($array_ee, $array_0);	
					
					$load = $row->load;
					$array_0 = array_fill(0, 3, 0);	
					$array_load = explode(",", $load);
					$array_load = array_merge($array_load, $array_0);	

					$avg_ee = $row->avg_ee;
					$array_0 = array_fill(0, 3, 0);	
					$array_avg_ee = explode(",", $avg_ee);	
					$array_avg_ee = array_merge($array_avg_ee, $array_0);	

					$balanced = $row->balanced;
					$array_0 = array_fill(0, 3, 0);	
					$array_balanced = explode(",", $balanced);	
					$array_balanced = array_merge($array_balanced, $array_0);	

					$hl_cell = $row->hl_cell;
					$array_0 = array_fill(0, 3, 0);	
					$array_hl_cell = explode(",", $hl_cell);	
					$array_hl_cell = array_merge($array_hl_cell, $array_0);								
				
					echo "<tr>";		
					echo "<td bgcolor='#EDEDEB' value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><b>".$row->node."</b></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_region[0]."</font></td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_rnc[0]."</font></td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_nodeb[0]."</font></td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_carrier[0]."</font></td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$array_azimuth[0]."</font></td>";

//					echo "<td bgcolor='".($array_ee[3] <= 15?$good2:($array_ee[3] <= 40?$yellow2:$bad2))."'>".$array_ee[3]."</font></td>";	
					// echo "<td bgcolor='".($array_ee[2] <= 15?$good2:($array_ee[2] <= 40?$yellow2:$bad2))."'>".$array_ee[2]."</font></td>";	
					// echo "<td bgcolor='".($array_ee[1] <= 15?$good2:($array_ee[1] <= 40?$yellow2:$bad2))."'>".$array_ee[1]."</font></td>";	
					echo "<td bgcolor='".($array_ee[0] <= 15?$good2:($array_ee[0] <= 40?$yellow2:$bad2))."'>".$array_ee[0]."</font></td>";	

//					echo "<td bgcolor='".($array_avg_ee[3] <= 15?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$array_avg_ee[3]."</font></td>";						
					// echo "<td bgcolor='".($array_avg_ee[2] <= 15?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$array_avg_ee[2]."</font></td>";						
					// echo "<td bgcolor='".($array_avg_ee[1] <= 15?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$array_avg_ee[1]."</font></td>";						
					echo "<td bgcolor='".($array_avg_ee[0] <= 15?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$array_avg_ee[0]."</font></td>";						
					
//					echo "<td bgcolor='".($array_load[3] <= 80?$good2:$bad2)."'>".$array_load[3]."</font></td>";	
					// echo "<td bgcolor='".($array_load[2] <= 80?$good2:$bad2)."'>".$array_load[2]."</font></td>";	
					// echo "<td bgcolor='".($array_load[1] <= 80?$good2:$bad2)."'>".$array_load[1]."</font></td>";	
					echo "<td bgcolor='".($array_load[0] <= 80?$good2:$bad2)."'>".$array_load[0]."</font></td>";	

//					echo "<td bgcolor='".($array_balanced[3] == 'OK'?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_balanced[3]."</font></td>";
					// echo "<td bgcolor='".($array_balanced[2] == 'OK'?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_balanced[2]."</font></td>";
					// echo "<td bgcolor='".($array_balanced[1] == 'OK'?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_balanced[1]."</font></td>";
					echo "<td bgcolor='".($array_balanced[0] == 'OK'?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_balanced[0]."</font></td>";

//					echo "<td bgcolor='".($array_hl_cell[3] == 0?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_hl_cell[3]."</font></td>";										
					// echo "<td bgcolor='".($array_hl_cell[2] == 0?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_hl_cell[2]."</font></td>";										
					// echo "<td bgcolor='".($array_hl_cell[1] == 0?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_hl_cell[1]."</font></td>";										
					echo "<td bgcolor='".($array_hl_cell[0] == 0?$good:$bad)."'><font style='font-family: calibri; font-size:12pt'>".$array_hl_cell[0]."</font></td>";										

					echo "</tr>";						
					
				}
				
			?>
	
		</tbody>
	</table>

</div>
<br>
</body>
</html>