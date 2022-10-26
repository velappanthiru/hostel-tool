$(document).ready(function() {

    var baseUrl = location.origin;
    
    // ========== Login event ============
    // ===================================
    $('#login-btn').on('click',function(e){
        e.preventDefault();
        let error = 0;

        error += Emptyvalidation();
        
        if(error == 0) {
            
            let email = $('.email').val();
            let password = $('.password').val();

            $.ajax({
                url : 'actions/auth.act.php',
                method : 'post',
                data : {
                    'email' : email,
                    'password' : password
                }
            }).done(function(res){
                var response = JSON.parse(res);
                if(response.statusCode == 200){
                    
                    toastr.success(response.message);
                    resetForm();
                    if(response.role == 'super admin' || response.role == 'admin'){
                        window.location.href = baseUrl + '/hostel-tool/admin/dashboard.php'
                    }
                    else {
                        window.location.href = baseUrl + '/hostel-tool/user/dashboard.php'
                    }
                }
                else if(response.statusCode == 403) {
                    toastr.error(response.message);
                    
                    setTimeout(() => {
                        window.location.href = baseUrl + '/hostel-tool/active-account.php';
                    }, 2000);
                }
                else{
                    toastr.error(response.message);
                }
            }).fail(function(res){
                toastr.error("Something went wrong, Internal server error.");
            })
        }

    })


    // ========== Register event ============
    // ======================================
    $('#register').on('click',function(e){
        e.preventDefault();
        let error = 0;

        error += validation();

        if (error == 0) {
            let form_data = {
                'first_name' : $('.first_name').val(),
                'last_name' : $('.last_name').val(),
                'email' : $('.email').val(),
                'gender' : $('.gender').val(),
                'contant_no' : $('.contant_no').val(),
                'password' : $('.password').val(),
                'cpassword' : $('.cpassword').val(),
            }

            $.ajax({
                url : 'actions/register.php',
                method : 'post',
                data : form_data
            }).done(function(res){
                var response = JSON.parse(res);
                if(response.statusCode == 200){
                    toastr.success(response.message);
                    resetForm();
                    window.location.href = baseUrl + '/hostel-tool/index.php';
                } else{
                    toastr.error(response.message);
                }
            }).fail(function(res){

            })
        }
    })

    // ========== Logout event ==============
    // ======================================
    $('.logout').on('click',function(e){
        e.preventDefault();
        
        $.ajax({
            url : baseUrl + '/hostel-tool/actions/logout.php',
            method : 'get',
        }).done(function(res){
            var response = JSON.parse(res);
            
            if(response.statusCode == 200){
                window.location.href = baseUrl + '/hostel-tool/index.php'
            } 
        }).fail(function(res){

        })
    })

    // ========== Logout event ==============
    // ======================================
    $('#reactive-btn').on('click',function(e){
        e.preventDefault();
        let error = 0;

        error += Emailvalidation();
        
        
        if (error == 0) {
            let email = $('.email').val();
            $.ajax({
                url : baseUrl + '/hostel-tool/actions/active-account.php',
                method : 'post',
                data : {
                    'email' : email
                }
            }).done(function(res){
                var response = JSON.parse(res);
                
                if(response.statusCode == 200){
                    toastr.success(response.message);
                    $('.email').val('');
                } else {
                    toastr.error(response.message);
                }
            }).fail(function(res){
                toastr.error("Something went wrong, Internal server error.");
            })
        }
    })

    notification(); // ===== notification function ======

    function notification() {
        $.ajax({
            url : baseUrl + '/hostel-tool/actions/notification-active.php',
            method : 'get'
        }).done(function(res){
            var response = JSON.parse(res);

            let content = '';
            let data = response.details;
            
            if(typeof data != 'undefined') {
                let lengthArr = data.length;
                
                if(lengthArr > 0) {
                    $('.notification-count').removeClass('d-none');
                    $('.notification-count').text(lengthArr);
                }
            }
            else{
                $('.notification-count').addClass('d-none');
                $('.notification-count').text(0);
            }
         
            if(response.statusCode == 200){

                $.each(data,function(ind,val) {
                    content += `
                    <a href ='${baseUrl}/hostel-tool/admin/account-active.php'>
                        <li class="hover position-relative m-2">
                            <div class="active-req p-3 d-flex justify-content-between align-items-center">
                                <div class="text">
                                    <p class="mb-0">New request to reactived #${val} this account</p>
                                </div>
                                <div class="close-icon cp ms-2">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                            <span class="vertical-line line-red" data-id=${val}></span>
                        </li>
                    </a>
                    `
                })

                
            } else {
                
                content += `<li class="hover position-relative m-2">
                                <div class="no-data p-3">
                                    <p class="mb-0">${response.message}</p>
                                </div>
                            </li>`
            }

            $('.notification-content ul').html(content);
        }).fail(function(res){
            toastr.error("Something went wrong, Internal server error.");
        })
    }
    viewDeactiveAccount()
    function viewDeactiveAccount() {
        $.ajax({
            url : baseUrl + '/hostel-tool/actions/view-deactive-account.php',
            method : 'get'
        }).done(function(res){
            let response = JSON.parse(res);
            let content = '';

            if(response.statusCode == 200) {
                let data = response.details;
                
                $.each(data,function(ind,val) {
                    content += `
                    <tr>
                        <td>${(val.id != '' && val.id != null) ? val.id : '--'}</td>
                        <td>${(val.first_name != '' && val.first_name != null) ? val.first_name : '--'}</td>
                        <td>${(val.last_name != '' && val.last_name != null) ? val.last_name : '--'}</td>
                        <td>${(val.email != '' && val.email != null) ? val.email : '--'}</td>
                        <td>${(val.contact_no != '' && val.contact_no != null) ? val.contact_no : '--'}</td>
                        <td>${(val.is_active != '' && val.is_active != null) ? '<span class="badge-red">In active</span>' : '--'}</td>
                        <td>
                            <div class='d-flex align-items-center mt-1'>
                                <div class='approve cp' data-id='${val.id}'>
                                    <i class="fas text-success fa-check-circle"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    `
                })
            }else {
                content += `
                <tr>
                    <td colspan = '7' class='text-center'>${response.message}</td>
                </tr>
                `
            }

            $('#account-active tbody').html(content);
        }).fail(function(res){
            
        })
    }


    $('body').on('click','.approve',function(){
        let id = $(this).attr('data-id');

        $.ajax({
            url : baseUrl + '/hostel-tool/helpers/mail.php',
            method : 'post',
            data : {
                'id' : id
            }
        }).done(function(res){
            let response = JSON.parse(res);

            
            if(response.statusCode == 200){
                toastr.success(response.message);
                viewDeactiveAccount();
            } else {
                toastr.error(response.message);
            }
        }).fail(function(res) {
            toastr.error("Something is wrong, Please try again later.");
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

    // ====== Password validation ===

    function passwordValidation(){
        let error = 0 ;
        let password_rejex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    
        $('.passwordValidation').each(function(){
    
            let _self = $(this);
            let required_field = _self.attr('data-required-field');
         
            if(_self.val() == ''){
                _self.removeClass('is-valid').addClass('is-invalid');
                _self.parent().find('.err-mge').text(required_field+' field is required.');
                error = 1;
            } else if(!(password_rejex.test(_self.val()))){
                _self.removeClass('is-valid').addClass('is-invalid');
                _self.parent().find('.err-mge').text(required_field+' is invalid.');
                error = 1;
            }
            else{
                _self.removeClass('is-invalid').addClass('is-valid');
                _self.parent().find('.err-mge').text('');
                error = 0;
            }
        })
    
        return error;
    }

    // ====== Email validation ===

    function Emailvalidation(){
        let error = 0;

        let email_rejex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        $('.emailvalidation').each(function(){
            let _self = $(this);
            let required_field = _self.attr('data-required-field');

            if(_self.val() == ''){
                _self.removeClass('is-valid').addClass('is-invalid');
                _self.parent().find('.err-mge').text(required_field+' field is required.');
                error = 1;
            } else if(!(email_rejex.test(_self.val()))){
                _self.removeClass('is-valid').addClass('is-invalid');
                _self.parent().find('.err-mge').text(required_field+' is invalid.');
                error = 1;
            }
            else{
                _self.removeClass('is-invalid').addClass('is-valid');
                _self.parent().find('.err-mge').text('');
                error = 0;
            }
        })

        return error;
    }

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
                    _self.addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
                }
            }
            else if(type == 'email') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else if(!(email_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error = 1;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
                }
            }
            else if(type == 'password') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else if(!(password_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error = 1;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
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
                    error = 0;
                }
            }
            else if(type == 'select'){
                if(_self.val() == ''){
                    _self.addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
                }
            }
            else if(type == 'phone') {
                if(_self.val() == ''){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' field is required.');
                    error = 1;
                } else if(!(phone_rejex.test(_self.val()))){
                    _self.removeClass('is-valid').addClass('is-invalid');
                    _self.parent().find('.err-mge').text(required_field+' is invalid.');
                    error = 1;
                }
                else{
                    _self.removeClass('is-invalid').addClass('is-valid');
                    _self.parent().find('.err-mge').text('');
                    error = 0;
                }
            }
        })
        return error;
    }

    function resetForm () {
        $('.validation').val('');
        $('.validation').removeClass('is-valid');
    }
})