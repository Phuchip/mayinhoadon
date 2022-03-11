$(document).ready(function (){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:40,
        nav:true,
        speed: 30,
        lazyLoad: true,
        autoplay: true,
        autoplayHoverPause: true,
        navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
        responsiveClass:true,
        responsive:{
            320:{
                items:1,
            },
            375:{
                items:1,
            },
            768:{
                items:1.2,
            },
            1024:{
                items:1.5,
            },
            1366:{
                items:2,
            },
            1520:{
                items:2,
            },
            1920:{
                items:2,
            }
        }
    })

});