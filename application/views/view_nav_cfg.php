<script type="text/javascript" >
	
$(document).ready( function () {
  $('#table_id').DataTable( {
    "bPaginate": false,
	"aaSorting": [],
	"bInfo": false
  } );
} );

$(function() {	
	$('#weekdate').datepicker()
  .on('changeDate', function(date){
	var date = $(this).val();
	var week = $.datepicker.iso8601Week(date);
	alert(week);
	    });
  });

// //let's create arrays
	<?php 
	// foreach($rncs as $row){
		// echo $row->node;
	// }
#echo json_encode($rncs);
#echo join($rncs, ',');

?>
 //var reportagg = "<?php #echo $reportagg; ?>";
 //var reportnetype = "<?php #echo $reportnetype; ?>";
 //var rncs = <?php #echo json_encode($rncs); ?>;	
 //var regional = <?php #echo json_encode($regional); ?>;	
 //var cidades = <?php #echo json_encode($cidades); ?>;	
 //var clusters = <?php #echo json_encode($clusters); ?>;		
 var mos = <?php echo json_encode($mos); ?>;
	
$(document).ready(function(){

//populate MOs

    $(mos).each(function (i) { //populate child options
        $("#mo_selection").append("<option value=\""+mos[i].mo+"\">"+mos[i].mo+"</option>");
    });



//If parent option is changed
$("#parent_selection").change(function() {
        var parent = $(this).val(); //get option value from parent
       
        switch(parent){ //using switch compare selected option and populate child
              case 'rncs':
                list(rncs);
                break;
              case 'regional':
                list(regional);
                break;             
              case 'cidades':
                list(cidades);
                break;
			case 'clusters':
                list(clusters);
                break;				
            default: //default child option is blank
                $("#child_selection").html('');  
                break;
           }
});

//function to populate child select box
function list(array_list)
{
    $("#child_selection").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options
        $("#child_selection").append("<option value=\""+array_list[i].node+"\">"+array_list[i].node+"</option>");
    });
}

});	
	
</script>
	
 </head>
<body>
<?php 
if (isset($weeknum)){
	$calendarinfo = "Week ".$weeknum;
} else{
	$calendarinfo = $reportdate;
}


 $attributes = array('name' => 'reportcfg', 'method' => 'post');
echo form_open('', $attributes);
?>

