<?php

use frontend\assets\AppAsset;
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;
use yii\bootstrap\Html;

$this->title = $page_title;
$bundle = AppAsset::register($this);
$bundle->addGoogleMapJS();

#VarDumper::dump($intersect_features, 10, 1);
?>
<section class="section page-content compare-index">
	<div class="loader trans_me"></div>
	<div class="container-lg">
		<header class="section__title text-center text-md-start">
			<h1>Facility Comparison</h1>
			<small>Vestibulum id ligula porta felis euismod semper</small>
		</header>
		
		<div id="js_compare_items" class="row flex-nowrap property-listing trans_all cols-<?=$total_count;?>">
			<?=$this->render('partials/items', ['models' => $models, 'user_favorites' => $user_favorites, 'intersect_features' => $intersect_features, 'desc_length' => 100]);?>
		</div>
		<?=$this->render('partials/modal');?>
	</div>
</section>
