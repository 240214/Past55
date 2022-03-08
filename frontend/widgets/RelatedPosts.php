<?php

namespace frontend\widgets;

use common\models\Posts;
use common\models\search\SearchPosts;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class RelatedPosts extends Widget{
	
	private $dataProvider;
	private $models;
	private $found = 0;
	public $category_id = null;
	public $post_type = 'post';
	public $limit = 4;
	public $title = '';
	public $not_found_text = '';
	
	public function init(){
		parent::init();
		
		$url = Yii::$app->request->getUrl();
		if(strstr($url, 'page') !== false){
			$url = explode('page', $url)[0];
		}
		
		$searchModel = new SearchPosts();
		$this->dataProvider = $searchModel->search(['category_id' => $this->category_id, 'type' => $this->post_type]);
		$this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$this->dataProvider->pagination = ['pageSize' => $this->limit];
		#$this->found = $dataProvider->getCount();
		#$this->models = $dataProvider;
		#VarDumper::dump($this->models, 10, 1); exit;
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/related-posts', [
			'dataProvider' => $this->dataProvider,
			'found' => $this->dataProvider->getCount(),
			'title' => $this->title,
			'not_found_text' => $this->not_found_text,
		]);
	}
	
}
