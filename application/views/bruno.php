<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
<script src="http://code.highcharts.com/highcharts.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">

 <link rel="stylesheet" type="text/css" href="/npsmart/DataTables-1.10.9/media/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="/npsmart/DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


	<style>
  .ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 200px;
  }
  </style>
 <style type="text/css">

 body {
    /* background-color: #E0E0E3; */ 
	 /*background-color: #F0F0F0 ;*/  
}

.borda
{
    box-shadow: 7px 5px 3px grey;
	border: 1px solid #CCCCCC;
	Border-radius: 0px;
	margin-left: 0.25%;
    margin-right: 0.25%;
	margin-top:0.25%;
	margin-bottom:0.25%;
	height: 400px;
    width: 48%;
    background-color: #ffffff;
    text-align: left;
    padding: 0.2%;
	position: relative;
	float:left;
}
 
.main {
    width: 100%;
	clear:both;
	text-align:center;
}

.ne{
	float:left;
	margin-left:5%;
}

.chart {
    
    max-width: 100%;
    height: 400px;
	clear:both;
    
}

.chart_content {
    
   width: 50%;
   height: 400px;
   float: left;
   position:relative;

}

.wc {
   width: 50%;
   height: 400px;
   float: left;
   position:relative;
}

.dashboard {
    
    max-width: 100%;
    
}

.chart1 {
    
    max-width: 100%;
    height: 400px;
	clear:both;
    
}

.modal {
    width: 1400px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
	right: 0;
	text-align: center;

    background: rgba(0, 0, 0, 0.7);
}
.modal .chart {
    min-width: 300px;
    max-width: 90%;
	height: 90%;
	
}
.modal .chart1 {
    min-width: 300px;
    max-width: 98%;
	height: 100%;	
}

#result {
	text-align: right;
	color: gray;
	min-height: 2em;
}
#table-sparkline {
	margin: 0 auto;
    border-collapse: collapse;
}

table.dataTable thead th, table.dataTable thead td {
    text-align: center;
}

th {
    font-weight: bold;
    text-align: center;
}

td {
    text-align: center;
}

td, th {
    padding: 5px;
  /*  border-bottom: 1px solid silver; */ 
    height: 20px;
}

thead th {
    border-top: 2px solid gray;
  /*  border-bottom: 2px solid gray; */ 
	text-align: center;
	
}
.highcharts-tooltip>span {
	background: white;
	border: 1px solid silver;
	border-radius: 3px;
	box-shadow: 1px 1px 2px #888;
	padding: 8px;
}

</style>
<script type="text/javascript">
// $(function() {
// $('.node').on('click', function() {
   // //e.preventDefault();
   // //document.getElementById('node').value = cellinfo[document.getElementById('cellname').value];
   // //$(this).parents('form').submit();
   // //alert($(this).val());
   // //alert("oi");
// });
// });
//$(document).ready(function () {
var mouseStick = "false";
var selectedSquare;
function selected(obj) {
    alert(obj.innerHTML);
}
//});



// $(document).ready(function () {
//   ajax_articles();
//   ajax_images();
//   ajax_gallery();
// });
//  
// function ajax_articles() {
//   $('.node').click(function () {
//     $.ajax({
//       url: base_url+"/npsmart/performance/ajax_mainkpis_rncdaily",
//       async: false,
//       type: "POST",
//       data: "type=article",
//       dataType: "html",
//       success: function(data) {
//         $('#ajax-content-container').html(data);
//       }
//     })
//   });
//    
// }
 

</script>
</head>

<script type="text/javascript" >


$(document).ready( function () {
  $('#table_id').DataTable( {
    "bPaginate": false
  } );
} );

</script>
	
 </head>
