<?php

use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;
use yii\bootstrap\Html;

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}

$this->title = $page_title;
$bundle = AppAsset::register($this);
$bundle->addGoogleMapJS();

$this->registerCssFile('@web/theme/css/compare.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
#$this->registerCssFile('@web/theme/css/main.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($intersect_features, 10, 1);
?>
<section class="compare-page compare-index">
	<div class="js_data_loader loader fixed trans-all"></div>
	
	<div class="compare-body container-lg">
		<h1 class="main-title text-center text-xl-start mb-15">Facility Comparison</h1>
		<p class="main-text-content main-desc text-center text-xl-start mb-0">Compare your favorite senior living communities here.</p>
		
		<div id="js_compare_items" class="row flex-nowrap property-listing mt-4 trans-all cols-<?=$total_count;?>">
			<?=$this->render('partials/items', ['models' => $models, 'user_favorites' => $user_favorites, 'intersect_features' => $intersect_features, 'desc_length' => 100]);?>
		</div>
		<?=$this->render('partials/modal');?>
	</div>
</section>
