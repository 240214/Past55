<?php

use common\models\Posts;
use common\models\Pages;
use yii\helpers\Url;
use frontend\widgets\PageLink;

#$blog = Posts::find()->select(['blog_title', 'created_at', 'id'])->limit(3)->all();

?>
<footer class="footer trans-all">
	<div class="row pt-85 pb-35 px-75 footer__top-box">
		<div class="col-xl-3 col-md-12 pe-85 mb-2">
			<div class="footer__logo text-white mb-2"><?=Yii::$app->params['settings']['site_title']?></div>
			<p class="main-text-content footer__text mb-3"><?=Yii::$app->params['settings']['footer_description']?></p>
			<div class="d-flex justify-content-center justify-content-xl-start">
				<a href="//<?=Yii::$app->params['settings']['facebook']?>" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-facebook"></i></a>
				<a href="//<?=Yii::$app->params['settings']['google']?>" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-google-plus"></i></a>
				<a href="//<?=Yii::$app->params['settings']['twiter']?>" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-twitter"></i></a>
				<a href="//<?=Yii::$app->params['settings']['instagram']?>" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-instagram"></i></a>
				<a href="//<?=Yii::$app->params['settings']['linkedin']?>" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-linkedin"></i></a>
			</div>
		</div>
		<div class="col-xl-2 col-6 mb-2">
			<div class="footer__subtitle text-white mb-2">About Us</div>
			<ul class="footer__list">
				<li class="footer__item"><?=PageLink::widget(['slug' => 'our-story', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'contact-us', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'press-media', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'carriers', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'careers-team', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
			</ul>
		</div>
		<div class="col-xl-2 col-6 mb-2">
			<div class="footer__subtitle text-white mb-2">Resources</div>
			<ul class="footer__list">
				<li class="footer__item"><?=PageLink::widget(['slug' => 'privacy-policy', 'tag_class' => 'footer__link text-white d-block mb-15', 'custom_title' => 'Our Policies']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'life-insurance-101', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><?=PageLink::widget(['slug' => 'refer-get-10', 'tag_class' => 'footer__link text-white d-block mb-15']);?></li>
				<li class="footer__item"><a href="<?=Url::toRoute('blog/index')?>" class="footer__link text-white d-block mb-15">Blog</a></li>
				<li class="footer__item"><a href="<?=Url::toRoute('login')?>" class="footer__link text-white d-block mb-15">Account Login</a></li>
			</ul>
		</div>
		<div class="col-xl-2 col-md-12 mb-2 pe-1">
			<div class="footer__subtitle text-white mb-2">Our Address</div>
			<p class="main-text-content text-white mb-2"><?=Yii::$app->params['settings']['address']?></p>

			<ul class="footer__list">
				<li class="text-white"><span>Email:</span> <a href="mailto:<?=Yii::$app->params['settings']['email']?>" class="footer__link text-white"><?=Yii::$app->params['settings']['email']?></a></li>
				<li class="text-white"><span>Phone:</span> <a href="tel:<?=Yii::$app->params['settings']['mobile']?>" class="footer__link text-white"><?=Yii::$app->params['settings']['mobile']?></a></li>
				<li class="text-white"><span>Office Time:</span> <?=Yii::$app->params['settings']['office_time']?></li>
			</ul>
		</div>
		<div class="col-xl-3 col-md-12 mb-2">
			<div class="footer__subtitle text-white mb-2">Disclaimer</div>
			<p class="main-text-content text-white"><?=Yii::$app->params['settings']['disclaimer']?></p>
		</div>
	</div>
	<div class="footer__divider"></div>
	<div class="footer__bottom-box d-flex flex-column flex-md-row align-items-center justify-content-between px-2 px-md-60 pb-2 pb-md-35 pt-2">
		<?=PageLink::widget(['slug' => 'privacy-policy', 'tag_class' => 'main-text-content text-white text-decoration-none']);?>
		<?=PageLink::widget(['slug' => 'terms-and-conditions', 'tag_class' => 'main-text-content text-white text-decoration-none']);?>
		<div class="footer__copyright main-text-content text-white text-decoration-none text-center text-md-end"><?=Yii::$app->params['settings']['site_name'];?>, All Rights Reserved. © <?=date('Y');?></div>
	</div>
</footer>

<div id="js_loader" class="loader trans_me"><div class="page-loader__spinner"></div></div>
<div id="js_backdrop" data-trigger="js_action_click" data-action="" data-target="" class="rmd-backdrop dark"></div>

<!-- Older IE warning message -->
<!--[if lt IE 11]>
<div class="ie-warning">
	<h1>Warning!!</h1>
	<p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
	<div class="ie-warning__inner">
		<ul class="ie-warning__download">
			<li>
				<a href="http://www.google.com/chrome/">
					<img src="img/browsers/chrome.png" alt="">
					<div>Chrome</div>
				</a>
			</li>
			<li>
				<a href="https://www.mozilla.org/en-US/firefox/new/">
					<img src="img/browsers/firefox.png" alt="">
					<div>Firefox</div>
				</a>
			</li>
			<li>
				<a href="http://www.opera.com">
					<img src="img/browsers/opera.png" alt="">
					<div>Opera</div>
				</a>
			</li>
			<li>
				<a href="https://www.apple.com/safari/">
					<img src="img/browsers/safari.png" alt="">
					<div>Safari</div>
				</a>
			</li>
			<li>
				<a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
					<img src="img/browsers/ie.png" alt="">
					<div>IE (New)</div>
				</a>
			</li>
		</ul>
	</div>
	<p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- IE9 Placeholder -->
<!--[if IE 11 ]>
<script src="<?=Yii::getAlias('@web');?>/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<![endif]-->
