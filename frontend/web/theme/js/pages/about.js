if(typeof jQuery === "undefined"){
    throw new Error("Frontend requires jQuery");
}

$(function(){
    "use strict";

    $.fn.exists = function(){
        return this.length !== 0;
    };

    var ABOUTJS = {
        options: {
            device: (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)),
            lg: [1920, 1200],
            md: [1199, 992],
            sm: [991, 768],
            xs: [767, 576],
            xxs: [575, 0],
            slick_options: {
                for: {
                    arrows: false,
                    dots: false,
                    infinite: false,
                    fade: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    asNavFor: '#js_slider_nav'
                },
                nav: {
                    arrows: true,
                    dots: false,
                    infinite: false,
                    fade: true,
                    focusOnSelect: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    asNavFor: '#js_slider_for',
                    prevArrow: '.slider-arrow.prev',
                    nextArrow: '.slider-arrow.next'
                },
            },
        },
        els: {
            js_slider_for: $("#js_slider_for"),
            js_slider_nav: $("#js_slider_nav"),
            js_custom_nav: $("#js_custom_nav"),
            slider: null,
        },
        Init: function(){
            this.Core.initEvents();
            this.Slider.Init();
        },
        Core: {
            initEvents: function(){
                $(document)
                    .on('blur', '[data-trigger="js_action_blur"]', ABOUTJS.Core.doAction)
                    .on('change', '[data-trigger="js_action_change"]', ABOUTJS.Core.doAction)
                    .on('click', '[data-trigger="js_action_click"]', ABOUTJS.Core.doAction)
                    .on('submit', '[data-trigger="js_action_submit"]', ABOUTJS.Core.doAction);
            },
            doAction: function(e){
                var $this = $(this),
                    action = $(this).data('action');

                switch(action){
                    case "next_slide":
                        ABOUTJS.Slider.NextSlide($this);
                        break;
                    case "prev_slide":
                        ABOUTJS.Slider.PrevSlide($this);
                        break;
                    default:
                        break;
                }

                e.preventDefault();
            },
        },
        Slider: {
            Init: function(){
                ABOUTJS.els.js_slider_for.slick(ABOUTJS.options.slick_options.for);
                ABOUTJS.els.js_slider_nav.slick(ABOUTJS.options.slick_options.nav);
            },
            NextSlide: function($btn){

            },
            PrevSlide: function($btn){

            },
        },
    };

    ABOUTJS.Init();
});
