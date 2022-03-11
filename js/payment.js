// click check box hidden form 2
document.getElementById('check_box').onclick = function(e){
    if (this.checked){
        $('.form-second').addClass('hidden');
    }else{
        $('.form-second').removeClass('hidden');
    }
};

// validate form order
$('#name').keyup(function(){
    var name = $(this);
    var error = name.parent().find('.error');
    if(name.val() == 0){
        if(name.hasClass('false') == false){
            name.addClass('false');
            name.after("<label class='error error_name'>Vui lòng nhập tên khách hàng</label>");
        }
    }else{
        name.removeClass('false');
        $('.error_name').remove();
    }
});
$('#email').keyup(function(){
    var email = $(this);
    if(email.val() == 0){
        if(email.hasClass('false') == false){
            email.addClass('false');
            email.after("<label class='error error_email'>Vui lòng nhập địa chỉ email</label>");
        }
    }else{
        email.removeClass('false');
        $('.error_email').remove();
    }
});
$('#phone').keyup(function(){
    var phone = $(this);
    if(phone.val() == 0){
        if(phone.hasClass('false') == false){
            phone.addClass('false');
            phone.after("<label class='error error_phone'>Vui lòng nhập số điện thoại</label>");
        }
    }else{
        phone.removeClass('false');
        $('.error_phone').remove();
    }
});
$('#address').keyup(function(){
    var address = $(this);
    if(address.val() == 0){
        if(address.hasClass('false') == false){
            address.addClass('false');
            address.after("<label class='error error_address'>Vui lòng nhập địa chỉ</label>");
        }
    }else{
        address.removeClass('false');
        $('.error_address').remove();
    }
});
$('#ship_name').keyup(function(){
    var ship_name = $(this);
    if($('#check_box').is(':checked')){
        return;
    }
    if(ship_name.val() == 0){
        if(ship_name.hasClass('false') == false){
            ship_name.addClass('false');
            ship_name.after("<label class='error error_ship_name'>Vui lòng nhập tên khách hàng</label>");
        }
    }else{
        ship_name.removeClass('false');
        $('.error_ship_name').remove();
    }
});
$('#ship_phone').keyup(function(){
    var ship_phone = $(this);
    if($('#check_box').is(':checked')){
        return;
    }
    if(ship_phone.val() == 0){
        if(ship_phone.hasClass('false') == false){
            ship_phone.addClass('false');
            ship_phone.after("<label class='error error_ship_phone'>Vui lòng nhập số điện thoại</label>");
        }
    }else{
        ship_phone.removeClass('false');
        $('.error_ship_phone').remove();
    }
});
$('#ship_address').keyup(function(){
    var ship_address = $(this);
    if($('#check_box').is(':checked')){
        return;
    }
    if(ship_address.val() == 0){
        if(ship_address.hasClass('false') == false){
            ship_address.addClass('false');
            ship_address.after("<label class='error error_ship_address'>Vui lòng nhập địa chỉ</label>");
        }
    }else{
        ship_address.removeClass('false');
        $('.error_ship_address').remove();
    }
});

$('.btn-submit-form').click(function(){
    var name = $('#name').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var ship_name = $('#ship_name').val();
    var ship_phone = $('#ship_phone').val();
    var ship_address = $('#ship_address').val();
    var ship_note = $('#ship_note').val();
    var error = 0;
    $('.error').remove();
    if(name == ''){
        $('#name').after("<label class='error error_name'>Vui lòng nhập tên khách hàng</label>");
        error = 1;
    }
    if(email != ''){
        if( !validateEmail(email)){
            $('#email').after("<label class='error error_email'>Sai định dạng email</label>");
            error = 1;
        }
    }else{
        $('#email').after("<label class='error error_email'>Vui lòng nhập địa chỉ email</label>");
        error = 1;
    }
    if(phone != ''){
        if( !validatePhone(phone)){
            $('#phone').after("<label class='error error_phone'>Sai định dạng số điện thoại</label>");
            error = 1;
        }
    }else{
        $('#phone').after("<label class='error error_phone'>Vui lòng nhập số điện thoại</label>");
        error = 1;
    }
    if(address == ''){
        $('#address').after("<label class='error error_address'>Vui lòng nhập địa chỉ</label>");
        error = 1;
    }
    if($('#check_box').is(':checked')){
        ship_name = name;
        ship_phone = phone;
        ship_address = address;
    }else{
        if(ship_name == ''){
            $('#ship_name').after("<label class='error error_ship_name'>Vui lòng nhập tên người nhận</label>");
            error = 1;
        }
        if(ship_phone != ''){
            if( !validatePhone(ship_phone)){
                $('#ship_phone').after("<label class='error error_ship_phone'>Sai định dạng số điện thoại</label>");
                error = 1;
            }
        }else{
            $('#ship_phone').after("<label class='error error_ship_phone'>Vui lòng nhập số điện thoại người nhận</label>");
            error = 1;
        }
        if(ship_address == ''){
            $('#ship_address').after("<label class='error error_ship_address'>Vui lòng nhập địa chỉ người nhận</label>");
            error = 1;
        }
    }
    if(error == 1){
        return;
    }
    $.ajax({
        type: "POST",
        url: "./ajax/payment.php",
        data: {
            name : name,
            phone : phone,
            email : email,
            address : address,
            ship_name : ship_name,
            ship_phone : ship_phone,
            ship_address : ship_address,
            ship_note : ship_note,
        },
        dataType: "json",
        beforeSend : function(){
            $('.btn-submit-form').html('Đang xử lý <i class="ic-loading-2"></i>');
        },
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                alert(data.mes);
                window.location.href = '/';
            }
        },
        complete: function() {
            $('.btn-submit-form').html('Đặt ngay');
        },
    });

});

function validatePhone($phone){
    var phoneReg = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
    return phoneReg.test($phone);
}
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

function getParent(element, selector) {
    while (element.parentElement) {
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }
        element = element.parentElement;
    }
}