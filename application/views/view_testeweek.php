<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

 <script type="text/javascript" >



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
		//document.getElementById('reportnename').value = kpi;
		document.getElementById('reportdate').value = date;
		//document.getElementById('reportkpi').value = obj.innerHTML
		document.reportopt.submit();

		//var year = new Date($('#daterange').datepicker('getDate').getFullYear());
		//var month = new Date($('#daterange').datepicker('getDate').getMonth());
		//var checkDate = new Date($('#daterange').datepicker('getDate'));
		//checkDate = $('#daterange').datepicker().val();
		//var date = $('#daterange').datepicker.formatDate("yy-mm-dd", new Date($('#daterange').datepicker('getDate')));
		//var dia = $('#daterange').val();
		//var dia = $( "#daterange" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		//var date = $("#daterange").datepicker({ dateFormat: 'dd,MM,yyyy' }).val();
		//alert(date);
		//alert(checkDate.getDay())
		//alert($(this).val(myWeekCalc()));
		// var day1 = $("#daterange").datepicker('getDate').getDate();
		// var day2 = $("#daterange").datepicker('getDate').getWeek();
		// alert(day1);
		// alert(day2);
		//var checkDate = new Date(date.getDate);
		//alert(checkDate);
		//alert(JSON.stringify(date))
	 })
});
function myWeekCalc() {
		//alert(date);
		var checkDate = new Date($("#daterange").datepicker('getDate').getTime());
		//alert(checkDate.getDay())
		// Find Thursday of this week starting on Sunday
		 checkDate.setDate(checkDate.getDate() + 4 - (checkDate.getDay()));
		 var time = checkDate.getTime();
		 checkDate.setMonth(0); // Compare with Jan 1
		 checkDate.setDate(1);
		 return Math.floor(Math.round((time - checkDate) / 86400000) / 7) + 1;
	}
	
$(function () {
	$('#inputWeekStartDay').datepicker({
		calendarWeeks: true
	});
});	

function weekPicker()
{
	$('.week-picker').datepicker({
		calendarWeeks: true,
		//selectOtherMonths: true,
		//showWeek: true,
		dateFormat: "yy-mm-dd",
		//calculateWeek: myWeekCalc,
		//onSelect: onSelect
});}


///////////////////////////////////////////////////////







	
	// // function getMonday(d) {
		// // d = new Date(d);
		// // var day  = d.getDay(), 
			// // diff = d.getDate() - day + (day == 6 ? 7:0); // adjust when day is sunday
		// // console.log(day);
		// // alert(day);
		// // return new Date(d.setDate(diff));
	// // }

	// // function onSelect(dateString, inst) {
		// // console.log(getMonday(dateString));
		// // $('input[name=date]').val(dateString);
		// // $(this).val('Week ' + myWeekCalc(getMonday(dateString)));
	// // }

   // .on('changeDate', function(value, date){
	// // //alert(date);
	// var calculateWeek = $( "#daterange" ).datepicker( "option", "calculateWeek" );
	// alert(calculateWeek);
	     // })
    //});
//});	
		//;
//  });
  
  

// $(function() {



// $("#weekno").datepicker({

// ,

// showButtonPanel: true,

// numberOfMonths: 3,

// showWeek: true

// });



// $(function() {



// $("#daterange").datepicker("option", "onSelect",

        // function(value, date)

        // { var week=$.datepicker.iso8601Week (

                // new Date(date.selectedYear,

                        // date.selectedMonth,

                        // date.selectedDay));

         // $(this).val(date.selectedYear+'-week-'+(week<10?'0':'')+week);

       // }

 // );



// });

//});

	
//var date = $(this).datepicker('getDate');
//      alert($.datepicker.formatDate('DD', date));	
//});

 // $(function() {
		// $("#daterange").daterangepicker({
      // ///  singleDatePicker: true//,
		// //showWeekNumbers: true

    // });
// });

 // $("#selectne").change(function(){
        // var type = $(this).find("option:selected").val();
		// alert(type);
    // //    if(type != undefined){
     // //       $(".template-"+type+":first").clone().insertBefore($(this)).show();
     // //       $(this).find("option").removeAttr("selected").find("option:first").attr("selected",true);
     // //   }
    // });

</script>
	
 </head>
