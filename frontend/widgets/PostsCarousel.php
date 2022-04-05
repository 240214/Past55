<?php

namespace frontend\widgets;

use common\models\Posts;
use common\models\search\SearchPosts;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class PostsCarousel extends Widget{
	
	private $dataProvider = null;
	public $listing_category_id = null;
	public $listing_category_slug = null;
	public $post_category_id = null;
	public $post_category_slug = null;
	public $post_type = 'post';
	public $limit = 5;
	private $title = '';
	private $found = 0;
	
	public function init(){
		parent::init();
		
		$flag = true;
		$where = '';
		
		if(!is_null($this->listing_category_id)){
			$where = ['posts.category_id' => $this->listing_category_id];
		}elseif(!is_null($this->listing_category_slug)){
			$where = ['category.slug' => $this->listing_category_slug];
		}elseif(!is_null($this->post_category_id)){
			$where = ['posts.post_category_id' => $this->post_category_id];
		}elseif(!is_null($this->post_category_slug)){
			$where = ['posts_categories.slug' => $this->post_category_slug];
		}else{
			$flag = false;
		}
		
		if($flag){
			$searchModel = new SearchPosts();
			$this->dataProvider = $searchModel->search([]);
			$this->dataProvider->query->where(['posts.type' => $this->post_type]);
			$this->dataProvider->query->andWhere($where);
			$this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
			$this->dataProvider->pagination = ['pageSize' => $this->limit];
			$this->found = $this->dataProvider->getCount();
			#VarDumper::dump($this->dataProvider->getModels(), 10, 1); exit;
			
			$this->view->registerCssFile('@web/theme/css/widgets/posts-carousel.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
		}
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/posts-carousel', [
			'dataProvider' => $this->dataProvider,
			'found' => $this->found,
			'title' => $this->title,
		]);
	}
	
}
