<?php
ini_set('memory_limit', '2048M');

		?>
<script>
 var reportmo = "<?php echo $reportmo; ?>";
 var element = "<?php echo $element; ?>";
//alert(element)
 $(document).ready(function() {
	 

    $('#cfg').DataTable( {
        "iDisplayLength": 20,
		// "iDisplayStart ": 20,
		 processing: true,
        //serverSide: true,
        ajax: {
            //"url": "/npsmart/umts/datatable",
            "url": "/npsmart/json/"+element+"/"+reportmo+".txt",
            //"url": "/npsmart/json/nodeb/retsubunit.txt",
            "type": "POST",
			  "contentType": 'application/json; charset=utf-8'
			//"data": function (data) { return data = JSON.stringify(data); }
        },
	
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
$tmpl = array ( 'table_open'  => '<table id="cfg" class="cell-border compact hover stripe" border="1 solid black" cellspacing="0" width="100%">',
  'heading_cell_start'  => '<th bgcolor="#3b5998"><font color="#FFFFFF" style="font-family: calibri; font-size:12pt">',
   'heading_cell_end'    => '</font></th>'
 );

$this->table->set_template($tmpl);
#$query = $this->db->query("SELECT * from ".$schema.$reportmo);
$query = $this->db->query("SELECT * from common_control.action_plan order by id desc");
$fields  = $query->list_fields();
#$fields = $this->db->list_fields($reportmo);

$this->table->set_heading($fields);
$this->table->set_footer($fields); // just like set_header
//$this->table->add_row($fields);
echo $this->table->generate($query);


?>

</div>

</body>
</html>