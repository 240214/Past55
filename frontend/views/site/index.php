<?php

/* @var $this yii\web\View */

$this->title = 'Home - page';

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use frontend\widgets\Image;

$this->registerCssFile('@web/theme/css/home.css', ['depends' => [BootstrapAsset::className()]]);

?>
<section class="first-screen-home">
	<div class="container">
		<div class="row justify-content-between align-items-center header-home__content">
			<div class="col-12 col-md-5 mb-35">
				<h1 class="first-screen-home__title">Senior living<br /> <span class="title-decor-line">communities</span> <br /> in Georgia.</h1>
				<p class="main-text-content">See pricing, availability, care offered, nearby places and more.</p>
				<label class="header-home__search-wrapp">
					<input class="header-home__search-input rounded-8 bg-white" type="text"
					       placeholder="Enter a city or zip">
					<button class="header-home__search-btn btn-primary-small">Search</button>
				</label>
			</div>
			<div class="col-12 col-md-7 d-md-flex justify-content-end">
				<?=Image::widget(['src' => '/theme/img/home/first-screen-home-bg.png', 'css_class' => 'img-fluid first-screen-home__bg d-none d-md-block']);?>
			</div>
		</div>
	</div>
</section>
<section class="companies container">
	<?php #=Image::widget(['src' => '/theme/img/home/first-screen-home-bg.png', 'css_class' => 'img-fluid first-screen-home__bg mb-4 m-auto d-none d-md-block d-lg-none d-xl-none']);?>
	<?=Image::widget(['src' => '/theme/img/home/first-screen-home-bg-m.png', 'css_class' => 'img-fluid d-md-none d-block mb-4 m-auto']);?>
	<h2 class="secondary-title text-center mb-5">More than 80,000+ companies trust GeorgiaCaring</h2>
	<div class="d-flex justify-content-center align-items-center flex-wrap">
		<?=Image::widget(['src' => '/theme/img/home/company-1.svg', 'css_class' => 'm-3', 'alt' => 'company-logo']);?>
		<?=Image::widget(['src' => '/theme/img/home/company-2.svg', 'css_class' => 'm-3', 'alt' => 'company-logo']);?>
		<?=Image::widget(['src' => '/theme/img/home/company-3.svg', 'css_class' => 'm-3', 'alt' => 'company-logo']);?>
		<?=Image::widget(['src' => '/theme/img/home/company-4.svg', 'css_class' => 'm-3', 'alt' => 'company-logo']);?>
		<?=Image::widget(['src' => '/theme/img/home/company-5.svg', 'css_class' => 'm-3', 'alt' => 'company-logo']);?>
	</div>
</section>
<section class="benefits">
	<div class="container">
		<h1 class="main-title text-center mb-5">We spread care to provide<br /> quality life</h1>
		<div class="row">
			<div class="col-12 col-md-4 mb-2">
				<div class="benefits-card d-flex flex-column">
					<?=Image::widget(['src' => '/theme/img/home/benefit-card-icon-1.svg', 'css_class' => 'mt-2 mt-lg-3 mb-3', 'alt' => 'benefit-icon']);?>
					<h4 class="benefit-card-title">See Pricing & Availability</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Most other websites try to hide pricing and availability in order to get you on the phone. Our site offers full transparency in sharing this information in order to save you time</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
			<div class="col-12 col-md-4 mb-2">
				<div class="benefits-card d-flex flex-column">
					<?=Image::widget(['src' => '/theme/img/home/benefit-card-icon-2.svg', 'css_class' => 'mt-2 mt-lg-3 mb-3', 'alt' => 'benefit-icon']);?>
					<h4 class="benefit-card-title">Save Favorites & Compare</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Save a list of communities and compare amenities, care offered, distances and location, and more in side by side comparisons.</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
			<div class="col-12 col-md-4 mb-2">
				<div class="benefits-card d-flex flex-column">
					<?=Image::widget(['src' => '/theme/img/home/benefit-card-icon-3.svg', 'css_class' => 'mt-2 mt-lg-3 mb-3', 'alt' => 'benefit-icon']);?>
					<h4 class="benefit-card-title">See Nearby Places</h4>
					<p class="benefit-card-content main-text-content flex-grow-1">Quickly see how far each community is from relatives, hospitals, pharmacies, parks, restaurants and more.</p>
					<a href="#" class="benefit-card-link text-decoration-none">Learn more</a>
				</div>
			</div>
		</div>
	</div>
	<?=Image::widget(['src' => '/theme/img/home/benefits-section-bg.svg', 'css_class' => 'benefits__bg d-none d-xl-block']);?>
