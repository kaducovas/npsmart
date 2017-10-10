<script type="text/javascript">
//var reportnename = <?php echo $reportnename;?>
//var node = 'CO';
var reportnename = "<?php echo $reportnename; ?>";
var reportdate = "<?php echo $reportdate; ?>";
</script>
<div class="triage_menu">
&emsp;<font color="#A4A4A4" size="4"><b><a style = "color:#A4A4A4" onclick='selectkpitriage(this)'>Overview</a></b></font>
</div>
<div align="right">
<font color="#A4A4A4" size="4"><b><a style = "color:#A4A4A4" onclick='selectkpitriage(this)'>Cell Mapping</a></b></font>&emsp;
</div>
<br>
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

	<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="95%">

		<thead>
			<tr>
				<th rowspan="2" bgcolor="#424242"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>
				<th style='display:none;'rowspan="2" bgcolor="#3b5998"><font color="#FFFFFF" style="font-size:20pt'">Node</font></th>			
				<th rowspan="2" bgcolor="#424242"><font color="#FFFFFF" style="font-size:20pt'">Region</font></th>
				<th rowspan="2" bgcolor="#424242"><font color="#FFFFFF" style="font-size:20pt'">RNC</font></th>
				<th rowspan="2" bgcolor="#424242"><font color="#FFFFFF" style="font-size:20pt'">NodeB</font></th>			
				<?php 
					foreach($triage_week as $row){
						$week = $row->week;
					}	
				

					if (isset($monthnum))
					{
						$months = array (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
						#$months[(int)$monthnum]; 

						echo "<th colspan='14' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week]."</font></th>";
						
	
					}
					elseif (isset($weeknum))
					{

						echo "<th colspan='14' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week."</font></th>";
						
					}
					
				?>
				</tr>
				<tr>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>KPI</a></font></div></th>
				<th bgcolor="#B23AEE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OMR</a></font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>TX/OMR</a></font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">RTWP CHECK<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">UNBALANCE<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">OVERSHOOTER<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">COVERED SITES<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">COVERED SITES NAME<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">PARAMETER CHECK<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">MOS OUT OF BASELINE<font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OTM</a></font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>CAPACITY</a></font></div></th>
				<th bgcolor="#FE642E"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>PLAN/ENG RF</a></font></div></th>
				<th bgcolor="#000000"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">AREA/STATUS</font></div></th>

			</tr>		
		</thead>
	
		<tbody>	

			<?php
			$bad2 = "#FF7272";
			$good2 = "#B1D38D";
			$bad = "#FF0000";
			$good = "#92D050";
			$orange = "#FAA20A";
			$yellow = "#FFFF00";
			$yellow2 = "#FCFA87";
			$title = "#436260";	
			$bgbad = "#FDE9D9";	
			$bggood = "#FFFFFF";
				

				foreach($triage_week as $row)
				{
					$region = $row->region;
					$rnc = $row->rnc;
					$nodeb = $row->nodeb;
					$kpi = $row->kpi;
					$omr = $row->omr;
					$tx_omr = $row->tx_omr;
					$otm = $row->otm;
					$cap = $row->capacity;
					$rf = $row->plan_eng_rf;
					$area = $row->area;
					$rtwp_check = $row->rtwp_check;
					$ee_balanced = $row->ee_balanced;
					$no_overshooter = $row->no_overshooter;
					$covered_sites_count = $row->covered_sites_count;
					$covered_sites = $row->covered_sites;
					$parameter_check = $row->parameter_check;
					$mo_out = $row->mo_out;
				
					echo "<tr>";		
					echo "<td bgcolor='#EDEDEB' value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><b>".$row->node."</b></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$region."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$rnc."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$nodeb."</font></td>";
					

					echo "<td bgcolor='".($kpi == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$kpi."</font></td>";
					echo "<td bgcolor='".($omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$omr."</font></td>";
					echo "<td bgcolor='".($tx_omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$tx_omr."</font></td>";
					echo "<td bgcolor='".($rtwp_check == 'OK'?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($rtwp_check == 'OK'?$good:$bad)."'>".$rtwp_check."</font></td>";
					echo "<td bgcolor='".($ee_balanced == 'OK'?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($ee_balanced == 'OK'?$good:$bad)."'>".$ee_balanced."</font></td>";
					echo "<td bgcolor='".($no_overshooter == 'OK'?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($no_overshooter == 'OK'?$good:$bad)."'>".$no_overshooter."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$covered_sites_count."</font></td>";	
					echo "<td bgcolor='#FFFFFF'>".$covered_sites."</font></td>";	
					echo "<td bgcolor='".($parameter_check == 'OK'?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($parameter_check == 'OK'?$good:$bad)."'>".$parameter_check."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$mo_out."</font></td>";					
					echo "<td bgcolor='".($otm == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$otm."</font></td>";
					echo "<td bgcolor='".($cap == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$cap."</font></td>";
					echo "<td bgcolor='".($rf == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$rf."</font></td>";
					echo "<td bgcolor='".($area == 'ANALYSIS'?"#A4A4A4":($area == 'OMR'?"#B23AEE":($area == 'TX/OMR'?"#66CDAA":($area == "OTM"?"#2E9AFE":($area == 'CAP'?"#EEDC82":($area == 'PLAN/ENG RF'?"#FE642E":($area == 'NORMAL'?$good:$good)))))))."'><font style='font-family: calibri; font-size:12pt'><b>".$area."</b></font></td>";

					echo "</tr>";						
					
				}
				
			?>
	
		</tbody>
	</table>
</div>
<br>
</body>
</html>