$( "#top-search" ).focus(function() {
    alert( "Handler for .keydown() called." );
});
$('#btn-modal').click(function(){
    $('#filter-modal').addClass('show');
    $('body').addClass('modal-fade');
});
$('.btn-modal-exit').click(function(){
    $('#filter-modal').removeClass('show');
    $('body').removeClass('modal-fade');
});
$('#modal-footer-cancel').click(function(){
    $('#filter-modal').removeClass('show');
    $('body').removeClass('modal-fade');
});
$('.modal-footer .modal-footer-fisrt').click(function(){
    $('#filter-modal').removeClass('show');
    $('body').removeClass('modal-fade');
});
$('#stock-filter-modal').click(function(){
    document.getElementById("stock-filter2").classList.toggle("show-view");
});
$('#filter2-modal').click(function(){
    document.getElementById("modal-filter-2").classList.toggle("show-view");
});

// modal cart
$('#cart-btn').click(function(){
    $('#cart-modal').addClass('show');
    $('body').addClass('modal-fade');
});
$('.btn-modal-close').click(function(){
    $('#cart-modal').removeClass('show');
    $('body').removeClass('modal-fade');
    $('#form-modal').removeClass('show');
});

// plus minus number
$('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
});
$('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
});
// delete product in cart
$('.delete-item').click(function(event){
    var parent = getParent(event.target,'.cart-item');
    id = $(this).val();
    $('.cart_item'+id).remove();
    $.ajax({
        url : '../ajax/add_cart.php',
        type : 'POST',
        data : {
            id : id,
            action : 'delete',
        },
        dataType : 'JSON',
        success : function(data){
            $('.total_item').text(data.num);
            $('.total_price').text(data.total+' đ');
            $('.cart-badge').text(data.num);
            if(data.num == 0){
                $('.mb-left').removeClass('active');
                $('.info-cart-btn .btn-cart').removeClass('active');
            }
        },
    });
});
// validate input number product
$('.numberPlace').bind("input change", function(){
    var num = $(this).val();
    var id = $(this).attr('name');
    if(num < 1){
        alert ('Vui lòng nhập giá trị lớn hơn 0');
        $(this).val('1');
    }else{
        $.ajax({
            url : '../ajax/add_cart.php',
            type : 'POST',
            data : {
                id : id,
                quantity : num,
                action : 'update',
            },
            dataType : 'JSON',
            success : function(data){
                $('.total_item').text(data.num);
                $('.total_price').text(data.total+' đ');
                $('.cart-badge').text(data.num);
            },
        });
    }
});

// dell cart
$('.delete-cart').click(function(){
    $.ajax({
        url : '../ajax/del_cart.php',
        type : 'POST',
        data : {
            action : 'delete_all',
        },
        dataType : 'JSON',
        success : function(data){
            alert(data.mes);
            window.location.reload();
        },
    });
});


function getParent(element, selector) {
    while(element.parentElement){
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }element = element.parentElement;
    }
}
function navbar_menu() {
    document.getElementById("navbar-menu").classList.toggle("show");
}

// dropdown
function filter1dropdown() {
    document.getElementById("filter1").classList.toggle("show-view");
    document.getElementById("filter1-btn").classList.toggle("filter1-btn-width");
    document.getElementById("ic-filter1-expand").classList.toggle("d-none");
}
function stockfilter(){
    document.getElementById("stock-filter").classList.toggle("show-view");
    document.getElementById("filter1-btn").classList.toggle("ft1-btn-width");
}
function filter2(){
    document.getElementById("filter2").classList.toggle("show-view");
}
function searchdropdown(){
    document.getElementById("suggestion-box").classList.add(("show"))
}
function searchdropdown2(){
    document.getElementById("suggestion-box2").classList.add(("show"))
}
// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('#search-box dropdown show')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

//accordion
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight+10 + "px";
            panel.style.minHeight = panel.scrollHeight+15 +"px";
        }
    });
}
// accordion2
var acc = document.getElementsByClassName("accordion2");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "none") {
            panel.style.display = "grid";
        } else {
            panel.style.display = "none";
        }
    });
}

// search ajax
// $('.search-box').keyup(function(){
//     var key = $(this).val();
//     $.ajax({
//         type : 'POST',
//         url : './ajax/search.php',
//         data : {key :key},
//         dataType : 'json',
//         success : function (data){
//             if(data.result == true){
//                 $('.output-search').html(data.output1);
//                 $('.suggestion-body .list-group').html(data.output2);
//             }else{
//                 $('.output-search').html(data.output1);
//                 $('.suggestion-body .list-group').html(data.output2);
//             }
//         }
//     });
// });

// add 1 item to cart
function addToCart(id){
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
        beforeSend : function(){
            $(this).html('<i class="ic-loading"></i>');
        },
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                alert(data.mes);
                window.location.reload();
            }
        },
        complete: function() {
            $(this).html('<i class="ic-cart"></i>');
        },
    });
}
$('.button-add-cart').click(function(){
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
        beforeSend : function(){
            $(this).html('<i class="ic-loading"></i>');
        },
        success : function(data){
            if(data.result == false){
                alert(data.mes);
            }else{
                alert(data.mes);
                window.location.reload();
            }
        },
        complete: function() {
            $(this).html('<i class="ic-cart"></i>');
        },
    });
});

