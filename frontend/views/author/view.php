<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;
use yii\web\JqueryAsset;

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/author.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen max-w-1260">
		<div class="row align-items-center flex-md-row-reverse">
			<div class="col-12 col-md-7">
				<img class="img-fluid" src="/theme/img/about/hero.jpg" alt="" width="715" height="438">
			</div>
			<div class="col-12 col-md-5">
				<div class="inner max-w-470-sm">
					<h1 class="main-title mb-2 mb-md-15"><?=$model->meta_title;?></h1>
					<p class="sub-title main-text-content text-color-black mb-25">People started talking about E‑A-T in August 2018, and it’s been mentioned in hundreds of SEO articles ever since.</p>
					<a class="btn-primary-medium contact-btn" href="/contact-us/">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>
