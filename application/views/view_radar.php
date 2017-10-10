<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
<?php
$bad = "#FF0000";
$good = "#92D050";
$orange = "#FAA20A";
$yellow = "yellow";
$title = "#394E58";			
	foreach($chart_weekly as $row)
	{
		$week[] = $row->week;
		$node[] = $row->node;
		$rf_health_index[] = $row->rf_health_index;
		$rf_health_index[] = $row->rf_health_index;
		$baseline[] = $row->baseline;
		$throughput[] = $row->throughput;
		$retention_3g[] = $row->retention_3g;
		$ps_call_completion[] = $row->ps_call_completion;
		$cs_call_completion[] = $row->cs_call_completion;
		$availability[] = $row->availability;
		$hardware_nodeb[] = $row->hardware_nodeb;
		$air_interface_ul[] = $row->air_interface_ul;
		$air_interface_dl[] = $row-> air_interface_dl;	
		$sho_overhead[] = $row-> sho_overhead;
		$overshooters[] = $row-> overshooters;
		$cpich_power_ratio[] = $row-> cpich_power_ratio;
		$worst_aging_factor[] = $row-> worst_aging_factor;
		$traffic_load[] = $row-> traffic_load;
		$process_tools[] = $row-> process_tools;
        $composite[] = $row-> composite;			
	}
