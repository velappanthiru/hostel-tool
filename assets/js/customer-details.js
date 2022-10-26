$(document).ready(function(){
    var baseUrl = window.location.origin; // ========== current url ===========

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

    // =========== Datatable initialize ============
    // =============================================
    var table = $('#customer-details').DataTable({
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
        "ajax" : {
            url : baseUrl+"/hostel-tool/actions/customer-details.php",
            dataSrc: "data",
            data : function(r){
            }
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
                    <span>${ (row.first_name != '' && row.first_name != null) ? row.first_name :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.last_name != '' && row.last_name != null) ? row.last_name :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.email != '' && row.email != null) ? row.email :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.contact_no != '' && row.contact_no != null) ? row.contact_no :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                    <span>${ (row.gender != '' && row.gender != null) ? row.gender :'--' }</span>
                    `;
                }
            },
            {
                render: function(data,type,row){
                    return`
                        <div class='d-flex justify-content-center align-items-center'>
                            <div class='edit_details cp' data-id='${row.id}'>
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class='delete_details cp' data-id='${row.id}'>
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


    // ============ Edit Details ==============
    // ======================================== 
    $('body').on('click','.edit_details',function(){
        let id = $(this).attr('data-id');
        $.ajax({
            url : baseUrl+"/hostel-tool/actions/edit-details.php",
            method : 'post',
            data : {
                'id' : id
            }
        }).done(function(res){
            var response = JSON.parse(res);
            if(response.statusCode == 200){
                $.confirm({
                    title: 'Add Room Details',
                    content: `
                        <div class="form-group mb-2">
                            <label for="" class="form-label">First Name</label>
                            <input type="text" class="form-control first_name validation" value = "${response.data.first_name}" data-required-field="First Name" data-type="text" id="first_name" name="first_name">
                            <small class="text-danger err-mge"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Last Name</label>
                            <input type="text" class="form-control last_name validation" value = "${response.data.last_name}" data-required-field="Last Name" data-type="text" id="last_name" name="last_name">
                            <small class="text-danger err-mge"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control email validation" value = "${response.data.email}" data-required-field="Email" data-type="text" id="email" name="email">
                            <small class="text-danger err-mge"></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Contact No</label>
                            <input type="text" class="form-control contact_no validation" value = "${response.data.contact_no}" data-required-field="Contact No" data-type="text" id="contact_no" name="contact_no">
                            <small class="text-danger err-mge"></small>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select gender validation" data-required-field="Gender" data-type="select">
                                <option value="">Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
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
                                        'id' : id,
                                        'first_name' : $('#first_name').val(),
                                        'last_name' : $('#last_name').val(),
                                        'email' : $('#email').val(),
                                        'contact_no' : $('#contact_no').val(),
                                        'gender' : $('#gender').val(),
                                    }
                                    $.ajax({
                                        url : baseUrl + '/hostel-tool/actions/update-details.php',
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
                    },
                    onContentReady: function () {
                        $(`select option[value= ${response.data.gender}]`).attr('selected', 'selected');   
                    }

                })
            } else{
                toastr.error(response.message);
            }
        }).fail(function(res){

        })
    })

    // ============ Delete Details ==============
    // ======================================== 
    $('body').on('click','.delete_details',function(){
        let id = $(this).attr('data-id');

        $.ajax({
            url : baseUrl+"/hostel-tool/actions/delete-details.php",
            method : 'post',
            data : {
                'id' : id
            }
        }).done(function(res){
            var response = JSON.parse(res);
            if(response.statusCode == 200){
                toastr.success(response.message);
                renderTableView(table);
            } else{
                toastr.error(response.message);
            }
        }).fail(function(res){
            toastr.error('Something went wrong. Internal server error.')
        })
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

    function renderTableView(table) {
        table.ajax.reload(function () {
        });
    }
})