<body>

       <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle collapsed" id="toggleButton" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="" style="padding:0px;"/></a>
               
                <a class="navbar-brand" id="aTitleVersion" href="#" style="width:170px;"><span id="aTitle">NPSmart</span>&nbsp; <span id="sVersion" style="font-size:12px; font-family:Calibri;">
                     v1.0</span></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav" id="mainMenu">
                     <li id="menuItemnqi" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Performance<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="disabled"><a href="#">Main KPIs</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/">Daily Report</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/worstcells">Worst Cells</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/monitor">Monitor</a></li>
                            <li class="divider"></li>
                            <li class="disabled"><a href="#">NQI CS</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Daily Report</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Worst Cells</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Monitor</a></li>
                           <li class="divider"></li>
                            <li class="disabled"><a href="#">NQI PS</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Daily Report</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Worst Cells</a></li>
                            <li id="menuItemnqi"><a href="/npsmart/performance/nqi">Monitor</a></li>
							<li class="divider"></li>
                        </ul>
                    </li>

                    <li id="menuItemradar"><a href="/">Capacity</a></li>
  
                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RNP<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="">Cells Database</a></li>
                              <li id="menuItemwaf"><a href="">Parameter List</a></li>
                              <li id="menuItemwaf"><a href="">RNC Configuration</a></li>
                              <li id="menuItemwaf"><a href="">NodeB Configuration</a></li>  
							<li id="menuItemlayermanagement"><a href="">Inventory</a></li>							  
							<li id="menuItemchangelog"><a href="">GIS</a></li>	
                        </ul>
                    </li>	
  

                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Baseline<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="">Consistency Check</a></li>
                              <li id="menuItemwaf"><a href="">Baseline Audit</a></li>
                        </ul>
                    </li>


                   <li id="menuItemcapacityanalysis"><a href="/CapacityAnalysis/Index">Action Plan</a></li>
				   
	
                <li id="menuItemwaf" class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                            <li id="menuItemwaf"><a href="">Counters</a></li>
                            <li id="menuItemwaf"><a href="">KPIs Target</a></li>
                        </ul>
				</li>
                 
                
                      <li id="menuItemchangelog"><a href="/ChangeLog/ChangeLog">Log</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
	
	 <li class="dropdown" id="dateMenu1">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Technology<span class="glyphicon glyphicon-phone pull-left" style="margin-top:2px;margin-right:4px;"></span><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="">GSM</a></li>
                              <li id="menuItemwaf"><a href="">UMTS</a></li>
                              <li id="menuItemwaf"><a href="">LTE</a></li>
         </ul>
     </li>

 
   <li class="dropdown" id="dateMenu1">
        <a href="#" id="trycalendar" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spDate">Week 42</span> <span class="glyphicon glyphicon-calendar pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions1" class="caret"></span></a>
        <div class="week-picker" id="calendarDiv" style="position:absolute;z-index:10"></div>
		<ul class="dropdown-menu" role="menu">
        <li id="menuItemwaf">Week: <input type="text" id="weekdate"/></li>
		</ul>
    </li>

                    <li class="dropdown" id="optionsMenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spOptions">NE</span> <span class="glyphicon glyphicon-th-list pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions" class="caret"></span></a>
                        <div class="dropdown-menu" style="padding:12px;margin-bottom:0px;padding-bottom:0px;">
                            <form class="form" id="formOptions">
                                     
     
      <div class="form-group">
        <label class="control-label" for="inputSmall">Network Node</label>
		<select id="selectne" class="form-control" style="max-width:200px;">
			<option value="book">Network</option>
			<option value="article">node</option>
			<option value="three">City</option>
			<option value="four">Cluster</option>
			<option value="four">RNC</option>
		</select>
        <select class="form-control input-sm" Id="networkNodeSelector" style="max-width:200px;"></select>
      </div>

     <a href="#" id="btnSubmit" class="btn btn-default btn-sm">Update</a>
     <div class="form-group">
      </div>

                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div width="100%">