</section>
<section class="location">
	<div class="container location__header mb-8">
		<h1 class="main-title text-center mb-2">Senior living locations</h1>
		<p class="main-text-content text-center">Our newsletter features articles from Richard, Gilfoyle and Dinesh, with<br /> occasional guest features from our investors and supporters.</p>
	</div>
	<div class="location__body py-6">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 max-w-1120 trans-all">
					<div class="location-card row align-items-center justify-content-between rounded-8 bg-white mb-3">
						<div class="col-12 col-md-6 d-flex justify-content-center justify-content-sm-start">
							<?=Image::widget(['src' => '/theme/img/home/location-card-img-1.jpg', 'css_class' => 'img-fluid rounded-10 rounded-10-md-left w-100 w-sm-auto']);?>
						</div>
						<div class="col-12 col-md-6 d-flex justify-content-center">
							<div class="w-100 max-w-420-sm">
								<a href="<?=Url::toRoute(['property/index', 'slug' => 'ga']);?>" class="location-card__location-name-box mt-65 text-color-primary">
									<i class="zmdi zmdi-star me-1"></i>Georgia
								</a>
								<ul class="location-card__list">
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'atlanta']);?>"><i class="zmdi zmdi-pin me-15"></i>Atlanta<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'roswell']);?>"><i class="zmdi zmdi-pin me-15"></i>Roswell<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Georgia', 'slug' => 'alpharetta']);?>"><i class="zmdi zmdi-pin me-15"></i>Alpharetta<i class="bi bi-arrow-right-short"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="location-card row flex-row-reverse align-items-center justify-content-between rounded-8 bg-white mb-3">
						<div class="col-12 col-md-6 d-flex justify-content-center justify-content-sm-end">
							<?=Image::widget(['src' => '/theme/img/home/location-card-img-2.jpg', 'css_class' => 'img-fluid rounded-10 rounded-10-md-right w-100 w-sm-auto']);?>
						</div>
						<div class="col-12 col-md-6 d-flex justify-content-center">
							<div class="w-100 max-w-420-sm">
								<a href="<?=Url::toRoute(['property/index', 'slug' => 'fl']);?>" class="location-card__location-name-box mt-65 text-color-secondary">
									<i class="zmdi zmdi-star me-1"></i>Florida
								</a>
								<ul class="location-card__list">
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'miami']);?>"><i class="zmdi zmdi-pin me-15"></i>Miami<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'orlando']);?>"><i class="zmdi zmdi-pin me-15"></i>Orlando<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'Florida', 'slug' => 'tampa']);?>"><i class="zmdi zmdi-pin me-15"></i>Tampa<i class="bi bi-arrow-right-short"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="location-card row align-items-center justify-content-between rounded-8 bg-white">
						<div class="col-12 col-md-6 d-flex justify-content-center justify-content-sm-start">
							<?=Image::widget(['src' => '/theme/img/home/location-card-img-3.jpg', 'css_class' => 'img-fluid rounded-10 rounded-10-md-left w-100 w-sm-auto']);?>
						</div>
						<div class="col-12 col-md-6 d-flex justify-content-center">
							<div class="w-100 max-w-420-sm">
								<a href="<?=Url::toRoute(['property/index', 'slug' => 'sc']);?>" class="location-card__location-name-box mt-65 text-color-green">
									<i class="zmdi zmdi-star me-1"></i>South Carolina
								</a>
								<ul class="location-card__list">
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'greenville']);?>"><i class="zmdi zmdi-pin me-15"></i>Greenville<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'charleston']);?>"><i class="zmdi zmdi-pin me-15"></i>Charleston<i class="bi bi-arrow-right-short"></i></a></li>
									<li class="location-card__item"><a href="<?=Url::toRoute(['property/index', 'state' => 'South Carolina', 'slug' => 'columbia']);?>"><i class="zmdi zmdi-pin me-15"></i>Coloumbia<i class="bi bi-arrow-right-short"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



