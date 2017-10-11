<?php
ini_set('memory_limit', '2048M');

		?>
		
<script>
 var reportmo = "<?php echo $reportmo; ?>";
 var element = "<?php echo $element; ?>";
//alert(element)
 $(document).ready(function() {
//teste	 

    $('#cfg').DataTable( {
        "iDisplayLength": 20,
		// "iDisplayStart ": 20,
		 processing: true,
        //serverSide: true,
         // ajax: {
            // // //"url": "/npsmart/umts/datatable",
            // "url": "/npsmart/json/"+element+"/"+reportmo+".txt",
            // // //"url": "/npsmart/json/nodeb/retsubunit.txt",
            // "type": "POST",
			// "contentType": 'application/json; charset=utf-8'
			// // //"data": function (data) { return data = JSON.stringify(data); }
        // },
	
		// "columns": [	
            // { "data": "rncid" },
            // { "data": "rncname" },
            // { "data": "region" },
            // { "data": "type" },
            // { "data": "version" },
            // { "data": "ip" },
            // { "data": "ftpuser" },
            // { "data": "password" },
            // { "data": "act" }
        // ],
		// scrollY:        200,
		// scrollCollapse: true,
		// scroller:       true,
		 
		 
		 
		 //"bProcessing": true,
		 //"bServerSide": true,
		//"sAjaxDataProp": "data",
		 //"sAjaxSource": '/npsmart/umts/datatable',
		 //"sServerMethod": 'POST',
		//"bJQueryUI": true,	
		//"oLanguage": {
          //      "sProcessing": "<img src='<?php echo base_url(); ?>assets/images/ajax-loader_dark.gif'>"
            //},
         //"fnInitComplete": function () {
                //oTable.fnAdjustColumnSizing();
          //  },
		// 'fnServerData': function (sSource, aoData, fnCallback) {
						// $.ajax
						// ({
							// 'dataType': 'json',
							// 'type': 'POST',
							// 'url': sSource,
							// 'data': aoData,
							// 'success': fnCallback
						// });
					// },
		  
		dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
				 title: 'export',
                exportOptions: {
                    columns: ':visible'
                }
            },
			{
                extend: 'copy',
				 title: 'export',
                exportOptions: {
                    columns: ':visible'
                }
            },
			{
                extend: 'csv',
				 title: 'export',
                exportOptions: {
                    columns: ':visible'
                }
            },
			{
                extend: 'excel',
				title: 'export',
                exportOptions: {
                    columns: ':visible'
                }
            },			
			{
                extend: 'pdf',
				//title: 'export',
                exportOptions: {
                    columns: ':visible'
                }
            },			
            'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: false
        } ]
    } );

    // Setup - add a text input to each footer cell
    $('#cfg tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#cfg').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

<body>
<div width="90%">
       <?php
            $query = pg_query("select * from alarm.alarm_log");
        ?>
		
<table id="cfg" class="cell-border compact hover stripe" border="1 solid black" cellspacing="0" width="100%">
			<thead>
            <tr>
                  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">log_serial_number</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">object_identity_name</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">object_identity</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">productname</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">netype</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">ne_object_identity</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">alarm_source</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">equipmentalarmserialnumber</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">alarmname</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">type</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">severity</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">status</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">occurrencetime timestamp</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">acknowledgementtime</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">clearancetime</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">un_acknowledgementoperator</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">clearanceoperator</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">locationinformation</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">linkfdn</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">linkname</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">linktype</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">alarm_identifier</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">alarm_id</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">object_instance_type</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">auto_clear</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">alarm_clear_type</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">business_affected</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">addtional_text</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">arrivedutctime</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">list_id integer</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">related_logid integer</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">agent_id</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">root_id</font></th>
				  <th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">show_flag</font></th>
				  </tr>
				  </thead>
            <?php
               while ($row = pg_fetch_array($query)) {
                   echo "<tr>";
                   echo "<td>".$row[0]."</td>";
                   echo "<td>".$row[1]."</td>";
                   echo "<td>".$row[2]."</td>";
				   echo "<td>".$row[3]."</td>";
				   echo "<td>".$row[4]."</td>";
				   echo "<td>".$row[5]."</td>";
				   echo "<td>".$row[6]."</td>";
				   echo "<td>".$row[7]."</td>";
				   echo "<td>".$row[8]."</td>";
				   echo "<td>".$row[9]."</td>";
				   echo "<td>".$row[10]."</td>";
				   echo "<td>".$row[11]."</td>";
				   echo "<td>".$row[12]."</td>";
				   echo "<td>".$row[13]."</td>";
				   echo "<td>".$row[14]."</td>";
				   echo "<td>".$row[15]."</td>";
				   echo "<td>".$row[16]."</td>";
				   echo "<td>".$row[17]."</td>";
				   echo "<td>".$row[18]."</td>";
				   echo "<td>".$row[19]."</td>";
				   echo "<td>".$row[20]."</td>";
				   echo "<td>".$row[21]."</td>";
				   echo "<td>".$row[22]."</td>";
				   echo "<td>".$row[23]."</td>";
				   echo "<td>".$row[24]."</td>";
				   echo "<td>".$row[25]."</td>";
				   echo "<td>".$row[26]."</td>";
				   echo "<td>".$row[27]."</td>";
				   echo "<td>".$row[28]."</td>";
				   echo "<td>".$row[29]."</td>";
				   echo "<td>".$row[30]."</td>";
				   echo "<td>".$row[31]."</td>";
				   echo "<td>".$row[32]."</td>";
				   echo "<td>".$row[33]."</td>";
                   echo "</tr>";
               }
            ?>

			<tfoot>
			<tr>
			  <td>log_serial_number</td>
			  <td>object_identity_name</td>
			  <td>object_identity</td>
			  <td>productname</td>
			  <td>netype</td>
			  <td>ne_object_identity</td>
			  <td>alarm_source</td>
			  <td>equipmentalarmserialnumber</td>
			  <td>alarmname</td>
			  <td>type</td>
			  <td>severity</td>
			  <td>status</td>
			  <td>occurrencetime</td>
			  <td>acknowledgementtime</td>
			  <td>clearancetime</td>
			  <td>un_acknowledgementoperator</td>
			  <td>clearanceoperator</td>
			  <td>locationinformation</td>
			  <td>linkfdn</td>
			  <td>linkname</td>
			  <td>linktype</td>
			  <td>alarm_identifier</td>
			  <td>alarm_id</td>
			  <td>object_instance_type</td>
			  <td>auto_clear</td>
			  <td>alarm_clear_type</td>
			  <td>business_affected</td>
			  <td>addtional_text</td>
			  <td>arrivedutctime</td>
			  <td>list_id</td>
			  <td>related_logid</td>
			  <td>agent_id</td>
			  <td>root_id</td>
			  <td>show_flag</td>
			</tr>
			</tfoot>
</table>
</div>
</body>

</html>