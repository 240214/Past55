<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;
use yii\helpers\VarDumper;

/**
 * Main frontend application asset bundle.
 */
class DashboardAsset extends AssetBundle {
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
	    // Bootstrap
	    #'/theme/plugins/bootstrap3/css/bootstrap.css', // 3.3.5
	    #'/theme/plugins/bootstrap4/css/bootstrap.css', // 4.5.3
	    #'theme/plugins/bootstrap5/css/bootstrap.css', // 5.0.0
	
	    // Material design colors
	    'theme/plugins/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
	
	    // pixeden
	    'theme/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css',
	    'theme/plugins/pe-icon-7-stroke/css/helper.css',
	
	    // Waves button ripple effects
	    'theme/plugins/Waves/dist/waves.min.css',
	
	    // CSS animations
	    'theme/plugins/animate.css/animate.min.css',
	    
	    // Select2
	    'theme/plugins/select2/dist/css/select2.min.css',
	    
	    // SweetAlert2
	    'theme/plugins/sweetalert2/dist/sweetalert2.min.css',
	    
	    // Trumbowyg
	    'theme/plugins/trumbowyg/dist/ui/trumbowyg.min.css',
	    
	    // Slick Slider
	    #'theme/plugins/slick-carousel/slick/slick.css',
	    
	    // NoUiSlider - Input Slider
	    #'theme/plugins/nouislider/distribute/nouislider.min.css',
	    
	    // Light Gallery
	    #'theme/plugins/lightgallery/dist/css/lightgallery.min.css',
	    
	    // rateYo - Ratings
	    #'theme/plugins/rateYo/src/jquery.rateyo.css',
	
	    // materialize
	    #'theme/plugins/materialize/css/materialize.min.css',
	
	    // Theme
        'theme/css/app_1.min.css',
        'theme/css/app_2.min.css',
        #'css/site.css',
        #'css/formCss.css',
    ];
    public $js = [
	    // jQuery
	    #'theme/plugins/jquery/dist/jquery.min.js', // 2.1.4
	    
	    // Bootstrap
	    #'theme/plugins/bootstrap3/js/bootstrap.min.js', // 3.3.5
	    #'theme/plugins/bootstrap4/js/bootstrap.bundle.min.js', // 4.5.3
	    #'theme/plugins/bootstrap5/js/bootstrap.bundle.min.js', // 5.0.0

	    // Waves button ripple effects
	    'theme/plugins/Waves/dist/waves.min.js',
	    
	    // Select 2
	    'theme/plugins/select2/dist/js/select2.full.min.js',
	    
	    // Slick Slider
	    #'theme/plugins/slick-carousel/slick/slick.min.js',
	    
	    // NoUiSlider
	    #'theme/plugins/nouislider/distribute/nouislider.min.js',
	    
	    // Light Gallery
	    #'theme/plugins/lightgallery/dist/js/lightgallery-all.min.js',
	
	    // rateYo - Ratings
	    #'theme/plugins/rateYo/src/jquery.rateyo.js',
	    
	    // Autosize - Auto height textarea
	    #'theme/plugins/autosize/dist/autosize.min.js',
	    
	    // jsSocials - Social link sharing
	    #'theme/plugins/jssocials/dist/jssocials.min.js',
	    
	    // LazyLoad
	    'theme/js/vanilla-lazyload/dist/lazyload.min.js',
	    
	    // materialize
	    #'theme/plugins/materialize/js/materialize.min.js',
	    
	    // Theme
    	'theme/js/page-loader.min.js',
    	#'theme/js/basic.js',
    	#'theme/js/app.min.js',
    	#'theme/js/demo/demo.js',
    	#'js/js.location.js',
    	#'js/frontend.js',
    ];
	public $depends = [
	    'yii\web\JqueryAsset', // 3.5.1
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\YiiAsset',
    ];
	
	
}
