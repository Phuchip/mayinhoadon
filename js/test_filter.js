$('.filter_2').click(function(){
    $(this).toggleClass('active');
    var array = [];
    var url = document.URL.split('?');
    url = url[0];
    $('.filter_2').each(function(index){
        elm = $(this);
        var value = elm.val();
        if(elm.hasClass('active')){
            array.push(value);
        }
    });

    $.ajax({
        url : '../ajax/filter_2.php',
        type : 'POST',
        data : {
            list_filter : array,
        },
        dataType : 'JSON',
        
        success : function(data){
            if(data != ''){
                window.location.href = url+data;
            }
        }
    });
});