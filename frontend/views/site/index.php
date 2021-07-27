<?php

/* @var $this yii\web\View */

$this->title = 'Home - page';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#$session     = Yii::$app->session;
#$city        = $session->get('city');
#$cityDefault = ($city) ? $city : "jodhpur";
?>

<section class="section living-communities bg-purple">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<h1 class="title">Senior Living Communities</h1>
				<p class="subtitle">The only website you will need when searching for a place to live.</p>
			</div>
			<div class="col-md-6">
				<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-4.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true, 'class' => 'mt-5 mt-md-0']);?>
			</div>
		</div>
	</div>
</section>
<section class="section living-locations">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-6">
				<h2 class="title">Senior Living Locations</h2>
			</div>
			<div class="col-md-6">
				<p class="subtitle">Our newsletter features articles from Richard, Gilfoyle and Dinesh, with occasional guest features from our investors and supporters.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'ga']);?>">Georgia</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'atlanta']);?>">Atlanta</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'roswell']);?>">Roswell</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'marietta']);?>">Marietta</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'fl']);?>">Florida</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'miami']);?>">Miami</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'orlando']);?>">Orlando</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'tampa']);?>">Tampa</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'sc']);?>">South Carolina</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'greenville']);?>">Greenville</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'charleston']);?>">Charleston</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'columbia']);?>">Columbia</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>



