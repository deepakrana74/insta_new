$(document).ready(function() {

    pageSetUp();
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">'+
            '<tr>'+
            '<td style="width:100px">Project Title:</td>'+
            '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Deadline:</td>'+
            '<td>'+d.ends+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Comments:</td>'+
            '<td>'+d.comments+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Action:</td>'+
            '<td>'+d.action+'</td>'+
            '</tr>'+
            '</table>';
    }

    // clears the variable if left blank
    var table = $('#example').DataTable( {
        "ajax": "data/dataList.json",
        "bDestroy": true,
        "iDisplayLength": 15,
        "columns": [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "est" },
            { "data": "contacts" },
            { "data": "status" },
            { "data": "target-actual" },
            { "data": "starts" },
            { "data": "ends" },
            { "data": "tracker" },
        ],
        "order": [[1, 'asc']],
        "fnDrawCallback": function( oSettings ) {
            runAllCharts()
        }
    } );

    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

})

$(document).ready(function() {

    pageSetUp();

    /* // DOM Position key index //

     l - Length changing (dropdown)
     f - Filtering input (search)
     t - The Table! (datatable)
     i - Information (records)
     p - Pagination (paging)
     r - pRocessing
     < and > - div elements
     <"#id" and > - div with an id
     <"class" and > - div with a class
     <"#id.class" and > - div with an id and class

     Also see: http://legacy.datatables.net/usage/features
     */

    /* BASIC ;*/
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    $('#dt_basic').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_dt_basic.respond();
        }
    });

    /* END BASIC */

    /* COLUMN FILTER  */
    var otable = $('#datatable_fixed_column').DataTable({
        //"bFilter": false,
        //"bInfo": false,
        //"bLengthChange": false
        //"bAutoWidth": false,
        //"bPaginate": false,
        //"bStateSave": true // saves sort state using localStorage
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_fixed_column) {
                responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_datatable_fixed_column.respond();
        }

    });

    // custom toolbar
    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

    // Apply the filter
    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

        otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();

    } );
    /* END COLUMN FILTER */

    /* COLUMN SHOW - HIDE */
    $('#datatable_col_reorder').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "autoWidth" : true,
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_col_reorder) {
                responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_datatable_col_reorder.respond();
        }
    });

    /* END COLUMN SHOW - HIDE */

    /* TABLETOOLS */
    $('#datatable_tabletools').dataTable({

        // Tabletools options:
        //   https://datatables.net/extensions/tabletools/button_options
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oTableTools": {
            "aButtons": [
                "copy",
                "csv",
                "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "SmartAdmin PDF Export",
                    "sPdfSize": "letter"
                },
                {
                    "sExtends": "print",
                    "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                }
            ],
            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
        "autoWidth" : true,
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_tabletools) {
                responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_datatable_tabletools.respond();
        }
    });

    /* END TABLETOOLS */

})

$('#activated').click(function(){
    var baseurl = basepath;
    var user_id  = $('#user_id').val();

});

$('input[name="user_status"]').change(function()
{
    if ($('#'+this.id).is(':checked')) {
        var Status = "1";
        var User_id = this.id.replace(/\D/g,'');
        $.ajax({
            type: "POST",
            url: baseurl_userstatus,
            data: {user_id:User_id, status:Status,_csrf : csrfToken},
            success: function(data)
            {
                var Result = JSON.parse(data);
            }
        });
    } else {
        var Status = "0";
        var User_id = this.id.replace(/\D/g,'');
        $.ajax({
            type: "POST",
            url: baseurl_userstatus,
            data: {user_id:User_id, status:Status,_csrf : csrfToken},
            success: function(data)
            {
                var Result = JSON.parse(data);
            }
        });
    }
});

$('input[name="event_status"]').change(function()
{
    if ($('#'+this.id).is(':checked')) {
        var Status = "1";
        var Event_id = this.id.replace(/\D/g,'');
        $.ajax({
            type: "POST",
            url: baseurl_eventstatus,
            data: {event_id:Event_id, status:Status,_csrf : csrfToken},
            success: function(data)
            {
                var Result = JSON.parse(data);
            }
        });
    } else {
        var Status = "0";
        var Event_id = this.id.replace(/\D/g,'');
        $.ajax({
            type: "POST",
            url: baseurl_eventstatus,
            data: {event_id:Event_id, status:Status,_csrf : csrfToken},
            success: function(data)
            {
                var Result = JSON.parse(data);
            }
        });
    }
});

$('input[name="event_joined_status"]').change(function()
{
    if (!confirm('Are you sure you want to continue?')) {
        location.reload();
    } else {
        if ($('#' + this.id).is(':checked')) {

            var Status = "2";
            var order_id = this.id.replace(/\D/g, '');
            $.ajax({
                type: "POST",
                url: baseurl_usereventjoined,
                data: {order_id: order_id, status: Status, _csrf: csrfToken},
                success: function (data)
                {
                    var Result = JSON.parse(data);
                    location.reload();
                }
            });
        }
    }
});

var $eventForm = $("#event-form").validate({
    // Rules for form validation
    rules : {
        title : {
            required : true,
        },
        file2 : {
            required : true,
        },
        eventdate : {
            required : true
        },
        address : {
            required : true,
        },
        entry_fees : {
            required : true,
            dollarsscents: true
        },
        event_description : {
            required : true
        }
    },

    // Messages for form validation
    messages : {
        title : {
            required : 'Please enter Event Title',
        },
        file2 : {
            required : 'Please Select Event Image',
        },
        eventdate : {
            required : 'Please enter Event Date'
        },
        address : {
            required : 'Please select Event Address',
        },
        entry_fees : {
            required : 'Please select Event Fees',
        },
        event_description : {
            required : 'Please select Event Description'
        }
    },

    // Do not change code below
    errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
    }
});

var $eventForm = $("#event-edit-form").validate({
    // Rules for form validation
    rules : {
        title : {
            required : true,
        },
        eventdate : {
            required : true
        },
        address : {
            required : true,
        },
        entry_fees : {
            required : true,
            dollarsscents: true
        },
        event_description : {
            required : true
        }
    },

    // Messages for form validation
    messages : {
        title : {
            required : 'Please enter Event Title',
        },
        eventdate : {
            required : 'Please enter Event Date'
        },
        address : {
            required : 'Please select Event Address',
        },
        entry_fees : {
            required : 'Please select Event Fees',
        },
        event_description : {
            required : 'Please select Event Description'
        }
    },

    // Do not change code below
    errorPlacement : function(error, element) {
        error.insertAfter(element.parent());
    }
});

jQuery.validator.addMethod("dollarsscents", function (value, element) {
    return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
}, "You must include two decimal places");

$(document).ready(function(){
    CKEDITOR.replace( 'event_description', { height: '200px', startupFocus : true} );
})

$(function() {
    $('input[name="eventdate"]').daterangepicker({
        timePicker: true,
        minDate: new Date(),
        locale: {
            format: 'D/M/Y hh:mm A'
        }
    });
});

$('input[name="entry_fees"]').bind("keyup blur",function(){
    $(this).val( $(this).val().replace(/[^\d\.]/g,'') )

});