// click filter
$('.filter').click(function(){
    $(this).toggleClass('active');
    var array = [];
    $('.filter').each(function(index){
        elm = $(this);
        var value = elm.val();
        if(elm.hasClass('active')){
            array.push(value);
        }
    });

    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            list_filter : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});

$('.input-filter').click(function(){
    var array = [];
    $('.filter_product').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array.push(value);
        }
    });
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            filter_product : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});
$('.input_stock').click(function(){
    var array = [];
    $('.stock_filter').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array.push(value);
        }
    });
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            stock_filter : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});
$('.input_manu').click(function(){
    var array = '';
    $('.manufacturer').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array += value+',';
        }
    });
    array = array.slice(0,-1);
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            hang_sx : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});
$('.input_cate').click(function(){
    var array = '';
    $('.category').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array += value+',';
        }
    });
    array = array.slice(0,-1);
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            loai_may : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});
$('.input_connect').click(function(){
    var array = '';
    $('.connect').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array += value+',';
        }
    });
    array = array.slice(0,-1);
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            ket_noi : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output2);
        }
    });
});
$('.input_paper').click(function(){
    var array = '';
    $('.paper').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            value = $(this).val();
            array += value+',';
        }
    });
    array = array.slice(0,-1);
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            kho_giay : array,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output3);
        }
    });
});

$('.apply_button').click(function(){
    var price_first = $('.price_first').val();
    var price_second = $('.price_second').val();
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            price_first : price_first,
            price_second : price_second,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output3);
        }
    });
});

$('.apply-modal').click(function(){
    var price_first = $('.price_first_modal').val();
    var price_second = $('.price_second_modal').val();
    $.ajax({
        url : '../ajax/filter.php',
        type : 'POST',
        data : {
            price_first : price_first,
            price_second : price_second,
        },
        dataType : 'JSON',
        beforeSend : function(){
            $('.load-bg').html('<div class="no-found"><img src="../images/icon/loading-found.gif" alt="Đang tìm kiếm"></div>');
        },
        success : function(data){
            $('.top-sale').html(data.output1);
            $('.top-discount').html(data.output2);
            $('.top-view').html(data.output3);
        }
    });
});
$('.btn-filter-product').click(function(){
    var elm = $(this);
    if(elm.hasClass('active')){
        $('.btn-filter-product').removeClass('active');
    }else{
        $('.btn-filter-product').removeClass('active');
        elm.addClass('active');
    }
});
$('.apply-modal-2').click(function(){
    var url = '?action=filter';

    var manu ='';
    $('.manu-modal').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            manu += $(this).val()+'%2C';
        }
    });
    if(manu != ''){
        manu = manu.slice(0,-3);
        url += `&manu=${manu}`;
    }
    var cate ='';
    $('.category_3').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            cate += $(this).val()+'%2C';
        }
    });
    if(cate != ''){
        cate = cate.slice(0,-3);
        url += `&cate=${cate}`;
    }
    var connect ='';
    $('.connect_3').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            connect += $(this).val()+'%2C';
        }
    });
    if(connect != ''){
        connect = connect.slice(0,-3);
        url += `&connect=${connect}`;
    }
    var paper ='';
    $('.paper_3').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            paper += $(this).val()+'%2C';
        }
    });
    if(paper != ''){
        paper = paper.slice(0,-3);
        url += `&paper=${paper}`;
    }
    const price_first = $('.price_first_modal').val().replace(/\D/g, "");
    const price_second = $('.price_second_modal').val().replace(/\D/g, "");
    url += `&min=${price_first}&max=${price_second}`;

    $('.btn-filter-product').each(function(index){
        elm = $(this);
        if(elm.hasClass('active')){
            url += `&filter=${$(this).val()}`;
        }
    });
    var product = '';
    $('.filter_product_3').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            product += $(this).val()+'%2C';
        }
    });
    if(product != ''){
        product = product.slice(0,-3);
        url += `&product=${product}`;
    }

    var stock = '';
    $('.stock_filter_3').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            stock += $(this).val()+'%2C';
        }
    });
    if(stock != ''){
        stock = stock.slice(0,-3);
        url += `&stock=${stock}`;
    }
    var link = document.URL.split('?');
    link = link[0];
    return window.location.href = link+url;
});
// replace money

var price_res = document.querySelectorAll(".price_re");
for(price_re of price_res){
    price_re.onkeyup = formatCurrency;
}

function formatCurrency(event){
    var input_var = event.target.value;
    if (input_var !=="") {
        event.target.value = input_var.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
}

// redirect search
$('.form-seach-submit').submit(function(){
    var value = $(this).find('.search-box').val();
    value = value.toLowerCase();
    $.ajax({
        url : '../ajax/redirect_search.php',
        type : 'POST',
        data : {key : value},
        dataType : 'JSON',
        success : function(data){
            if(data.result == true){
                window.location.href = data.link;
            }else{
                window.location.href = data.link;
            }
        },
    });
});

