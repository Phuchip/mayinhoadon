$(function() {
    $( "#range-slider1" ).slider({
        range: "min",
        value: 3500000,
        min: 0,
        max: getMax(),
        step:100000,
        slide: function( event, ui ) {
            $( "#range-price" ).val( ui.value);
        }
    });
    $( "#range-price" ).val( $( "#range-slider1" ).slider( "value"));
});
function getMax(){
    var max = '';
    $.ajax({
        url : '../ajax/getmax.php',
        dataType: "json",
        async: false,
        success:function(data){
            max = data;
        }
    });
    return max;
}