<?php

use yii\bootstrap\BootstrapAsset;
use frontend\assets\AppAsset;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
#use yii\widgets\Breadcrumbs;
#use frontend\components\BreadcrumbsNew;
use yii\web\View;
use yii\widgets\Pjax;
use common\models\Users;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\Property;
use yii\widgets\LinkPager;
use frontend\widgets\Breadcrumbs;
use frontend\widgets\CategoryContentList;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerMetaTag(['name' => 'description', 'content' => $meta['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $meta['keywords']]);
if($meta['noindex']){
	$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,nofollow']);
}
$this->title = $meta['title'];
$this->registerCssFile('@web/theme/css/category-template.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
?>
<section class="hub-page">
	<div class="hub-page__first-screen">
		<h1 class="d-none d-md-block main-title text-center mb-3">How to create, sell, and<br> profit from an online course</br> in 2021</h1>
		<h1 class="d-block d-md-none main-title text-center mb-2">How to create, sell, and profit from an online course in 2021</h1>
		<p class="main-text-content text-color-black text-center mb-0">People started talking about E‑A-T in August 2018, and it’s been mentioned</br> in hundreds of SEO articles ever since.</p>
	</div>
</section>

<section class="container main-text-content text-color-black pt-4 pt-md-9">
	<div class="row mb-7">
		
		<div class="col-12">
			<h2 class="hub-page__title mb-2">What is E‑A-T? Why It’s Important</br> for senior living</h2>
			<div class="mb-3 mb-md-4 d-flex align-items-center">
				<img class="me-2" src="./img/hub-page-author-avatar.png" alt="">
				<div class="author-info">
					<date>October 15, 2021 by</date>
					<a href="#" class="text-color-primary">Jackie Mckoy</a>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-9">
			<p class="main-text-content text-color-black">People started talking about E‑A-T in August 2018, and it’s been mentioned in hundreds of SEO articles ever since.</p>
			<p class="main-text-content text-color-black highlighted-paragraph text-decoration-underline fst-italic fw-weight-bolder">If you ask a group of people what eating healthy means to them, you’ll probably get a</br> different answer every time.</p>
			<p class="main-text-content text-color-black">For some, healthy eating means reining in a fast food habit or consuming more fruits and vegetables, while for others it may mean occasionally enjoying a piece of cake without feeling guilty.Still yet, those who have certain medical conditions and even food allergies may conceptualize the concept of healthy eating in their own unique way.</p>
			<p class="main-text-content text-color-black">What’s more, what healthy eating means to you may even change throughout the different stages of your life as you grow and adapt to your ever-changing needs. Healthy eating is human, and as humans, we all have different wants and needs, which inevitably affect our food choices.</p>
			<p class="main-text-content text-color-black">For some, healthy eating means reining in a fast food habit or consuming more fruits and vegetables, while for others it may mean occasionally enjoying a piece of cake without feeling guilty.Still yet, those who have certain medical conditions and even food allergies may conceptualize the concept of healthy eating in their own unique way.</p>
			<ul class="check-list">
				<li>What is assisted living</li>
				<li>Assisted living cost</li>
				<li>Paying for assisted living</li>
				<li>Medicare assisted living</li>
				<li>Assisted living tax deduction</li>
				<li>Difference between assisted living and nursing home</li>
				<li>When to move from assisted living to nursing home</li>
				<li>Does long term care insurance cover assisted living</li>
				<li>Signs it is time for assisted living</li>
				<li>Talking to parent about moving to assisted living</li>
				<li>Georgia regulations for assisted living</li>
			</ul>
			<h3 id="section_1" class="numbered-title mb-2 mb-md-25">1. Just searching for pictures</h3>
			<p class="main-text-content text-color-black">If you’re just searching for pictures of cute cats, then E‑A-T probably doesn’t matter that much. The topic is subjective, and it’s no big deal if you see a cat you don’t think is cute.</p>
			<p class="main-text-content text-color-black highlighted-paragraph fst-italic">Established in 2002, this Elmcroft location holds an assisted living license to care for 75 residents, 61 in assisted living and 14 in memory.</p>
			<p class="main-text-content text-color-black">Among the beautiful apartments and communal gathering spaces, residents love to come together for socializing and activities. There are multiple spaces for gathering inside and out. There are areas to sit and visit or play cards or billiards and more.</p>
			<h3 id="section_2" class="numbered-title mb-2 mb-md-25">2. Senior Living Quotes</h3>
			<p class="main-text-content text-color-black">If you’re just searching for pictures of cute cats, then E‑A-T probably doesn’t matter that much. The topic is subjective, and it’s no big deal if you see a cat you don’t think is cute.</p>
			<p class="main-text-content text-color-black highlighted-paragraph fst-italic">Established in 2002, this Elmcroft location holds an assisted living license to care for 75 residents, 61 in assisted living and 14 in memory.</p>
			<p class="main-text-content text-color-black">Among the beautiful apartments and communal gathering spaces, residents love to come together for socializing and activities. There are multiple spaces for gathering inside and out. There are areas to sit and visit or play cards or billiards and more.</p>
		</div>

		<aside class="col-12 col-md-3 mt-4 mt-md-0">
			<div class="sticky-block">
				<?=CategoryContentList::widget(['category_id' => $category_id, 'title' => 'Content']);?>
				<h4 class="content-title">Content</h4>
				<ul class="content-list">
					<li><a href="#section_1">What is assisted living?</a></li>
					<li><a href="#section_2">Assisted living cost</a></li>
					<li><a href="#">Paying for assisted living</a></li>
					<li><a href="#">Medicare assisted living</a></li>
					<li><a href="#">Assisted living tax deduction</a></li>
					<li><a href="#">Difference between assisted living and nursing home</a></li>
					<li><a href="#">When to move from assisted living to nursing home</a></li>
					<li><a href="#">Does long term care insurance cover assisted living</a></li>
					<li><a href="#">Signs it is time for assisted living</a></li>
					<li><a href="#">Talking to parent about moving to assisted living</a></li>
					<li><a href="#">Georgia regulations for assisted living</a></li>
				</ul>
			</div>
		</aside>
		
	</div>
</section>

<section class="container main-text-content text-color-black pt-4 pt-md-9">
	<h3 class="highlighted-title mb-3 mb-md-4">Related Articles</h3>
	<div class="row mb-2 mb-md-6">
		<div class="col-12 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-img-1.png" alt="">
				<div class="related-article-card__author mb-1">
					<img class="me-1" src="./img/related-article-author-img-1.png" alt="">
					<span class="related-article-card__author-name">Jane Cooper</span>
				</div>
				<a href="#" class="related-article-card__title d-block mb-15 mb-md-2 text-decoration-none">No one cares until
					someone cares; be that one!</a>
				<p class="related-article-card__text mb-2">The phrase ‘Love one another’ is so wise. By loving
					one another, we invest in each other and ourselves</p>
				<a href="#" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
		<div class="col-12 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-img-2.png" alt="">
				<div class="related-article-card__author mb-1">
					<img class="me-1" src="./img/related-article-author-img-2.png" alt="">
					<span class="related-article-card__author-name">Jane Cooper</span>
				</div>
				<a href="#" class="related-article-card__title d-block mb-15 mb-md-2 text-decoration-none">No one cares until
					someone cares; be that one!</a>
				<p class="related-article-card__text mb-2">The phrase ‘Love one another’ is so wise. By loving
					one another, we invest in each other and ourselves</p>
				<a href="#" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
		<div class="col-12 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-img-3.png" alt="">
				<div class="related-article-card__author mb-1">
					<img class="me-1" src="./img/related-article-author-img-3.png" alt="">
					<span class="related-article-card__author-name">Jane Cooper</span>
				</div>
				<a href="#" class="related-article-card__title d-block mb-15 mb-md-2 text-decoration-none">No one cares until
					someone cares; be that one!</a>
				<p class="related-article-card__text mb-2">The phrase ‘Love one another’ is so wise. By loving
					one another, we invest in each other and ourselves</p>
				<a href="#" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
		<div class="col-12 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<img class="img-fluid mb-2 mb-md-3" src="./img/related-article-img-4.png" alt="">
				<div class="related-article-card__author mb-1">
					<img class="me-1" src="./img/related-article-author-img-4.png" alt="">
					<span class="related-article-card__author-name">Jane Cooper</span>
				</div>
				<a href="#" class="related-article-card__title d-block mb-15 mb-md-2 text-decoration-none">No one cares until
					someone cares; be that one!</a>
				<p class="related-article-card__text mb-2">The phrase ‘Love one another’ is so wise. By loving
					one another, we invest in each other and ourselves</p>
				<a href="#" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
	</div>
</section>
