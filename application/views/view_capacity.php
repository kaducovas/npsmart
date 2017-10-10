<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<?php
foreach($dash_capacity as $row){
					#echo $row->node;
					 $node[$row->node] = $row->node;
					 $dlpowerrange1[$row->node] = $row->dlpowerrange1;
					 $dlpowerrange2[$row->node] = $row->dlpowerrange2;
					 $dlpowerrange3[$row->node] = $row->dlpowerrange3;
					$coderange1[$row->node] = $row->coderange1;
					 $coderange2[$row->node] = $row->coderange2;
					 $coderange3[$row->node] = $row->coderange3;
					 $fachrange1[$row->node] = $row->fachrange1;
					 $fachrange2[$row->node] = $row->fachrange2;
					 $fachrange3[$row->node] = $row->fachrange3;					 
					$rachrange1[$row->node] = $row->rachrange1;
					 $rachrange2[$row->node] = $row->rachrange2;
					 $rachrange3[$row->node] = $row->rachrange3;
					$dlcerange1[$row->node] = $row->dlcerange1;
					 $dlcerange2[$row->node] = $row->dlcerange2;
					 $dlcerange3[$row->node] = $row->dlcerange3;
					$ulcerange1[$row->node] = $row->ulcerange1;
					 $ulcerange2[$row->node] = $row->ulcerange2;
					 $ulcerange3[$row->node] = $row->ulcerange3;	
					$cnbaprange1[$row->node] = $row->cnbaprange1;
					 $cnbaprange2[$row->node] = $row->cnbaprange2;
					 $cnbaprange3[$row->node] = $row->cnbaprange3;		
					$pchrange1[$row->node] = $row->pchrange1;
					 $pchrange2[$row->node] = $row->pchrange2;
					 $pchrange3[$row->node] = $row->pchrange3;					 
					 			
				 }
				 
  ?>
  
 <div id="container" class="main"> 

<form action="/npsmart/umts/worstcells" name="wcform" method="post">
<input type="hidden" id="rnc" name="rnc" value="" />
<input type="hidden" id="date" name="wcdate" value="" />
<input type="hidden" id="kpi" name="kpi" value="" />
<div align="left">
<a target="_blank" class="link" href="/npsmart/output/cell_utilization_weekly.csv">Download Cell Capacity</a>
<br>
<a target="_blank" class="link" href="/npsmart/output/nodeb_utilization_weekly.csv">Download NodeB Capacity</a>
</div>
<div width="50%">
<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
	<tr>
	
	<tr>
		<th rowspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
        <th colspan="15" bgcolor="#3C6D7A" align="center"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Cell Resource Utilization</font></th>
        <th colspan="9" bgcolor="#3C6D7A" align="center"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">NodeB Resource Utilization</font></th>
		</tr>
			
            <th colspan="3" bgcolor="#3C6D7A" align="center"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Non-HS Power</font></th>
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Non-HS Code</th>
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">FACH</font></th>
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RACH</font></th>
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">PCH</font></th>
			<!--<th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RTWP Free Time</font></th>
			<th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">RTWP Busy Time</font></th>-->
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">DLCE</font></th>
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">ULCE</font></th>			
            <th colspan="3" bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">CNBAP</font></th>			
        </tr>
		<tr>

            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0-50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>		
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>		
           <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 40%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 40 - 60%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 60 - 100%</font></th>
 <!--           <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">< -100dBm </font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">-100 - -90dBm</font></th> 
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">> -90dBm </font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">< -100dBm </font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">-100 - -90dBm</font></th> 
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">> -90dBm </font></th>-->
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 70%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 70 - 100%</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">0 - 50%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 50 - 60%</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"> 60 - 100%</font></th>

        </tr>
	</thead>
	
	<tbody>		

	<?php
	$bad = "#FF0000";	
	$good = "#009900";
	$yellow = "#FFA500";
	$title = "#3C6D7A";
	#$yellow = "#E9AB17";
			
