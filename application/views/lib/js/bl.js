function onBaselineCheckClick()
{
	
	var networkType = "3G"; // get from interface later
	var cluster = $('select[name=cluster]').val(); //"DF_RNCs"; // get from interface later
	var baselineRule = $('select[name=baselineRules]').val(); 
	
	if ($('#gbox_list2')) $('#gbox_list2').replaceWith("<table id='list2'></table>" )
	
	
	
	jQuery("#list2").jqGrid({
   	url:'baseline.php?networktype=' + networkType + '&rule=' + baselineRule.substr(1) + '&cluster=' + cluster ,
	datatype: "json",
   	colNames:['Mo','No of Parameters', 'Discrepancy', '%'],
   	colModel:[
   		{name:'mo',index:'mo asc', width:298, sortable:false},
   		{name:'num_param',index:'num_param', width:110, sortable:false},
   		{name:'discrepancy',index:'discrepancy, invdate', width:90, sortable:false},
   		{name:'percentage',index:'percentage', width:80, align:"right", sortable:false}
   	],
   	rowNum:99,
   	rowList:[33,66,99],
   	pager: '#pager2',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    caption:"Baseline Check",
	loadComplete : function () {
		$("div.logFileName").html("<a target=_blank href=output/" + jQuery("#list2").getGridParam('userData') + ">Download results</a>");
		generateBLChart();
	}
});
jQuery("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
	

	
}

function generateBLChart()
{
	 // generate chart
	 // steps: generate hidden table with MO/percentage to be used for highchart
 
 
    var outputHTMLFileData, o;
	var v_spaces = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

	var v_numRows;
	
	

	o = "<table border=0 width=100%><tr><td  width=35%>";
	o +=  "<table class='highchart' border=1 data-graph-container='.bl_chart' data-graph-type='column' data-graph-xaxis-rotation='300'  data-graph-color-1='#FF9848' data-graph-height='600'  data-graph-legend-disabled='1'>";
    o +=  "<caption><b>Discrepanies<b></caption>";
	o += " <thead><tr bgcolor=gray><th>MO</th><th data-graph-skip='1'>No of Parameters</th><th data-graph-skip='1' >Discrepancy</th><th>%</th></tr> </thead><tbody>";
 
	v_numRows = jQuery('#list2 tr').length -1;
	
	for (i=1; i<=v_numRows; i++) {
		o += "<tr><td>" + jQuery('#list2').jqGrid ('getCell', i, 'mo') + v_spaces + "</td>";
        o += "<td>NumParameters</td><td bgcolor=#FDE9D9>NumDescrepancies</td>";
		o += "<td bgcolor=#FDE9D9>" + jQuery('#list2').jqGrid ('getCell', i, 'percentage') + "</td></tr>";
	}
	o += "</table>";
	outputHTMLFileData = o;
	
	$("div.hiddenTable").html(outputHTMLFileData);
 
	$('table.highchart').highchartTable();

}


function updateControls()
{
	//get list of Clusters and templates
	
	$.ajax({
  url: 'getClustersList.php',
  type: 'GET',
  data: 'networkType=3G',
  success: function(dataStr) {
	var data=dataStr.split(",");
	var $select = $('select[name=cluster]');
	$select.find('option').remove();       
$.each(data, function(ind, val) {
	if (val!="") $('<option>').val(val).text(val).appendTo($select);
	}
 );

},
  error: function(e) {
	//called when there is an error
	//console.log(e.message);
  }
});
	
	
// Get Baseline rules

	$.ajax({
  url: 'getRuleList.php',
  type: 'GET',
  data: 'networkType=3G',
  success: function(jsonStr) {
	 
	 eval('var dataStr = ' + jsonStr); // {k1:'UCELLDRD Rule',k2:'HSPA Users Check',k3:'RESELECTION'}
    var $select = $('select[name=baselineRules]');
	$select.find('option').remove();
	
	 $.each(dataStr, function (key, value) {
            $('<option>').val(key).text(value).appendTo($select);
        });
},
  error: function(e) {
	//called when there is an error
	//console.log(e.message);
  }
});
	
}
