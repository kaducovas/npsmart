<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div id="content" class="chart_content_large"><div id="acc" class="chart1"></div></div>
<br>
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

	<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="60%">

		<thead>
			<tr>
				<th rowspan="2" bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Node</font></th>
				<th style='display:none;'rowspan="2" bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Node</font></th>
				<?php
				if ($nekpi == 'rf_health_index') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>RF Health Index</font></th>";
				}
				else if($nekpi == 'process_tools') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>SW Release & Features</font></th>";
				}
				else if($nekpi == 'worst_aging_factor') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Worst Aging Factor</font></th>";	
				}
				else if($nekpi == 'baseline') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Baseline (Consistency Check)</font></th>";
				}
				else if($nekpi == 'throughput') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Throughput</font></th>";
				}
				else if($nekpi == 'retention_3g') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Service Retention in 3G</font></th>";
				}
				else if($nekpi == 'ps_call_completion') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>PS (Call Completion)</font></th>";
				}
				else if($nekpi == 'cs_call_completion') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>CS (Call Completion)</font></th>";
				}
				else if($nekpi == 'availability') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Availability</font></th>";
				}
				else if($nekpi == 'traffic_load') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Traffic Load</font></th>";			
				}
				else if($nekpi == 'hardware_nodeb') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Hardware (NodeB: CE & Iub/RNC)</font></th>";		
				}
				else if($nekpi == 'air_interface_ul') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Air Interface UL (RTWP)</font></th>";		
				}
				else if($nekpi == 'air_interface_dl') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Air Interface DL (Codes & Power)</font></th>";		
				}
				else if($nekpi == 'sho_overhead') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>SHO Overhead</font></th>";		
				}
				else if($nekpi == 'overshooters') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Overshooters</font></th>";		
				}
				else if($nekpi == 'cpich_power_ratio') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>CPICH Power Ratio</font></th>";	
				}
				else if($nekpi == 'composite') {
				echo "<th colspan='4' bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>Composite RADAR Score</font></th>";
				}
				else{}
				?>
				</tr>
			<tr>
				<?php 
					// foreach($nqi_weekly_region as $row){
					// $weeks = $row->weeks;
					// }
					$weeks = $radar_weekly_region[0]->weeks;
					$week = explode(",", $weeks);		
 
					if (isset($monthnum))
					{
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]."</td>"; 

							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[0]]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[1]]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[2]]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>".$months[(int)$week[3]]."</font></th>";	
	
					}
					else if (isset($weeknum))
					{
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[0]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[1]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[2]."</font></th>";
							echo "<th bgcolor='#394E58'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W".$week[3]."</font></th>";
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
				$title = "#394E58";
				
				foreach($radar_weekly_region as $row)
				{					
					$rf_health_index = $row->rf_health_index;
					$array_0 = array_fill(0, 3, 0);	
					$array_rf_health_index = explode(",", $rf_health_index);	
					$array_rf_health_index = array_merge($array_rf_health_index, $array_0);

					$process_tools = $row->process_tools;
					$array_0 = array_fill(0, 3, 0);	
					$array_process_tools = explode(",", $process_tools);	
					$array_process_tools = array_merge($array_process_tools, $array_0);
					
					$worst_aging_factor = $row->worst_aging_factor;
					$array_0 = array_fill(0, 3, 0);	
					$array_worst_aging_factor = explode(",", $worst_aging_factor);
					$array_worst_aging_factor = array_merge($array_worst_aging_factor, $array_0);

					$baseline = $row->baseline;
					$array_0 = array_fill(0, 3, 0);	
					$array_baseline = explode(",", $baseline);
					$array_baseline = array_merge($array_baseline, $array_0);	
					
					$throughput = $row->throughput;
					$array_0 = array_fill(0, 3, 0);	
					$array_throughput = explode(",", $throughput);
					$array_throughput = array_merge($array_throughput, $array_0);	
					
					$retention_3g = $row->retention_3g;
					$array_0 = array_fill(0, 3, 0);	
					$array_retention_3g = explode(",", $retention_3g);
					$array_retention_3g = array_merge($array_retention_3g, $array_0);	
					
					$ps_call_completion = $row->ps_call_completion;
					$array_0 = array_fill(0, 3, 0);	
					$array_ps_call_completion = explode(",", $ps_call_completion);
					$array_ps_call_completion = array_merge($array_ps_call_completion, $array_0);	
					
					$cs_call_completion = $row->cs_call_completion;
					$array_0 = array_fill(0, 3, 0);	
					$array_cs_call_completion = explode(",", $cs_call_completion);
					$array_cs_call_completion = array_merge($array_cs_call_completion, $array_0);	
					
					$availability = $row->availability;
					$array_0 = array_fill(0, 3, 0);	
					$array_availability = explode(",", $availability);
					$array_availability = array_merge($array_availability, $array_0);	
										
					$traffic_load = $row->traffic_load;
					$array_0 = array_fill(0, 3, 0);	
					$array_traffic_load = explode(",", $traffic_load);
					$array_traffic_load = array_merge($array_traffic_load, $array_0);
					
					$hardware_nodeb = $row->hardware_nodeb;
					$array_0 = array_fill(0, 3, 0);	
					$array_hardware_nodeb = explode(",", $hardware_nodeb);
					$array_hardware_nodeb = array_merge($array_hardware_nodeb, $array_0);	
					
					$air_interface_ul = $row->air_interface_ul;
					$array_0 = array_fill(0, 3, 0);	
					$array_air_interface_ul = explode(",", $air_interface_ul);
					$array_air_interface_ul = array_merge($array_air_interface_ul, $array_0);
					
					$air_interface_dl = $row->air_interface_dl;
					$array_0 = array_fill(0, 3, 0);	
					$array_air_interface_dl = explode(",", $air_interface_dl);
					$array_air_interface_dl = array_merge($array_air_interface_dl, $array_0);	
					
					$sho_overhead = $row->sho_overhead;
					$array_0 = array_fill(0, 3, 0);	
					$array_sho_overhead = explode(",", $sho_overhead);
					$array_sho_overhead = array_merge($array_sho_overhead, $array_0);
					
					$overshooters = $row->overshooters;
					$array_0 = array_fill(0, 3, 0);	
					$array_overshooters = explode(",", $overshooters);
					$array_overshooters = array_merge($array_overshooters, $array_0);	
					
					$cpich_power_ratio = $row->cpich_power_ratio;
					$array_0 = array_fill(0, 3, 0);	
					$array_cpich_power_ratio = explode(",", $cpich_power_ratio);
					$array_cpich_power_ratio = array_merge($array_cpich_power_ratio, $array_0);
					
					$composite = $row->composite;
					$array_0 = array_fill(0, 3, 0);	
					$array_composite = explode(",", $composite);
					$array_composite = array_merge($array_composite, $array_0);

					echo "<tr>";		
					echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";	

					if ($nekpi == 'rf_health_index'){
					echo "<td bgcolor='".($array_rf_health_index[0] >= 8?$good:($array_rf_health_index[0] >= 6?$yellow:($array_rf_health_index[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_rf_health_index[0]."</font></td>";
					echo "<td bgcolor='".($array_rf_health_index[1] >= 8?$good:($array_rf_health_index[1] >= 6?$yellow:($array_rf_health_index[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_rf_health_index[1]."</font></td>";
					echo "<td bgcolor='".($array_rf_health_index[2] >= 8?$good:($array_rf_health_index[2] >= 6?$yellow:($array_rf_health_index[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_rf_health_index[2]."</font></td>";
					echo "<td bgcolor='".($array_rf_health_index[3] >= 8?$good:($array_rf_health_index[3] >= 6?$yellow:($array_rf_health_index[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_rf_health_index[3]."</font></td>";
					}
					else if ($nekpi == 'process_tools'){
					echo "<td bgcolor='".($array_process_tools[0] >= 8?$good:($array_process_tools[0] >= 6?$yellow:($array_process_tools[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_process_tools[0]."</font></td>";
					echo "<td bgcolor='".($array_process_tools[1] >= 8?$good:($array_process_tools[1] >= 6?$yellow:($array_process_tools[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_process_tools[1]."</font></td>";
					echo "<td bgcolor='".($array_process_tools[2] >= 8?$good:($array_process_tools[2] >= 6?$yellow:($array_process_tools[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_process_tools[2]."</font></td>";
					echo "<td bgcolor='".($array_process_tools[3] >= 8?$good:($array_process_tools[3] >= 6?$yellow:($array_process_tools[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_process_tools[3]."</font></td>";
					}
					else if ($nekpi == 'worst_aging_factor'){
					echo "<td bgcolor='".($array_worst_aging_factor[0] >= 8?$good:($array_worst_aging_factor[0] >= 6?$yellow:($array_worst_aging_factor[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_worst_aging_factor[0]."</font></td>";
					echo "<td bgcolor='".($array_worst_aging_factor[1] >= 8?$good:($array_worst_aging_factor[1] >= 6?$yellow:($array_worst_aging_factor[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_worst_aging_factor[1]."</font></td>";
					echo "<td bgcolor='".($array_worst_aging_factor[2] >= 8?$good:($array_worst_aging_factor[2] >= 6?$yellow:($array_worst_aging_factor[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_worst_aging_factor[2]."</font></td>";
					echo "<td bgcolor='".($array_worst_aging_factor[3] >= 8?$good:($array_worst_aging_factor[3] >= 6?$yellow:($array_worst_aging_factor[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_worst_aging_factor[3]."</font></td>";
					}
					else if ($nekpi == 'baseline'){
					echo "<td bgcolor='".($array_baseline[0] >= 8?$good:($array_baseline[0] >= 6?$yellow:($array_baseline[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_baseline[0]."</font></td>";
					echo "<td bgcolor='".($array_baseline[1] >= 8?$good:($array_baseline[1] >= 6?$yellow:($array_baseline[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_baseline[1]."</font></td>";
					echo "<td bgcolor='".($array_baseline[2] >= 8?$good:($array_baseline[2] >= 6?$yellow:($array_baseline[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_baseline[2]."</font></td>";
					echo "<td bgcolor='".($array_baseline[3] >= 8?$good:($array_baseline[3] >= 6?$yellow:($array_baseline[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_baseline[3]."</font></td>";
					}
					else if ($nekpi == 'throughput'){
					echo "<td bgcolor='".($array_throughput[0] >= 8?$good:($array_throughput[0] >= 6?$yellow:($array_throughput[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_throughput[0]."</font></td>";
					echo "<td bgcolor='".($array_throughput[1] >= 8?$good:($array_throughput[1] >= 6?$yellow:($array_throughput[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_throughput[1]."</font></td>";
					echo "<td bgcolor='".($array_throughput[2] >= 8?$good:($array_throughput[2] >= 6?$yellow:($array_throughput[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_throughput[2]."</font></td>";
					echo "<td bgcolor='".($array_throughput[3] >= 8?$good:($array_throughput[3] >= 6?$yellow:($array_throughput[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_throughput[3]."</font></td>";
					}
					else if ($nekpi == 'retention_3g'){
					echo "<td bgcolor='".($array_retention_3g[0] >= 8?$good:($array_retention_3g[0] >= 6?$yellow:($array_retention_3g[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_retention_3g[0]."</font></td>";
					echo "<td bgcolor='".($array_retention_3g[1] >= 8?$good:($array_retention_3g[1] >= 6?$yellow:($array_retention_3g[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_retention_3g[1]."</font></td>";
					echo "<td bgcolor='".($array_retention_3g[2] >= 8?$good:($array_retention_3g[2] >= 6?$yellow:($array_retention_3g[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_retention_3g[2]."</font></td>";
					echo "<td bgcolor='".($array_retention_3g[3] >= 8?$good:($array_retention_3g[3] >= 6?$yellow:($array_retention_3g[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_retention_3g[3]."</font></td>";
					}
					else if ($nekpi == 'ps_call_completion'){
					echo "<td bgcolor='".($array_ps_call_completion[0] >= 8?$good:($array_ps_call_completion[0] >= 6?$yellow:($array_ps_call_completion[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_ps_call_completion[0]."</font></td>";
					echo "<td bgcolor='".($array_ps_call_completion[1] >= 8?$good:($array_ps_call_completion[1] >= 6?$yellow:($array_ps_call_completion[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_ps_call_completion[1]."</font></td>";
					echo "<td bgcolor='".($array_ps_call_completion[2] >= 8?$good:($array_ps_call_completion[2] >= 6?$yellow:($array_ps_call_completion[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_ps_call_completion[2]."</font></td>";
					echo "<td bgcolor='".($array_ps_call_completion[3] >= 8?$good:($array_ps_call_completion[3] >= 6?$yellow:($array_ps_call_completion[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_ps_call_completion[3]."</font></td>";
					}
					else if ($nekpi == 'cs_call_completion'){
					echo "<td bgcolor='".($array_cs_call_completion[0] >= 8?$good:($array_cs_call_completion[0] >= 6?$yellow:($array_cs_call_completion[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cs_call_completion[0]."</font></td>";
					echo "<td bgcolor='".($array_cs_call_completion[1] >= 8?$good:($array_cs_call_completion[1] >= 6?$yellow:($array_cs_call_completion[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cs_call_completion[1]."</font></td>";
					echo "<td bgcolor='".($array_cs_call_completion[2] >= 8?$good:($array_cs_call_completion[2] >= 6?$yellow:($array_cs_call_completion[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cs_call_completion[2]."</font></td>";
					echo "<td bgcolor='".($array_cs_call_completion[3] >= 8?$good:($array_cs_call_completion[3] >= 6?$yellow:($array_cs_call_completion[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cs_call_completion[3]."</font></td>";
					}
					else if ($nekpi == 'availability'){
					echo "<td bgcolor='".($array_availability[0] >= 8?$good:($array_availability[0] >= 6?$yellow:($array_availability[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_availability[0]."</font></td>";
					echo "<td bgcolor='".($array_availability[1] >= 8?$good:($array_availability[1] >= 6?$yellow:($array_availability[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_availability[1]."</font></td>";
					echo "<td bgcolor='".($array_availability[2] >= 8?$good:($array_availability[2] >= 6?$yellow:($array_availability[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_availability[2]."</font></td>";
					echo "<td bgcolor='".($array_availability[3] >= 8?$good:($array_availability[3] >= 6?$yellow:($array_availability[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_availability[3]."</font></td>";
					}
					else if ($nekpi == 'traffic_load'){
					echo "<td bgcolor='".($array_traffic_load[0] >= 8?$good:($array_traffic_load[0] >= 6?$yellow:($array_traffic_load[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_traffic_load[0]."</font></td>";
					echo "<td bgcolor='".($array_traffic_load[1] >= 8?$good:($array_traffic_load[1] >= 6?$yellow:($array_traffic_load[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_traffic_load[1]."</font></td>";
					echo "<td bgcolor='".($array_traffic_load[2] >= 8?$good:($array_traffic_load[2] >= 6?$yellow:($array_traffic_load[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_traffic_load[2]."</font></td>";
					echo "<td bgcolor='".($array_traffic_load[3] >= 8?$good:($array_traffic_load[3] >= 6?$yellow:($array_traffic_load[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_traffic_load[3]."</font></td>";
					}
					else if ($nekpi == 'hardware_nodeb'){
						if ($array_hardware_nodeb[0] == "-" or $array_hardware_nodeb[1] == "-" or $array_hardware_nodeb[2] == "-" or $array_hardware_nodeb[3] == "-"){
					echo "<td bgcolor='#E6E6E6'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[0]."</font></td>";
					echo "<td bgcolor='#E6E6E6'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[1]."</font></td>";
					echo "<td bgcolor='#E6E6E6'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[2]."</font></td>";
					echo "<td bgcolor='#E6E6E6'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[3]."</font></td>";
						}
					else{
					echo "<td bgcolor='".($array_hardware_nodeb[0] >= 8?$good:($array_hardware_nodeb[0] >= 6?$yellow:($array_hardware_nodeb[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[0]."</font></td>";
					echo "<td bgcolor='".($array_hardware_nodeb[1] >= 8?$good:($array_hardware_nodeb[1] >= 6?$yellow:($array_hardware_nodeb[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[1]."</font></td>";
					echo "<td bgcolor='".($array_hardware_nodeb[2] >= 8?$good:($array_hardware_nodeb[2] >= 6?$yellow:($array_hardware_nodeb[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[2]."</font></td>";
					echo "<td bgcolor='".($array_hardware_nodeb[3] >= 8?$good:($array_hardware_nodeb[3] >= 6?$yellow:($array_hardware_nodeb[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_hardware_nodeb[3]."</font></td>";
					}
					}
					else if ($nekpi == 'air_interface_ul'){
					echo "<td bgcolor='".($array_air_interface_ul[0] >= 8?$good:($array_air_interface_ul[0] >= 6?$yellow:($array_air_interface_ul[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_ul[0]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_ul[1] >= 8?$good:($array_air_interface_ul[1] >= 6?$yellow:($array_air_interface_ul[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_ul[1]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_ul[2] >= 8?$good:($array_air_interface_ul[2] >= 6?$yellow:($array_air_interface_ul[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_ul[2]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_ul[3] >= 8?$good:($array_air_interface_ul[3] >= 6?$yellow:($array_air_interface_ul[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_ul[3]."</font></td>";
					}
					else if ($nekpi == 'air_interface_dl'){
					echo "<td bgcolor='".($array_air_interface_dl[0] >= 8?$good:($array_air_interface_dl[0] >= 6?$yellow:($array_air_interface_dl[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_dl[0]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_dl[1] >= 8?$good:($array_air_interface_dl[1] >= 6?$yellow:($array_air_interface_dl[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_dl[1]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_dl[2] >= 8?$good:($array_air_interface_dl[2] >= 6?$yellow:($array_air_interface_dl[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_dl[2]."</font></td>";
					echo "<td bgcolor='".($array_air_interface_dl[3] >= 8?$good:($array_air_interface_dl[3] >= 6?$yellow:($array_air_interface_dl[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_air_interface_dl[3]."</font></td>";
					}
					else if ($nekpi == 'sho_overhead'){
					echo "<td bgcolor='".($array_sho_overhead[0] >= 8?$good:($array_sho_overhead[0] >= 6?$yellow:($array_sho_overhead[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_sho_overhead[0]."</font></td>";
					echo "<td bgcolor='".($array_sho_overhead[1] >= 8?$good:($array_sho_overhead[1] >= 6?$yellow:($array_sho_overhead[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_sho_overhead[1]."</font></td>";
					echo "<td bgcolor='".($array_sho_overhead[2] >= 8?$good:($array_sho_overhead[2] >= 6?$yellow:($array_sho_overhead[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_sho_overhead[2]."</font></td>";
					echo "<td bgcolor='".($array_sho_overhead[3] >= 8?$good:($array_sho_overhead[3] >= 6?$yellow:($array_sho_overhead[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_sho_overhead[3]."</font></td>";
					}
					else if ($nekpi == 'overshooters'){
					echo "<td bgcolor='".($array_overshooters[0] >= 8?$good:($array_overshooters[0] >= 6?$yellow:($array_overshooters[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_overshooters[0]."</font></td>";
					echo "<td bgcolor='".($array_overshooters[1] >= 8?$good:($array_overshooters[1] >= 6?$yellow:($array_overshooters[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_overshooters[1]."</font></td>";
					echo "<td bgcolor='".($array_overshooters[2] >= 8?$good:($array_overshooters[2] >= 6?$yellow:($array_overshooters[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_overshooters[2]."</font></td>";
					echo "<td bgcolor='".($array_overshooters[3] >= 8?$good:($array_overshooters[3] >= 6?$yellow:($array_overshooters[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_overshooters[3]."</font></td>";
					}
					else if ($nekpi == 'cpich_power_ratio'){
					echo "<td bgcolor='".($array_cpich_power_ratio[0] >= 8?$good:($array_cpich_power_ratio[0] >= 6?$yellow:($array_cpich_power_ratio[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cpich_power_ratio[0]."</font></td>";
					echo "<td bgcolor='".($array_cpich_power_ratio[1] >= 8?$good:($array_cpich_power_ratio[1] >= 6?$yellow:($array_cpich_power_ratio[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cpich_power_ratio[1]."</font></td>";
					echo "<td bgcolor='".($array_cpich_power_ratio[2] >= 8?$good:($array_cpich_power_ratio[2] >= 6?$yellow:($array_cpich_power_ratio[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cpich_power_ratio[2]."</font></td>";
					echo "<td bgcolor='".($array_cpich_power_ratio[3] >= 8?$good:($array_cpich_power_ratio[3] >= 6?$yellow:($array_cpich_power_ratio[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_cpich_power_ratio[3]."</font></td>";
					}
					else if ($nekpi == 'composite'){
					echo "<td bgcolor='".($array_composite[0] >= 8?$good:($array_composite[0] >= 6?$yellow:($array_composite[0] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_composite[0]."</font></td>";
					echo "<td bgcolor='".($array_composite[1] >= 8?$good:($array_composite[1] >= 6?$yellow:($array_composite[1] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_composite[1]."</font></td>";
					echo "<td bgcolor='".($array_composite[2] >= 8?$good:($array_composite[2] >= 6?$yellow:($array_composite[2] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_composite[2]."</font></td>";
					echo "<td bgcolor='".($array_composite[3] >= 8?$good:($array_composite[3] >= 6?$yellow:($array_composite[3] >= 4?$orange:$bad)))."'><font style='font-family: calibri; font-size:12pt'>".$array_composite[3]."</font></td>";
					}
					else{}
					echo "</tr>";			
				}
			?>
	
		</tbody>
	</table>
</div>
<br>
</body>
</html>