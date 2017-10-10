<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<?php
				foreach($node_weekly_report as $row){
					#echo $row->node;
					 $node[$row->node] = $row->node;
					 $type[$row->node] = $row->type;
					 $rrc_service[$row->node] = $row->rrc_service;
					 $fails_rrc_service[$row->node] = $row->fails_rrc_service;
					 $rrc_signaling[$row->node] = $row->rrc_signaling;
					 $fails_rrc_signaling[$row->node] = $row->fails_rrc_signaling;
					 $s1sig[$row->node] = $row->s1sig;
					 $fails_s1sig[$row->node] = $row->fails_s1sig;
					 $e_rab[$row->node] = $row->e_rab;
					 $fails_e_rab[$row->node] = $row->fails_e_rab;
					 $call_setup[$row->node] = $row->call_setup;
					 $csfb[$row->node] = $row->csfb;
					 $fails_csfb[$row->node] = $row->fails_csfb;
					 
					 $availability[$row->node] = $row->availability;
					 
					 $intra_freq_hoo_out[$row->node] = $row->intra_freq_hoo_out;
					 $inter_freq_hoo_out[$row->node] = $row->inter_freq_hoo_out;
					 $handover_in[$row->node] = $row->handover_in;
					 $iratho_l2c[$row->node] = $row->iratho_l2c;
					 $iratho_l2w[$row->node] = $row->iratho_l2w;
					 $iratho_l2g[$row->node] = $row->iratho_l2g;
					 $iratho_l2t[$row->node] = $row->iratho_l2t;
					
					 $retention_4g[$row->node] = $row->retention_4g;
					 
					 $service_drop[$row->node] = $row->service_drop;
					 
					 $cell_downlink_avg_thp[$row->node] = $row->cell_downlink_avg_thp;
					 $cell_uplink_avg_thp[$row->node] = $row->cell_uplink_avg_thp;
					 $rb_cell_downlink_avg_thp[$row->node] = $row->rb_cell_downlink_avg_thp;
					 $rb_cell_uplink_avg_thp[$row->node] = $row->rb_cell_uplink_avg_thp;
					 
					 $downlink_traffic_volume[$row->node] = $row->downlink_traffic_volume;
					 $uplink_traffic_volume[$row->node] = $row->uplink_traffic_volume;
					 $average_user_volume[$row->node] = $row->average_user_volume;
					 
					 $rb_utilization_dl[$row->node] = $row->rb_utilization_dl;
					 $rrc_signaling_ul[$row->node] = $row->rrc_signaling_ul;
					 $rb_preschedule_rb_urul[$row->node] = $row->rb_preschedule_rb_urul;

				 }	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				 
  
  ?>
  
 <div id="container" class="main"> 

 <form action="/npsmart/lte/worstcells" name="wcform" method="post">
<input type="hidden" id="wcreportnename" name="reportnename" value="" />
<input type="hidden" id="wcreportnetype" name="reportnetype" value="" />
<input type="hidden" id="wctimeagg" name="timeagg" value="" />
<input type="hidden" id="wcreportdate" name="reportdate" value="" />
<input type="hidden" id="wckpi" name="kpi" value="" />
<div width="50%">
<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
        <tr>

			<th rowspan="2" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
			<th style='display:none;'rowspan="2" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
            <th colspan="6" bgcolor="#3C6D7A" align="center"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Accessibility</font></th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Retainability</th>
            <th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Retention</font></th>
            <th colspan="2" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Traffic (GB)</font></th>
            <th colspan="2" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Throughput (Mbps)</font></th>
            <th colspan="5" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Handover</font></th>
			<th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Availability</font></th>
			<th colspan="1" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Utilization</font></th>
        </tr>
		<tr>

            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RRC Service</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RRC Signaling</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">S1 Sig</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">E-RAB</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Call Setup</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">CSFB</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Service Retainability</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">4G Retention</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">DL</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">UL</font></th>
            <!--<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">DL</font></th>-->
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">DL</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">UL</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Intra Freq Out</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Inter Freq Out</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">HO In</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">IRAT L2W</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">IRAT L2G</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Availability</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RB Utilization DL</font></th>
        </tr>
	</thead>
	
	<tbody>		

	<?php
	$bad = "#FF0000";	
	$good = "#009900";
	$yellow = "#FFFF00";
	$title = "#3C6D7A";
	#$yellow = "#E9AB17";
	
