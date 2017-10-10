<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
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

<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
        <tr>

			<th rowspan="2" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">Node</font></th>
			<th style='display:none;'rowspan="2" bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">Node</font></th>			
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDA HS</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDR HS</th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">3G-Retention HS</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">Weighted Availability</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">User Throughput</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">HSDPA Users Ratio</font></th>
			<th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:14pt">NQI HS</font></th>
        </tr>
		<tr>
  <?php 
  
 // foreach($nqi_weekly_region as $row){
	 // $weeks = $row->weeks;
 // }
 $weeks = $nqi_weekly_region[0]->weeks;
 $week = explode(",", $weeks);		
 
if (isset($monthnum)){
	$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
	#$months[(int)$monthnum]; 

	for ($i = 1; $i <= 7; $i++) {
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[0]]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[1]]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[2]]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[3]]."</font></th>";
	}
	
}
elseif (isset($weeknum)){
	for ($i = 1; $i <= 7; $i++) {
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>W".$week[0]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>W".$week[1]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>W".$week[2]."</font></th>";
		echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>W".$week[3]."</font></th>";
	}
} 
 

 ?>
        </tr>
	</thead>
	
	<tbody>		

	<?php
				$bad = "#FF0000";
				$bgbad = "#FDE9D9";	
				$good = "#92D050";
				$bggood = "#FFFFFF";
				$yellow = "#FFFF00";
				$title = "#C0504D";
	
//onclick='selected(this)'

