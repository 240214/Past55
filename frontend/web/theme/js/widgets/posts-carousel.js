$(document).ready(function(){
    $('.js_posts_carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        centerMode: false,
        lazyLoad: 'progressive',
        responsive: [
            {breakpoint: 992, settings: {slidesToShow: 2, centerMode: false}},
            {breakpoint: 768, settings: {slidesToShow: 1, centerMode: true, arrows: false}},
        ]
    });
});
