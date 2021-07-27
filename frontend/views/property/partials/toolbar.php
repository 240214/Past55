<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<section class="action-header">
	<div class="container">
		<div class="action-header__item action-header__item--search " style="max-width: 70%;box-shadow:none">
			<?php $form = ActiveForm::begin(['action' => Url::toRoute('search/home')]); ?>
			<input required="required" type="text" data-toggle="collapse" data-target="#adSearch" name="SearchForm[input]" class="search__input" placeholder="Enter any Neighorhood, Feature, Zip Code">
			
			<div id="adSearch" class="collapse searchHead">
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
								<input  name="SearchForm[priceMin]" id="property-price-min" value="" type="hidden" />
								<input  name="SearchForm[priceMax]" id="property-price-max" value="" type="hidden" />
								
								<span  id="property-price-upper"></span>
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
								<input type="checkbox" name="SearchForm[bedroom]"  value="2" id="bed2" checked>2
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
			<?php ActiveForm::end(); ?>
		
		</div>
		
		<div class="action-header__item action-header__views d-none d-sm-block">
			<a  href="javascript:void()" data-tag="gridview" class="zmdi zmdi-apps active"></a>
			<a href="javascript:void()" data-tag="listview" class="zmdi zmdi-view-list"></a>
		</div>
		
		<div class="action-header__item action-header__item--sort d-block d-md-none">
			<span class="action-header__small">Sort by :</span>
			<form id="property" method="get">
				<select onchange="$('#property').submit()" name="sort" class="select2">
					<option>select</option>
					<option value="NTO">Newest to oldest</option>
					<option  value="OTN">Oldest to Newest</option>
					<option  value="HL">Price hight to low</option>
					<option  value="LH">Price low to high</option>
					<option  value="NOP">No. of photos</option>
				</select>
			</form>
		
		</div>
	</div>
</section>
