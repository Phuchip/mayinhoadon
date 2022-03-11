// $(document).ready(function () {
//     $('html, body').animate({
//         scrollTop: $('.filter_page').offset().top
//     });
// });
$('.filter_2').click(function(){
    if($(this).hasClass('active')){
        $('.filter_2').removeClass('active');
    }else{
        $('.filter_2').removeClass('active');
        $(this).addClass('active');
    }
    getURL();
    
});
$('.input-filter-2').click(function(){
    getURL();
});
$('.input_stock_2').click(function(){
    getURL();
});

$('.apply_button_filter').click(function(){
    var url = '?action=filter';

    var manu ='';
    $('.manufacturer').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            manu += $(this).val()+'%2C';
        }
    });
    if(manu != ''){
        manu = manu.slice(0,-3);
        url += `&manu=${manu}`;
    }
    var cate ='';
    $('.category').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            cate += $(this).val()+'%2C';
        }
    });
    if(cate != ''){
        cate = cate.slice(0,-3);
        url += `&cate=${cate}`;
    }
    var connect ='';
    $('.connect').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            connect += $(this).val()+'%2C';
        }
    });
    if(connect != ''){
        connect = connect.slice(0,-3);
        url += `&connect=${connect}`;
    }
    var paper ='';
    $('.paper').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            paper += $(this).val()+'%2C';
        }
    });
    if(paper != ''){
        paper = paper.slice(0,-3);
        url += `&paper=${paper}`;
    }
    const price_first = $('.price_first').val().replace(/\D/g, "");
    const price_second = $('.price_second').val().replace(/\D/g, "");
    url += `&min=${price_first}&max=${price_second}`;

    $('.filter_2').each(function(index){
        elm = $(this);
        if(elm.hasClass('active')){
            url += `&filter=${$(this).val()}`;
        }
    });

    var product = '';
    $('.filter_product').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            product += $(this).val()+'%2C';
        }
    });
    if(product != ''){
        product = product.slice(0,-3);
        url += `&product=${product}`;
    }

    var stock = '';
    $('.stock_filter').find('input[type=checkbox]').each(function(index){
        
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

function getURL(){
    var url = '?action=filter';
    var manu ='';
    $('.manufacturer').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            manu += $(this).val()+'%2C';
        }
    });
    if(manu != ''){
        manu = manu.slice(0,-3);
        url += `&manu=${manu}`;
    }
    var cate ='';
    $('.category').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            cate += $(this).val()+'%2C';
        }
    });
    if(cate != ''){
        cate = cate.slice(0,-3);
        url += `&cate=${cate}`;
    }
    var connect ='';
    $('.connect').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            connect += $(this).val()+'%2C';
        }
    });
    if(connect != ''){
        connect = connect.slice(0,-3);
        url += `&connect=${connect}`;
    }
    var paper ='';
    $('.paper').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            paper += $(this).val()+'%2C';
        }
    });
    if(paper != ''){
        paper = paper.slice(0,-3);
        url += `&paper=${paper}`;
    }
    $('.filter_2').each(function(index){
        elm = $(this);
        if(elm.hasClass('active')){
            url += `&filter=${$(this).val()}`;
        }
    });

    var product = '';
    $('.filter_product').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            product += $(this).val()+'%2C';
        }
    });
    if(product != ''){
        product = product.slice(0,-3);
        url += `&product=${product}`;
    }

    var stock = '';
    $('.stock_filter').find('input[type=checkbox]').each(function(index){
        
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
}
$('.page-li').click(function(){
    var page = $(this).val();
    var url = '?action=filter';

    var manu ='';
    $('.manufacturer').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            manu += $(this).val()+'%2C';
        }
    });
    if(manu != ''){
        manu = manu.slice(0,-3);
        url += `&manu=${manu}`;
    }
    var cate ='';
    $('.category').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            cate += $(this).val()+'%2C';
        }
    });
    if(cate != ''){
        cate = cate.slice(0,-3);
        url += `&cate=${cate}`;
    }
    var connect ='';
    $('.connect').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            connect += $(this).val()+'%2C';
        }
    });
    if(connect != ''){
        connect = connect.slice(0,-3);
        url += `&connect=${connect}`;
    }
    var paper ='';
    $('.paper').find('input[type=checkbox]').each(function(index){
        if ($(this).is(':checked')) {
            paper += $(this).val()+'%2C';
        }
    });
    if(paper != ''){
        paper = paper.slice(0,-3);
        url += `&paper=${paper}`;
    }

    $('.filter_2').each(function(index){
        elm = $(this);
        if(elm.hasClass('active')){
            url += `&filter=${$(this).val()}`;
        }
    });

    var product = '';
    $('.filter_product').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            product += $(this).val()+'%2C';
        }
    });
    if(product != ''){
        product = product.slice(0,-3);
        url += `&product=${product}`;
    }

    var stock = '';
    $('.stock_filter').find('input[type=checkbox]').each(function(index){
        
        if ($(this).is(':checked')) {
            stock += $(this).val()+'%2C';
        }
    });
    if(stock != ''){
        stock = stock.slice(0,-3);
        url += `&stock=${stock}`;
    }
    url += `&page=${page}`;
    var link = document.URL.split('?');
    link = link[0];
    return window.location.href = link+url;
});