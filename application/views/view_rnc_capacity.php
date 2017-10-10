<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<?php
if ($reportnetype == 'rnc') {
echo "<div id='content' class='chart_content_large'><div id='acc' class='chart1'></div></div>";
}
?>
<br>
<div align="left">
<a target="_blank" class="link" href="/npsmart/output/weekly_rnc_capacity.csv">Download RNC Capacity</a>
</div>
<div width="100%">

	<form action="/npsmart/umts/worstcells" name="wcform" method="post">
		<input type="hidden" id="wcreportnename" name="reportnename" value="" />
		<input type="hidden" id="wcreportnetype" name="reportnetype" value="" />
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
				<th rowspan="6" bgcolor="#2A4641" width="4%"><font color="#FFFFFF" style="font-size:20pt'">RNC</font></th>
				<th style='display:none;'rowspan="6" bgcolor="#3b5998"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>			
				<th rowspan="6" bgcolor="#2A4641" width="4%"><font color="#FFFFFF" style="font-size:20pt'">Region</font></th>
				<th rowspan="6" bgcolor="#2A4641" width="4%"><font color="#FFFFFF" style="font-size:20pt'">NE Type</font></th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">CPU Load</font></th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">DSP Load</th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">Interface Board CPU Load</font></th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">Interface Board Transload</font></th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">IuPS Utilizantion</font></th>
				<th colspan="3" bgcolor="#2A4641" width="14%"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt'">IuB Utilizantion</font></th>				
			</tr>
				<tr><th colspan="18" bgcolor="#FF7272"><font style="font-family: calibri; font-size:10pt">Critical: > 80%</font></th></tr>
				<tr><th colspan="18" bgcolor="#FDBD4F"><font style="font-family: calibri; font-size:10pt">Corrective: > 65% - <= 80%</font></th></tr>
				<tr><th colspan="18" bgcolor="#FCFA87"><font style='font-family: calibri; font-size:10pt'>Warning: > 50% - <= 65%</font></th></tr>
				<tr><th colspan="18" bgcolor="#B1D38D"><font style='font-family: calibri; font-size:10pt'>Normal: <= 50%</font></th></tr>	
			<tr>
				<?php 
					// foreach($rnc_capacity_weekly as $row){
					// $weeks = $row->weeks;
					// }
					$weeks = $rnc_capacity_weekly[0]->weeks;
					$week = explode(",", $weeks);		
 
					if (isset($monthnum))
					{
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]; 

						for ($i = 1; $i <= 6; $i++) 
						{
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>".$months[(int)$week[2]]."</font></th>";
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>".$months[(int)$week[1]]."</font></th>";
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>".$months[(int)$week[0]]."</font></th>";
						}	
	
					}
					elseif (isset($weeknum))
					{
						for ($i = 1; $i <= 6; $i++) 
						{
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>W".$week[2]."</font></th>";
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>W".$week[1]."</font></th>";
						echo "<th bgcolor='#8CA5A0' width='10%'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt''>W".$week[0]."</font></th>";
						}
					}
				?>
						</tr>			
		</thead>
	
		<tbody>	

			<?php
			$bad = "#FF0000";
			$good = "#92D050";
			$orange = "#FAA20A";
			$yellow = "yellow";
			$title = "#2A4641";	
				foreach($rnc_capacity_weekly as $row)
				{	
					$region = $row->region;
					$array_0 = array_fill(0, 3, 0);	
					$array_region = explode(",", $region);	
					$array_region = array_merge($array_region, $array_0);

					$netype = $row->netype;
					$array_0 = array_fill(0, 3, 0);	
					$array_netype = explode(",", $netype);
					$array_netype = array_merge($array_netype, $array_0);	

					$cpu_load = $row->cpu_load;
					$array_0 = array_fill(0, 3, 0);	
					$array_cpu_load = explode(",", $cpu_load);
					$array_cpu_load = array_merge($array_cpu_load, $array_0);	

					$dsp_load = $row->dsp_load;
					$array_0 = array_fill(0, 3, 0);	
					$array_dsp_load = explode(",", $dsp_load);	
					$array_dsp_load = array_merge($array_dsp_load, $array_0);	

					$ib_cpu_load = $row->ib_cpu_load;
					$array_0 = array_fill(0, 3, 0);	
					$array_ib_cpu_load = explode(",", $ib_cpu_load); 
					$array_ib_cpu_load = array_merge($array_ib_cpu_load, $array_0);
					
					$ib_forward_load = $row->ib_forward_load;
					$array_0 = array_fill(0, 3, 0);	
					$array_ib_forward_load = explode(",", $ib_forward_load);
					$array_ib_forward_load = array_merge($array_ib_forward_load, $array_0);	
					
					$iu_ps = $row->iu_ps;
					$array_0 = array_fill(0, 3, 0);	
					$array_iu_ps = explode(",", $iu_ps);
					$array_iu_ps = array_merge($array_iu_ps, $array_0);	

					$iub = $row->iub;
					$array_0 = array_fill(0, 3, 0);	
					$array_iub = explode(",", $iub);	
					$array_iub = array_merge($array_iub, $array_0);	
						

					echo "<tr>";		
					echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:14pt''><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";	
					
					echo "<td><font style='font-family: calibri; font-size:14pt'>".$array_region[0]."</font></td>";

					echo "<td><font style='font-family: calibri; font-size:14pt'>".$array_netype[0]."</font></td>";
					
				echo "<td bgcolor='".($array_cpu_load[2] <= 50?$good:($array_cpu_load[2] <= 65?$yellow:($array_cpu_load[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_cpu_load[2]."%</font></td>";	
				echo "<td bgcolor='".($array_cpu_load[1] <= 50?$good:($array_cpu_load[1] <= 65?$yellow:($array_cpu_load[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_cpu_load[1]."%</font></td>";	
				echo "<td bgcolor='".($array_cpu_load[0] <= 50?$good:($array_cpu_load[0] <= 65?$yellow:($array_cpu_load[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_cpu_load[0]."%</font></td>";	
				
				echo "<td bgcolor='".($array_dsp_load[2] <= 50?$good:($array_dsp_load[2] <= 65?$yellow:($array_dsp_load[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_dsp_load[2]."%</font></td>";		
				echo "<td bgcolor='".($array_dsp_load[1] <= 50?$good:($array_dsp_load[1] <= 65?$yellow:($array_dsp_load[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_dsp_load[1]."%</font></td>";		
				echo "<td bgcolor='".($array_dsp_load[0] <= 50?$good:($array_dsp_load[0] <= 65?$yellow:($array_dsp_load[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_dsp_load[0]."%</font></td>";		

				echo "<td bgcolor='".($array_ib_cpu_load[2] <= 50?$good:($array_ib_cpu_load[2] <= 65?$yellow:($array_ib_cpu_load[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_cpu_load[2]."%</font></td>";
				echo "<td bgcolor='".($array_ib_cpu_load[1] <= 50?$good:($array_ib_cpu_load[1] <= 65?$yellow:($array_ib_cpu_load[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_cpu_load[1]."%</font></td>";
				echo "<td bgcolor='".($array_ib_cpu_load[0] <= 50?$good:($array_ib_cpu_load[0] <= 65?$yellow:($array_ib_cpu_load[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_cpu_load[0]."%</font></td>";

				echo "<td bgcolor='".($array_ib_forward_load[2] <= 50?$good:($array_ib_forward_load[2] <= 65?$yellow:($array_ib_forward_load[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_forward_load[2]."%</font></td>";
				echo "<td bgcolor='".($array_ib_forward_load[1] <= 50?$good:($array_ib_forward_load[1] <= 65?$yellow:($array_ib_forward_load[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_forward_load[1]."%</font></td>";
				echo "<td bgcolor='".($array_ib_forward_load[0] <= 50?$good:($array_ib_forward_load[0] <= 65?$yellow:($array_ib_forward_load[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_ib_forward_load[0]."%</font></td>";
			
				echo "<td bgcolor='".($array_iu_ps[2] <= 50?$good:($array_iu_ps[2] <= 65?$yellow:($array_iu_ps[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iu_ps[2]."%</font></td>";
				echo "<td bgcolor='".($array_iu_ps[1] <= 50?$good:($array_iu_ps[1] <= 65?$yellow:($array_iu_ps[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iu_ps[1]."%</font></td>";
				echo "<td bgcolor='".($array_iu_ps[0] <= 50?$good:($array_iu_ps[0] <= 65?$yellow:($array_iu_ps[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iu_ps[0]."%</font></td>";
			
				echo "<td bgcolor='".($array_iub[2] <= 50?$good:($array_iub[2] <= 65?$yellow:($array_iub[2] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iub[2]."%</font></td>";					
				echo "<td bgcolor='".($array_iub[1] <= 50?$good:($array_iub[1] <= 65?$yellow:($array_iub[1] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iub[1]."%</font></td>";					
				echo "<td bgcolor='".($array_iub[0] <= 50?$good:($array_iub[0] <= 65?$yellow:($array_iub[0] <= 80?$orange:$bad)))."'><font style='font-family: calibri; font-size:14pt'>".$array_iub[0]."%</font></td>";					
	
					echo "</tr>";			
				}
			?>
	
		</tbody>
	</table>

</div>
<br>
</body>
</html>