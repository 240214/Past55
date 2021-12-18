$('.compare__slider').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    responsive: [{
        breakpoint: 1400,
        settings: {
            slidesToShow: 2,
        }
    },
    {
        breakpoint: 990,
        settings: {
            slidesToShow: 1,
        }
    },]
});

$(function () {
    $('.js_selectpicker').selectpicker();
});