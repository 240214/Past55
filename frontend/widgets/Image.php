<?php


namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;

class Image extends Widget{
	
	public $src = '';
	public $css_class = '';
	public $alt = '';
	public $from_cdn = false;
	public $lazyload = true;
	public $data_srcset = '';
	public $data_sizes = '';
	
	public function init(){
		parent::init();
	}
	
	public function run(){
		return Yii::$app->Helpers->getImage([
			'src' => $this->src,
			'alt' => $this->alt,
			'from_cdn' => $this->from_cdn,
			'lazyload' => $this->lazyload,
			'class' => $this->css_class,
			'data-srcset' => $this->data_srcset,
			'data-sizes' => $this->data_sizes,
		]);
	}
}
