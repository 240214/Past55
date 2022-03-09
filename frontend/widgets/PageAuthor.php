<?php


namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;

class PageAuthor extends Widget{
	
	public $date;
	public $name = '';
	public $link = '#';
	public $avatar = '';
	
	public function init(){
		parent::init();
		
		$this->view->registerCssFile('@web/theme/css/widgets/page-author.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/page-author', [
			'date' => $this->date,
			'name' => $this->name,
			'link' => $this->link,
			'avatar' => $this->avatar,
		]);
	}
}