#onclick='selected(this)'	
#href='/npsmart/umts/main?node=".$node[$k]."'
foreach ($node as $k => $v) {
					echo "<tr>";
					echo "<td value='".$type[$k]."'><a id='".$node[$k]."' onclick='selectne(this)' class='node' value='".$node[$k]."'>".$node[$k]."</a></td>";
					echo "<td style='display:none;'>".$type[$k]."</td>";
					echo "<td><font color='".($rrc_service[$k] >= 98.5?$good:$bad)."'>".$rrc_service[$k]."%</font></td>";
					echo "<td><font color='".($rrc_signaling[$k] >= 98.5?$good:$bad)."'>".$rrc_signaling[$k]."%</font></td>";
					echo "<td><font color='".($s1sig[$k] >= 98.5?$good:$bad)."'>".$s1sig[$k]."%</font></td>";
					echo "<td><font color='".($e_rab[$k] >= 98.5?$good:$bad)."'>".$e_rab[$k]."%</font></td>";
					echo "<td><font color='".($call_setup[$k] >= 98.5?$good:$bad)."'>".$call_setup[$k]."%</font></td>";
					echo "<td><font color='".($csfb[$k] >= 98.5?$good:$bad)."'>".$csfb[$k]."%</font></td>";
					echo "<td><font color='".($service_drop[$k] >= 98.5?$good:$bad)."'>".$service_drop[$k]."%</font></td>";
					echo "<td><font color='".($retention_4g[$k] >= 98.5?$good:$bad)."'>".$retention_4g[$k]."%</font></td>";
					echo "<td><font color='".($downlink_traffic_volume[$k] >= 0?$good:$bad)."'>".$downlink_traffic_volume[$k]."</font></td>";
					echo "<td><font color='".($uplink_traffic_volume[$k] >= 0?$good:$bad)."'>".$uplink_traffic_volume[$k]."</font></td>";
					#echo "<td><font color='".($cell_downlink_avg_thp[$k] >= 0?$good:$bad)."'>".$cell_downlink_avg_thp[$k]."</font></td>";
					echo "<td><font color='".($cell_downlink_avg_thp[$k] >= 12?$good:$bad)."'>".$cell_downlink_avg_thp[$k]."</font></td>";
					echo "<td><font color='".($cell_uplink_avg_thp[$k] >= 1?$good:$bad)."'>".$cell_uplink_avg_thp[$k]."</font></td>";
					echo "<td><font color='".($intra_freq_hoo_out[$k] >= 98.5?$good:$bad)."'>".$intra_freq_hoo_out[$k]."%</font></td>";
					echo "<td><font color='".($inter_freq_hoo_out[$k] >= 98.5?$good:$bad)."'>".$inter_freq_hoo_out[$k]."%</font></td>";
					echo "<td><font color='".($handover_in[$k] >= 98.5?$good:$bad)."'>".$handover_in[$k]."%</font></td>";
					echo "<td><font color='".($iratho_l2w[$k] >= 98.5?$good:$bad)."'>".$iratho_l2w[$k]."%</font></td>";
					echo "<td><font color='".($iratho_l2g[$k] >= 98.5?$good:$bad)."'>".$iratho_l2g[$k]."%</font></td>";
					echo "<td><font color='".($availability[$k] >= 99?$good:$bad)."'>".$availability[$k]."%</font></td>";
					echo "<td><font color='".($rb_utilization_dl[$k] <= 70?$good:$bad)."'>".$rb_utilization_dl[$k]."%</font></td>";
					
					echo "</tr>";
				}			
	?>

	</tbody>
</table>
	
</div>

<br><br>
<div id="content" class="chart_content"><div id="acc" class="chart1"></div></div>
<div id="content" class="chart_content"><div id="csfb" class="chart1"></div></div>
<div style="clear: both;"></div>
<div id="content" class="chart_content"><div id="drop" class="chart"></div></div>
<div id="content" class="chart_content"><div id="retention" class="chart"></div></div>	
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="traffic" class="chart"></div></div>			
<div id="content" class="chart_content"><div id="users" class="chart"></div></div>
<div style="clear: both;"></div>
<div id="content" class="chart_content"><div id="thp" class="chart"></div></div>
<div id="content" class="chart_content"><div id="utilization" class="chart"></div></div>
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="handover" class="chart"></div></div>
<div id="content" class="chart_content"><div id="availability" class="chart"></div></div>			
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