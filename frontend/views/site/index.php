<?php

/* @var $this yii\web\View */

$this->title = 'Home - page';

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$this->registerCssFile('@web/theme/css/home.css', ['depends' => [BootstrapAsset::className()]]);

?>
<section class="first-screen-home">
	<div class="container">
		<div class="row justify-content-between align-items-center header-home__content">
			<div class="col-xl-5 col-12 mb-35">
				<h1 class="first-screen-home__title">Senior living<br /> <span class="title-decor-line">communities</span> <br /> in Georgia.</h1>
				<p class="main-text-content">See pricing, availability, care offered, nearby places and more.</p>
				<label class="header-home__search-wrapp">
					<input class="header-home__search-input rounded-8 bg-white" type="text"
					       placeholder="Enter a city or zip">
					<button class="header-home__search-btn btn-primary-small">Search</button>
				</label>
			</div>
			<div class="col-xl-7 col-12 d-none d-xl-flex justify-content-end ">
				<img src="/theme/img/home/first-screen-home-bg.png" alt="" class="img-fluid first-screen-home__bg">
			</div>
		</div>
	</div>
</section>
<section class="companies container">
	<img src="/theme/img/home/first-screen-home-bg.png" alt="" class="img-fluid d-xl-none d-block mb-4">
	<h2 class="secondary-title text-center mb-5">More than 80,000+ companies trust GeorgiaCaring</h2>
	<div class="d-flex justify-content-center align-items-center flex-wrap">
		<img class="m-3" src="/theme/img/home/company-1.png" alt="company-logo">
		<img class="m-3" src="/theme/img/home/company-2.png" alt="company-logo">
		<img class="m-3" src="/theme/img/home/company-3.png" alt="company-logo">
		<img class="m-3" src="/theme/img/home/company-4.png" alt="company-logo">
		<img class="m-3" src="/theme/img/home/company-5.png" alt="company-logo">
	</div>
</section>
<section class="benefits">
	<div class="container">
		<h1 class="main-title text-center mb-5">We spread care to provide<br /> quality life</h1>
		<div class="row">
			<div class="col-xl-4 col-md-12 mb-2">
				<div class="benefits-card d-flex flex-column">
					<img src="/theme/img/home/benefit-card-icon-1.png" alt="benefit-icon">
					<h4 class="benefit-card-title">See Pricing & Availability</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Most other websites try to hide
						pricing and availability in order to
						get you on the phone. Our site offers full transparency in sharing this information in order to
						save you time</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
			<div class="col-xl-4 col-md-12 mb-2">
				<div class="benefits-card d-flex flex-column">
					<img src="/theme/img/home/benefit-card-icon-1.png" alt="benefit-icon">
					<h4 class="benefit-card-title">Save Favorites & Compare</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Save a list of communities and compare
						amenities, care offered,
						distances and location, and more in side by side comparisons.</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
			<div class="col-xl-4 col-md-12 mb-2">
				<div class="benefits-card d-flex flex-column">
					<img src="/theme/img/home/benefit-card-icon-3.png" alt="benefit-icon">
					<h4 class="benefit-card-title">See Nearby Places</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Quickly see how far each community is
						from relatives, hospitals,
						pharmacies, parks, restaurants and more.</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
		</div>
	</div>
	<img class="benefits__bg d-none d-xl-block" src="/theme/img/home/benefits-section-bg.png" alt="">
</section>
<section class="location">
	<div class="container location__header mb-8">
		<h1 class="main-title text-center mb-2">Senior living locations</h1>
		<p class="main-text-content text-center">Our newsletter features articles from Richard, Gilfoyle and Dinesh, with<br /> occasional guest features from our investors and supporters.</p>
	</div>
	<div class="location__body py-6">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-10">
					<div
							class="location-card row align-items-start justify-content-between p-25 rounded-8 bg-white mb-3">
						<div class="col-xl-6 col-md-12 d-flex justify-content-center">
							<img class="img-fluid" src="/theme/img/home/location-card-img-1.png" alt="">
						</div>
						<div class="col-xl-6 col-md-12">
							<div class="location-card__location-name-box mt-65 text-color-primary">
								<i class="zmdi zmdi-star me-1"></i>Northern Georgia
							</div>
							<ul class="location-card__list">
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Atlanta<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Roswell<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Alpharetta<i class="bi bi-arrow-right-short"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="location-card row flex-row-reverse align-items-start justify-content-between p-25 rounded-8 bg-white mb-3">
						<div class="col-xl-6 col-md-12 d-flex justify-content-center">
							<img class="img-fluid" src="/theme/img/home/location-card-img-2.png" alt="">
						</div>
						<div class="col-xl-6 col-md-12">
							<div class="location-card__location-name-box mt-65 text-color-secondary">
								<i class="zmdi zmdi-star me-1"></i>Middle Georgia
							</div>
							<ul class="location-card__list">
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Miami<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Orlando<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Tampa<i class="bi bi-arrow-right-short"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="location-card row align-items-start justify-content-between p-25 rounded-8 bg-white">
						<div class="col-xl-6 col-md-12 d-flex justify-content-center">
							<img class="img-fluid" src="/theme/img/home/location-card-img-3.png" alt="">
						</div>
						<div class="col-xl-6 col-md-12">
							<div class="location-card__location-name-box mt-65 text-color-green">
								<i class="zmdi zmdi-star me-1"></i>South Georgia
							</div>
							<ul class="location-card__list">
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Greenville<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Charleston<i class="bi bi-arrow-right-short"></i></a></li>
								<li class="location-card__item"><a href="#"><i class="zmdi zmdi-pin me-15"></i>Coloumbia<i class="bi bi-arrow-right-short"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="contact-us text-center">
	<div class="container">
		<div class="contact-us__subtitle mb-2">We <i class="bi bi-heart-fill text-color-primary"></i> Love to Help</div>
		<h1 class="main-title mb-3">Are you looking for senior<br /> living <span class="title-decor-line">community?</span></h1>
		<a href="#" class="btn-primary-medium contact-us__btn">Contact Us</a>
	</div>
	<img class="contact-us__bg d-none d-md-block" src="/theme/img/home/contact-us-section-bg.png" alt="">
</section>

<section class="section living-communities bg-purple">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<h1 class="title">Senior Living Communities</h1>
				<p class="subtitle">The only website you will need when searching for a place to live.</p>
			</div>
			<div class="col-md-6">
				<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-4.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true, 'class' => 'mt-5 mt-md-0']);?>
			</div>
		</div>
	</div>
</section>
<section class="section living-locations">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-6">
				<h2 class="title">Senior Living Locations</h2>
			</div>
			<div class="col-md-6">
				<p class="subtitle">Our newsletter features articles from Richard, Gilfoyle and Dinesh, with occasional guest features from our investors and supporters.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'ga']);?>">Georgia</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'atlanta']);?>">Atlanta</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'roswell']);?>">Roswell</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'marietta']);?>">Marietta</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'fl']);?>">Florida</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'miami']);?>">Miami</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'orlando']);?>">Orlando</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'tampa']);?>">Tampa</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card container">
					<h2 class="card-header-title"><a href="<?=Url::toRoute(['property/index', 'slug' => 'sc']);?>">South Carolina</a></h2>
					<?=Yii::$app->Helpers->getImage(['src' => '/uploads/bg_4-3.svg', 'alt' => 'Senior Living Communities', 'from_cdn' => false, 'lazyload' => true]);?>
					<ul class="menu-list">
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'greenville']);?>">Greenville</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'charleston']);?>">Charleston</a></li>
						<li><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'columbia']);?>">Columbia</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>



