<?php

namespace frontend\widgets;

use common\models\Posts;
use common\models\search\SearchPosts;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class CategoryRelatedPosts extends Widget{
	
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
		
		#VarDumper::dump($this->category_id, 10, 1);
		
		$searchModel = new SearchPosts();
		$this->dataProvider = $searchModel->search([]);
		$this->dataProvider->query->where(['posts.category_id' => $this->category_id, 'posts.type' => $this->post_type]);
		$this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$this->dataProvider->pagination = ['pageSize' => $this->limit];
		
		$this->view->registerCssFile('@web/theme/css/widgets/related-posts.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/category-related-posts', [
			'dataProvider' => $this->dataProvider,
			'found' => $this->dataProvider->getCount(),
			'title' => $this->title,
			'not_found_text' => $this->not_found_text,
		]);
	}
	
}
