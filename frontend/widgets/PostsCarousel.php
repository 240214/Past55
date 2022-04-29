<?php

namespace frontend\widgets;

use common\models\Posts;
use common\models\search\SearchPosts;
use frontend\assets\AppAsset;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;
use common\models\Category;
use common\models\PostsCategories;
use yii\helpers\Url;
use yii\web\JqueryAsset;

class PostsCarousel extends Widget{
	
	private $dataProvider = null;
	public $listing_category_id = null;
	public $listing_category_slug = null;
	public $post_category_id = null;
	public $post_category_slug = null;
	public $post_type = 'post';
	public $display_see_all_link = false;
	public $display_post_type = false;
	public $display_nav_arrows = true;
	public $limit = 6;
	private $head = ['title' => '', 'link' => ''];
	private $found = 0;
	
	public function init(){
		parent::init();
		
		$flag = true;
		$where = '';
		
		if(!is_null($this->listing_category_id)){
			$where = ['posts.category_id' => $this->listing_category_id];
			$category = Category::find()->select(['name', 'slug'])->where(['id' => $this->listing_category_id])->one();
			if($category){
				$this->head['title'] = $category->name;
				$this->head['link'] = Url::toRoute(['category/view', 'category_slug' => $category->slug]);
			}
		}elseif(!is_null($this->listing_category_slug)){
			$where = ['category.slug' => $this->listing_category_slug];
			$category = Category::find()->select(['name', 'slug'])->where(['slug' => $this->listing_category_slug])->one();
			if($category){
				$this->head['title'] = $category->name;
				$this->head['link'] = Url::toRoute(['category/view', 'category_slug' => $category->slug]);
			}
		}elseif(!is_null($this->post_category_id)){
			$where = ['posts.post_category_id' => $this->post_category_id];
			$category = PostsCategories::find()->select(['title', 'slug'])->where(['id' => $this->post_category_id])->one();
			if($category){
				$this->head['title'] = $category->title;
				$this->head['link'] = Url::toRoute(['category/view', 'category_slug' => $category->slug]);
			}
		}elseif(!is_null($this->post_category_slug)){
			$where = ['posts_categories.slug' => $this->post_category_slug];
			$category = PostsCategories::find()->select(['title', 'slug'])->where(['slug' => $this->post_category_slug])->one();
			if($category){
				$this->head['title'] = $category->title;
				$this->head['link'] = Url::toRoute(['category/view', 'category_slug' => $category->slug]);
			}
		}else{
			$flag = false;
		}
		
		$searchModel = new SearchPosts();
		$this->dataProvider = $searchModel->search([]);
		$this->dataProvider->query->where(['posts.type' => $this->post_type]);
		if(!empty($where)){
			$this->dataProvider->query->andWhere($where);
		}
		$this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];
		$this->dataProvider->pagination = ['pageSize' => $this->limit];
		$this->found = $this->dataProvider->getCount();

		#VarDumper::dump($this->dataProvider->getModels(), 10, 1); exit;
		#VarDumper::dump($this->found, 10, 1); exit;
		
		if($this->found){
			$this->view->registerCssFile('@web/theme/plugins/slick/css/slick.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
			$this->view->registerCssFile('@web/theme/plugins/slick/css/slick-theme.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
			$this->view->registerCssFile('@web/theme/css/widgets/posts-carousel.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
			$this->view->registerJsFile('@web/theme/plugins/slick/js/slick.min.js?v='.YII_JS_VERS, ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
			$this->view->registerJsFile('@web/theme/js/widgets/posts-carousel.js?v='.YII_JS_VERS, ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
		}
	}
	
	public function run(){
		return $this->render('@frontend/views/widgets/posts-carousel', [
			'dataProvider' => $this->dataProvider,
			'found' => $this->found,
			'head' => $this->head,
			'display_see_all_link' => $this->display_see_all_link,
			'display_post_type' => $this->display_post_type,
			'display_nav_arrows' => $this->display_nav_arrows ? '' : 'hide-nav-arrows',
		]);
	}
	
}
