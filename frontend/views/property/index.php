<?php

use yii\bootstrap\BootstrapAsset;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
#use yii\widgets\Breadcrumbs;
#use frontend\components\BreadcrumbsNew;
use yii\widgets\Pjax;
use common\models\Users;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\Property;
use yii\widgets\LinkPager;
use frontend\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $meta['title'];
$this->params['breadcrumbs'] = $breadcrumbs;
#$this->params['breadcrumbs'][] = $this->title;

#$session = Yii::$app->session;
#$city = $session->get('city');
#$cityDefault = ($city)?$city:"jodhpur";
$property = new Property();

$options['add_to_compare'] = false;
$options['desc_length'] = 300;
$options['display_price'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_price']);
$options['display_desc'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_description']);
$options['display_rating'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_rating']);

$this->registerCssFile('@web/theme/css/category.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/css/properties.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($category_city_content, 10, 1);
?>
<section class="category">
	<div class="js_data_loader loader fixed trans-all"></div>
	<div class="container-fluid container-lg">
		<div class="row mb-3">
			<div class="col-12">
				<div id="category__filter-adaptive-menu-btn" class="btn-toggle-filter filter-btn d-flex d-md-none align-items-center justify-content-between px-2 mb-35 mb-xl-0"
				     data-trigger="js_action_click"
				     data-action="toggle_filter_sidebar"
				     data-container="#js_filter_results">
					<span>Filter</span>
					<i class="icon-arrow-down"></i>
				</div>
			</div>
			
			<aside id="js_filter_bar" class="col-12 col-md-4 d-none d-md-block category__filter-wrap mb-3 mb-md-0">
				<div class="sticky-block">
					<?=$this->render('sidebar/category-filter', ['categories' => $categories, 'property' => $property, 'form_url' => $form_url, 'found_label' => $found_label, 'options' => $options]);?>
					<?=$this->render('sidebar/narrow-cities-widget', ['display_narrow_cities' => $display_narrow_cities, 'narrow_cities' => $narrow_cities, 'with_wrap' => true]);?>
					<?=$this->render('sidebar/nearby-cities-widget', ['display_nearby_cities' => $display_nearby_cities, 'nearby_cities' => $nearby_cities, 'with_wrap' => true]);?>
					<?php #=$this->render('sidebar/subscribe');?>
				</div>
			</aside>
			
			<div class="col-12 col-md-8">
				<h1 class="main-title"><?=$meta['title'];?></h1>
				<div class="row mb-2 mb-xl-4">
					<div class="col-12">
						<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
					</div>
				</div>

				<div class="category__body">
					<div id="js_filter_results" class="row property-listing trans_all <?=(!$dataProvider->getCount() ? 'no-results' : '');?>">
						<?php
						if($dataProvider->getCount()):?>
							<?=$this->render('partials/items', ['models' => $dataProvider->getModels(), 'options' => $options]);?>
						<?php else:?>
							<div class="card box">
								<h3><?=$not_found_label;?></h3>
							</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex justify-content-end">
			<nav id="js_filter_pagination">
				<?=LinkPager::widget([
					'pagination' => $pagination,
					'pageCssClass' => 'page-item',
					'prevPageCssClass' => 'page-item prev',
					'nextPageCssClass' => 'page-item next',
					'linkOptions' => ['class' => 'page-link'],
					'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
				]);?>
			</nav>
		</div>
	</div>
</section>

<?php if(!is_null($category_city_content)):?>
<section class="category-article pt-6">
	<div class="container max-w-1100">
		<h2 class="main-title text-center mb-2 mb-md-6 me-auto ms-auto"><?=$category_city_content->title;?></h2>
		<img src="<?=$category_city_content->image;?>" alt="" class="img-fluid ml-auto mr-auto mb-2 mb-md-6 d-block rounded-8">
		<div class="main-text-content">
			<?=$category_city_content->content;?>
		</div>
	</div>
</section>
<?php endif;?>
