<?php

use common\models\Users;
use frontend\assets\AppAsset;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\BootstrapAsset;
use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title  = Yii::t('app', $model['title']);
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('@web/theme/css/post.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
?>

<section class="section">
	<div class="container">
		<header class="section__title text-start">
			<h2><?=$model['title'];?></h2>

			<div class="actions actions--section">

			</div>
		</header>

		<div class="col-md-10">
			<p>
				<?=$model['content'];?>
			</p>
		</div>
	</div>
</section>

<section class="article">
	<div class="container">
		
		<div class="row">
			<div class="col-12 col-xl-2"></div>
			<div class="col-12 col-xl-7">
				<div class="article__stickers d-flex align-items-center flex-wrap mb-15">
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Home</div>
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Resources</div>
					<div class="article-sticker me-1 mb-1 mb-md-0 d-flex align-items-center justify-content-center">Senior Living</div>
				</div>
			</div>
			<div class="col-12 col-xl-3"></div>
		</div>

		<div class="row">

			<div class="col-12 col-xl-2">
				<div class="d-block d-xl-none">
					<h1 class="main-title mb-15"><?=$model['title'];?></h1>
					<div class="article-info-box d-flex mb-25">
						<span class="article__info me-2">By Jonathan Holloway</span>
						<span class="article__info me-1">July 30, 2021</span>
					</div>
				</div>
				<div class="article-content__open-tab-btn d-flex d-xl-none align-items-center justify-content-between mb-1">
					<span>Table of Contents</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<div class="article-content__body d-none d-xl-block">
					<h4 class="article__content-title">Content</h4>
					<a class="article__content-link article__content-link--active text-decoration-none mb-1" href="#">What is E-A-T</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How important is EAT?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How is EAT evaluated?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">Is E-A-T a ranking factor?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">Do websites have an E-A-T score?</a>
					<a class="article__content-link text-decoration-none mb-1" href="#">How to improve and demonstrate E-A-T</a>
				</div>
				<div class="article-author__open-tab-btn d-flex d-xl-none align-items-center justify-content-between mb-2">
					<span>Author Bio</span>
					<img src="../shared/images/select-icon-checkbox.png" alt="">
				</div>
				<div class="article-author__body d-none">
					<img class="mb-2" src="./img/article-avatar.png" alt="">
					<div class="article-autor__name">Jonathan Holloway</div>
					<div class="article-autor__position mb-15">Certified Senior Advisor</div>
					<p class="article-autor__short-info mb-15">Head of Content @ Ahrefs (or, in plain English, I'm the guy responsible for ensuring that every blog post we publish is EPIC).</p>
					<div class="d-flex">
						<a href="#" class="social-icon-wrapp d-flex align-items-center justify-content-center rounded-circle me-1"><i class="zmdi zmdi-twitter"></i></a>
						<a href="#" class="social-icon-wrapp d-flex align-items-center justify-content-center rounded-circle"><i class="zmdi zmdi-linkedin"></i></a>
					</div>
				</div>
			</div>

			<div class="col-12 col-xl-7 main-text-content text-color-black">
				<div class="d-none d-xl-block">
					<h1 class="main-title mb-15">What is E‑A-T? Why It’s Important for senior living</h1>
					<div class="article-info-box d-flex mb-25">
						<span class="article__info me-2">By Jonathan Holloway</span>
						<span class="article__info me-1">July 30, 2021</span>
					</div>
				</div>
				<p>People started talking about E‑A-T in August 2018, and it’s been mentioned in hundreds of SEO articles ever since.</p>
				<p class="highlighted-paragraph">If you ask a group of people what eating healthy means to them, you’ll probably get a different answer every time.</p>
				<p>For some, healthy eating means reining in a fast food habit or consuming more fruits and vegetables, while for others it may mean occasionally enjoying a piece of cake without feeling guilty.Still yet, those who have certain medical conditions and even food allergies may conceptualize the concept of healthy eating in their own unique way.
				</p>
				<p>What’s more, what healthy eating means to you may even change throughout the different stages of your life as you grow and adapt to your ever-changing needs. Healthy eating is human, and as humans, we all have different wants and needs, which inevitably affect our food choices.
				</p>
				<h2 class="article-subtitle mb-2 mb-md-3 mt-1 mt-md-5">What healthy eating means for me. It comes from Senior</h2>
				<p>E‑A-T- stands for expertise, authoritativeness, and trustworthiness. It comes from Google’s Search Quality Rater Guidelines—a 168-page document used by human quality raters to assess the quality of Google’s search results.</p>
				<p>By the time I was in college, healthy eating was about following nutritional guidelines and doing everything by the book. However, it meant that my view of the food on my plate had changed. I went from seeing meals I enjoyed to only seeing nutrients.</p>
				<p class="highlighted-paragraph">Established in 2002, this Elmcroft location holds an assisted living license to care for 75 residents, 61 in assisted living and 14 in memory care.</p>
				<p>Among the beautiful apartments and communal gathering spaces, residents love to come together for socializing and activities. There are multiple spaces for gathering inside and out. There are areas to sit and visit or play cards or billiards and more.</p>
				<img class="img-fluid" src="./img/article-img-1.png" alt="">
				<h2 class="article-subtitle mb-2 mb-md-3 mt-1 mt-md-5">E‑A-T is important for all queries, but some more so than others.</h2>
				
				<h3 class="article__numeric-title">1. Just searching for pictures</h3>
				<p>If you’re just searching for pictures of cute cats, then E‑A-T probably doesn’t matter that much. The topic is subjective, and it’s no big deal if you see a cat you don’t think is cute.</p>
				<p class="highlighted-paragraph">Established in 2002, this Elmcroft location holds an assisted living license to care for 75 residents, 61 in assisted living and 14 in memory.</p>
				<p>Among the beautiful apartments and communal gathering spaces, residents love to come together for socializing and activities. There are multiple spaces for gathering inside and out. There are areas to sit and visit or play cards or billiards and more.</p>
				<h3 class="article__numeric-title">2. Important for queries</h3>
				<p>Given the nature of the information being sought here, that’s not just mildly inconvenient—it’s potentially life-threatening.</p>
				<p>E‑A-T is also important for queries like “how to improve credit score.” Here, advice from the clueless and unauthoritative is unlikely to be legit and shouldn’t be trusted.</p>
				<h3 class="article__numeric-title">3. Our Mentors Tips</h3>
				<p>Expertise, authoritativeness, and trustworthiness are similar concepts—but not identical. So, they’re each evaluated independently using a different set of criteria. Given the nature of the information being sought here.</p>
				
				<img class="img-fluid" src="./img/article-img-3.png" alt="">
				<h2 class="article-subtitle mb-2 mb-md-3 mt-1 mt-md-5">They’re Rich in Vitamins and Plant Compounds</h2>
				<p>E‑A-T- stands for expertise, authoritativeness, and trustworthiness. It comes from Google’s Search Quality Rater Guidelines—a 168-page document used by human quality raters to assess the quality of Google’s search results.</p>
				<p>By the time I was in college, healthy eating was about following nutritional guidelines and doing everything by the book. However, it meant that my view of the food on my plate had changed. I went from seeing meals I enjoyed to only seeing nutrients.</p>
				<h3 class="article-subtitle-small">Enjoy this read?</h3>
				<p>Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
				<p>E‑A-T- stands for expertise, authoritativeness, and trustworthiness. It comes from Google’s Search Quality Rater Guidelines—a 168-page document used by human quality raters to assess the quality of Google’s search results.</p>
				<p class="highlighted-paragraph">Established in 2002, this Elmcroft location holds an assisted living license to care for 75 residents, 61 in assisted living and 14 in memory care.</p>
				<p>Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
				<h3 class="article-subtitle-small">Final thoughts</h3>
				<p>E‑A-T is important for SEO, and it’s something that you should work to improve—especially if you cover YMYL topics. If that sounds annoying, remember that Google doesn’t owe you a living. Having a website doesn’t necessarily mean you deserve to rank. If there’s better, more authoritative content out there, or competitors with better products or services, then Google will, quite rightly, try to send traffic their way—not yours. </p>
				<p>E‑A-T- stands for expertise, authoritativeness, and trustworthiness. It comes from Google’s Search Quality Rater Guidelines—a 168-page document used by human quality raters to assess the quality of Google’s search results.</p>
				<p>By the time I was in college, healthy eating was about following nutritional guidelines and doing everything by the book. However, it meant that my view of the food on my plate had changed. I went from seeing meals I enjoyed to only seeing nutrients.</p>
			</div>

			<div class="article-autor col-12 col-xl-3 d-none d-xl-block">
				<img class="mb-2" src="./img/article-avatar.png" alt="">
				<div class="article-autor__name">Jonathan Holloway</div>
				<div class="article-autor__position mb-15">Certified Senior Advisor</div>
				<p class="article-autor__short-info mb-15">Head of Content @ Ahrefs (or, in plain English, I'm the guy responsible for ensuring that every blog post we publish is EPIC).</p>
				<div class="d-flex">
					<a href="#" class="social-icon-wrapp d-flex align-items-center justify-content-center rounded-circle me-1"><i class="zmdi zmdi-twitter"></i></a>
					<a href="#" class="social-icon-wrapp d-flex align-items-center justify-content-center rounded-circle"><i class="zmdi zmdi-linkedin"></i></a>
				</div>
			</div>
			
		</div>
	</div>

	<div class="container main-text-content text-color-black">
		<div class="row">
			<div class="col-12 col-xl-2"></div>
			<div class="col-12 col-xl-8">
				<h3 class="article-subtitle-small">Related Articles</h3>
				<p class="mb-4">Trust is about the legitimacy, transparency, and accuracy of the</br> website and its content.</p>

				<div class="related-article-list row mb-0 mb-md-4">
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-1.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Keep content up to date Although the Quality Raters</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-2.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Lots of people get hung up with this one</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
				</div>
				<div class="related-article-list row mb-5">
					<div class="related-article-item col-12 col-md-6 mb-3 mb-md-0">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-3.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Keep content up to date Although the Quality Raters</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
					<div class="related-article-item col-12 col-md-6">
						<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-4.png" alt="">
						<div class="related-article-item__sticker d-flex align-items-center justify-content-center mb-1">Raters look for a number</div>
						<a href="#" class="related-article-item__title mb-15 text-decoration-none">Lots of people get hung up with this one</a>
						<p class="related-article-item__text">Trust is about the legitimacy, transparency, and accuracy of the website and its content.</p>
					</div>
				</div>
			</div>
			<div class="col-12 col-xl-2"></div>
		</div>
		<div class="divider-wrapp mb-2">
			<img src="../shared/images/divider.png" alt="">
		</div>
	</div>

</section>
