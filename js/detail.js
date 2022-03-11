// Detail product slick
$('#multiple-items').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplaySpeed :3000,
    pauseOnFocus: true,
    pauseOnHover: true,
    adaptiveHeight : false,
    asNavFor: "#thumbnail-slick",
    prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
    nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
});
$("#thumbnail-slick").slick({
    infinite: true,
    slidesToShow: 3,
    focusOnSelect : true,
    arrows: false,
    autoplaySpeed :3000,
    pauseOnFocus: true,
    pauseOnHover: true,
    adaptiveHeight : false,
    asNavFor: "#multiple-items"
});
// Show img when click
$('.send_img').click(function(){
    $('.file-detail').remove();
    $('.input-img').click();
});
var sizeScreen = $(window).width();
// list product relate slick

if (sizeScreen > 1024) {
    $('#list-pr').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
} else if(sizeScreen > 768) {
    $('#list-pr').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
} else if(sizeScreen > 425) {
    $('#list-pr').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
}else if(sizeScreen <= 425){
    $('#list-pr').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
}

// click button add cart
$('.btn-add-to-cart').click(function(){
    var input = $(this).parent().find('input');
    var number = input.val();
    var id = $('#id_product').val();
    if(number < 1){
        alert ('Vui lòng nhập số lượng lớn tối thiểu là 1');
        input.val('1');
    }else{
        $.ajax({
            url : '../ajax/add_cart.php',
            type : 'POST',
            data : {
                id : id,
                quantity : number,
                action : 'add',
            },
            dataType : 'JSON',
            beforeSend : function(){
                $('.btn-add-cart i').addClass('ic-loading');
            },
            success : function(data){
                if(data.result == false){
                    $('#form_add_cart').after("<label class='error'>"+data.mes+"</label>");
                }else{
                    $('.error').remove();
                    alert(data.mes);
                    input.val('1');
                    window.location.reload();
                }
            },
            complete: function() {
                $('.btn-add-cart i').removeClass('ic-loading');
                $('.btn-add-cart').removeClass('.btn-add-to-cart');
            },
        });
    }
    
});
// click order now
$('.contact-supplier').click(function(){
    var id = $(this).val();
    var number = 1;
    $.ajax({
        url : '../ajax/add_cart.php',
        type : 'POST',
        data : {
            id : id,
            quantity : number,
            action : 'add',
        },
        dataType : 'JSON',
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                window.location.href = './gio-hang.html';
            }
        },
    });
});
// scroll param
$(".para-detail").click(function() {
    $('html,body').animate({
        scrollTop: $(".info-product-body").offset().top},
        'slow');
});

// compact button
$('.btn-compact .compact').click(function(){
    var x = this.innerHTML;
    if (x == 'Thu gọn <i class="ic-angle-up"></i>') {
        this.innerHTML = 'Xem thêm <i class="ic-angle-down"></i>';
    }else{
        this.innerHTML = 'Thu gọn <i class="ic-angle-up"></i>';
    }
    $('.info-product-intro .product-intro-body').toggleClass('hidden');
});

// show and hidden button send comment
$('.input-txt').keyup(function(){
    var x = $(this).val();
    var count = x.length;
    var parent = $(this).parent().find('.send_comment');
    if (count > 1) {
        parent.removeClass('hidden');
    }else{
        parent.addClass('hidden');
    }
});

