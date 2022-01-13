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
		<h1 class="main-title">My Favorites</h1>
		<p class="main-text-content pb-2 pb-md-4">Compare your favorite senior living communities here.</p>

		<div class="row mb-5">
			<?php if(count($models)):?>
				<aside id="js_filter_bar" class="col-md-4 trans-me">
					<div class="sticky-block my-favorites__box bg-white p-2">
						<div id="js_compare_panel" class="d-print-none compare-panel trans-all">
							<div class="header">
								<h4 class="mb-1 widget-title">Compare Places</h4>
								<p class="js_result_count_label main-text-content mb-2 widget-desc">Lorem ipsum dolor sit amet dolor amue</p>
							</div>
							<div id="js_compare_items" class="list-group item-container"></div>
							
							<div class="divider-wrapp">
								<img class="mb-3" src="../shared/images/divider.png" alt="">
							</div>
		
							<div class="compare-place-item row bg-white">
								<div class="col-4 col-md-3">
									<img class="img-fluid" src="./img/compare-place-img-1.png" alt="">
								</div>
								<div class="col-8 col-md-9 pe-1">
									<h4 class="compare-place-item__title">Historic Roswell Place</h4>
									<div class="address mb-15">
										<i class="bi bi-geo-alt me-1"></i>
										<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
									</div>
								</div>
							</div>
		
							<div class="divider-wrapp mb-25">
								<img src="../shared/images/divider.png" alt="">
							</div>
		
							<div class="compare-place-item row bg-white">
								<div class="col-4 col-md-3">
									<img class="img-fluid" src="./img/compare-place-img-1.png" alt="">
								</div>
								<div class="col-8 col-md-9 pe-1">
									<h4 class="compare-place-item__title">Historic Roswell Place</h4>
									<div class="address mb-15">
										<i class="bi bi-geo-alt me-1"></i>
										<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
									</div>
								</div>
							</div>
		
							<div class="divider-wrapp mb-25">
								<img src="../shared/images/divider.png" alt="">
							</div>
		
							<div class="compare-place-item row bg-white mb-2">
								<div class="col-4 col-md-3">
									<img class="img-fluid" src="./img/compare-place-img-1.png" alt="">
								</div>
								<div class="col-8 col-md-9 pe-1">
									<h4 class="compare-place-item__title">Historic Roswell Place</h4>
									<div class="address mb-15">
										<i class="bi bi-geo-alt me-1"></i>
										<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
									</div>
								</div>
							</div>
		
							<div class="d-flex flex-column align-items-center">
								<?=Html::button('Compare these planes', ['id' => 'js_btn_compare', 'class' => 'compare__btn btn-primary-medium mb-2', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'compare_items']);?>
								<?=Html::button('Reset all places', ['id' => 'js_btn_reset', 'class' => 'compare__reset-btn btn-primary-medium mb-1', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'reset_items']);?>
							</div>
							
						</div>
					</div>
				</aside>
				<div class="col-md-8">
					<div id="js_favorite_items" class="property-listing trans_all">
						<?=$this->render('partials/items', ['models' => $models, 'options' => $options]);?>
					</div>

					<div class="my-favorites__item row bg-white p-2 m-0">
						<div class="col-xxl-5 col-12">
							<img class="my-favorites__img mb-2 mb-xxl-0 img-fluid" src="./img/favorites-place-1.png" alt="">
						</div>
						<div class="col-xxl-7 col-12">
							<h2 class="my-favorites__item-title mb-1"><a>Historic Roswell Place</a></h2>
							<div class="address mb-15">
								<i class="bi bi-geo-alt me-1"></i>
								<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
							</div>
							<p class="my-favorites__item-text mb-2 d-none d-md-block">Elmcroft communities’ goal and mission is to: Enrich the lives of those who live and work with us by responding to their unique needs.</p>
							<button class="my-favorites__add-btn d-flex align-items-center justify-content-center bg-white">
								<div class="my-favorites-add-btn__icon-wrapp d-flex align-items-center justify-content-center me-1">
									<i class="bi bi-check2"></i>
								</div>
								<span>Add to comparison</span>
							</button>
						</div>
						<div class="add-to-favorite-btn add-to-favorite-btn--favorite-page position-absolute top-30 start-30 bg-white d-flex align-items-center justify-content-center">
							<i class="bi bi-heart text-color-primary"></i>
							<i class="bi bi-heart-fill text-color-primary"></i>
						</div>
					</div>
	
					<div class="my-favorites__item row bg-white p-2 m-0">
						<div class="col-xxl-5 col-12">
							<img class="my-favorites__img mb-2 mb-xxl-0 img-fluid" src="./img/favorites-place-2.png" alt="">
						</div>
						<div class="col-xxl-7 col-12">
							<h4 class="my-favorites__item-title mb-1">St George Village</h4>
							<div class="address mb-15">
								<i class="bi bi-geo-alt me-1"></i>
								<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
							</div>
							<p class="my-favorites__item-text mb-2 d-none d-md-block">Elmcroft communities’ goal and mission is to: Enrich the lives of those who live and work with us by responding to their unique needs.</p>
							<button class="my-favorites__add-btn d-flex align-items-center justify-content-center bg-white">
								<div class="my-favorites-add-btn__icon-wrapp d-flex align-items-center justify-content-center me-1">
									<i class="bi bi-check2"></i>
								</div>
								<span>Add to comparison</span>
							</button>
						</div>
						<div class="add-to-favorite-btn add-to-favorite-btn--active add-to-favorite-btn--favorite-page position-absolute top-30 start-30 bg-white d-flex align-items-center justify-content-center">
							<i class="bi bi-heart text-color-primary"></i>
							<i class="bi bi-heart-fill text-color-primary"></i>
						</div>
					</div>
	
					<div class="my-favorites__item row bg-white p-2 m-0">
						<div class="col-xxl-5 col-12">
							<img class="my-favorites__img mb-2 mb-xxl-0 img-fluid" src="./img/favorites-place-3.png" alt="">
						</div>
						<div class="col-xxl-7 col-12">
							<h4 class="my-favorites__item-title mb-1">Elmcroft of Roswell</h4>
							<div class="address mb-15">
								<i class="bi bi-geo-alt me-1"></i>
								<span class="similar-offers__adress">295 East Crossville Road, Roswell, GA 30075, USA</span>
							</div>
							<p class="my-favorites__item-text mb-2 d-none d-md-block">Elmcroft communities’ goal and mission is to: Enrich the lives of those who live and work with us by responding to their unique needs.</p>
							<button class="my-favorites__add-btn d-flex align-items-center justify-content-center bg-white">
								<div class="my-favorites-add-btn__icon-wrapp d-flex align-items-center justify-content-center me-1">
									<i class="bi bi-check2"></i>
								</div>
								<span>Add to comparison</span>
							</button>
						</div>
						<div class="add-to-favorite-btn add-to-favorite-btn--favorite-page position-absolute top-30 start-30 bg-white d-flex align-items-center justify-content-center">
							<i class="bi bi-heart text-color-primary"></i>
							<i class="bi bi-heart-fill text-color-primary"></i>
						</div>
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
<!--------------------------------------------------------------------------------------------------------------------------->
	<div class="container-lg">
		<header class="section__title text-center text-md-start">
			<h1>My Favorites</h1>
			<small>Vestibulum id ligula porta felis euismod semper</small>
		</header>
		
		<div class="mob-filter-wrap d-block d-md-none">
			<a role="button" class="btn-toggle-filter btn btn-warning" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_favorite_items">
				<i class="zmdi zmdi-tune zmdi-hc-fw"></i>
				<span>Compare Places</span>
			</a>
		</div>
		
		<div class="row">
			<?php if(count($models)):?>
			<aside id="js_filter_bar" class="col-md-4 trans_me">
				<div class="sticky-block">
					<div id="js_compare_panel" class="card d-print-none compare-panel trans_all">
						<div class="header">
							<h2>Compare Places</h2>
							<small class="js_result_count_label">Vestibulum id ligula porta felis euismod semper</small>
							<a role="button" class="btn-close-filter btn btn-default trans_me d-block d-md-none" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_compare_items">
								<i class="zmdi zmdi-close zmdi-hc-fw"></i>
								<span>Close</span>
							</a>
						</div>
						<div id="js_compare_items" class="list-group item-container"></div>
						<div class="footer">
							<?=Html::button('Compare These Places', ['id' => 'js_btn_compare', 'class' => 'btn btn-info', 'disabled' => 'disabled', 'data-trigger' => 'js_action_click', 'data-action' => 'compare_items']);?>
						</div>
					</div>
				</div>
			</aside>
			<div class="col-md-8">
				<div id="js_favorite_items" class="property-listing trans_all">
					<?=$this->render('@frontend/views/property/partials/items', ['models' => $models, 'add_to_compare' => true, 'desc_length' => 140]);?>
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

