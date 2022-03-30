<?php

namespace frontend\widgets;

use common\models\Posts;
use common\models\search\SearchPosts;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class RelatedPosts extends Widget{
	
	private $dataProvider;
	public $current_post_id = null;
	public $category_id = null;
	public $post_type = 'post';
	public $limit = 4;
	public $title = '';
	public $subtitle = '';
	public $not_found_text = '';
	
	public function init(){
		parent::init();
		
		$url = Yii::$app->request->getUrl();
		if(strstr($url, 'page') !== false){
			$url = explode('page', $url)[0];
		}
		
		
		$searchModel = new SearchPosts();
		$this->dataProvider = $searchModel->search([]);
		$this->dataProvider->query->where(['posts.category_id' => $this->category_id, 'posts.type' => $this->post_type]);
		$this->dataProvider->query->andWhere(['NOT', ['posts.post_category_id' => null]]);
		$this->dataProvider->query->andWhere(['!=', 'posts.id', $this->current_post_id]);
		$this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$this->dataProvider->pagination = ['pageSize' => $this->limit];
		
		#VarDumper::dump($this->dataProvider->getModels(), 10, 1); exit;
		
		$this->view->registerCssFile('@web/theme/css/widgets/related-posts.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/related-posts', [
			'dataProvider' => $this->dataProvider,
			'found' => $this->dataProvider->getCount(),
			'title' => $this->title,
			'subtitle' => $this->subtitle,
			'not_found_text' => $this->not_found_text,
		]);
	}
	
}
