<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';

</script>
<?php
				foreach($node_weekly_report as $row){
					#echo $row->node;
					 $node[$row->node] = $row->node;
					 $type[$row->node] = $row->type;
					 $acc_cs[$row->node] = $row->acc_cs;
					 $availability[$row->node] = $row->availability;
					 $retainability_cs[$row->node] = round($row->retainability_cs,2);

					 $smp_5[$row->node] = $row->smp_5;
					 $smp_7[$row->node] = $row->smp_7;
					 $smp_8[$row->node] = $row->smp_8;
					 $smp_9[$row->node] = $row->smp_9;

					 $sdcch_traffic[$row->node] = $row->sdcch_traffic;
					 $tch_traffic_fr[$row->node] = $row->tch_traffic_fr;
					 $tch_traffic_hr[$row->node] = $row->tch_traffic_hr;
				 }
			 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								//FORGET ABOUT IT!!!

			// foreach($accessibility_node_rate_weekly as $row){
				 // $node[$row->node] = $row->node;
				 // $acc_rrc[$row->node] = $row->acc_rrc;
				 // $acc_cs[$row->node] = $row->acc_cs;
				 // $acc_ps[$row->node] = $row->acc_ps;
				 // $acc_hsdpa[$row->node] = $row->acc_hsdpa;
				 // $acc_hsdpa_f2h[$row->node] = $row->acc_hsdpa_f2h;
				 // }
			 // foreach($retainability_node_rate_weekly as $row){
				 // $drop_cs[$row->node] = $row->drop_cs;
				 // $drop_ps[$row->node] = $row->drop_ps;
				 // $drop_hsdpa[$row->node] = $row->drop_hsdpa;
				 // $drop_hsupa[$row->node] = $row->drop_hsupa;
				 // }				 

			 // foreach($mobility_node_rate_weekly as $row){
				 // $sho_succ_rate[$row->node] = $row->sho_succ_rate;
				 // $soft_hand_succ_rate[$row->node] = $row->soft_hand_succ_rate;
				 // $iratho_cs_succ_rate[$row->node] = $row->iratho_cs_succ_rate;
				 // $iratho_ps_succ_rate[$row->node] = $row->iratho_ps_succ_rate;
				 // $retention_cs_succ_rate[$row->node] = $row->retention_cs_succ_rate;
				 // $retention_ps_succ_rate[$row->node] = $row->retention_ps_succ_rate;
				 // }
				 
			 // foreach($coverage_node_rate_weekly as $row){
				 // $sho_over[$row->node] = $row->sho_over;
				 // $rtwp[$row->node] = $row->rtwp;
				 // }

			 // foreach($availability_node_rate_weekly as $row){
				 // $availability[$row->node] = $row->availability;
				 // }

			 // foreach($traffic_node_rate_weekly as $row){
				 // $data_hsdpa[$row->node] = $row->data_hsdpa;
				 // $data_hsupa[$row->node] = $row->data_hsupa;
				 // $ps_r99_ul[$row->node] = $row->ps_r99_ul;
				 // $ps_r99_dl[$row->node] = $row->ps_r99_dl;
				 // $voice_traffic_dl[$row->node] = $row->voice_traffic_dl;
				 // $voice_traffic_ul[$row->node] = $row->voice_traffic_ul;
				 // $hsdpa_users[$row->node] = $row->hsdpa_users;
				 // $hsupa_users[$row->node] = $row->hsupa_users;
				 // $ps_nonhs_users[$row->node] = $row->ps_nonhs_users;
				 // }

			 // foreach($seviceintegrity_node_rate_weekly as $row){
				 // $thp_hsdpa[$row->node] = $row->thp_hsdpa;
				 // $thp_hsupa[$row->node] = $row->thp_hsupa;
				 // }			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				 
  
  ?>
  
 <div id="container" class="main"> 

<form action="/npsmart/umts/worstcells" name="wcform" method="post">
<input type="hidden" id="wcreportnename" name="reportnename" value="" />
<input type="hidden" id="wcreportnetype" name="reportnetype" value="" />
<input type="hidden" id="wctimeagg" name="timeagg" value="" />
<input type="hidden" id="wcreportdate" name="reportdate" value="" />
<input type="hidden" id="wckpi" name="kpi" value="" />

<div width="50%">
<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
        <tr>

			<th rowspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
			<th style='display:none;'rowspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
            <th colspan="1" bgcolor="#3C6D7A" align="center"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Accessibility CS</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Availability</th>
			<th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Retainability CS</th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">SMP 5</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">SMP 7</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">SMP 8</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">SMP 9</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">sdcch_traffic</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">tch_traffic_fr</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">tch_traffic_hr</font></th>
        </tr>
	</thead>
	
	<tbody>		

	<?php
	$bad = "#FF0000";	
	$good = "#009900";
	$yellow = "#FFFF00";
	$title = "#3C6D7A";
	#$yellow = "#E9AB17";
