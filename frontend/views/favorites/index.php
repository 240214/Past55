<?php

use common\models\Property;
use yii\bootstrap\BootstrapAsset;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\View;
use yii\widgets\LinkPager;
use yii\bootstrap\Html;

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

$options['add_to_compare'] = true;
$options['desc_length'] = 140;
$options['display_desc'] = true;
$options['display_price'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_price']);
$options['display_rating'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_rating']);

$this->registerCssFile('@web/theme/css/favorites.css', ['depends' => [BootstrapAsset::className()]]);
$this->registerCssFile('@web/theme/css/properties.css', ['depends' => [BootstrapAsset::className()]]);

#VarDumper::dump($model, 10, 1);
?>

<section class="favorites">
	<div class="js_data_loader loader fixed trans-all"></div>

	<div class="my-favorites container pb-6">
		<h1 class="main-title mb-15">My Favorites</h1>
		<p class="main-text-content main-desc m-0">Compare your favorite senior living communities here.</p>

		<div class="row mb-5 mt-45">
			<?php if(count($models)):?>
				<aside id="js_filter_bar" class="col-md-4 mb-4 mb-md-0 trans-me">
					<div class="sticky-block">
						<div id="js_compare_panel" class="d-none my-favorites__box compare-panel bg-white p-2 trans-all">
							<div class="header">
								<h4 class="mb-1 widget-title">Compare Places</h4>
								<p class="js_result_count_label main-text-content mb-0 widget-desc">Lorem ipsum dolor sit amet dolor amue</p>
							</div>
							<div id="js_compare_items" class="compare-items"></div>
							<div id="js_compare_btn_group" class="d-flex flex-column align-items-center mt-3">
								<?=Html::button('Compare these planes', ['id' => 'js_btn_compare', 'class' => 'compare__btn btn-primary-medium mb-2', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'compare_items']);?>
								<?=Html::button('Reset all places', ['id' => 'js_btn_reset', 'class' => 'compare__reset-btn btn-primary-medium mb-1', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'reset_items']);?>
							</div>
						</div>
						<div id="js_compare_panel_info" class="compare-panel-info d-flex flex-row flex-nowrap align-items-start pt-2 pt-md-0">
							<i class="bi bi-check-square me-1 icon"></i>
							<p class="desc">Click add to comparison on at least two of your favorites to compare.</p>
						</div>
					</div>
				</aside>
				<div class="col-md-8">
					<div id="js_favorite_items" class="property-listing trans_all">
						<?=$this->render('partials/items', ['models' => $models, 'options' => $options]);?>
					</div>
				</div>
			<?php else:?>
				<div class="col-12">
					<div class="card mt-5 mb-5">
						<div class="body text-center pt-5 pb-5 mt-5 mb-5">
							<h2>Oops! You have no favorite properties.</h2>
							<small>Search for properties and add some to their favorites to use</small>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
</section>

