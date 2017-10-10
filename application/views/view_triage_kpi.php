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

						echo "<th colspan='19' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>".$months[(int)$week]."</font></th>";
						
	
					}
					elseif (isset($weeknum))
					{

						echo "<th colspan='19' bgcolor='#424242'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt''>W".$week."</font></th>";
						
					}
					
				?>
				</tr>
				<tr>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">QDA CS</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">QDA HS</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">QDR CS</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">QDR HS</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">THROUGHPUT</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">AVAIABILITY</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">CS RETENTION</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">PS RETENTION</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">HSDPA USER RATIO</font></div></th>				
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">RTWP</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">NQI CS</font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">NQI HS<font></div></th>
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>KPI</a></font></div></th>
				<th bgcolor="#B23AEE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OMR</a></font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>TX/OMR</a></font></div></th>
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
					$qda_cs = $row->qda_cs;
					$qda_hs = $row->qda_hs;
					$qdr_cs = $row->qdr_cs;
					$qdr_ps = $row->qdr_ps;
					$throughput = $row->throughput;
					$availability = $row->availability;
					$retention_cs = $row->retention_cs;
					$retention_ps = $row->retention_ps;
					$hsdpa_users_ratio = $row->hsdpa_users_ratio;
					$rtwp = $row->rtwp;
					$nqi_cs = $row->nqi_cs;
					$nqi_hs = $row->nqi_hs;
				
					echo "<tr>";		
					echo "<td bgcolor='#EDEDEB' value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><b>".$row->node."</b></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$region."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$rnc."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$nodeb."</font></td>";
					

					echo "<td bgcolor='".($qda_cs >= 90?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($qda_cs >= 90?$good:$bad)."'>".$qda_cs."%</font></td>";
					echo "<td bgcolor='".($qda_hs >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($qda_hs >= 92?$good:$bad)."'>".$qda_hs."%</font></td>";
					echo "<td bgcolor='".($qdr_cs >= 90?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($qdr_cs >= 90?$good:$bad)."'>".$qdr_cs."%</font></td>";					
					echo "<td bgcolor='".($qdr_ps >= 95?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($qdr_ps >= 95?$good:$bad)."'>".$qdr_ps."%</font></td>";
					echo "<td bgcolor='".($throughput >= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($throughput >= 92?$good:$bad)."'>".$throughput."%</font></td>";
					echo "<td bgcolor='".($availability >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($availability >= 99.50?$good:$bad)."'>".$availability."%</font></td>";					
					echo "<td bgcolor='".($retention_cs >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($retention_cs >= 99.50?$good:$bad)."'>".$retention_cs."%</font></td>";
					echo "<td bgcolor='".($retention_ps >= 100?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($retention_ps >= 100?$good:$bad)."'>".$retention_ps."%</font></td>";
					echo "<td bgcolor='".($hsdpa_users_ratio >= 99.50?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($hsdpa_users_ratio >= 99.50?$good:$bad)."'>".$hsdpa_users_ratio."%</font></td>";					
					echo "<td bgcolor='".($rtwp <= -90?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($rtwp <= -90?$good:$bad)."'>".$rtwp."</font></td>";
					echo "<td bgcolor='".($nqi_cs >= 85?$good:($nqi_cs >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:12pt'>".$nqi_cs."%</font></td>";
					echo "<td bgcolor='".($nqi_hs >= 85?$good:($nqi_hs >= 70?$yellow:$bad))."'><font style='font-family: calibri; font-size:12pt'>".$nqi_hs."%</font></td>";
					echo "<td bgcolor='".($kpi == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$kpi."</font></td>";
					echo "<td bgcolor='".($omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$omr."</font></td>";
					echo "<td bgcolor='".($tx_omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$tx_omr."</font></td>";
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