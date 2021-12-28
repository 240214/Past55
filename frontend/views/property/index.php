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

$options['display_price'] = intval(Yii::$app->params['settings']['display_listing_item_price']);
$options['display_desc'] = intval(Yii::$app->params['settings']['display_listing_item_description']);

$this->registerCssFile('@web/theme/css/category.css', ['depends' => [BootstrapAsset::className()]]);
?>
<section class="category">
	<div class="container-fluid container-lg">
		<div class="row mb-3">
			<div class="col-12 col-md-4 d-none d-md-block category__filter-wrap">
				<div class="filter-box p-35 mb-2">
					<div class="filter-box__title mb-2">Price range</div>
					<select class="filter-box__select mb-4 form-select _js_selectpicker">
						<option>$1000-$1500</option>
						<option>$1000-$1500</option>
						<option>$1000-$1500</option>
					</select>
					<div class="filter-box__title mb-2">Types of communities</div>
					<div class="d-flex flex-wrap mb-5">
						<div class="filter-box__btn filter-box__btn--active d-flex align-items-center justify-content-center px-2 mb-15 me-1">55+ Communities</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Memory Care</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Senior Apartments</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Senior Living</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Nursing Homes</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Skilled Nursing</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Assisted living</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Independent Living</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Active Adult Communites</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Apartments</div>
					</div>
					<div class="d-flex justify-content-between">
						<button class="filter-box__reset-btn me-1">Reset</button>
						<button class="btn-primary-large">Apply Filter</button>
					</div>
				</div>
				<div class="filter-box p-35 mb-2">
					<div class="filter-box__title mb-2">Nearby cities</div>
					<div class="d-flex flex-wrap">
						<div class="filter-box__btn filter-box__btn--active d-flex align-items-center justify-content-center px-2 mb-15 me-1">Marietta, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Alpharetta, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Macon County, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Athens, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Sandy Springs, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Atlanta, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Columbus, GA</div>
						<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Savannah, GA</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<h1 class="main-title"><?=$meta['title'];?></h1>
				<div class="row mb-2 mb-xl-4">
					<div class="col-12">
						<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
					</div>
				</div>
				
				<div id="category__filter-adaptive-menu-btn" class="filter-btn d-flex d-md-none align-items-center justify-content-between px-2 mb-35 mb-xl-0">
					<span>Filter</span>
					<i class="icon-arrow-down"></i>
				</div>
				
				<div id="category__filter-adaptive-menu" class="category__filter-wrap d-none">
					<div class="filter-box p-1 p-md-35 mb-2">
						<div class="filter-box__title mb-2">Price range</div>
						<select class="filter-box__select mb-4 form-select _js_selectpicker">
							<option>$1000-$1500</option>
							<option>$1000-$1500</option>
							<option>$1000-$1500</option>
						</select>
						<div class="filter-box__title mb-2">Types of communities</div>
						<div class="d-flex flex-wrap mb-5">
							<div class="filter-box__btn filter-box__btn--active d-flex align-items-center justify-content-center px-2 mb-15 me-1">55+ Communities</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Memory Care</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Senior Apartments</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Senior Living</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Nursing Homes</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Skilled Nursing</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Assisted living</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Independent Living</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Active Adult Communites</div>
							<div class="filter-box__btn d-flex align-items-center justify-content-center px-2 mb-15 me-1">Apartments</div>
						</div>
						<div class="d-flex justify-content-between">
							<button class="filter-box__reset-btn me-1">Reset</button>
							<button class="btn-primary-large">Apply Filter</button>
						</div>
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

<section class="section page-content properties-index">
	<div class="js_data_loader loader trans_me"></div>
	<div class="container-lg">


		<div class="mob-filter-wrap d-block d-md-none">
			<a role="button" class="btn-toggle-filter btn btn-warning" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_filter_results">
				<i class="zmdi zmdi-tune zmdi-hc-fw"></i>
				<span>Filter</span>
			</a>
		</div>

		<div class="row">
			<aside id="js_filter_bar" class="col-md-4 trans_me">
				<div class="sticky-block">
					<?=$this->render('sidebar/category-filter', ['categories' => $categories, 'property' => $property, 'form_url' => $form_url, 'found_label' => $found_label]);?>
					<?=$this->render('sidebar/narrow-cities-widget', ['display_narrow_cities' => $display_narrow_cities, 'narrow_cities' => $narrow_cities, 'with_wrap' => true]);?>
					<?=$this->render('sidebar/nearby-cities-widget', ['display_nearby_cities' => $display_nearby_cities, 'nearby_cities' => $nearby_cities, 'with_wrap' => true]);?>
					<?php #=$this->render('sidebar/subscribe');?>
				</div>
			</aside>
			<div class="col-md-8">
			</div>
		</div>

	</div>
</section>

<section class="category-article pt-6">
	<div class="container">
		<h1 class="main-title text-center mb-2 mb-md-6">Getting Ready to Move to Assisted<br /> Living in Miami</h1>
		<img src="/theme/img/category/category-article.png" alt="" class="img-fluid mb-2 mb-md-6">
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
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Review the assisted living facility's policies and procedures with your loved one, so you both know exactly what to expect as your loved one gets settled into their new home.</span></li>
					<li class="main-text-content mb-3 d-flex""><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Sell your loved one's current home or start the process to cancel their current rental agreement.</span></li>
					<li class="main-text-content mb-3 d-flex""><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Sort through your loved one's belongings. Pack everything your loved one needs to keep and donate, sell or give away any belongings that remain.</span></li>
					<li class="main-text-content mb-3 d-flex""><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Make a list of any services you need to cancel once your loved one moves including utilities and meal services.</span></li>
				</ul>
			</div>
			<div class="col-xl-6 col-md-12">
				<ul class="category-article__list">
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Ask the staff for a list of suggested items to bring to the community. Having a list on hand makes it a lot easier to determine what belongings your loved one should keep.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Donate or sell your loved one's car, or give it to a younger family member.</span></li>
					<li class="main-text-content mb-3 d-flex"><i class="bi bi-check2-circle me-15 text-color-primary"></i><span>Review your loved one's finances and pay any outstanding bills.</span></li>
				</ul>
			</div>
		</div>
	</div>
</section>
