<?php

namespace frontend\widgets;

use common\models\Pages;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class PageLink extends Widget{
	
	public $id;
	public $slug;
	public $tag_class;
	public $custom_title;
	private $model;
	
	public function init(){
		parent::init();
		
		$this->model = Pages::find()
		                    ->select(['title', 'slug'])
		                    ->where(['id' => $this->id])
		                    ->orWhere(['slug' => $this->slug])
		                    ->one();
	}
	
	public function run(){
		if(!is_null($this->model)){
			return $this->render('@frontend/views/widgets/page-link', [
				'model'     => $this->model,
				'tag_class' => $this->tag_class,
				'custom_title' => $this->custom_title,
			]);
		}else{
			return '';
		}
	}
	
}
