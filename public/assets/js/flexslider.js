$(window).on('load',function() {
    $('.flexslider').flexslider({
        animation: "fade",
        slideshowSpeed: 7000,
        animationSpeed: 1000,
        directionNav: false,
        controlNav: false,
    });

    $('.avisSlider').flexslider({
        animation: "slide",
        slideshowSpeed: 7000,
        animationSpeed: 1000,
    });
});
