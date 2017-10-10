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

						echo "<th colspan='17' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week]."</font></th>";
						
	
					}
					elseif (isset($weeknum))
					{

						echo "<th colspan='17' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week."</font></th>";
						
					}
					
				?>
				</tr>
				<tr>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>KPI</a></font></div></th>
				<th bgcolor="#B23AEE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OMR</a></font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>TX/OMR</a></font></div></th>
				<th bgcolor="#2E9AFE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OTM</a></font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">EE<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">LOAD<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">CODE<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">DL POWER<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">FACH<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">RACH<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">PCH<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">CNBAP<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">DL CE<font></div></th>
				<th bgcolor="#EEDC82"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">UL CE<font></div></th>
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
					$ee = $row->ee;
					$load = $row->load;
					$code_utilization = $row->code_utilization;
					$dlpower_utilization = $row->dlpower_utilization;
					$user_fach_utilization = $row->user_fach_utilization;
					$rach_utilization = $row->rach_utilization;
					$pch_utilization = $row->pch_utilization;
					$cnbap_utilization = $row->cnbap_utilization;
					$dlce_utilization = $row->dlce_utilization;
					$ulce_utilization = $row->ulce_utilization;
				
					echo "<tr>";		
					echo "<td bgcolor='#EDEDEB' value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><b>".$row->node."</b></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$region."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$rnc."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$nodeb."</font></td>";
					

					echo "<td bgcolor='".($kpi == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$kpi."</font></td>";
					echo "<td bgcolor='".($omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$omr."</font></td>";
					echo "<td bgcolor='".($tx_omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$tx_omr."</font></td>";
					echo "<td bgcolor='".($otm == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$otm."</font></td>";

					echo "<td bgcolor='".($ee <=38?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($ee <=38?$good:$bad)."'>".$ee."%</font></td>";
					echo "<td bgcolor='".($load <=80?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($load <=80?$good:$bad)."'>".$load."%</font></td>";
					echo "<td bgcolor='".($code_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($code_utilization <=70?$good:$bad)."'>".$code_utilization."%</font></td>";
					echo "<td bgcolor='".($dlpower_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($dlpower_utilization <=70?$good:$bad)."'>".$dlpower_utilization."%</font></td>";
					echo "<td bgcolor='".($user_fach_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($user_fach_utilization <=70?$good:$bad)."'>".$user_fach_utilization."%</font></td>";
					echo "<td bgcolor='".($rach_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($rach_utilization <=70?$good:$bad)."'>".$rach_utilization."%</font></td>";
					echo "<td bgcolor='".($pch_utilization <=60?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($pch_utilization <=60?$good:$bad)."'>".$pch_utilization."%</font></td>";
					echo "<td bgcolor='".($cnbap_utilization <=60?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($cnbap_utilization <=60?$good:$bad)."'>".$cnbap_utilization."%</font></td>";
					echo "<td bgcolor='".($dlce_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($dlce_utilization <=70?$good:$bad)."'>".$dlce_utilization."%</font></td>";
					echo "<td bgcolor='".($ulce_utilization <=70?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($ulce_utilization <=70?$good:$bad)."'>".$ulce_utilization."%</font></td>";

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