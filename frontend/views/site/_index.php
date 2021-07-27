<?php

/* @var $this yii\web\View */

$this->title = 'Home - page';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

$session     = Yii::$app->session;
$city        = $session->get('city');
$cityDefault = ($city) ? $city : "jodhpur";
?>

<header id="header" style="box-shadow: none;">
	<div class="header__search container">
		<?php $form = ActiveForm::begin(['action' => Url::toRoute('search/home')]); ?>
		<div class="search">
			<div class="search__type dropdown">
				<a href="#" data-toggle="dropdown">For</a>

				<div class="dropdown-menu">
					<div>
						<input type="radio" name="SearchForm[listfor]" value="rent">
						<span>Rent</span>
					</div>
					<div>
						<input type="radio" name="SearchForm[listfor]" value="sell">
						<span>Buy</span>
					</div>
				</div>
			</div>

			<div class="search__body">
				<input required="required" type="text" name="SearchForm[input]" class="search__input" placeholder="Enter any Neighorhood, Feature, Zip Code" data-rmd-action="advanced-search-open">

				<div class="search__advanced">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Ownership</label>

							<select class="select2" name="SearchForm[ownership]">
								<option value="owner">Owner</option>
								<option value="dealer">Dealer</option>
								<option value="builder">Builder</option>
							</select>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Property Type</label>

							<select class="select2" name="SearchForm[type]">
								<option value="commercial">Commercial</option>
								<option value="residential">Residential</option>

							</select>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group form-group--range">
							<label>Price Range</label>
							<div class="input-slider-values clearfix">
								<div class="pull-left">
									<span>$</span>
									<input name="SearchForm[priceMin]" id="property-price-min" value="" type="hidden"/>
									<input name="SearchForm[priceMax]" id="property-price-max" value="" type="hidden"/>

									<span id="property-price-upper"></span>
								</div>
								<div class="pull-right">
									<span>$</span>
									<span id="property-price-lower"></span>
								</div>
							</div>
							<div id="property-price-range" onmouseout="$('#property-price-min').val($('#property-price-upper').text());$('#property-price-max').val($('#property-price-lower').text())"></div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group form-group--range">
							<label>Area Size (sqft)</label>
							<div class="input-slider-values clearfix">
								<div class="pull-left" id="property-area-upper"></div>
								<div class="pull-right" id="property-area-lower"></div>
							</div>
							<div id="property-area-range"></div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Bedrooms</label>
							<div class="btn-group btn-group-justified" data-toggle="buttons">
								<label class="btn">
									<input type="checkbox" name="SearchForm[bedroom]" value="1" id="bed1">1
								</label>
								<label class="btn active">
									<input type="checkbox" name="SearchForm[bedroom]" value="2" id="bed2" checked>2
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bedroom]" value="3" id="bed3">3
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bedroom]" value="4" id="bed4">4
								</label>
								<label class="btn">
									<input type="checkbox" name="advanced-search-beds" value="5" id="bed5">4+
								</label>
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Bathrooms</label>
							<div class="btn-group btn-group-justified" data-toggle="buttons">
								<label class="btn active">
									<input type="checkbox" name="SearchForm[bathroom]" value="1" id="bath1" checked>1
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bathroom]" value="2" id="bath2">2
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bathroom]" value="3" id="bath3">3
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bathroom]" value="4" id="bath4">4
								</label>
								<label class="btn">
									<input type="checkbox" name="SearchForm[bathroom]c" value="5" id="bath5">4+
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-12 m-t-10">
						<button class="btn btn-primary">Search</button>
						<button class="btn btn-link" data-rmd-action="advanced-search-close">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>

	<div class="header__recommended">
		<div class="my-location">
			<div class="my-location__title">Properties nearby your location</div>
			<div class="dropdown my-location__location hidden-xs">
				<a href="#" data-toggle="dropdown"><i class="zmdi zmdi-pin"></i> <span id="dCity"> <?=$cityDefault;?></span> Change City</a>

				<div class="dropdown-menu pull-right stop-propagate">
					<strong>Change Location</strong>
					<small>Set your location to get list of properties nearby you</small>

					<div class="form-group form-group--float cityForm">
						<input type="text" data-ref-set="<?=Url::toRoute('search/set')?>" data-ref="<?=Url::toRoute('search/city')?>" id="citySearchInput" class="form-control" placeholder="Enter City, State, Zip">
						<ul id="cityWaiting" class="list-group hidden" style="box-shadow: 0px 1px 2px #555;">
							<li class="list-group-item" style="box-shadow: 0px 2px 2px #55555580;border-top: 1px solid #ddd;">
								<b id="cityWaitingResult"><i class="zmdi zmdi-spinner zmdi-hc-spin"></i> Searching...</b>
							</li>


						</ul>
						<i class="form-group__bar"></i>
					</div>

					<button class="btn btn-primary btn-sm" type="button" onclick="citySearch()" id="citySearch">find Location</button>
					<span class="hidden">Searching...</span>
				</div>
			</div>
		</div>

		<div class="listings-grid">
			
			<?php
			foreach($featured as $product){
				?>
				<div class="listings-grid__item">
					<a href="<?=Url::toRoute(['property/view', 'id' => $product['id'], 'state' => $product['state'], 'city' => $product['city'], 'slug' => $product['slug']]);?>">
						<div class="listings-grid__main" style="max-height: 180px;overflow: hidden">
							<img src="<?=Yii::getAlias('@web')?>/images/property/<?=$product['id'];?>/<?=$product['image']?>" alt="">
							<div class="listings-grid__price">$<?=$product['price']?></div>
						</div>

						<div class="listings-grid__body">
							<small><?=$product['title']?></small>
							<h5><?=$product['address']?></h5>
						</div>

						<ul class="listings-grid__attrs">
							<li><i class="listings-grid__icon listings-grid__icon--bed"></i> <?=$product['bedrooms']?></li>
							<li><i class="listings-grid__icon listings-grid__icon--bath"></i> <?=$product['bathrooms']?></li>
							<li><i class="listings-grid__icon listings-grid__icon--parking"></i> <?=$product['parking']?></li>
						</ul>
					</a>

					<div class="actions listings-grid__favorite">
						<div class="actions__toggle">
							<input type="checkbox" data-del="<?=Url::toRoute('saved/remove-property/'.base64_encode($product['id']))?>" data-ref="<?=Url::toRoute('saved/property/'.base64_encode($product['id']))?>" property="<?=$product['id']?>">
							<i class="zmdi zmdi-favorite-outline"></i>
							<i class="zmdi zmdi-favorite"></i>
						</div>
					</div>
				</div>
				<?php
			}
			?>


		</div>
	</div>