<input type="hidden" id="reportmo" name="reportmo" value="" />
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
                <a class="navbar-brand" href="http://support.huawei.com"><img src="/npsmart/images/huawei_logo_icon.png" style="padding:0px; top:0px; width:30px; height:30px;"/></a>
               
               <a class="navbar-brand" id="aTitleVersion" href="/npsmart/umts/" style="width:170px;"><span id="aTitle">NPSmart</span>&nbsp; <span id="sVersion" style="font-size:12px; font-family:Calibri;">
                     v2.0</span></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav" id="mainMenu">
                     <li id="menuItemnqi" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Performance<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="menuItemnqi"><a href="/npsmart/umts/">Main KPIs</a></li>
                            <li class="menuItemnqi"><a onclick='selectreportname(this)'>AMX NQI HS</a></li>
                            <li class="menuItemnqi"><a onclick='selectreportname(this)'>AMX NQI CS</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/txintegrity">TX Integrity</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/overshooters">Overshooters</a></li>
                            <!--<li class="menuItemnqi"><a href="/npsmart/umts/feature_phase2">Feature Report</a></li>-->
                            <li class="disabled"><a href="#">AMX Radar</a></li>
                            <li class="disabled"><a href="#">Unbalance</a></li>
                        </ul>
                    </li>

                    <li id="menuItemwaf" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Capacity<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
						<li class="menuItemnqi"><a href="/npsmart/umts/capacity">Cell & NodeB Capacity</a></li>
						<li class="menuItemnqi"><a href="/npsmart/umts/rnc_capacity">RNC Capacity</a></li>
                        </ul>
						</li>	
  
                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RNP<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li class="menuItemnqi"><a href="/npsmart/umts/rfpar">Cells Database</a></li>
                              <li><a href="/npsmart/umts/cfg">RNC & Cell Configuration</a></li>
                            <li class="menuItemnqi"><a href="/npsmart/umts/nodebcfg">NodeB Configuration</a></li>  
                            <li class="menuItemnqi"><a href="/npsmart/lte/enodebcfg">eNodeB Configuration</a></li>  
                            <li class="menuItemnqi"><a href="/npsmart/umts/srancfg">Single-RAN Configuration</a></li> 
							<li class="menuItemnqi"><a href="/npsmart/umts/inventory">Inventory</a></li>	
							<li class="menuItemnqi"><a href="/npsmart/umts/gis">GIS</a></li>
							<li class="menuItemnqi"><a href="/npsmart/umts/alarm">Alarm</a></li>
                        </ul>
                    </li>	
  

                     <li id="menuItemwaf" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Baseline<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                              <li class="disabled"><a href="#">Baseline NodeB Audit</a></li>
                              <li class="menuItemnqi"><a href="/npsmart/umts/baseline">Baseline Cell & RNC Audit</a></li>
                        </ul>
                    </li>


					<li class="disabled"><a href="#">Action Plan</a></li>
				   
	
                <li id="menuItemwaf" class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                            <li class="disabled"><a href="#">Counters</a></li>
                            <li class="disabled"><a href="#">KPIs Target</a></li>
                        </ul>
				</li>
                 
                
                      <li class="disabled"><a href="#">Log</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
	
	 <li class="dropdown" id="dateMenu1">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">UMTS<span class="glyphicon glyphicon-phone pull-left" style="margin-top:2px;margin-right:4px;"></span><span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
                              <li class="disabled"><a href="#">GSM</a></li>
                              <li id="menuItemwaf"><a href="/npsmart/umts/">UMTS</a></li>
                              <li id="menuItemwaf"><a href="/npsmart/lte/">LTE</a></li>
         </ul>
     </li>
	 
                    <li class="dropdown" id="optionsMenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spOptions"><?php echo $reportmo;?></span> <span class="glyphicon glyphicon-th-list pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions" class="caret"></span></a>
                        <div class="dropdown-menu" style="padding:12px;margin-bottom:0px;padding-bottom:0px;">
                            <form class="form" id="formOptions">
						<div class="form-group">
							Parameter Class : 
						<select name="mo_selection" id="mo_selection" style="width:200px;">
						</select>
						</div>
						<a href="#" id="btnSubmit" class="btn btn-default btn-sm" onclick='selectmo($("#mo_selection").val())';>Update</a>
						<div class="form-group">
						</div>
						</form>
						</div>
						</li>

                    <!--<li class="dropdown" id="optionsMenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span id="spOptions"><?php echo $reportnename;?></span> <span class="glyphicon glyphicon-th-list pull-left" style="margin-top:2px;margin-right:4px;"></span><span id="caretOptions" class="caret"></span></a>
                        <div class="dropdown-menu" style="padding:12px;margin-bottom:0px;padding-bottom:0px;">
                            <form class="form" id="formOptions">
							

<div class="form-group">
Network Node : <select name="parent_selection" id="parent_selection" style="width:200px;">
    <option value="">-- Please Select --</option>
    <option value="regional">Region</option>
    <option value="rncs">RNC</option>
    <option value="cidades">City</option>

</select>
<select name="child_selection" id="child_selection" style="width:200px;">
</select>
</div>
     <a href="#" id="btnSubmit" class="btn btn-default btn-sm" onclick='selectnenav($("#child_selection").val(),$("#parent_selection").val())';>Update</a>
     <div class="form-group">
      </div>

                            </form>
                        </div>
                    </li>-->
<!--                    <li id="liAmdocsLogo"><img src="/npsmart/images/huawei-logo.png" width="130" height="30"" style="margin-top:5px;margin-right:-8px;padding-left:4px;" /></li>-->
                </ul>
            </div>
        </div>
    </nav>