#onclick='selected(this)'	
#href='/npsmart/umts/main?node=".$node[$k]."'
foreach ($node as $k => $v) {
					echo "<tr>";
					echo "<td value='".$node[$k]."'><a id='".$node[$k]."' onclick='selectne(this)' class='node' value='".$node[$k]."'>".$node[$k]."</a></td>";
					echo "<td><font color='".($dlpowerrange1[$k] <1 ?$good:$good)."'>".$dlpowerrange1[$k]."</font></td>";
					echo "<td><font color='".($dlpowerrange2[$k] <1 ?$good:$yellow)."'>".$dlpowerrange2[$k]."</font></td>";
					echo "<td><font color='".($dlpowerrange3[$k] < 1?$good:$bad)."'>".$dlpowerrange3[$k]."</font></td>";
					echo "<td><font color='".($coderange1[$k] <1 ?$good:$good)."'>".$coderange1[$k]."</font></td>";
					echo "<td><font color='".($coderange2[$k] <1 ?$good:$yellow)."'>".$coderange2[$k]."</font></td>";
					echo "<td><font color='".($coderange3[$k] < 1?$good:$bad)."'>".$coderange3[$k]."</font></td>";
					echo "<td><font color='".($fachrange1[$k] <1 ?$good:$good)."'>".$fachrange1[$k]."</font></td>";
					echo "<td><font color='".($fachrange2[$k] <1 ?$good:$yellow)."'>".$fachrange2[$k]."</font></td>";
					echo "<td><font color='".($fachrange3[$k] < 1?$good:$bad)."'>".$fachrange3[$k]."</font></td>";					
					echo "<td><font color='".($rachrange1[$k] <1 ?$good:$good)."'>".$rachrange1[$k]."</font></td>";
					echo "<td><font color='".($rachrange2[$k] <1 ?$good:$yellow)."'>".$rachrange2[$k]."</font></td>";
					echo "<td><font color='".($rachrange3[$k] < 1?$good:$bad)."'>".$rachrange3[$k]."</font></td>";
					echo "<td><font color='".($pchrange1[$k] <1 ?$good:$good)."'>".$pchrange1[$k]."</font></td>";
					echo "<td><font color='".($pchrange2[$k] <1 ?$good:$yellow)."'>".$pchrange2[$k]."</font></td>";
					echo "<td><font color='".($pchrange3[$k] < 1?$good:$bad)."'>".$pchrange3[$k]."</font></td>";					
					echo "<td><font color='".($dlcerange1[$k] <1 ?$good:$good)."'>".$dlcerange1[$k]."</font></td>";
					echo "<td><font color='".($dlcerange2[$k] <1 ?$good:$yellow)."'>".$dlcerange2[$k]."</font></td>";
					echo "<td><font color='".($dlcerange3[$k] < 1?$good:$bad)."'>".$dlcerange3[$k]."</font></td>";
					echo "<td><font color='".($ulcerange1[$k] <1 ?$good:$good)."'>".$ulcerange1[$k]."</font></td>";
					echo "<td><font color='".($ulcerange2[$k] <1 ?$good:$yellow)."'>".$ulcerange2[$k]."</font></td>";
					echo "<td><font color='".($ulcerange3[$k] < 1?$good:$bad)."'>".$ulcerange3[$k]."</font></td>";
					echo "<td><font color='".($cnbaprange1[$k] <1 ?$good:$good)."'>".$cnbaprange1[$k]."</font></td>";
					echo "<td><font color='".($cnbaprange2[$k] <1 ?$good:$yellow)."'>".$cnbaprange2[$k]."</font></td>";
					echo "<td><font color='".($cnbaprange3[$k] < 1?$good:$bad)."'>".$cnbaprange3[$k]."</font></td>";
					echo "</tr>";
				}			

	?>

	</tbody>
</table>
	
</div>

<br><br>
<div id="content" class="chart_content"><div id="dlpower" class="chart1"></div></div>
<div id="content" class="chart_content"><div id="code" class="chart"></div></div>
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="fach" class="chart"></div></div>			
<div id="content" class="chart_content"><div id="rach" class="chart"></div></div>
<div style="clear: both;"></div>
<div id="content" class="chart_content"><div id="dlce" class="chart"></div></div>
<div id="content" class="chart_content"><div id="ulce" class="chart"></div></div>	
<div style="clear: both;"></div>
<div id="content" class="chart_content"><div id="pch" class="chart"></div></div>
<div id="content" class="chart_content"><div id="cnbap" class="chart"></div></div>	
<div style="clear: both;"></div>				
<!--<div id="content" class="chart_content"><div id="handover" class="chart"></div></div>
<div id="content" class="chart_content"><div id="sho_overhead" class="chart"></div></div>
<div style="clear: both;"></div>			
<div id="content" class="chart_content"><div id="availability" class="chart"></div></div>			
<div id="content" class="chart_content"><div id="rtwp" class="chart"></div></div>
<div style="clear: both;"></div>		-->	
	
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
</body>
</html>