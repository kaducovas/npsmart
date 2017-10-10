<script type="text/javascript" >
$(document).ready( function () {
  $('#table-sparkline').DataTable( {
    "bPaginate": true,
	"aaSorting": [],
	"bInfo": true,
	"bFilter": true,
	"dom": '<"top">rt<"bottom"ifp><"clear">',
	"iDisplayLength": 24,
	
	"language": {
            //"lengthMenu": "Display _MENU_ cells per page",
            "lengthMenu": "",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing _PAGE_ page of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
  } );
} );

var kpi = "<?php echo $this->input->post('kpi'); ?>";
var wcdate = "<?php echo $this->input->post('wcdate'); ?>";
var node = "<?php echo $this->input->post('node'); ?>";
</script>
<form action="/npsmart/lte/worstcells" name="wcform" method="post">
<input type="hidden" id="wcreportnename" name="reportnename" value="" />
<input type="hidden" id="wcreportnetype" name="reportnetype" value="" />
<input type="hidden" id="wctimeagg" name="timeagg" value="" />
<input type="hidden" id="wcreportdate" name="reportdate" value="" />
<input type="hidden" id="wckpi" name="kpi" value="" />
<div class="dashboard">
<!--<form action="/npsmart/umts/worstcells" name="wcform" method="post">
<input type="hidden" id="node" name="node" value="" />
<input type="hidden" id="cellname" name="cellname" value="" />
<input type="hidden" id="date" name="wcdate" value="" />
<input type="hidden" id="kpi" name="kpi" value="" />
<div class="dashboard">-->
<div id="content" class="wc_chart_content">	
		
		<div id="wcchart1" class="border" style="margin-bottom:1%; height:98%;"></div>
		<div id="wcchart2" class="border" style="margin-top:1%; height:98%;"></div>
</div>

<div class="wc border">

<table id="table-sparkline" class="stripe hover compact row-border" bgcolor="#ffffff">
    <thead>
        <tr>
            <!--<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Date</font></th>-->
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Worst Cells</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt"><?php echo  $this->input->post('kpi');?></font></th>
            <!--<th>Daily KPI</th>-->
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Fails</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Daily Fails</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Weight</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Region KPI</font></th>
			<th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">New Region KPI</font></th>
            <th bgcolor="#3C6D7A"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">Impact Per Day</font></th>
        </tr>
    </thead>
    <tbody id="tbody-sparkline">
	
	
	<?php
	$bad = "#FF0000";	
	$good = "#009900";
			foreach($wc as $row){
		
			#echo "<tr><th onclick='selected(this)'>";
			echo "<tr><th>";

			#echo $row->date."</th>";
			echo $row->cellname."</th>";
			echo "<td><font color='".($row->kpi_cell_rate >= 98.5?$good:$bad)."'>".$row->kpi_cell_rate."%</font></td>";
			#echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_kpi_cell_rate).'" />';
			echo "<td>".$row->cell_fails."</td>";			
			echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_cell_fails).'" />';
			echo "<td>".$row->impact."%</td>";
			#echo "<td>".()$row->impact."%</td>";
			echo "<td><font color='".($row->kpi_node_rate >= 98.5?$good:$bad)."'>".$row->kpi_node_rate."%</font></td>";
			echo "<td><font color='".($row->new_node_kpi >= 98.5?$good:$bad)."'>".$row->new_node_kpi."%</font></td>";
			echo '<td data-sparkline="'.str_replace(',', ', ', $row->daily_impact).' ; column" />';			
		#	echo '<td data-sparkline="-20, 90, -21, 74 ; column"/>';
			echo "</tr>";
			}
	?>
    </tbody>
</table>
</div>
<div style="clear: both;"></div>
</div>
</form>

	