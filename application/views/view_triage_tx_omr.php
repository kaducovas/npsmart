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
				<th bgcolor="#A4A4A4"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>KPI</a></font></div></th>
				<th bgcolor="#B23AEE"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'"><a style= "color:#FFFFFF" onclick='selectkpitriage(this)'>OMR</a></font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">TX TYPE<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">DELAY<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">JITTER<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">LOST<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">IUB FLOWCTRL DL DROP<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">IUB FLOWCTRL UL DROP<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">IUB FLOWCTRL DL CONG<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">IUB FLOWCTRL UL CONG<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">ATM DL UTILIZATION<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">ATM UL UTILIZATION<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">TX INTEGRITY<font></div></th>
				<th bgcolor="#66CDAA"><div class='vrt_triage'><font color="#FFFFFF" style="font-size:20pt'">NOTE<font></div></th>				
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
					$tx_type = $row->tx_type;
					$delay = $row->ping_meandelay;
					$jitter = $row->ping_meanjitter;
					$lost = $row->ping_meanlost;
					$dl_dropnum_lgcport1 = $row->vs_iub_flowctrol_dl_dropnum_lgcport1;
					$ul_dropnum_lgcport1 = $row->vs_iub_flowctrol_ul_dropnum_lgcport1;
					$dl_congtime_lgcport1 = $row->vs_iub_flowctrol_dl_congtime_lgcport1;
					$ul_congtime_lgcport1 = $row->vs_iub_flowctrol_ul_congtime_lgcport1;
					$dl_utilization = $row->atm_dl_utilization;
					$ul_utilization = $row->atm_ul_utilization;
					$tx_integrity = $row->tx_integrity;
					$note_tx_omr = $row->note_tx_omr;
				
					echo "<tr>";		
					echo "<td bgcolor='#EDEDEB' value='".$row->node."'><font style='font-family: calibri; font-size:12pt'><b>".$row->node."</b></font></td>";		
					echo "<td style='display:none;'>".$row->type."</td>";

					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$region."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$rnc."</font></td>";
					echo "<td bgcolor='#FFFFFF'><font style='font-family: calibri; font-size:12pt'>".$nodeb."</font></td>";
					

					echo "<td bgcolor='".($kpi == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$kpi."</font></td>";
					echo "<td bgcolor='".($omr == 'OK'?$good2:$bad2)."'><font style='font-family: calibri; font-size:12pt'>".$omr."</font></td>";
					
					echo "<td bgcolor='#FFFFFF'>".$tx_type."</font></td>";
					echo "<td bgcolor='".($delay <= 80?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($delay <=80?$good:$bad)."'>".$delay."</font></td>";
					echo "<td bgcolor='".($jitter <= 5?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($jitter <=5?$good:$bad)."'>".$jitter."</font></td>";
					echo "<td bgcolor='".($lost <= 5?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($lost <=5?$good:$bad)."'>".$lost."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$dl_dropnum_lgcport1."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$ul_dropnum_lgcport1."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$dl_congtime_lgcport1."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$ul_congtime_lgcport1."</font></td>";					
					echo "<td bgcolor='".($dl_utilization <= 80?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($dl_utilization <=80?$good:$bad)."'>".$dl_utilization."</font></td>";
					echo "<td bgcolor='".($ul_utilization <= 80?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($ul_utilization <=80?$good:$bad)."'>".$ul_utilization."</font></td>";
					echo "<td bgcolor='".($tx_integrity <= 92?$bggood:$bgbad)."'><font style='font-family: calibri; font-size:12pt' color='".($tx_integrity <=92?$good:$bad)."'>".$tx_integrity."</font></td>";
					echo "<td bgcolor='#FFFFFF'>".$note_tx_omr."</font></td>";


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