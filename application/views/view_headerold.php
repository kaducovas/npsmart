<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="/js/themes/gray.js"></script>
  
<!-- Include Required Prerequisites -->

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  
  
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/start/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
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
	background-color: #F0F0F0 ; 
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
th {
    font-weight: bold;
    text-align: center;
}

td {
    text-align: center;
}

td, th {
    padding: 5px;
    border-bottom: 1px solid silver;
    height: 20px;
}

thead th {
    border-top: 2px solid gray;
    border-bottom: 2px solid gray;
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
</head>