<table id="table_id" class="cell-border compact hover" border="1 solid black" cellspacing="0" width="100%">

    <thead>
        <tr>

			<th rowspan="2" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Node</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">QDA</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">QDR</th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">3G-Retention</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Weighted Availability</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">User Throughput</font></th>
            <th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">HSDPA Users Ratio</font></th>
			<th colspan="4" bgcolor="#C0504D"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">NQI</font></th>
        </tr>
		<tr>
  <?php 
 
 for ($i = 1; $i <= 7; $i++) {
 echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W40</font></th>";
 echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W41</font></th>";
 echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W42</font></th>";
 echo "<th bgcolor='#C0504D'><font color='#FFFFFF' style='font-family: calibri; font-size:12pt'>W43</font></th>";
 }
 ?>

 
        </tr>
	</thead>
	
	<tbody>		

	<?php
	$bad = "#FF0000";	
	$good = "#009900";
	$yellow = "#FFFF00";
	$title = "#C0504D";
	#$yellow = "#E9AB17";
// foreach($nqi_weekly_region as $row){		
	// $qda_ps_f2h = $row->qda_ps_f2h;
	// $array_qda_ps_f2h = explode(",", $qda_ps_f2h);	

	// $qdr_ps = $row->qdr_ps;
	// $array_qdr_ps = explode(",", $qdr_ps);	

	// $retention_ps = $row->retention_ps;
	// $array_retention_ps = explode(",", $retention_ps);	

	// $availability = $row->availability;
	// $array_availability = explode(",", $availability);	

	// $throughput = $row->throughput;
	// $array_throughput = explode(",", $throughput);

	// $hsdpa_users_ratio = $row->hsdpa_users_ratio;
	// $array_hsdpa_users_ratio = explode(",", $hsdpa_users_ratio);	

	// $nqi_ps_f2h = $row->nqi_ps_f2h;
	// $array_nqi_ps_f2h = explode(",", $nqi_ps_f2h); 
	
	 for ($i = 1; $i <= 7; $i++) {
$array_qda_ps_f2h[0] = 	40;
$array_qda_ps_f2h[1] = 	40;
$array_qda_ps_f2h[2] = 	40;
$array_qda_ps_f2h[3] = 	40;
$array_qdr_ps[0] = 40;
$array_qdr_ps[1] = 40;
$array_qdr_ps[2] = 40;
$array_qdr_ps[3] = 40;
$array_retention_ps[0] = 40;
$array_retention_ps[1] = 40;
$array_retention_ps[2] = 40;
$array_retention_ps[3] = 40;
$array_availability[0] = 40;
$array_availability[1] = 40;
$array_availability[2] = 40;
$array_availability[3] = 40;
$array_throughput[0] = 40;
$array_throughput[1] = 40;
$array_throughput[2] = 40;
$array_throughput[3] = 40;
$array_hsdpa_users_ratio[0] = 40; 
$array_hsdpa_users_ratio[1] = 40;
$array_hsdpa_users_ratio[2] = 40;
$array_hsdpa_users_ratio[3] = 40;
$array_nqi_ps_f2h[0] = 40;
$array_nqi_ps_f2h[1] = 40;
$array_nqi_ps_f2h[2] = 40;
$array_nqi_ps_f2h[3] = 40;


			 echo "<tr>";		
			 echo "<td>NODE</td>";		
			 echo "<td><font color='".($array_qda_ps_f2h[0] >= 65?$good:$bad)."'>".$array_qda_ps_f2h[0]."%</font></td>";
			 echo "<td><font color='".($array_qda_ps_f2h[1] >= 65?$good:$bad)."'>".$array_qda_ps_f2h[1]."%</font></td>";
			 echo "<td><font color='".($array_qda_ps_f2h[2] >= 65?$good:$bad)."'>".$array_qda_ps_f2h[2]."%</font></td>";
			 echo "<td><font color='".($array_qda_ps_f2h[3] >= 65?$good:$bad)."'>".$array_qda_ps_f2h[3]."%</font></td>";

			 echo "<td><font color='".($array_qdr_ps[0] >= 65?$good:$bad)."'>".$array_qdr_ps[0]."%</font></td>";
			 echo "<td><font color='".($array_qdr_ps[1] >= 65?$good:$bad)."'>".$array_qdr_ps[1]."%</font></td>";
			 echo "<td><font color='".($array_qdr_ps[2] >= 65?$good:$bad)."'>".$array_qdr_ps[2]."%</font></td>";
			 echo "<td><font color='".($array_qdr_ps[3] >= 65?$good:$bad)."'>".$array_qdr_ps[3]."%</font></td>";

			
			 echo "<td><font color='".($array_retention_ps[0] >= 99?$good:$bad)."'>".$array_retention_ps[0]."%</font></td>";
			 echo "<td><font color='".($array_retention_ps[1] >= 99?$good:$bad)."'>".$array_retention_ps[1]."%</font></td>";
			 echo "<td><font color='".($array_retention_ps[2] >= 99?$good:$bad)."'>".$array_retention_ps[2]."%</font></td>";
			 echo "<td><font color='".($array_retention_ps[3] >= 99?$good:$bad)."'>".$array_retention_ps[3]."%</font></td>";
			
			 echo "<td><font color='".($array_availability[0] >= 99.20?$good:$bad)."'>".$array_availability[0]."%</font></td>";
			 echo "<td><font color='".($array_availability[1] >= 99.20?$good:$bad)."'>".$array_availability[1]."%</font></td>";
			 echo "<td><font color='".($array_availability[2] >= 99.20?$good:$bad)."'>".$array_availability[2]."%</font></td>";
			 echo "<td><font color='".($array_availability[3] >= 99.20?$good:$bad)."'>".$array_availability[3]."%</font></td>";
					
			 echo "<td><font color='".($array_throughput[0] >= 75?$good:$bad)."'>".$array_throughput[0]."%</font></td>";
			 echo "<td><font color='".($array_throughput[1] >= 75?$good:$bad)."'>".$array_throughput[1]."%</font></td>";
			 echo "<td><font color='".($array_throughput[2] >= 75?$good:$bad)."'>".$array_throughput[2]."%</font></td>";
			 echo "<td><font color='".($array_throughput[3] >= 75?$good:$bad)."'>".$array_throughput[3]."%</font></td>";
	
			 echo "<td><font color='".($array_hsdpa_users_ratio[0] >= 98?$good:$bad)."'>".$array_hsdpa_users_ratio[0]."%</font></td>";
			 echo "<td><font color='".($array_hsdpa_users_ratio[1] >= 98?$good:$bad)."'>".$array_hsdpa_users_ratio[1]."%</font></td>";
			 echo "<td><font color='".($array_hsdpa_users_ratio[2] >= 98?$good:$bad)."'>".$array_hsdpa_users_ratio[2]."%</font></td>";
			 echo "<td><font color='".($array_hsdpa_users_ratio[3] >= 98?$good:$bad)."'>".$array_hsdpa_users_ratio[3]."%</font></td>";

			 echo "<td bgcolor='".($array_nqi_ps_f2h[0] >= 55?$good:($array_nqi_ps_f2h[0] >= 35?$yellow:$bad))."'>".$array_nqi_ps_f2h[0]."%</td>";
			 echo "<td bgcolor='".($array_nqi_ps_f2h[1] >= 55?$good:($array_nqi_ps_f2h[1] >= 35?$yellow:$bad))."'>".$array_nqi_ps_f2h[1]."%</td>";
			 echo "<td bgcolor='".($array_nqi_ps_f2h[2] >= 55?$good:($array_nqi_ps_f2h[2] >= 35?$yellow:$bad))."'>".$array_nqi_ps_f2h[2]."%</td>";
			 echo "<td bgcolor='".($array_nqi_ps_f2h[3] >= 55?$good:($array_nqi_ps_f2h[3] >= 35?$yellow:$bad))."'>".$array_nqi_ps_f2h[3]."%</td>";

			 echo "</tr>";			
			}
	?>
	
	</tbody>
</table>

</div>

</body>
</html>