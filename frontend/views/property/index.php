<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\Property;
use yii\widgets\LinkPager;

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
?>

<?php #=$this->render('partials/toolbar');?>

<section class="section page-content properties-index">
	<div class="js_data_loader loader trans_me"></div>
	<div class="container-lg">
		
		<header class="section__title text-center text-md-start">
			<h1><?=$meta['title'];?></h1>
			<small id="js_breadcrumbs">
				<?=Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]);?>
			</small>
		</header>
		
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
					<?php #=$this->render('sidebar/subscribe');?>
				</div>
			</aside>
			<div class="col-md-8">
				<?php #Pjax::begin();?>
					<div id="js_filter_results" class="property-listing trans_all">
						<?=$this->render('partials/items', ['models' => $dataProvider->getModels(), 'add_to_compare' => false, 'desc_length' => 300]);?>
					</div>
					<nav id="js_filter_pagination" class="text-center">
						<?=LinkPager::widget(['pagination' => $pagination]);?>
					</nav>
				<?php #Pjax::end();?>
			</div>
		</div>

	</div>
</section>