# style='display:none;'			
#onclick='selected(this)'	
#href='/npsmart/umts/main?node=".$node[$k]."'
foreach ($node as $k => $v) {
					echo "<tr>";
					echo "<td onclick='selectne(this)' value='".$type[$k]."'><a id='".$node[$k]."' class='node' value='".$node[$k]."'>".$node[$k]."</a></td>";
					echo "<td style='display:none;'>".$type[$k]."</td>";
					#echo "<td value='".$node[$k]."'><input id='".$node[$k]."' onclick='selectne(this)' class='node' name='".$type[$k]."' value='".$node[$k]."'></td>";
					echo "<td><font color='".($acc_cs[$k] >= 98.0?$good:$bad)."'>".$acc_cs[$k]."%</font></td>";
					echo "<td><font color='".($availability[$k] >= 99.5?$good:$bad)."'>".$availability[$k]."%</font></td>";;
					echo "<td><font color='".($retainability_cs[$k] >= 98?$good:$bad)."'>".$retainability_cs[$k]."%</font></td>";;
					echo "<td><font color='".($smp_5[$k] >= 95.0?$good:$bad)."'>".$smp_5[$k]."%</font></td>";
					echo "<td><font color='".($smp_7[$k] <= 2.0?$good:$bad)."'>".$smp_7[$k]."%</font></td>";
					echo "<td><font color='".($smp_8[$k] >= 98.0?$good:$bad)."'>".$smp_8[$k]."%</font></td>";
					echo "<td><font color='".($smp_9[$k] <= 5.0?$good:$bad)."'>".$smp_9[$k]."%</font></td>";
					echo "<td><font color='".($sdcch_traffic[$k] > 0?$good:$bad)."'>".$sdcch_traffic[$k]."</font></td>";
					echo "<td><font color='".($tch_traffic_fr[$k] > 0?$good:$bad)."'>".$tch_traffic_fr[$k]."</font></td>";
					echo "<td><font color='".($tch_traffic_hr[$k] > 0?$good:$bad)."'>".$tch_traffic_hr[$k]."</font></td>";
					echo "</tr>";
				}			
			 // echo "<tr>";
			// // #echo "<td>".$row->week."</td>";			
			 // echo "<td>".$row->node."</td>";			
			 // echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";		
			 // echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";		
			 // echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";					
			#echo "<td>".$row->qda_ps_f2h."</td>";
			// echo "<td><font color='".($row->qda_ps_f2h >= 65?$good:$bad)."'>".$row->qda_ps_f2h."%</font></td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".($row->qdr_ps >= 65?$good:$bad)."'>".$row->qdr_ps."%</font></td>";
			// #echo "<td>".$row->qdr_ps."</td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".($row->retention_ps >= 99?$good:$bad)."'>".$row->retention_ps."%</font></td>";
			// #echo "<td>".$row->retention_ps."</td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";		
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";		
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";		
			// echo "<td><font color='".($row->availability >= 99.20?$good:$bad)."'>".$row->availability."%</font></td>";
			// #echo "<td>".$row->availability."</td>";					
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".($row->throughput >= 75?$good:$bad)."'>".$row->throughput."%</font></td>";
			// #echo "<td>".$row->throughput."</td>";
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".(rand(0,100) >= 65?$good:$bad)."'>".rand(0,100)."%</font></td>";			
			// echo "<td><font color='".($row->hsdpa_users_ratio >= 98?$good:$bad)."'>".$row->hsdpa_users_ratio."%</font></td>";
			// #echo "<td>".$row->hsdpa_users_ratio."</td>";		
			// echo "<td bgcolor='".(rand(0,100) >= 55?$good:(rand(0,100) >= 35?$yellow:$bad))."'>".rand(0,100)."%</td>";
			// echo "<td bgcolor='".(rand(0,100) >= 55?$good:(rand(0,100) >= 35?$yellow:$bad))."'>".rand(0,100)."%</td>";
			// echo "<td bgcolor='".(rand(0,100) >= 55?$good:(rand(0,100) >= 35?$yellow:$bad))."'>".rand(0,100)."%</td>";
			// echo "<td bgcolor='".($row->nqi_ps_f2h >= 55?$good:($row->nqi_ps_f2h >= 35?$yellow:$bad))."'>".$row->nqi_ps_f2h."%</td>";
			// #echo "<td>".$row->nqi_ps_f2h."</td>";	
			// echo "</tr>";			
			// }
	?>

	</tbody>
</table>
	
</div>

<br><br>
<div id="content" class="chart_content"><div id="acc" class="chart1"></div></div>
<div id="content" class="chart_content"><div id="availability" class="chart"></div></div>
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="retainability_cs" class="chart"></div></div>
<div id="content" class="chart_content"><div id="smp_5" class="chart"></div></div>			
<div style="clear: both;"></div>
<div id="content" class="chart_content"><div id="smp_7" class="chart"></div></div>
<div id="content" class="chart_content"><div id="smp_8" class="chart"></div></div>	
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="smp_9" class="chart"></div></div>
<div id="content" class="chart_content"><div id="traffic" class="chart"></div></div>

<div style="clear: both;"></div>			
<!--	<div id="content" class="chart_content"><div id="fails_rrc" class="chart1"></div></div>
	<div id="content" class="chart_content"><div id="fails_hs" class="chart1"></div></div>
	<div style="clear: both;"></div>
	<div id="content" class="chart_content"><div id="acc_cs" class="chart1"></div></div>
	<div id="content" class="chart_content"><div id="acc_ps" class="chart1"></div></div>
	<div style="clear: both;"></div>
	<div id="content" class="chart_content"><div id="fails_cs" class="chart"></div></div>
	<div id="content" class="chart_content"><div id="fails_ps" class="chart"></div></div>
	<div style="clear: both;"></div>-->
</form>
</div>
	<button id="export">Export all</button>
</body>
</html>