<?php
ini_set('memory_limit', '2048M');
#echo count($cells);
		foreach($cells as $row){
			$cellinfo[$row->cellname] = $row->cellid;
			$rnc[] = $row->rnc;
			$cellid[] =  $row->cellid;
			$cellname[] = $row->cellname;
			$site[] = $row->site;
			$regional[] = $row->regional;
			$uf[] = $row->uf;	
			$cluster[] = $row->cluster;
			$cidade[] = $row->cidade;
			
		}
		#echo $cellinfo['UMSCPE01A'];
		#echo count($cellinfo);
		$rncunique = $array = array_values(array_filter(array_unique($rnc)));;
		$clusterunique = $array = array_values(array_filter(array_unique($cluster)));;
		$cidadeunique = $array = array_values(array_filter(array_unique($cidade)));;
		#echo join($cellinfo, ',');
		#echo "<br><br>";
		#echo json_encode($cellinfo);
		#$rnc_query = $_POST['cellid'];
		#echo $rnc_query;
		#$cellid_query = $_POST['cellid'];
		#echo $cellid_query;
		#echo $echo;
		?>

<script type="text/javascript">
$( '#acc_rrc' ).click( function() {
    $( '#acc_rrc' ).width( $( window ).width() );
    $( '#acc_rrc' ).height( $( window ).height() );
});


var cellinfo = <?php echo json_encode($cellinfo, JSON_PRETTY_PRINT) ?>;

//alert(Object.keys(cellinfo).length);
</script>				

<script type="text/javascript">

$(function() {
	var rnc = <?php echo json_encode($rncunique); ?>;
	var cluster = <?php echo json_encode($clusterunique); ?>;
	var cidade = <?php echo json_encode($cidadeunique); ?>;
	var cellname = <?php echo json_encode($cellname); ?>;
	var kpis = [
      "Availability",
	  "Accessibility",
      "Retainability",
      "Coverage",
      "Mobility",
      "Service Integrity",
      "Traffic"
    ];
    $( "#rnc" ).autocomplete({
      source: rnc
    });
	$( "#cellname" ).autocomplete({
      source: cellname
    });
    $( "#clustername" ).autocomplete({
      source: cluster
    });
    $( "#cidadename" ).autocomplete({
      source: cidade
    });	
    $( "#kpi" ).autocomplete({
      source: kpis
    });			
  }); 
  </script>

<body>

<div id="container" class="main">
	
<!--	<img src="/npsmart/images/HUAWEI-LOGO.jpg" width="130" height="60" />-->
	
	

	<form method="post" name="neform" accept-charset="utf-8" action="/npsmart/performance/monitor">
	<font size="4" color="#303030"><b>RNC: </b></font>
	<input id="rnc" type="text" name="rnc"/>
	<font size="4" color="#303030"><b>Site: </b></font> 
	<input id="sitename" type="text" name="site" />
	<font size="4" color="#303030"><b>Cell: </b></font> 
	<input id="cellname" type="text" name="cellid" />
	<font size="4" color="#303030"><b>Cluster: </b></font> 
	<input id="clustername" type="text" name="cluster" />
	<font size="4" color="#303030"><b>Cidade: </b></font> 
	<input id="cidadename" type="text" name="cidade" />
	<input type="button" name="mysubmit" value="Submit" onclick="document.getElementById('cellname').value = cellinfo[document.getElementById('cellname').value]; document.neform.submit();">
	<br><br>
	<font size="4" color="#303030"><b>KPI: </b></font> 
		<input id="kpi" type="text" name="kpi" />	
		<input type="text" name="daterange" value=""<?php #date_default_timezone_set("Brazil/East");date_default_timezone_set("Brazil/East");echo date('Y/m/d', time() - 60 * 60 * 48);;?>/>
		<script type="text/javascript">
		$(function() {
			$('input[name="daterange"]').daterangepicker({

		});
	});
	</script>	
	<span class="ne" style="color:#303030" text-align="left">
	<?php	
	if(isset($ne)){
		echo '<h3<<b>'.$level.'</b>: '.$ne."</h3>";
		}
	?>
	</span>

	<br><br><br>
	</form>

	<div id="dl_volume" class="chart1"></div>
	<div id="ul_volume" class="chart1"></div>
	<div id="hsdpa_users" class="chart1"></div>
	<div id="hsupa_users" class="chart1"></div>
	
		
		<div id="container" style="width:100%; height:400px;"></div>
		<div id="container2" style="width:100%; height:400px;"></div>
	
<!--		<div id="drop_cs" class="chart"></div>
		<div id="drop_ps" class="chart"></div>
		<div id="retention_cs" class="chart"></div>
		<div id="retention_ps" class="chart"></div>
		<div id="unavailability" class="chart"></div>-->


	</div>

</div>		

</body>
</html>