function showForm(e) {
    var value = $(e).parents().find('.input-comment-reply').val();
    if(value === ''){
        alert ('Vui lòng điền nội dung bình luận');
        return;
    }
    else{
        $('#form-modal').addClass('show');
        $('body').addClass('modal-fade');
    }
}
//modal form
$('.send_comment').click(function(){
    var comment = $('.input-txt').val();
    if(comment === ''){
        alert ('Vui lòng điền nội dung bình luận');
        return;
    }else{
        $('#form-modal').addClass('show');
        $('body').addClass('modal-fade');
    }
    
});
// Hover star
$('.full').click(function(){
    var value = $(this).attr('title');
    $('.desc-star').text(value);
});
$('.full').hover(function(){
    var value = $(this).attr('title');
    $('.desc-star').text(value);
});
// Comment ajax
$('.md-form-btn').click(function(){
    var rating = '';
    var gender = '';
    var name = $("input[name=name]").val();
    var email = $("input[name=email]").val();
    var phone = $("input[name=phone]").val();
    var id_product = $("input[name=id_product]").val();
    var parent = $("input[name=parent]").val();
    var data = new FormData();
    if(parent != 0){
        var comment = $('.input-comment-reply').val();
    }else{
        var comment = $('.input-comment').val();
    }
    $('.rating-comment').find('input[type=radio]').each(function(index){
        if ($(this).is(':checked')) {
            rating = $(this).val();
        }
    });
    $('.input_radio').find('input[type=radio]').each(function(index){
        if ($(this).is(':checked')) {
            gender = $(this).val();
        }
    });
    if(name == ''){
        $("input[name=name]").after("<label class='error error_name'>Vui lòng nhập họ và tên</label>");
    }
    if(email != ''){
        $(".error_email").remove();
        if( !validateEmail(email)){
            $("input[name=email]").after("<label class='error error_email'>Sai định dạng email</label>");
        }
    }
    if(phone != ''){
        $(".error_phone").remove();
        if(!validatePhone(phone)){
            $("input[name=phone]").after("<label class='error error_phone'>Sai định dạng số điện thoại</label>");
        }
    }
    if(comment === ''){
        alert ('Vui lòng điền nội dung bình luận');
        return;
    }
    var oject = $( '#files' ).prop('files');
    if(oject.length > 3){
        alert ('Vui lòng chọn tối đa 3 ảnh');
    }
    for(let i =0; i < oject.length; i++){
        data.append('file[]',oject[i]);
    }
    data.append('id_product',id_product)
    data.append('parent',parent)
    data.append('name',name)
    data.append('phone',phone)
    data.append('email',email)
    data.append('gender',gender)
    data.append('comment',comment)
    data.append('rate',rating)

    $.ajax({
        type: "POST",
        url: "./ajax/add_comment.php",
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: data,
        dataType: "json",
        beforeSend : function(){
            $('.md-form-btn').html('Đang xử lý <i class="ic-loading-2"></i>');
        },
        success : function(data){
            $("input[name=parent]").val('0');
            $('.input-txt').val('');
            $('.file-detail').remove();
            $('body').removeClass('modal-fade');
            $('#form-modal').removeClass('show');
            var html ='';
            if(data.images != ''){
                for(let i = 0; i < data.images.length; i++){
                    html += '<img class="lazyload" src="/images/loading.gif" data-src="../pictures/comment/'+data.images[i]+'" alt="comment image">';
                }
            }
            if(parent == 0){
                $('.fetch_comment').before('<div class="show-comment"><div class="col-md-3 info-user"><div class="cmt-avatar"><img class=" lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_83.png" alt="Avtar user"></div><div class="name-date-cmt-mobile"><p class="cmt-name">'+name+' </p><div class="cmt-date-time"><span class="cmt-date">'+data.day+'</span> <span class="cmt-time">  '+data.time+'</span></div></div><span class="pending">(Bình luận của bạn đang chờ được duyệt)</span></div><div class="col-md-9 info-cmt"><p class="cmt-content">'+comment+'</p><div class="cmt-image">'+html+'</div><a href="javascript:void(0)" class="reply" id="'+data.id_comment+'">Trả lời</a></div></div>');
            }else{
                $('#'+parent).after('<div class="show-reply d-flex"><i class="ic-top-result"></i><div class="reply-avt"><img class="lazyload" src="/images/loading.gif" data-src="../pictures/users/Ellipse_84.png"></div><div class="reply-cmt"><p class="reply-cmt-name">'+name+' <span class="pending">(Bình luận của bạn đang chờ được duyệt)</span></p><p class="reply-cmt-content">'+comment+'</p><div class="cmt-date-time"><span class="cmt-date">'+data.day+'</span>  <span class="cmt-time">  '+data.time+'</span></div></div></div>')
            }
        },
        complete: function() {
            $('.form-reply').remove();
            $('.md-form-btn').html('Cập nhật');
        },
    });
});
$(document).on('click', '.reply', function(event){
    var parent = $(this).attr("id");
    $(".id_parent").val(parent);
    var pr = $(this).parent().find('.form-reply');
    if (pr.length > 0) {
        $('.form-reply').remove();
    }else{
        $(this).after(`<div class="comment-are mt-3 form-reply">
                                <form method="POST">
                                    <textarea name="comment" class="input-txt input-comment-reply" placeholder="Mời bạn để lại bình luận..." required></textarea>
                                    <div class="group-input justify-content-lg-end">
                                        <div class="group-btn-right">
                                            <button type="button" class="send_comment" onclick="showForm(this)">Gửi bình luận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>`);
        $('.input-comment-reply').focus();
    }
});

