<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	
	public $css = [
		// Bootstrap
		'template/bootstrap/css/bootstrap.css', // 3.3.5
		#'template/bootstrap4/css/bootstrap.css', // 4.5.3
		#'template/bootstrap5/css/bootstrap.css', // 5.0.0

		// Font Awesome
		'template/font-awesome/css/font-awesome.min.css',

		// Ionicons
		'template/ionicons/css/ionicons.min.css',

		// pixeden
		'template/pe-icon-7-stroke/css/pe-icon-7-stroke.css',
		'template/pe-icon-7-stroke/css/helper.css',

		// jvectormap
		'template/plugins/jvectormap/jquery-jvectormap-1.2.2.css',

		// Theme style
		'template/dist/css/Myadmin.css',

		// quikr Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.
		'template/dist/css/skins/_all-skins.min.css',
		'css/site.css',
	];
	
	public $js = [
		// jQuery 2.1.4
		#'template/plugins/jQuery/jQuery-2.1.4.min.js',

		// Bootstrap
		'template/bootstrap/js/bootstrap.min.js', // 3.3.5
		#'template/bootstrap4/js/bootstrap.min.js', // 4.5.3
		#'template/bootstrap5/js/bootstrap.min.js', // 5.0.0

		// FastClick
		'template/plugins/fastclick/fastclick.min.js',

		// Myadmin App
		'template/dist/js/app.min.js',

		// Sparkline
		'template/plugins/sparkline/jquery.sparkline.min.js',

		// jvectormap
		'template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
		'template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',

		// SlimScroll 1.3.0
		'template/plugins/slimScroll/jquery.slimscroll.min.js',

		// ChartJS 1.0.1
		'template/plugins/chartjs/Chart.min.js',

		// Myadmin dashboard demo (This is only for demo purposes)
		#'template/dist/js/pages/dashboard2.js',

		// Myadmin for demo purposes
		#'template/dist/js/demo.js',

		// Backend JS
		'template/dist/js/backend.js',
		'template/dist/js/google_map.js',
		'@gmap',
		#'template/dist/js/location.js', // Remove
		#https://maps.googleapis.com/maps/api/js?key=AIzaSyBpqHARfx5A4xN-U4oEZsfPypx9oHrbCaQ&libraries=places&callback=initMap // Remove
		#'template/dist/js/map.js', // Remove
	];
	
	private $map_params = [
		'url' => 'https://maps.googleapis.com/maps/api/js',
		'key' => '',
		'sensor' => true,
		'libraries' => [
			'places',
			'geometry',
			#'geocode',
		],
		'channel' => 'monorail-prod',
		'language' => 'en_US',
		'callback' => 'initMap',
	];
	
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
	
	public function init(){
		parent::init();
		
		foreach($this->js as $js_k => $js){
			if($js == '@gmap'){
				$q = [];
				foreach($this->map_params as $k => $v){
					if($k == 'url'){
						$this->js[$js_k] = $v.'?';
					}elseif($k == 'libraries'){
						$q[$k] = implode(',', $v);
					}elseif($k == 'key'){
						$q[$k] = Yii::$app->params['google_api_key'];
					}else{
						$q[$k] = $v;
					}
				}
				$this->js[$js_k] .= http_build_query($q);
				/*$this->js[$k] = $this->map_params['url'].'?'.
				                'key='.$this->map_params['key'].
				                'sensor='.$this->map_params['sensor'].
				                'libraries='.implode(',', $this->map_params['libraries']).
				                'channel='.$this->map_params['monorail-prod'].*/
			}
		}
	}
	
}
