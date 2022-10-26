$(document).ready(function(){

    let baseUrl = window.location.origin;

    $('#branch').on('change',function(){
        let val = $(this).val();
        $.ajax({
            url : baseUrl+"/hostel-tool/actions/available-room.php",
            method : 'get',
            data : {
                'branch' : val
            }
        }).done(function(res) {
            let response = JSON.parse(res);

            if(response.statusCode == 200) {
                let content = '';

                content += `<option value="">Select Room no</option>`;

                $.each(response.data,function(ind,val){
                    content += `
                    <option value = '${val.room_num}'>${val.room_num}</option>
                    `
                })

                $('#room_number').html(content)
            }
        }).fail(function(res){

        })
    })


    $('#room_number').on('change',function(){
        let val = $(this).val();
        $.ajax({
            url : baseUrl+"/hostel-tool/actions/availability.php",
            method : 'get',
            data : {
                'room_num' : val
            }
        }).done(function(res) {
            let response = JSON.parse(res);

            if(response.statusCode == 200) {
                let content = '';
                let data = response.data;
                $.each(data,function(ind,val) {
                    $('#available_seat').val(val.avail_seat);
                    $('#fees').val(val.fees);
                    $('#seater').val(val.seater);
                    $('#ad_amount').val(3000)
                })
            }
        }).fail(function(res){

        })
    })

    $('#book_room').on('click',function(e){
        e.preventDefault();
        let error = 0;
       
        error += validation();
        error += checkRoomAvailable();

        $(".disabled_cls").removeAttr("disabled");
        let form_data = $('#booking-room').serialize();
        $(".disabled_cls").attr("disabled", "disabled");
        
        if(error == 0) {
            $.ajax({
                url : baseUrl+"/hostel-tool/actions/book-room.php",
                method : 'post',
                data : form_data
            }).done(function(res) {
                console.log(res);
                let response = JSON.parse(res);
    
                if(response.statusCode == 200) {
                    toastr.success(response.message);
                    $('.empty').val('');
                    $('input:checkbox').prop('checked', false);
                }else{
                    toastr.error(response.message);
                }
            }).fail(function(res){
                toastr.error("Something went wrong, Internal server error.");
            })
        }
    })


    function validation() {
        let error = 0;
        let email_rejex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let password_rejex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
        var phone_rejex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
        
        $('.validation').each(function(){
            let _self = $(this);
            
            let required_field = _self.attr('data-required-field');

            let type = _self.attr('data-type');
            
            if(type == 'text') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
            else if(type == 'email') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else if(!(email_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error = 1;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
            else if(type == 'password') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else if(!(password_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error++;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
            else if (type == 'cpassword') {
                let password = $('.password').val();

                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error =1;
                } else if(password != _self.val()){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text("The password confirmation does not match");
                    error =1;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
            else if(type == 'select'){
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            } else if(type == 'select2') {
                if(_self.val() == ''){
                    _self.parent().find('.select2-selection--single').removeClass('i-valid').addClass('i-invalid');
                    _self.parent().find('.select2-selection--multiple').removeClass('i-valid').addClass('i-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else{
                    _self.parent().find('.select2-selection--multiple').removeClass('i-invalid').addClass('i-valid');
                    _self.parent().find('.select2-selection--single').removeClass('i-invalid').addClass('i-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
            else if(type == 'phone') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error++;
                } else if(!(phone_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error++;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                }
            }
        })
        return error;
    }

    function checkRoomAvailable() {
        let avail = $('#available_seat').val();
        let number_seat = $('#number_seat').val();
        let error = 0;

        if(number_seat == ''){
            $('#number_seat').removeClass('is-valid').addClass('is-invalid');
            $('#number_seat').parent().find('.err-mge').text('Number of seat field is required.');
            error++;
        }
        else if(avail < number_seat) {
            $('#number_seat').removeClass('is-valid').addClass('is-invalid');
            $('#number_seat').parent().find('.err-mge').text('Number of seat must less of available seat.');
            error++;
        }else {
            $('#number_seat').removeClass('is-invalid').addClass('is-valid');
            $('#number_seat').parent().find('.err-mge').text('');
        }

        return error;
    }

    $('#flexCheckDefault').on('change',function(){
        if ($(this).is(':checked')) {
            // I'm checked let's do something
            let curr_address = $('#curr_address').val();
            let curr_city = $('#curr_city').val();
            let curr_state = $('#curr_state').val();
            let curr_pincode = $('#curr_pincode').val();
            if(curr_address == '' && curr_city == '' && curr_pincode == '' && curr_state == '') {
                $(this).parent().find('.err-mge').text('Fill out all current address fields')
            }else {
                $('#permanent_address').val(curr_address);
                $('#permanent_city').val(curr_city);
                $('#permanent_state').val(curr_state);
                $('#permanent_pincode').val(curr_pincode);
                $(this).parent().find('.err-mge').text('')
            }
            
        }
    })
})