// newlatter
$('.btn-new-letter').submit(function(event){
    var value = $(this).find('.new_letter').val();
    var id = $(this).find('.id_product').attr('data-id');
    $.ajax({
        type: "POST",
        url: "./ajax/new_letter.php",
        data: {value : value,id :id},
        dataType: "json",
        success:function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                alert(data.mes);
                window.location.reload();
            }
        },
    });
});
// gallery product
$('.show-gallery').click(function(){
    $('#gallery').css('display','block');
    $('body').addClass('modal-fade');
});
function closeModal() {
    document.getElementById("gallery").style.display = "none";
    $('body').removeClass('modal-fade');
}
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("gallery-slide");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
// validate form
$("input[name=name]").keyup(function(){
    var value = $(this).val();
    if(value == ''){
        $('.error_name').remove();
        $("input[name=name]").after("<label class='error error_name'>Vui lòng nhập họ và tên</label>");
    }else{
        $(".error_name").remove();
    }
});

function validatePhone($phone){
    var phoneReg = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
    return phoneReg.test($phone);
}
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}
function countWords(str) {
    return str.trim().split(/\s+/).length;
}


// dropdown info product page detail
var btns = document.querySelectorAll('.btn-ipcm');
for(btn of btns){
    btn.onclick = showSlide;
}

function showSlide(event){
    var parent =  getParent(event.target, ".parent-btn-ipcm");
    var slide = parent.querySelector('.slideToggle');
    var button = parent.querySelector('.btn-ipcm i');
    button.classList.toggle('ic-angle-down')
    slide.classList.toggle('hidden');
}
// show image
// Hàm thực hiện việc xử lý files sau khi User chọn
function handleFileSelect(event) {
    // Lấy danh sách các files mà User chọn
    var files = event.target.files;
    if(files.length > 3){
      alert('Vui lòng chọn tối đa 3 ảnh');
      return;
    }
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        // Duyệt từng file trong danh sách và render vào DIV trống đặt sẵn
        renderFileInfo(file);
    }
}

function getIconremove(select){
    var removes = document.querySelectorAll(select);
    for(re of removes){
        re.onclick = removeParent
    }
}

function removeParent(event) {
    var parent = getParent(event.target,".file-detail");
parent.remove();
}
function getParent(element, selector) {
    while(element.parentElement){
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }element = element.parentElement;
    }
}
// Hàm thực hiện tạo HTML cho việc hiển thị chi tiết một file nào đó truyền vào
function renderFileInfo(file) {
    // Khởi tạo đối tượng `FileReader`
    var fileReader = new FileReader();
    // Hàm xử lý sự kiện `onload` sau khi file được load
    fileReader.onload = function(event) {
        // Truy cập vào thuộc tính `result` để lấy được dữ liệu File dưới dạng `data URL`
        var imageUrl = event.target.result,
        fileDetailHtml = '',
        detailElement = document.createElement('div');

        // Trường hợp là file ảnh thì hiển thị thêm Thumbnail
        if (file.type.match('image.*')) {
            fileDetailHtml += '<img class="thumbnail" src="' + imageUrl + '" />';
        }
        fileDetailHtml += '<i class="ic-remove"></i>'
        detailElement.className = 'file-detail';
        detailElement.innerHTML = fileDetailHtml;

        // Sau khi chuẩn bị xong thông tin thì ghi dữ liệu HTML vào DIV trống chuẩn bị sẵn
        document.getElementById('files-list').appendChild(detailElement);
    getIconremove(".ic-remove");

    }
    // Truyền `File` vào đối tượng `FileReader` và chỉ thị đọc ra dữ liệu dưới dạng `data URL`
    // Sau khi load thành công sẽ thực hiện đoạn code trong `onload` function phía trên
    fileReader.readAsDataURL(file);
}
// Gắn sự kiện xử lý files sau khi User chọn
document.getElementById("files").addEventListener('change', handleFileSelect, false);