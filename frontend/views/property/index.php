<?php

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\grid\GridView;
#use yii\widgets\Breadcrumbs;
#use frontend\components\BreadcrumbsNew;
use yii\widgets\Pjax;
use common\models\User;
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

$options['display_price'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_price']);
$options['display_desc'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_description']);
$options['display_rating'] = intval(Yii::$app->params['settings']['category_page_display_listing_item_rating']);

$this->registerCssFile('@web/theme/css/category.css', ['depends' => [BootstrapAsset::className()]]);
?>
<section class="category">
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
							<?=$this->render('partials/items', ['models' => $dataProvider->getModels(), 'add_to_compare' => false, 'desc_length' => 300, 'options' => $options]);?>
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

<section class="category-article pt-6">
	<div class="container max-w-1100">
		<h1 class="main-title text-center mb-2 mb-md-6">Getting Ready to Move to Assisted<br /> Living in Miami</h1>
		<img src="/theme/img/category/category-article.png" alt="" class="img-fluid ml-auto mr-auto mb-2 mb-md-6 d-block">
		<p class="category-article__textbox main-text-content mb-25">Moving into an assisted living community near you in Miami requires some time and planning, but the
			process is a lot easier on you and your loved one if you're prepared. It's important to keep your loved
			one involved in each step of the planning process. This helps them accept the change they are about to
			make and feel good about it.</p>
		<p class="category-article__textbox main-text-content mb-25">
			You should start by scheduling a physical exam for your loved one. This way you know exactly the type of
			care your loved one requires, which makes it a lot easier to find an assisted living community that fits
			their needs.
		</p>
		<p class="category-article__subtitle mb-4"><b>In addition to completing a medical assessment, you should also:</b></p>
		<div class="row">
			<div class="col-xl-6 col-md-12">
				<ul class="category-article__list">
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Review the assisted living facility's policies and procedures with your loved one, so you both know exactly what to expect as your loved one gets settled into their new home.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Sell your loved one's current home or start the process to cancel their current rental agreement.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Sort through your loved one's belongings. Pack everything your loved one needs to keep and donate, sell or give away any belongings that remain.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Make a list of any services you need to cancel once your loved one moves including utilities and meal services.</span></li>
				</ul>
			</div>
			<div class="col-xl-6 col-md-12">
				<ul class="category-article__list">
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Ask the staff for a list of suggested items to bring to the community. Having a list on hand makes it a lot easier to determine what belongings your loved one should keep.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Donate or sell your loved one's car, or give it to a younger family member.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary fs-20"></i><span>Review your loved one's finances and pay any outstanding bills.</span></li>
				</ul>
			</div>
		</div>
	</div>
</section>
