// -------------------------------------------------------------------
// SLIDER

$('.about-us-slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    fade: true,
    asNavFor: '.about-us-slider-nav'
});

$('.about-us-slider-nav').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.about-us-slider-for',
    dots: false,
    arrows: true,
    focusOnSelect: true,
    Infinity: true,
    prevArrow: '.about-us-slider__arrow-left',
    nextArrow: '.about-us-slider__arrow-right'
});