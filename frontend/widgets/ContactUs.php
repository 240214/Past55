<?php


namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;

class ContactUs extends Widget{
	
	public function init(){
		parent::init();
		
		$this->view->registerCssFile('@web/theme/css/contact-us.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/contact-us', []);
	}
}
