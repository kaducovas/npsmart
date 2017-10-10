<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--<script src="https://code.highcharts.com/modules/multicolor_series.js"></script>-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">

 <link rel="stylesheet" type="text/css" href="/npsmart/DataTables-1.10.9/media/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="/npsmart/DataTables-1.10.9/media/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">-->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="/npsmart/css/buttons.datatables.min.css">
<!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" />-->
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/scroller/1.4.1/js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.4.1/css/scroller.dataTables.min.css" />



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
 .navbar-custom {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;	 
  background-color: #000000;
  border-color: #454545;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#454545), to(#000000));
  background-image: -webkit-linear-gradient(top, #454545, 0%, #000000, 100%);
  background-image: -moz-linear-gradient(top, #454545 0%, #000000 100%);
  background-image: linear-gradient(to bottom, #454545 0%, #000000 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0E1112', endColorstr='#2D3437', GradientType=0);
}
.navbar-custom .navbar-brand {
  color: #ffffff;
}
.navbar-custom .navbar-brand:hover,
.navbar-custom .navbar-brand:focus {
  color: #637881;
  background-color: transparent;
}
.navbar-custom .navbar-text {
  color: #ffffff;
}
.navbar-custom .navbar-nav > li:last-child > a {
  border-right: 1px solid #0E1112;
}
.navbar-custom .navbar-nav > li > a {
  color: #ffffff;
  border-left: 1px solid #0E1112;
}
.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus {
  color: #000000;
  background-color: #94AFBC;
}
.navbar-custom .navbar-nav > .active > a,
.navbar-custom .navbar-nav > .active > a:hover,
.navbar-custom .navbar-nav > .active > a:focus {
  color: #637881;
  background-color: #0E1112;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#0E1112), to(#2D3437));
  background-image: -webkit-linear-gradient(top, #0E1112, 0%, #2D3437, 100%);
  background-image: -moz-linear-gradient(top, #0E1112 0%, #2D3437 100%);
  background-image: linear-gradient(to bottom, #0E1112 0%, #2D3437 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2D3437', endColorstr='#0E1112', GradientType=0);
}
.navbar-custom .navbar-nav > .disabled > a,
.navbar-custom .navbar-nav > .disabled > a:hover,
.navbar-custom .navbar-nav > .disabled > a:focus {
  color: #637881;
  background-color: transparent;
}
.navbar-custom .navbar-toggle {
  border-color: #637881;
}
.navbar-custom .navbar-toggle:hover,
.navbar-custom .navbar-toggle:focus {
  background-color: #637881;
}
.navbar-custom .navbar-toggle .icon-bar {
  background-color: #637881;
}
.navbar-custom .navbar-collapse,
.navbar-custom .navbar-form {
  border-color: #0E1112;
}
.navbar-custom .navbar-nav > .dropdown > a:hover .caret,
.navbar-custom .navbar-nav > .dropdown > a:focus .caret {
  border-top-color: #637881;
  border-bottom-color: #637881;
}
.navbar-custom .navbar-nav > .open > a,
.navbar-custom .navbar-nav > .open > a:hover,
.navbar-custom .navbar-nav > .open > a:focus {
  background-color: #0E1112;
  color: #637881;
}
.navbar-custom .navbar-nav > .open > a .caret,
.navbar-custom .navbar-nav > .open > a:hover .caret,
.navbar-custom .navbar-nav > .open > a:focus .caret {
  border-top-color: #637881;
  border-bottom-color: #637881;
}
.navbar-custom .navbar-nav > .dropdown > a .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}

.navbar-custom .navbar-nav .open .dropdown-menu > li > a {
    color: #000000;

  }
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #ffffff;

    background-color: #637881;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #637881;
    background-color: #0E1112;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:focus {
    color: #6A7D86;
    background-color: transparent;
  }

.navbar-custom .navbar-link {
  color: #ffffff;
}
.navbar-custom .navbar-link:hover {
  color: #C1CCD2;
}
</style>
 <style type="text/css">

 body {
    /* background-color: #E0E0E3; */ 
	 background-color: #F8F8F8 ;
	 padding-top: 70px; }
	 
 .whitebody {
    /* background-color: #E0E0E3; */ 
	 background-color: #FFFFFF ;
	 padding-top: 0px; }
	 
	 
@media screen and (max-width: 768px) {
    body { padding-top: 0px; }
}	 


.borda
{
    box-shadow: 7px 5px 3px grey;
	border: 1px solid #637881;
	Border-radius: 0px;
	margin-left: 0.25%;
    margin-right: 0.25%;
	margin-top:0.25%;
	margin-bottom:0.25%;
	height: 400px;
    width: 49%;
    background-color: #ffffff;
    text-align: center;
    padding: 0.2%;
	position: relative;
	float:left;
}
 
.main {
	/*background-color: #E0E0E3;*/
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

.border{
	box-shadow: 7px 5px 3px grey;
	border: 1px solid #637881;
	Border-radius: 0px;
	
}

.chart_content {
	
    box-shadow: 7px 5px 3px grey;
	margin-left: 0.5%;
    margin-right: 0.5%;
	margin-top:0.25%;
	margin-bottom:0.25%;
	border: 1px solid #637881;
	Border-radius: 0px;
   width: 49%;
   height: 400px;
   float: left;
   position:relative;
}

.chart_content_large {
	
    box-shadow: 7px 5px 3px grey;
	margin-left: 1%;
    margin-right: 1%;
	margin-top:0.25%;
	margin-bottom:0.25%;
	border: 1px solid #637881;
	Border-radius: 0px;
   width: 98%;
   height: 400px;
   position:relative;
}



.wc_chart_content {
	
   /* box-shadow: 7px 5px 3px grey;*/
	margin-left: 0.5%;
    margin-right: 0.5%;
	margin-top:0.25%;
	margin-bottom:0.25%;
	/*border: 1px solid #637881;*/
	/*Border-radius: 0px;*/
   width: 49%;
   /* height: 440px; */
   float: left;
   position:relative;
}

.wc {
	background-color: #ffffff;
   width: 49%;
   height: 65%;
   margin-left: 0.5%;
   margin-right: 0.5%;
   margin-top:0.25%;
   margin-bottom:0.25%;
   float: left;
   position:relative;
}

.dashboard {
    background-color: #E0E0E3;    
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

.dataTables_filter {  
	margin-top: 12px; 
	margin-left: 40px; 
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0px;
}

.dataTables_wrapper .dataTables_paginate{
    padding: 0px;
	margin: 0 0 0 0 ; 
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
	document.getElementById('date').value = wcdate;
	document.getElementById('kpi').value = kpi;
	document.getElementById('rnc').value = rnc;
	document.getElementById('cellname').value = obj.innerHTML
	document.wcform.submit();
    //alert(obj.innerHTML);
}

///send ne to main
function selectne(obj) {
	//alert(obj);
	document.getElementById('reportdate').value = reportdate;
	//document.getElementById('kpi').value = kpi;
	//document.getElementById('rnc').value = rnc;
	document.getElementById('reportnename').value = obj.innerHTML
	document.reportopt.submit();
    //alert(obj.innerHTML);
}

function selectnenav(obj,type) {
	//alert(type);
	document.getElementById('reportdate').value = reportdate;
	//document.getElementById('kpi').value = kpi;
	//document.getElementById('rnc').value = rnc;
	document.getElementById('reportnename').value = obj
	if(type == 'cidades' && reportagg == 'daily'){
		alert("NPSmart current release does not support City Level Daily Report.")
	} else {
		document.reportopt.submit();
	}	
}

$(function() {	
	$('#daterange').datepicker({
    calendarWeeks: true,
	dateFormat: "yy-mm-dd",//,	
	//showAnim:'slideDown',
	//calculateWeek: myWeekCalc,
		
})

.on('changeDate', function(date) {
		//myWeekCalc()
		var day = $('#daterange').datepicker('getDate').getDate();
		var year = $('#daterange').datepicker('getDate').getFullYear();
		var month = $('#daterange').datepicker('getDate').getMonth()+1;
		var date = year+'-'+month+'-'+day;
		//document.getElementById('reportnetype').value = date;
		document.getElementById('reportnename').value = reportnename;
		document.getElementById('reportdate').value = date;
		//document.getElementById('reportkpi').value = obj.innerHTML
		document.reportopt.submit();
	 })
});

function selecttimeagg(obj) {
	if(obj.innerHTML == 'Weekly Report'){
		document.reportopt.action = '/npsmart/umts/main'
	} else if(obj.innerHTML == 'Daily Report') {
		document.reportopt.action = '/npsmart/umts/daily'
	} else if(obj.innerHTML == 'Commercial Hour Report') {
		document.reportopt.action = '/npsmart/umts/ch'
	}
	document.getElementById('reportdate').value = reportdate;
	//document.getElementById('kpi').value = kpi;
	//document.getElementById('rnc').value = rnc;
	document.getElementById('reportnename').value = reportnename;
	//if(reportnetype == 'city'){
	//	alert("NPSmart current release does not support City Level Daily Report.")
	//} else {
		document.reportopt.submit();
	//}
}
// if (node.substring(0, 3) == 'RNC') {
									// document.getElementById('rnc').value = node;
									// document.getElementById('date').value = date[event.point.x];
									// document.getElementById('kpi').value = this.name;
									// document.wcform.submit();
								// } else {
									// alert("NPSmart current release does not support Region Level Worst Cells.")
								// }
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