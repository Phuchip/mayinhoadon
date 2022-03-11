// cart product slick
var sizeScreen = $(window).width();
if (sizeScreen > 1024) {
    $('#slick-product-viewed').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
} else if(sizeScreen > 768) {
    $('#slick-product-viewed').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
} else if(sizeScreen > 425) {
    $('#slick-product-viewed').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
}else if(sizeScreen <= 425){
    $('#slick-product-viewed').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight : false,
        prevArrow:"<button type='button' class='slick-btn slick-left'><i class='ic-slick-left' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-btn slick-right'><i class='ic-slick-right' aria-hidden='true'></i></button>",
    });
}
// dropdown info product page cart
var carts = document.querySelectorAll('.btn-dropdown');
for(cart of carts){
    cart.onclick = showContent;
}
function showContent(event){
    var parents = getParent(event.target,".ci-dropdown");
    var dropdown = parents.querySelector('.btn-dropdown-content');
    dropdown.classList.toggle('hidden');
}
function getParent(element, selector) {
    while(element.parentElement){
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }element = element.parentElement;
    }
}