<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div id="container" class="main">


<form action="/npsmart/umts/worstcells" name="wcform" method="post">
<input type="hidden" id="rnc" name="rnc" value="" />
<input type="hidden" id="date" name="wcdate" value="" />
<input type="hidden" id="kpi" name="kpi" value="" />
</form>

<form action="/npsmart/umts/weeklyworstcells" name="weekwcform" method="post">
<input type="hidden" id="node" name="node" value="" />
<input type="hidden" id="week" name="week" value="" />
<input type="hidden" id="weeklykpi" name="kpi" value="" />
</form>

<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
        <tr>

			<th rowspan="2" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">Node</font></th>
			<th style='display:none;'rowspan="2" bgcolor="#3b5998"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">Node</font></th>			
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDA</font></th>
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDR</th>
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">Weighted Availability</font></th>
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">4G-Retention</font></th>
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDE DL</font></th>
            <th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">QDE UL</font></th>
			<th colspan="4" bgcolor="#C0504D"><font style='font-family: calibri; font-size:14pt' color="#FFFFFF" style="font-family: calibri; font-size:14pt">NQI</font></th>
        </tr>
		<tr>
  <?php 
 
	 				// $weeks = $nqi_weekly_region[0]->months;
					// $week = explode(",", $weeks);		
 
					if (isset($monthnum))
					{
						$weeks = $nqi_weekly_region[0]->months;
						$week = explode(",", $weeks);
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]; 

						for ($i = 1; $i <= 7; $i++) 
						{
							echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[0]]."</font></th>";
							echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[1]]."</font></th>";
							echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[2]]."</font></th>";
							echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:14pt'>".$months[(int)$week[3]]."</font></th>";
						}	
	
					}
					elseif (isset($weeknum))
					{
						$weeks = $nqi_weekly_region[0]->weeks;
						$week = explode(",", $weeks);
						for ($i = 1; $i <= 7; $i++) 
						{
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
				$yellow = "#FFAA00";
				$yellow1 = "#FFFF00";
				$title = "#C0504D";
	
//onclick='selected(this)'

foreach($nqi_weekly_region as $row){		
	$qda = $row->qda;
	$array_0 = array_fill(0, 3, 0);	
	$array_qda = explode(",", $qda);	
	$array_qda = array_merge($array_qda, $array_0);

	$qdr = $row->qdr;
	$array_0 = array_fill(0, 3, 0);	
	$array_qdr = explode(",", $qdr);	
	$array_qdr = array_merge($array_qdr, $array_0);

	$lte_retention = $row->lte_retention;
	$array_0 = array_fill(0, 3, 0);		
	$array_lte_retention = explode(",", $lte_retention);	
	$array_lte_retention = array_merge($array_lte_retention, $array_0);

	$availability = $row->availability;
	$array_0 = array_fill(0, 3, 0);		
	$array_availability = explode(",", $availability);	
	$array_availability = array_merge($array_availability, $array_0);
	
	$qde_dl = $row->qde_dl;
	$array_0 = array_fill(0, 3, 0);		
	$array_qde_dl = explode(",", $qde_dl);
	$array_qde_dl = array_merge($array_qde_dl, $array_0);
	
	$qde_ul = $row->qde_ul;
	$array_0 = array_fill(0, 3, 0);		
	$array_qde_ul = explode(",", $qde_ul);	
	$array_qde_ul = array_merge($array_qde_ul, $array_0);
	
	$nqi = $row->nqi;
	$array_0 = array_fill(0, 3, 0);		
	$array_nqi = explode(",", $nqi); 
	$array_nqi = array_merge($array_nqi, $array_0);
	
			 echo "<tr>";		
					echo "<td value='".$row->node."'><font style='font-family: calibri; font-size:14pt'><a id='".$row->node."' onclick='selectne(this)' class='node' value='".$row->node."'>".$row->node."</a></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";	
			#echo "<td>".$row->node."</td>";		
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qda[0] >= 99?$good:($array_qda[0] >= 98?$yellow:$bad))."'>".$array_qda[0]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qda[1] >= 99?$good:($array_qda[1] >= 98?$yellow:$bad))."'>".$array_qda[1]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qda[2] >= 99?$good:($array_qda[2] >= 98?$yellow:$bad))."'>".$array_qda[2]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qda[3] >= 99?$good:($array_qda[3] >= 98?$yellow:$bad))."'>".$array_qda[3]."%</font></td>";

			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr[0] >= 99?$good:($array_qdr[0] >= 98?$yellow:$bad))."'>".$array_qdr[0]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr[1] >= 99?$good:($array_qdr[1] >= 98?$yellow:$bad))."'>".$array_qdr[1]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr[2] >= 99?$good:($array_qdr[2] >= 98?$yellow:$bad))."'>".$array_qdr[2]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qdr[3] >= 99?$good:($array_qdr[3] >= 98?$yellow:$bad))."'>".$array_qdr[3]."%</font></td>";
			
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_availability[0] >= 99?$good:($array_availability[0] >= 97?$yellow:$bad))."'>".$array_availability[0]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_availability[1] >= 99?$good:($array_availability[1] >= 97?$yellow:$bad))."'>".$array_availability[1]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_availability[2] >= 99?$good:($array_availability[2] >= 97?$yellow:$bad))."'>".$array_availability[2]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_availability[3] >= 99?$good:($array_availability[3] >= 97?$yellow:$bad))."'>".$array_availability[3]."%</font></td>";

			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_lte_retention[0] >= 95?$good:($array_lte_retention[0] >= 90?$yellow:$bad))."'>".$array_lte_retention[0]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_lte_retention[1] >= 95?$good:($array_lte_retention[1] >= 90?$yellow:$bad))."'>".$array_lte_retention[1]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_lte_retention[2] >= 95?$good:($array_lte_retention[2] >= 90?$yellow:$bad))."'>".$array_lte_retention[2]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_lte_retention[3] >= 95?$good:($array_lte_retention[3] >= 90?$yellow:$bad))."'>".$array_lte_retention[3]."%</font></td>";			 
					
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qde_dl[0] >= 95?$good:($array_qde_dl[0] >= 85?$yellow:$bad))."'>".$array_qde_dl[0]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qde_dl[1] >= 95?$good:($array_qde_dl[1] >= 85?$yellow:$bad))."'>".$array_qde_dl[1]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qde_dl[2] >= 95?$good:($array_qde_dl[2] >= 85?$yellow:$bad))."'>".$array_qde_dl[2]."%</font></td>";
			 echo "<td onclick='wcweek(this)'><font style='font-family: calibri; font-size:14pt' color='".($array_qde_dl[3] >= 95?$good:($array_qde_dl[3] >= 85?$yellow:$bad))."'>".$array_qde_dl[3]."%</font></td>";
	
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_qde_ul[0] >= 95?$good:($array_qde_ul[0] >= 85?$yellow:$bad))."'>".$array_qde_ul[0]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_qde_ul[1] >= 95?$good:($array_qde_ul[1] >= 85?$yellow:$bad))."'>".$array_qde_ul[1]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_qde_ul[2] >= 95?$good:($array_qde_ul[2] >= 85?$yellow:$bad))."'>".$array_qde_ul[2]."%</font></td>";
			 echo "<td><font style='font-family: calibri; font-size:14pt' color='".($array_qde_ul[3] >= 95?$good:($array_qde_ul[3] >= 85?$yellow:$bad))."'>".$array_qde_ul[3]."%</font></td>";

					echo "<td bgcolor='".($array_nqi[0] >= 85?$good:($array_nqi[0] >= 70?$yellow1:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi[0]."%</font></td>";
					echo "<td bgcolor='".($array_nqi[1] >= 85?$good:($array_nqi[1] >= 70?$yellow1:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi[1]."%</font></td>";
					echo "<td bgcolor='".($array_nqi[2] >= 85?$good:($array_nqi[2] >= 70?$yellow1:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi[2]."%</font></td>";
					echo "<td bgcolor='".($array_nqi[3] >= 85?$good:($array_nqi[3] >= 70?$yellow1:$bad))."'><font style='font-family: calibri; font-size:14pt'>".$array_nqi[3]."%</font></td>";

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