?>
</script>
 <div>

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
<div id="acc" class="radar_content"></div></div>	
<div class="radar_table">
<table id="table2" class="cell-border stripe hover" border="1 solid black" cellspacing="0" width="100%">
			<tr>
				<?php
				echo "<th rowspan='2' bgcolor='#394E58'><a style= 'color:#FFFFFF' onclick='selectkpiradar(this)'>".$node[0]."</a></th>";
				?>			
				<th colspan="4" bgcolor="#394E58"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Radar KPI Score</font></th>
				</tr>
				
			<tr>
				<?php 	
					if (isset($monthnum))
					{
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]."</td>"; 

							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[0]]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[1]]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[2]]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[3]]."</font></th>";
	
					}
					elseif (isset($weeknum))
					{
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[0]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[1]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[2]."</font></th>";
							echo "<th bgcolor='#637881'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[3]."</font></th>";
						
					}
				?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><font color = '#B0B0B0'>RF Health Index</font></th>		
			<?php				   					
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$rf_health_index[0]."</font></td>";	
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$rf_health_index[1]."</font></td>";	
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$rf_health_index[2]."</font></td>";	
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$rf_health_index[3]."</font></td>";	
			    ?>
			</tr>

			<tr>
			<th bgcolor="#FFFFFF"><font color = '#B0B0B0'>SW Release & Features</font></th>
			<?php					
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$process_tools[0]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$process_tools[1]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$process_tools[2]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$process_tools[3]."</font></td>";
				?>
			</tr>


			<tr>
			<th bgcolor="#FFFFFF"><font color = '#B0B0B0'>Worst Aging Factor</font></th>
			<?php		
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$worst_aging_factor[0]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$worst_aging_factor[1]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$worst_aging_factor[2]."</font></td>";
				echo "<td bgcolor='orange'><font color = '#B0B0B0' style='font-family: calibri; font-size:12pt'>".$worst_aging_factor[3]."</font></td>";
			    ?>
			</tr>

			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Baseline (Consistency Check)</a></th>
			<?php		
				echo "<td bgcolor='".($baseline[0] >= 8?$good:($baseline[0] >= 6?$yellow:($baseline[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$baseline[0]."</font></td>";
				echo "<td bgcolor='".($baseline[1] >= 8?$good:($baseline[1] >= 6?$yellow:($baseline[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$baseline[1]."</font></td>";
				echo "<td bgcolor='".($baseline[2] >= 8?$good:($baseline[2] >= 6?$yellow:($baseline[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$baseline[2]."</font></td>";
				echo "<td bgcolor='".($baseline[3] >= 8?$good:($baseline[3] >= 6?$yellow:($baseline[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$baseline[3]."</font></td>";
			    ?>
			</tr>

			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Throughput</a></th>
			<?php						
				echo "<td bgcolor='".($throughput[0] >= 8?$good:($throughput[0] >= 6?$yellow:($throughput[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$throughput[0]."</font></td>";
				echo "<td bgcolor='".($throughput[1] >= 8?$good:($throughput[1] >= 6?$yellow:($throughput[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$throughput[1]."</font></td>";
				echo "<td bgcolor='".($throughput[2] >= 8?$good:($throughput[2] >= 6?$yellow:($throughput[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$throughput[2]."</font></td>";
				echo "<td bgcolor='".($throughput[3] >= 8?$good:($throughput[3] >= 6?$yellow:($throughput[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$throughput[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Service Retention in 3G</a></th>
			<?php		
				echo "<td bgcolor='".($retention_3g[0] >= 8?$good:($retention_3g[0] >= 6?$yellow:($retention_3g[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$retention_3g[0]."</font></td>";
				echo "<td bgcolor='".($retention_3g[1] >= 8?$good:($retention_3g[1] >= 6?$yellow:($retention_3g[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$retention_3g[1]."</font></td>";
				echo "<td bgcolor='".($retention_3g[2] >= 8?$good:($retention_3g[2] >= 6?$yellow:($retention_3g[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$retention_3g[2]."</font></td>";
				echo "<td bgcolor='".($retention_3g[3] >= 8?$good:($retention_3g[3] >= 6?$yellow:($retention_3g[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$retention_3g[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>PS (Call Completion)</a></th>
			<?php		
				echo "<td bgcolor='".($ps_call_completion[0] >= 8?$good:($ps_call_completion[0] >= 6?$yellow:($ps_call_completion[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$ps_call_completion[0]."</font></td>";
				echo "<td bgcolor='".($ps_call_completion[1] >= 8?$good:($ps_call_completion[1] >= 6?$yellow:($ps_call_completion[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$ps_call_completion[1]."</font></td>";
				echo "<td bgcolor='".($ps_call_completion[2] >= 8?$good:($ps_call_completion[2] >= 6?$yellow:($ps_call_completion[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$ps_call_completion[2]."</font></td>";
				echo "<td bgcolor='".($ps_call_completion[3] >= 8?$good:($ps_call_completion[3] >= 6?$yellow:($ps_call_completion[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$ps_call_completion[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>CS (Call Completion)</a></th>
			<?php		
				echo "<td bgcolor='".($cs_call_completion[0] >= 8?$good:($cs_call_completion[0] >= 6?$yellow:($cs_call_completion[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cs_call_completion[0]."</font></td>";
				echo "<td bgcolor='".($cs_call_completion[1] >= 8?$good:($cs_call_completion[1] >= 6?$yellow:($cs_call_completion[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cs_call_completion[1]."</font></td>";
				echo "<td bgcolor='".($cs_call_completion[2] >= 8?$good:($cs_call_completion[2] >= 6?$yellow:($cs_call_completion[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cs_call_completion[2]."</font></td>";
				echo "<td bgcolor='".($cs_call_completion[3] >= 8?$good:($cs_call_completion[3] >= 6?$yellow:($cs_call_completion[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cs_call_completion[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:blue" onclick='selectkpiradar(this)'>Availability</a></th>
			<?php		
				echo "<td bgcolor='".($availability[0] >= 8?$good:($availability[0] >= 6?$yellow:($availability[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$availability[0]."</font></td>";
				echo "<td bgcolor='".($availability[1] >= 8?$good:($availability[1] >= 6?$yellow:($availability[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$availability[1]."</font></td>";
				echo "<td bgcolor='".($availability[2] >= 8?$good:($availability[2] >= 6?$yellow:($availability[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$availability[2]."</font></td>";
				echo "<td bgcolor='".($availability[3] >= 8?$good:($availability[3] >= 6?$yellow:($availability[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$availability[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Traffic Load</a></th>
			<?php		
				echo "<td bgcolor='".($traffic_load[0] >= 8?$good:($traffic_load[0] >= 6?$yellow:($traffic_load[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$traffic_load[0]."</font></td>";
				echo "<td bgcolor='".($traffic_load[1] >= 8?$good:($traffic_load[1] >= 6?$yellow:($traffic_load[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$traffic_load[1]."</font></td>";
				echo "<td bgcolor='".($traffic_load[2] >= 8?$good:($traffic_load[2] >= 6?$yellow:($traffic_load[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$traffic_load[2]."</font></td>";
				echo "<td bgcolor='".($traffic_load[3] >= 8?$good:($traffic_load[3] >= 6?$yellow:($traffic_load[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$traffic_load[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Hardware (NodeB: CE and Iub/RNC)</a></th>
			<?php		
				echo "<td bgcolor='".($hardware_nodeb[0] >= 8?$good:($hardware_nodeb[0] >= 6?$yellow:($hardware_nodeb[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$hardware_nodeb[0]."</font></td>";
				echo "<td bgcolor='".($hardware_nodeb[1] >= 8?$good:($hardware_nodeb[1] >= 6?$yellow:($hardware_nodeb[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$hardware_nodeb[1]."</font></td>";
				echo "<td bgcolor='".($hardware_nodeb[2] >= 8?$good:($hardware_nodeb[2] >= 6?$yellow:($hardware_nodeb[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$hardware_nodeb[2]."</font></td>";
				echo "<td bgcolor='".($hardware_nodeb[3] >= 8?$good:($hardware_nodeb[3] >= 6?$yellow:($hardware_nodeb[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$hardware_nodeb[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Air Interface UL (RTWP)</a></th>
			<?php		
				echo "<td bgcolor='".($air_interface_ul[0] >= 8?$good:($air_interface_ul[0] >= 6?$yellow:($air_interface_ul[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_ul[0]."</font></td>";
				echo "<td bgcolor='".($air_interface_ul[1] >= 8?$good:($air_interface_ul[1] >= 6?$yellow:($air_interface_ul[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_ul[1]."</font></td>";
				echo "<td bgcolor='".($air_interface_ul[2] >= 8?$good:($air_interface_ul[2] >= 6?$yellow:($air_interface_ul[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_ul[2]."</font></td>";
				echo "<td bgcolor='".($air_interface_ul[3] >= 8?$good:($air_interface_ul[3] >= 6?$yellow:($air_interface_ul[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_ul[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Air Interface DL (Codes and Power)</a></th>
			<?php		
				echo "<td bgcolor='".($air_interface_dl[0] >= 8?$good:($air_interface_dl[0] >= 6?$yellow:($air_interface_dl[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_dl[0]."</font></td>";
				echo "<td bgcolor='".($air_interface_dl[1] >= 8?$good:($air_interface_dl[1] >= 6?$yellow:($air_interface_dl[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_dl[1]."</font></td>";
				echo "<td bgcolor='".($air_interface_dl[2] >= 8?$good:($air_interface_dl[2] >= 6?$yellow:($air_interface_dl[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_dl[2]."</font></td>";
				echo "<td bgcolor='".($air_interface_dl[3] >= 8?$good:($air_interface_dl[3] >= 6?$yellow:($air_interface_dl[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$air_interface_dl[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>SHO Overhead</a></th>
			<?php		
				echo "<td bgcolor='".($sho_overhead[0] >= 8?$good:($sho_overhead[0] >= 6?$yellow:($sho_overhead[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$sho_overhead[0]."</font></td>";
				echo "<td bgcolor='".($sho_overhead[1] >= 8?$good:($sho_overhead[1] >= 6?$yellow:($sho_overhead[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$sho_overhead[1]."</font></td>";
				echo "<td bgcolor='".($sho_overhead[2] >= 8?$good:($sho_overhead[2] >= 6?$yellow:($sho_overhead[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$sho_overhead[2]."</font></td>";
				echo "<td bgcolor='".($sho_overhead[3] >= 8?$good:($sho_overhead[3] >= 6?$yellow:($sho_overhead[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$sho_overhead[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>Overshooters</a></th>
			<?php		
				echo "<td bgcolor='".($overshooters[0] >= 8?$good:($overshooters[0] >= 6?$yellow:($overshooters[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$overshooters[0]."</font></td>";
				echo "<td bgcolor='".($overshooters[1] >= 8?$good:($overshooters[1] >= 6?$yellow:($overshooters[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$overshooters[1]."</font></td>";
				echo "<td bgcolor='".($overshooters[2] >= 8?$good:($overshooters[2] >= 6?$yellow:($overshooters[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$overshooters[2]."</font></td>";
				echo "<td bgcolor='".($overshooters[3] >= 8?$good:($overshooters[3] >= 6?$yellow:($overshooters[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$overshooters[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#FFFFFF"><a style= "color:black" onclick='selectkpiradar(this)'>CPICH Power Ratio</a></th>
			<?php		
				echo "<td bgcolor='".($cpich_power_ratio[0] >= 8?$good:($cpich_power_ratio[0] >= 6?$yellow:($cpich_power_ratio[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cpich_power_ratio[0]."</font></td>";
				echo "<td bgcolor='".($cpich_power_ratio[1] >= 8?$good:($cpich_power_ratio[1] >= 6?$yellow:($cpich_power_ratio[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cpich_power_ratio[1]."</font></td>";
				echo "<td bgcolor='".($cpich_power_ratio[2] >= 8?$good:($cpich_power_ratio[2] >= 6?$yellow:($cpich_power_ratio[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cpich_power_ratio[2]."</font></td>";
				echo "<td bgcolor='".($cpich_power_ratio[3] >= 8?$good:($cpich_power_ratio[3] >= 6?$yellow:($cpich_power_ratio[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$cpich_power_ratio[3]."</font></td>";
			    ?>
			</tr>
			
			<tr>
			<th bgcolor="#C1CCD2"><a style= "color:#0404B4" onclick='selectkpiradar(this)'><i>Composite Radar Score</i></a></th>
			<?php		
				echo "<td bgcolor='".($composite[0] >= 8?$good:($composite[0] >= 6?$yellow:($composite[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'><b>".$composite[0]."</b></font></td>";
				echo "<td bgcolor='".($composite[1] >= 8?$good:($composite[1] >= 6?$yellow:($composite[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'><b>".$composite[1]."</b></font></td>";
				echo "<td bgcolor='".($composite[2] >= 8?$good:($composite[2] >= 6?$yellow:($composite[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'><b>".$composite[2]."</b></font></td>";
				echo "<td bgcolor='".($composite[3] >= 8?$good:($composite[3] >= 6?$yellow:($composite[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'><b>".$composite[3]."</b></font></td>";
			    ?>
			</tr>
	</table>
	</div>
	</div>
</body>
</html>