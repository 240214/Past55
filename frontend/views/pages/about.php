<?php

use frontend\widgets\ImageOptimize;
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

$this->registerCssFile('@web/theme/plugins/slick/css/slick.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/plugins/slick/css/slick-theme.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/css/pages/about.css?v='.YII_CSS_VERS, ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/plugins/slick/js/slick.min.js?v='.YII_JS_VERS, ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/js/pages/about.js?v='.YII_JS_VERS, ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
?>
<section class="hero">
	<div class="container first-screen max-w-1260">
		<div class="row align-items-center flex-md-row-reverse">
			<div class="col-12 col-md-7">
				<?=ImageOptimize::widget(["src" => '/theme/img/about/hero.jpg', "alt" => "georgiacaring office", "width" => 715, "height" => 438, "css" => "img-fluid"]);?>
			</div>
			<div class="col-12 col-md-5">
				<div class="inner max-w-470-sm">
					<h1 class="main-title mb-2 mb-md-15">We're Here to Help</h1>
					<p class="sub-title main-text-content text-color-black mb-25">Use this site to make the search for senior living less stressful. Or reach out and let us help you.</p>
					<a class="btn-primary-medium contact-btn" href="/contact-us/">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="partners container-fluid max-w-1000">
	<!-- <div class="wrap">
		<div class="inner">
			<img class="img-fluid" src="/theme/logos/airbnb.svg" alt="" width="70" height="23">
			<img class="img-fluid" src="/theme/logos/hubspot.svg" alt="" width="76" height="23">
			<img class="img-fluid" src="/theme/logos/google.svg" alt="" width="66" height="23">
			<img class="img-fluid" src="/theme/logos/microsoft.svg" alt="" width="101" height="23">
			<img class="img-fluid" src="/theme/logos/walmart.svg" alt="" width="93" height="23">
			<img class="img-fluid" src="/theme/logos/fedex.svg" alt="" width="72" height="23">
		</div>
	</div> -->
</section>

<section class="content container-fluid max-w-1260">
	<div class="row mb-1 mb-md-1">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="label ff-inter mb-15">// Our Mission</div>
			<h2 class="title ff-pt-serif m-0 max-w-430">To help you during a stressful time in life.</h2>
		</div>
		<div class="col-12 col-md-6 ps-md-6">
			<div class="line mb-2 mb-md-3"></div>
			<p class="main-desc max-w-490-sm mb-25 mb-md-3">Our goal is to provide the most complete information on senior care communities in Georgia. Feel free to browse the site at your own pace. You can also contact us and we will help you find the right community at no cost to you. Our experts are standing by.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="mission-galery">
				<?=ImageOptimize::widget(["src" => '/theme/img/about/01.jpg', "alt" => "senior family", "width" => 370, "height" => 291, "css" => "img-fluid"]);?>
				<?=ImageOptimize::widget(["src" => '/theme/img/about/02.jpg', "alt" => "senior living", "width" => 370, "height" => 291, "css" => "img-fluid"]);?>
				<?=ImageOptimize::widget(["src" => '/theme/img/about/03.jpg', "alt" => "memory care", "width" => 370, "height" => 291, "css" => "img-fluid"]);?>
				<?=ImageOptimize::widget(["src" => '/theme/img/about/04.jpg', "alt" => "andgie fred", "width" => 370, "height" => 291, "css" => "img-fluid"]);?>
			</div>
		</div>
		<div class="col-12 col-md-6 ps-md-6">
			<p class="main-desc max-w-490-sm mb-2 mb-md-25">We are founded on entrepreneurialism, and we are a small business at heart. We work closely with the local community and stay involved. This business exists to help others in a time of need. When a loved one needs care, it can be overwhelming. We hope that our site helps ease that stress.</p>
			<p class="main-desc max-w-490-sm mb-2 mb-md-25 fw-bold"><u><i>GerogiaCaring.com's mission is to help others through a stressufl time.</i></u> We know first hand the difficulties of finding care for a loved one. Our site features tools and resources to make the process easier.</p>
			<p class="main-desc max-w-490-sm">From the care offered, amenities, to pricing and distance from relatives, our site is designed to give you the info you need so you can make the best decision. And if that is not enough, our experts are here to assist in any way you need.</p>
		</div>
	</div>
</section>

<section class="values container-fluid max-w-1260">
	<h2 class="title mb-4 mb-md-7">Our values</h2>
	<div class="row mb-2 mb-md-3">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="main-desc inner bg-color-1">
				<h2 class="ff-pt-serif max-w-415-sm">Transparency</h2>
				<p>Our company culture is one of transparency. Employees and our website visitors must know the reasons we do what we do, so that trust can exist.</p>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="main-desc inner bg-color-2">
				<h2 class="ff-pt-serif max-w-415-sm">Integrity</h2>
				<p>Take the high road or the high road will take you. We believe in doing the right thing from the start so we can help people long-term.</p>
			</div>
		</div>
	</div>
	<div class="mb-2 mb-md-3 bg-color-3">
		<div class="row align-items-center">
			<div class="col-12 col-md-6">
				<div class="main-desc inner max-w-480-sm m-auto">
					<h2 class="big ff-pt-serif">A commitment to quality</h2>
					<p>We understand the importance of high-quality, and we strive to have it show in everything we do.</p>
					<blockquote>"Working with the team at GeorgiaCaring.com is always rewarding. We truly help people - <b>Lindsay H</b></blockquote>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div id="js_slider_for" class="slider-for">
					<?=ImageOptimize::widget(["src" => '/theme/img/about/slide_03.jpg', "alt" => "", "width" => 767, "height" => 633, "css" => "img-fluid"]);?>

				</div>
				<div class="slider-footer ff-airbnb-cereal-app">
					<div id="js_custom_nav" class="custom-nav">
						<a href="#" role="button" tabindex="-1" class="slider-arrow prev">Prev</a>
						<a href="#" role="button" tabindex="-1" class="slider-arrow next">Next</a>
					</div>
					<div id="js_slider_nav" class="slider-nav">
						<div class="item">This website was a huge help to me when I was looking for care for my husband. - <b>Elaine C</b></div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="main-desc inner bg-color-4">
				<h2 class="ff-pt-serif max-w-415-sm">Innovation</h2>
				<p>We strive to innovate in everything we do. From website features to how we manage our relationships, our goal is to raise the bar.</p>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="main-desc inner bg-color-5">
				<h2 class="ff-pt-serif max-w-415-sm">Boldness</h2>
				<p>You learn as you get older that some rules were meant to be broken. We pride ourselves on being bold in the name of helping others.</p>
			</div>
		</div>
	</div>
</section>