<body>
<?php 

#echo count($cells);
		// foreach($cells as $row){
			// $cellinfo[$row->cellname] = $row->cellid;
			// $rnc[] = $row->rnc;
			// $cellid[] =  $row->cellid;
			// $cellname[] = $row->cellname;
			// $site[] = $row->site;
			// $regional[] = $row->regional;
			// $uf[] = $row->uf;	
			// $cluster[] = $row->cluster;
			// $cidade[] = $row->cidade;
			
		// }
		// $rncunique = $array = array_values(array_filter(array_unique($rnc)));;
		// $clusterunique = $array = array_values(array_filter(array_unique($cluster)));;
		// $cidadeunique = $array = array_values(array_filter(array_unique($cidade)));;
		?>
<form action="/npsmart/umts/main" name="reportopt" method="get">
<input type="hidden" id="reportnetype" name="reportnetype" value="" />
<input type="hidden" id="reportnename" name="reportnename" value="" />
<input type="hidden" id="reportdate" name="reportdate" value="" />
<input type="hidden" id="reportkpi" name="reportkpi" value="" />
</form>
       <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle collapsed" id="toggleButton" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="/npsmart/images/huawei_logo_icon.png" style="padding:0px; top:0px; width:30px; height:30px;"/></a>
               
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
                            <li id="menuItemnqi"><a href="#">Monitor</a></li>
                            <li class="divider"></li>
                            <li class="disabled"><a href="#">NQI CS</a></li>
                            <li id="menuItemnqi"><a href="#">Daily Report</a></li>
                            <li id="menuItemnqi"><a href="#">Worst Cells</a></li>
                            <li id="menuItemnqi"><a href="#">Monitor</a></li>
                           <li class="divider"></li>
                            <li class="disabled"><a href="#">NQI PS</a></li>
                            <li id="menuItemnqi"><a href="#">Daily Report</a></li>
                            <li id="menuItemnqi"><a href="#">Worst Cells</a></li>
                            <li id="menuItemnqi"><a href="#">Monitor</a></li>
							<li class="divider"></li>
                        </ul>
                    </li>

                    <li id="menuItemradar"><a href="#">Capacity</a></li>
  
                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RNP<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="#">Cells Database</a></li>
                              <li id="menuItemwaf"><a href="#">Parameter List</a></li>
                              <li id="menuItemwaf"><a href="#">RNC Configuration</a></li>
                              <li id="menuItemwaf"><a href="#">NodeB Configuration</a></li>  
							<li id="menuItemlayermanagement"><a href="#">Inventory</a></li>							  
							<li id="menuItemchangelog"><a href="#">GIS</a></li>	
                        </ul>
                    </li>	
  

                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Baseline<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="#">Consistency Check</a></li>
                              <li id="menuItemwaf"><a href="#">Baseline Audit</a></li>
                        </ul>
                    </li>


                   <li id="menuItemcapacityanalysis"><a href="#">Action Plan</a></li>
				   
	
                <li id="menuItemwaf" class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                            <li id="menuItemwaf"><a href="#">Counters</a></li>
                            <li id="menuItemwaf"><a href="#">KPIs Target</a></li>
                        </ul>
				</li>
                 
                
                      <li id="menuItemchangelog"><a href="#">Log</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
	
	 <li class="dropdown" id="dateMenu1">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Technology<span class="glyphicon glyphicon-phone pull-left" style="margin-top:2px;margin-right:4px;"></span><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
                              <li id="menuItemwaf"><a href="#">GSM</a></li>
                              <li id="menuItemwaf"><a href="#">UMTS</a></li>
                              <li id="menuItemwaf"><a href="#">LTE</a></li>
         </ul>
     </li>

 
   <li class="dropdown" id="dateMenu1">
        <a href="#" id="daterange" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spDate">Week</span> <span class="glyphicon glyphicon-calendar pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions1" class="caret"></span></a>
        <div class="week-picker" id="calendarDiv" style="position:absolute;z-index:10"></div>
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
<!--                    <li id="liAmdocsLogo"><img src="/npsmart/images/huawei-logo.png" width="130" height="30"" style="margin-top:5px;margin-right:-8px;padding-left:4px;" /></li>-->
                </ul>
            </div>
        </div>
    </nav>

</body>
</html>