</header>
<section class="section">
	<div class="container">
		<header class="section__title">
			<h2><?=$totalListing;?> Properties for Sale, Rent & Real Estate</h2>
			<small>Villas, Apartments, Office Spaces and Commercial Builsings</small>
		</header>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card__header card__header--minimal">
						<h2>Recent Properties for Sale</h2>
						<small>Nunc urnami tempor eget ipsum eurutrum gravida tellus</small>
					</div>

					<div class="grid-widget grid-widget--listings">
						<?php
						foreach($forSell as $product){
							?>
							<div class="col-xs-6">
								<a class="grid-widget__item" href="<?=Url::toRoute('property/view/')."/".base64_encode($product['id'])?>">
									<img src="<?=Yii::getAlias('@web');?>/images/property/<?=$product['id'];?>/<?=($product['image'] == null) ? 'default.jpg' : $product['image'];?>" alt="">
									<div class="grid-widget__info">
										<h3>$<?=$product['price']?></h3>
										<small><?=$product['title']?></small>
									</div>
								</a>
							</div>
							<?php
						}
						?>
					</div>

					<a class="view-more" href="<?=Url::toRoute('property/sale')?>">
						View all properties for sale <i class="zmdi zmdi-long-arrow-right"></i>
					</a>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card__header card__header--minimal">
						<h2>Recent Properties for Rent</h2>
						<small>Suspendisse quis massa fringilla sagittis velit utultrices tellus</small>
					</div>

					<div class="grid-widget grid-widget--listings">
						<?php
						foreach($forRent as $product){
							?>
							<div class="col-xs-6">
								<a class="grid-widget__item" href="<?=Url::toRoute('property/view/')."/".base64_encode($product['id'])?>">
									<img src="<?=Yii::getAlias('@web')?>/images/property/<?=$product['id'];?>/<?=($product['image'] == null) ? 'default.jpg' : $product['image'];?>" alt="">

									<div class="grid-widget__info">
										<h3>$<?=$product['price']?></h3>
										<small><?=$product['address']?></small>
									</div>
								</a>
							</div>
							<?php
						}
						?>
					</div>

					<a class="view-more" href="<?=Url::toRoute('property/rent')?>">
						View all properties for rent <i class="zmdi zmdi-long-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>

		<div class="row">


			<div class="col-md-12">
				<div class="card">
					<div class="card__header card__header--minimal">
						<h2>Properties by Agents</h2>
						<small>Duis congue placerat libero in tristique dignissim posuere</small>
					</div>

					<div class="grid-widget grid-widget--listings">
						<?php
						foreach($agents as $agentsList){
							?>
							<div class="col-xs-2">
								<a class="grid-widget__item" href="agent-detail.html">
									<img src="<?=Yii::getAlias('@web')?>/images/user/<?=$agentsList['image']?>" alt="">

									<div class="grid-widget__info">
										<h4><?=$agentsList['name']?></h4>
										<small><?=$agentsList['total'];?> Listings</small>
									</div>
								</a>
							</div>
							<?php
						}
						?>


					</div>

					<a class="view-more" href="<?=Url::toRoute('user/agents')?>">
						View all agents <i class="zmdi zmdi-long-arrow-right"></i>
					</a>

				</div>
			</div>
		</div>
	</div>
</section>



