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

$this->registerCssFile('@web/theme/plugins/slick/css/slick.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/plugins/slick/css/slick-theme.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/css/pages/about.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/plugins/slick/js/slick.min.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/js/pages/about.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);

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

<section class="partners container-fluid max-w-1000">
	<div class="wrap">
		<div class="inner">
			<img class="img-fluid" src="/theme/logos/airbnb.svg" alt="" width="70" height="23">
			<img class="img-fluid" src="/theme/logos/hubspot.svg" alt="" width="76" height="23">
			<img class="img-fluid" src="/theme/logos/google.svg" alt="" width="66" height="23">
			<img class="img-fluid" src="/theme/logos/microsoft.svg" alt="" width="101" height="23">
			<img class="img-fluid" src="/theme/logos/walmart.svg" alt="" width="93" height="23">
			<img class="img-fluid" src="/theme/logos/fedex.svg" alt="" width="72" height="23">
		</div>
	</div>
</section>

<section class="content container-fluid max-w-1260">
	<div class="row mb-5 mb-md-9">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="label ff-inter mb-15">// Our Mission</div>
			<h2 class="title ff-pt-serif m-0 max-w-430">Change every part of your community in real time.</h2>
		</div>
		<div class="col-12 col-md-6 ps-md-6">
			<div class="line mb-2 mb-md-3"></div>
			<p class="main-desc max-w-490-sm mb-25 mb-md-3">You receive the money for free within three working days and we get it back when you receive your next income. It's simple and it allows you to stay in control in case of a glitch without having a bank on your tail.</p>
			<a class="btn-primary-medium contact-btn" href="/contact-us/">Contact Us</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="mission-galery">
				<img class="img-fluid" src="/theme/img/about/01.jpg" alt="" width="370" height="291">
				<img class="img-fluid" src="/theme/img/about/02.jpg" alt="" width="370" height="291">
				<img class="img-fluid" src="/theme/img/about/03.jpg" alt="" width="370" height="291">
				<img class="img-fluid" src="/theme/img/about/04.jpg" alt="" width="370" height="291">
			</div>
		</div>
		<div class="col-12 col-md-6 ps-md-6">
			<p class="main-desc max-w-490-sm mb-2 mb-md-25">We are founded on entrepreneurialism, are solely backed by entrepreneurs and invest in the next generation of entrepreneurs. We love what we do, and it’s in our DNA to work with inspiring innovators. Get to know us, before we get to know your business.</p>
			<p class="main-desc max-w-490-sm mb-2 mb-md-25 fw-bold"><u><i>Bling's mission is to help you be financially healthy.</i></u> By supporting you in the event of the unforeseen without worsening the situation and by helping you to manage your budget well. Knowing what you're doing with your money is the best way to stay in control of it.</p>
			<p class="main-desc max-w-490-sm">We are founded on entrepreneurialism, are solely backed by entrepreneurs and invest in the next generation of entrepreneurs. We love what we do, and it’s in our DNA to work with inspiring innovators. Get to know us, before we get to know your business.</p>
		</div>
	</div>
</section>

<section class="values container-fluid max-w-1260">
	<h2 class="title mb-4 mb-md-7 text-center">Our values</h2>
	<div class="row mb-2 mb-md-3">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="main-desc inner bg-color-1">
				<h2 class="ff-pt-serif max-w-415-sm">Consumer, Company, Team, Self department</h2>
				<p>We lean on each other to succeed. Understanding different viewpoints and celebrating our coworkers' wins lead to stronger decisions and teams.</p>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="main-desc inner bg-color-2">
				<h2 class="ff-pt-serif max-w-415-sm">Consumer, Company, Team, Self department</h2>
				<p>We lean on each other to succeed. Understanding different viewpoints and celebrating our coworkers' wins lead to stronger decisions and teams.</p>
			</div>
		</div>
	</div>
	<div class="mb-2 mb-md-3 bg-color-3">
		<div class="row align-items-center">
			<div class="col-12 col-md-6">
				<div class="main-desc inner max-w-480-sm m-auto">
					<h2 class="big ff-pt-serif">A commitment to quality</h2>
					<p>A good reputation is hard earned and easily lost. Caring understand that technology products are essential to our customers.</p>
					<blockquote>" I could not be more thrilled that I ended up deciding on Circle to become the home of the Caring Moment community - <b>Larry</b></blockquote>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div id="js_slider_for" class="slider-for">
					<img class="img-fluid" src="/theme/img/about/slide_01.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_02.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_03.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_04.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_05.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_06.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_07.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_08.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_09.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_10.jpg" alt="" width="767" height="633">
					<img class="img-fluid" src="/theme/img/about/slide_11.jpg" alt="" width="767" height="633">
				</div>
				<div class="slider-footer ff-airbnb-cereal-app">
					<div id="js_custom_nav" class="custom-nav">
						<a href="#" role="button" tabindex="-1" class="slider-arrow prev">Prev</a>
						<a href="#" role="button" tabindex="-1" class="slider-arrow next">Next</a>
					</div>
					<div id="js_slider_nav" class="slider-nav">
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Alexa Bliss</b></div>
						<div class="item">They are so unique and modern. I really love their service. Thanks a lot cursor for helping me - <b>James Smith</b></div>
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Liam Johnson</b></div>
						<div class="item">They are so unique and modern. I really love their service. Thanks a lot cursor for helping me - <b>Mason Williams</b></div>
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Jacob Jones</b></div>
						<div class="item">They are so unique and modern. I really love their service. Thanks a lot cursor for helping me - <b>William Brown</b></div>
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Ethan Hunt</b></div>
						<div class="item">They are so unique and modern. I really love their service. Thanks a lot cursor for helping me - <b>Michael Davis</b></div>
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Alexander Miller</b></div>
						<div class="item">They are so unique and modern. I really love their service. Thanks a lot cursor for helping me - <b>Abraham Wilson</b></div>
						<div class="item">I really love their service. They are so unique and modern. Thanks a lot cursor for helping me - <b>Adrian Moore</b></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 mb-2 mb-md-0">
			<div class="main-desc inner bg-color-4">
				<h2 class="ff-pt-serif max-w-415-sm">Consumer, Company, Team, Self department</h2>
				<p>We lean on each other to succeed. Understanding different viewpoints and celebrating our coworkers' wins lead to stronger decisions and teams.</p>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="main-desc inner bg-color-5">
				<h2 class="ff-pt-serif max-w-415-sm">Consumer, Company, Team, Self department</h2>
				<p>We lean on each other to succeed. Understanding different viewpoints and celebrating our coworkers' wins lead to stronger decisions and teams.</p>
			</div>
		</div>
	</div>
</section>
