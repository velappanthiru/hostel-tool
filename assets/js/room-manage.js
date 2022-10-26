$(document).ready(function () {

    let location  = window.location.origin;


    var showExportButton = [];
    showExportButton =[
        { 
            extend: 'csv',
            text: 'Export Csv',
            title: 'customers_details' + moment(new Date()).format("YYYY-MM-DD_h.mm A"),
            exportOptions: {
                columns: "thead th:not(.noExport)"
            },
        } ,
        { 
            extend: 'pdf',
            text: 'Export Pdf',
            title: 'customers_details' + moment(new Date()).format("YYYY-MM-DD_h.mm A"),
            exportOptions: {
                columns: "thead th:not(.noExport)"
            },
        } 
    ];

    $('#add_room').on('click',function(e){
        e.preventDefault();

        $.confirm({
            title: 'Add Room Details',
            content: `
                <div class="form-group mb-2">
                    <label for="" class="form-label">Room Number</label>
                    <input type="text" class="form-control room_num validation" data-required-field="Room Number" data-type="text" id="room_num" name="room_num">
                    <small class="text-danger err-mge"></small>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="form-label">Seater</label>
                    <input type="text" class="form-control seater validation" data-required-field="Seater" data-type="text" id="seater" name="seater">
                    <small class="text-danger err-mge"></small>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="form-label">Branch</label>
                    <select class="form-select validation" id = 'branch' data-required-field="Branch" aria-label="Default select example">
                        <option value=''>Choose</option>
                        <option value="b1">Branch 1</option>
                        <option value="b2">Branch 2</option> 
                        <option value="b3">Branch 3</option>                                           
                    </select>
                    <small class="text-danger err-mge"></small>
                </div>
                <div class="form-group mb-2">
                    <label for="" class="form-label">Fees Per month</label>
                    <input type="text" class="form-control fees validation" data-required-field="Fees Per month" data-type="text" id="fees" name="fees">
                    <small class="text-danger err-mge"></small>
                </div>
            `,
            type: 'dark',
            buttons: {
                confirm : {
                    text : 'Add To Room',
                    btnClass : 'btn-blue',
                    action :  function(){
                        let error = 0;
                        error += Emptyvalidation();

                        if (error > 0) {
                            return false;
                        } else{

                            let form_data = {
                                'room_num' : $.trim($('#room_num').val()),
                                'seater' : $.trim($('#seater').val()),
                                'branch' : $.trim($('#branch').val()),
                                'fees' : $.trim($('#fees').val()),
                            }
                            $.ajax({
                                url : location + '/hostel-tool/actions/add-room.php',
                                method : 'post',
                                data : form_data
                            }).done(function(res) {
                                var response = JSON.parse(res);
                                if(response.statusCode == 200){
                                    toastr.success(response.message);
                                    renderTableView(table)
                                } else{
                                    toastr.error(response.message);
                                }
                            }).fail(function(res) {

                            })
                        }
                    }
                },
                cancel: function () {
                    //close
                },
            }
        })




        // ====== Empty validation ===

        function Emptyvalidation(){
            let error = 0;
            $('.validation').each(function(){
                let _self = $(this);
                
                let required_field = _self.attr('data-required-field');
            
                if(_self.val() == ''){
                    _self.addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
                }
        
            })
            return error;
        }
    })


    var table = $('#room-details').DataTable({
        "processing": true,
        "pageLength": 25,
        "lengthMenu": [15, 25, 50, 100, 150, 200, 300],
        "pagingType": "simple_numbers",
        "fixedHeader": {
            header: 100,
            headerOffset: 0
        },
        "ajax" : {
            url : location +"/hostel-tool/actions/room-details.php",
            dataSrc: "data",
            // data : function(r){
            // }
        },
        "columns": [
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.id != '' && row.id != null) ? row.id :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.room_num != '' && row.room_num != null) ? row.room_num :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.seater != '' && row.seater != null) ? row.seater :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.branch != '' && row.branch != null) ? row.branch :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.fees != '' && row.fees != null) ? row.fees :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.lunch_date != '' && row.lunch_date != null) ? row.lunch_date :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                        <div class='d-flex justify-content-center align-items-center'>
                                <div class='edit_todo cursor-pointer' data-id='${row.id}'>
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class='delete_todo cursor-pointer' data-id='${row.id}'>
                                    <i class="fa-solid fa-trash-can ms-3"></i>
                                </div>
                        </div>
                    `;
                }
            },

        ],
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


    function renderTableView(table) {
        table.ajax.reload(function () {
        });
    }
})