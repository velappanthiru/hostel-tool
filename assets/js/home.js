$(document).ready(function(){
    var showExportButton = [];
    showExportButton =[
        { 
            extend: 'csv',
            text: 'Export Csv',
            title: 'daily_log_details' + moment(new Date()).format("YYYY-MM-DD_h.mm A"),
            exportOptions: {
                columns: "thead th:not(.noExport)"
            },
        } ,
        { 
            extend: 'pdf',
            text: 'Export Pdf',
            title: 'daily_log_details' + moment(new Date()).format("YYYY-MM-DD_h.mm A"),
            exportOptions: {
                columns: "thead th:not(.noExport)"
            },
        } 
    ];

    var table = $('#members-out-details').DataTable({
        "processing": true,
        "pageLength": 25,
        "lengthMenu": [15, 25, 50, 100, 150, 200, 300],
        "pagingType": "simple_numbers",
        // dom: 'Bfrtip',
        buttons:  [],
        "fixedHeader": {
            header: 100,
            headerOffset: 0
        },
        language: {
            emptyTable: "No records are available",                
            zeroRecords:  "No records are available",
            paginate: {
                previous: "<i class='fa fa-chevron-left me-1' style='color:#778ca2'></i>Prev",
                next: "Next<i class='fa fa-chevron-right ms-1' style='color:#778ca2'></i>"
            },
            searchPlaceholder: "Search",
        },
    });


    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: showExportButton
    }).container().appendTo($('#buttons'));
})