foreach($nqi_weekly_region as $row){		
	$qda_ps_f2h = $row->qda_ps_f2h;
	$array_0 = array_fill(0, 3, 0);	
	$array_qda_ps_f2h = explode(",", $qda_ps_f2h);	
	$array_qda_ps_f2h = array_merge($array_qda_ps_f2h, $array_0);

	$qdr_ps = $row->qdr_ps;
	$array_0 = array_fill(0, 3, 0);	
	$array_qdr_ps = explode(",", $qdr_ps);	
	$array_qdr_ps = array_merge($array_qdr_ps, $array_0);

	$retention_ps = $row->retention_ps;
	$array_0 = array_fill(0, 3, 0);		
	$array_retention_ps = explode(",", $retention_ps);	
	$array_retention_ps = array_merge($array_retention_ps, $array_0);

	$availability = $row->availability;
	$array_0 = array_fill(0, 3, 0);		
	$array_availability = explode(",", $availability);	
	$array_availability = array_merge($array_availability, $array_0);
	
	$throughput = $row->throughput;
	$array_0 = array_fill(0, 3, 0);		
	$array_throughput = explode(",", $throughput);
	$array_throughput = array_merge($array_throughput, $array_0);
	
	$hsdpa_users_ratio = $row->hsdpa_users_ratio;
	$array_0 = array_fill(0, 3, 0);		
	$array_hsdpa_users_ratio = explode(",", $hsdpa_users_ratio);	
	$array_hsdpa_users_ratio = array_merge($array_hsdpa_users_ratio, $array_0);
	
	$nqi_ps_f2h = $row->nqi_ps_f2h;
	$array_0 = array_fill(0, 3, 0);		
	$array_nqi_ps_f2h = explode(",", $nqi_ps_f2h); 
	$array_nqi_ps_f2h = array_merge($array_nqi_ps_f2h, $array_0);
	
			 echo "<tr>";		
			 echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:14pt'><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
			 echo "<td style='display:none;'>".$row->type."</td>";	
					echo "<td bgcolor='".($array_qda_ps_f2h[0] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qda_ps_f2h[0] >= 92?$good:$bad)."'>".$array_qda_ps_f2h[0]."%</font></td>";
					echo "<td bgcolor='".($array_qda_ps_f2h[1] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qda_ps_f2h[1] >= 92?$good:$bad)."'>".$array_qda_ps_f2h[1]."%</font></td>";
					echo "<td bgcolor='".($array_qda_ps_f2h[2] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qda_ps_f2h[2] >= 92?$good:$bad)."'>".$array_qda_ps_f2h[2]."%</font></td>";
					echo "<td bgcolor='".($array_qda_ps_f2h[3] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qda_ps_f2h[3] >= 92?$good:$bad)."'>".$array_qda_ps_f2h[3]."%</font></td>";

					echo "<td bgcolor='".($array_qdr_ps[0] >= 95?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr_ps[0] >= 95?$good:$bad)."'>".$array_qdr_ps[0]."%</font></td>";
					echo "<td bgcolor='".($array_qdr_ps[1] >= 95?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr_ps[1] >= 95?$good:$bad)."'>".$array_qdr_ps[1]."%</font></td>";
					echo "<td bgcolor='".($array_qdr_ps[2] >= 95?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr_ps[2] >= 95?$good:$bad)."'>".$array_qdr_ps[2]."%</font></td>";
					echo "<td bgcolor='".($array_qdr_ps[3] >= 95?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr_ps[3] >= 95?$good:$bad)."'>".$array_qdr_ps[3]."%</font></td>";
			
					echo "<td bgcolor='".($array_retention_ps[0] >= 100?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_retention_ps[0] >= 100?$good:$bad)."'>".$array_retention_ps[0]."%</font></td>";
					echo "<td bgcolor='".($array_retention_ps[1] >= 100?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_retention_ps[1] >= 100?$good:$bad)."'>".$array_retention_ps[1]."%</font></td>";
					echo "<td bgcolor='".($array_retention_ps[2] >= 100?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_retention_ps[2] >= 100?$good:$bad)."'>".$array_retention_ps[2]."%</font></td>";
					echo "<td bgcolor='".($array_retention_ps[3] >= 100?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_retention_ps[3] >= 100?$good:$bad)."'>".$array_retention_ps[3]."%</font></td>";
			
					echo "<td bgcolor='".($array_availability[0] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_availability[0] >= 99.50?$good:$bad)."'>".$array_availability[0]."%</font></td>";
					echo "<td bgcolor='".($array_availability[1] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_availability[1] >= 99.50?$good:$bad)."'>".$array_availability[1]."%</font></td>";
					echo "<td bgcolor='".($array_availability[2] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_availability[2] >= 99.50?$good:$bad)."'>".$array_availability[2]."%</font></td>";
					echo "<td bgcolor='".($array_availability[3] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_availability[3] >= 99.50?$good:$bad)."'>".$array_availability[3]."%</font></td>";
					
					echo "<td bgcolor='".($array_throughput[0] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_throughput[0] >= 92?$good:$bad)."'>".$array_throughput[0]."%</font></td>";
					echo "<td bgcolor='".($array_throughput[1] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_throughput[1] >= 92?$good:$bad)."'>".$array_throughput[1]."%</font></td>";
					echo "<td bgcolor='".($array_throughput[2] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_throughput[2] >= 92?$good:$bad)."'>".$array_throughput[2]."%</font></td>";
					echo "<td bgcolor='".($array_throughput[3] >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_throughput[3] >= 92?$good:$bad)."'>".$array_throughput[3]."%</font></td>";
	
					echo "<td bgcolor='".($array_hsdpa_users_ratio[0] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_hsdpa_users_ratio[0] >= 99.50?$good:$bad)."'>".$array_hsdpa_users_ratio[0]."%</font></td>";
					echo "<td bgcolor='".($array_hsdpa_users_ratio[1] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_hsdpa_users_ratio[1] >= 99.50?$good:$bad)."'>".$array_hsdpa_users_ratio[1]."%</font></td>";
					echo "<td bgcolor='".($array_hsdpa_users_ratio[2] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_hsdpa_users_ratio[2] >= 99.50?$good:$bad)."'>".$array_hsdpa_users_ratio[2]."%</font></td>";
					echo "<td bgcolor='".($array_hsdpa_users_ratio[3] >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:14pt' color='".($array_hsdpa_users_ratio[3] >= 99.50?$good:$bad)."'>".$array_hsdpa_users_ratio[3]."%</font></td>";

					echo "<td bgcolor='".($array_nqi_ps_f2h[0] >= 85?$good:($array_nqi_ps_f2h[0] >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi_ps_f2h[0]."%</font></td>";
					echo "<td bgcolor='".($array_nqi_ps_f2h[1] >= 85?$good:($array_nqi_ps_f2h[1] >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi_ps_f2h[1]."%</font></td>";
					echo "<td bgcolor='".($array_nqi_ps_f2h[2] >= 85?$good:($array_nqi_ps_f2h[2] >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi_ps_f2h[2]."%</font></td>";
					echo "<td bgcolor='".($array_nqi_ps_f2h[3] >= 85?$good:($array_nqi_ps_f2h[3] >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi_ps_f2h[3]."%</font></td>";
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