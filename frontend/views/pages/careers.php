<?php

use yii\helpers\VarDumper;
use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use frontend\widgets\PostsCarousel;

$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => '']);
if($model->meta_noindex){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $model->meta_title;
$this->params['breadcrumbs'][] = $model->title;

$this->registerCssFile('@web/theme/css/pages/careers.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);

?>
<section class="hero">
	<div class="container first-screen text-center max-w-700">
		<h1 class="main-title mb-15 mb-md-25 me-auto ms-auto"><?=$model->meta_title;?></h1>
		<p class="main-text-content text-color-black mb-15 mb-md-25 me-auto ms-auto">Join our passionate team of senior living experts.</p>
		<a class="btn-primary-medium screen-btn m-auto" href="#hiring">See open positions</a>
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

<section class="content container-fluid max-w-1290">
	<div class="row mb-35 mb-md-10">
		<div class="col-12">
			<div class="subtitle mb-15 mb-md-25">Why work at GeorgiaCaring.com?</div>
			<h1 class="main-title m-0 max-w-860">We believe in putting people first.</h1>
		</div>
	</div>
	<div class="row mb-3 mb-md-9">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="max-w-530-sm me-md-auto">
				<h2 class="item-title mb-15 mb-md-2">Make a difference</h2>
				<p class="item-text mb-2 mb-md-3">Contribute work that has a direct impact on the quality of peoples lives. GeorgiaCaring.com is committed to helping our senior citizens.</p>
				<h2 class="item-title mb-15 mb-md-2">Flexible hours</h2>
				<p class="item-text mb-2 mb-md-3">With remote employees from all corners of the world, choose a schedule that best fits your life.</p>
				<h2 class="item-title mb-15 mb-md-2">Work From Home</h2>
				<p class="item-text mb-0">As a fully remote company, we have embraced the new way of doing business. Join us from anywhere in the world.</p>
			</div>
		</div>
		<div class="col-12 col-md-6 work-proccess">
			<div class="row">
				<div class="col-8">
					<img class="img-fluid" src="/theme/img/careers/04.jpg" alt="">
				</div>
				<div class="col-4">
					<img class="img-fluid" src="/theme/img/careers/05.jpg" alt="">
				</div>
				<div class="col-12">
					<img class="img-fluid" src="/theme/img/careers/06.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
	<div class="row flex-md-row-reverse">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="max-w-530-sm ms-md-auto">
				<h2 class="item-title mb-15 mb-md-2">Growing Market</h2>
				<p class="item-text mb-2 mb-md-3">The senior living market is currently valued at over $80 billion, with projected growth to $119 billion by 2027.</p>
				<h2 class="item-title mb-15 mb-md-2">Competitive benefits</h2>
				<p class="item-text mb-2 mb-md-3">Health insurance, dental, 401k, and unlimited PTO are standard.</p>
				<h2 class="item-title mb-15 mb-md-2">Work Life Balance</h2>
				<p class="item-text mb-0">As one of our core values, we believe in shutting off when work is done. </p>
			</div>
		</div>
		<div class="col-12 col-md-6 work-proccess">
			<div class="row">
				<div class="col-8">
					<img class="img-fluid" src="/theme/img/careers/07.jpg" alt="">
				</div>
				<div class="col-4">
					<img class="img-fluid" src="/theme/img/careers/08.jpg" alt="">
				</div>
				<div class="col-12">
					<img class="img-fluid" src="/theme/img/careers/09.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="hiring pt-4 pb-2 pt-md-6 pb-md-4" id="hiring">
	<div class="container">
		<h2 class="title mb-1 mb-md-25">We're hiring</h2>
		<p class="main-text-content text-color-black mb-2 mb-md-4">We’re looking for passionate people to join the GeorgiaCaring.com team.</p>

		<div class="box d-block text-decoration-none bg-white p-25 py-md-3 px-md-5 mb-15 mb-md-3 position-relative">
			<div class="title mb-15 mb-md-3">
				<a href="#">Community Success Manager</a>
			</div>
			<a href="#" class="detail">Detail</a>
			<div class="d-flex">
				<div class="location d-flex align-items-center justify-content-center">Georgia</div>
				<div class="dot"></div>
				<div class="tag d-flex align-items-center justify-content-center">Remote</div>
			</div>
		</div>

		<div class="box d-block text-decoration-none bg-white p-25 py-md-3 px-md-5 mb-15 mb-md-3 position-relative">
			<div class="title mb-15 mb-md-3">
				<a href="#">SEO Manager</a>
			</div>
			<a href="#" class="detail">Detail</a>
			<div class="d-flex">
				<div class="location d-flex align-items-center justify-content-center">Georgia</div>
				<div class="dot"></div>
				<div class="tag d-flex align-items-center justify-content-center">Remote</div>
			</div>
		</div>

		<div class="dash-line mt-3 mb-2 mt-md-6 mb-md-35"></div>

		<p class="main-text-content text-color-black text-center mb-1">Didn’t find a position that suits you? Don’t worry you can send us your CV and we will review it.</p>
		<p class="text-center main-text-content text-color-black">
			<strong class="hiring-email-text">
				​​Email us at: <a class="text-decoration-none text-color-primary" href="mailto:careers@georgiacaring.com">careers@georgiacaring.com</a>
			</strong>
		</p>
	</div>
</section>
