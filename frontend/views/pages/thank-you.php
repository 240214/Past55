<?php

/* @var $this yii\web\View */

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;


$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title                   = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/pages/thank-you.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

#VarDumper::dump($settings, 10, 1);
?>
<section class="hero">
	<div class="container first-screen text-center max-w-700">
		<h1 class="main-title mb-15 mb-md-25 me-auto ms-auto"><?=$model->meta_title;?></h1>
		<p class="main-text-content text-color-black text-center">Someone will reply to your message in the next business day.</p>
	</div>
</section>

<section class="media container-fluid max-w-1290">
	<div class="row">
		<div class="col-7 col-md-4">
			<img class="img-fluid" src="/theme/img/careers/01.jpg" alt="">
		</div>
		<div class="col-5 col-md-3">
			<img class="img-fluid" src="/theme/img/careers/02.jpg" alt="">
		</div>
		<div class="col-12 col-md-5">
			<img class="img-fluid" src="/theme/img/careers/03.jpg" alt="">
		</div>
	</div>
</section>
