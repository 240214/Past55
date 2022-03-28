<?php

namespace frontend\widgets;

use common\models\Property;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class RelatedProperties extends Widget{
	
	private $model;
	public $category_id = null;
	public $city = null;
	public $limit = 10;
	public $exclude_id = 0;
	public $title = '';
	public $sub_title = '';
	public $not_found_text = '';
	public $wrapper_class = '';
	
	public function init(){
		parent::init();
		
		$fields = ['id', 'title', 'slug', 'address', 'image', 'state', 'city'];
		
		if($this->city != null){
			$this->model = Property::find()
				->select($fields)
				->where(['city' => $this->city])
				->andWhere(['!=', 'id', $this->exclude_id])
				->orderBy(['id' => 'DESC'])
				->limit($this->limit)
				->all();
		}
		
		if(!$this->model)
			$this->city = null;
		
		if($this->city == null && $this->category_id != null){
			$this->model = Property::find()
				->select($fields)
				->where(['category_id' => $this->category_id])
				->andWhere(['!=', 'id', $this->exclude_id])
				->orderBy(['id' => 'DESC'])
				->limit($this->limit)
				->all();
		}
		
		$this->view->registerCssFile('@web/theme/css/widgets/related-properties.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/related-properties', [
			'model' => $this->model,
			'found' => count($this->model),
			'title' => $this->title,
			'sub_title' => $this->sub_title,
			'not_found_text' => $this->not_found_text,
			'wrapper_class' => $this->wrapper_class,
		]);
	}
	
}
