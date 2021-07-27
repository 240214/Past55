<?php

namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;

class Links extends Widget{
	
	public $links_type;
	private $model;
	
	public function init(){
		parent::init();
		
		if($this->links_type !== null){
			switch($this->links_type){
				case "pages":
					$this->model = Pages::find()->select(['title', 'slug'])->all();
					break;
			}
		}
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/links', [
			'model' => $this->model,
			'type' => $this->links_type
		]);
	}
	
}
