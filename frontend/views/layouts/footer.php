<?php

use common\models\Blog;
use common\models\Pages;
use yii\helpers\Url;
use frontend\widgets\Links;

$blog = Blog::find()->select(['blog_title', 'created_at', 'id'])->limit(3)->all();

?>
<footer class="footer">
	<div class="row pt-85 pb-35 px-75 footer__top-box">
		<div class="col-xl-3 col-md-12 pe-85 mb-2">
			<div class="footer__logo text-white mb-2">GeorgiaCaring</div>
			<p class="main-text-content footer__text mb-3">Lorem ipsum dolor sit adipiscing elit. Viverra velit, pretium, tristique laoreet eget odio sed sed.</p>
			<div class="d-flex justify-content-center justify-content-xl-start">
				<a href="#" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-facebook"></i></a>
				<a href="#" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-google-plus"></i></a>
				<a href="#" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-instagram"></i></a>
				<a href="#" class="footer__social-icon-box d-flex justify-content-center align-items-center me-15"><i class="zmdi zmdi-linkedin"></i></a>
			</div>
		</div>
		<div class="col-xl-2 col-6 mb-2">
			<div class="footer__subtitle text-white mb-2">About Us</div>
			<ul class="footer__list">
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Our Story</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Contact Us</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Press & Media</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Carriers</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Careers/Team</a></li>
			</ul>
		</div>
		<div class="col-xl-2 col-6 mb-2">
			<div class="footer__subtitle text-white mb-2">Resources</div>
			<ul class="footer__list">
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Our Policies</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Life Insurance 101</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Refer. get $10</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Blog</a></li>
				<li class="footer__item"><a href="#" class="footer__link text-white d-block mb-15">Account Login</a></li>
			</ul>
		</div>
		<div class="col-xl-2 col-md-12 mb-2 pe-1">
			<div class="footer__subtitle text-white mb-2">Our Address</div>
			<p class="main-text-content text-white mb-2">3233 Poplar Street, Burr<br /> Ridge, Illinois, USA</p>

			<ul class="footer__list">
				<li class="text-white"><b>Email:</b> <a href="mailto:info@mikostudio.com" class="footer__link text-white">info@mikostudio.com</a></li>
				<li class="text-white"><b>Phone:</b> <a href="tel:785358412890" class="footer__link text-white">(785) 358412890</a></li>
				<li class="text-white"><b>Office Time:</b> 10am - 8pm</li>
			</ul>
		</div>
		<div class="col-xl-3 col-md-12 mb-2">
			<div class="footer__subtitle text-white mb-2">Disclaimer</div>
			<p class="main-text-content text-white">The information on Past55.com is for informational purposes only
				and is not to be construed as legal or health advice. Past55.com strives to keep community
				information up to date. This information may be different than what you see on a community’s
				website. Please review information on a communities website before making a decision.</p>
		</div>
	</div>
	<div class="footer__divider"></div>
	<div class="footer__bottom-box d-flex align-items-center justify-content-between px-2 px-md-75 pb-2 pb-md-35 pt-2">
		<a href="#" class="main-text-content text-white text-decoration-none">Privacy Policy</a>
		<a href="#" class="main-text-content text-white text-decoration-none">Terms & Conditions</a>
	</div>
</footer>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer__block">
					<a class="logo clearfix" href="#">
						<div class="logo__text">
							<span><?=Yii::$app->params['settings']['site_name']?></span>
							<span><?=Yii::$app->params['settings']['site_title']?></span>
						</div>
					</a>
					
					<address class="mt-3 f-14">
						<?=Yii::$app->params['settings']['address']?>
					</address>
					
					<div class="f-20"><?=Yii::$app->params['settings']['mobile']?></div>
					<div class="f-14 mt-2"><?=Yii::$app->params['settings']['email']?></div>
					
					<div class="f-20 mt-4">
						<a href="//<?=Yii::$app->params['settings']['google']?>" class="me-4"><i class="zmdi zmdi-google"></i></a>
						<a href="//<?=Yii::$app->params['settings']['facebook']?>" class="me-4"><i class="zmdi zmdi-facebook"></i></a>
						<a href="//<?=Yii::$app->params['settings']['twiter']?>"><i class="zmdi zmdi-twitter"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer__block footer__block--blog">
					<div class="footer__title">Latest from our blog</div>
					<?php
					foreach($blog as $bl){
						$BlogUrl = Url::toRoute('blog/detail/'.base64_encode($bl['id']).'/'.str_replace(' ', '+', $bl['blog_title']))
						?>
						<a href="<?=$BlogUrl?>">
							<?=$bl['blog_title']?>
							<small>On <?=date('Y/m/d', $bl['created_at'])?> at <?=date('h:i', $bl['created_at'])?> </small>
						</a>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer__block">
					<div class="footer__title">Disclaimer</div>
					
					<div><?=Yii::$app->params['settings']['disclaimer']?></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer__bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<?=Links::widget(['links_type' => 'pages']);?>
				</div>
				<div class="col-md-6">
					<div class="footer__copyright"><?=Yii::$app->params['settings']['site_name'];?>, All Rights Reserved. © <?=date('Y');?></div>
				</div>
			</div>
		</div>
		
		<div class="footer__to-top" data-rmd-action="scroll-to" data-rmd-target="html">
			<i class="zmdi zmdi-chevron-up"></i>
		</div>
	</div>
</footer>

<div id="js_loader" class="loader trans_me"><div class="page-loader__spinner"></div></div>
<div id="js_backdrop" data-trigger="js_action_click" data-action="" data-target="" class="rmd-backdrop dark"></div>

<!-- Older IE warning message -->
<!--[if lt IE 9]>
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
<!--[if IE 9 ]>
<script src="<?=Yii::getAlias('@web');?>/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
<![endif]-->
