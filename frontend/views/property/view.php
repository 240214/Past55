<?php

use frontend\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use common\models\Property;
use yii\helpers\Url;
use frontend\widgets\RelatedProperties;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model common\models\Property */

$this->title = $property->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerLinkTag(['rel' => 'canonical', 'href' => $property->canonical_url]);

$bundle = AppAsset::register($this);
$this->registerCssFile('@web/theme/plugins/slick/css/slick.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/plugins/slick/css/slick-theme.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
#$this->registerCssFile('@web/theme/plugins/jssocials/css/jssocials.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
#$this->registerCssFile('@web/theme/plugins/jssocials/css/jssocials-theme-minima.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerCssFile('@web/theme/css/property.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
#$this->registerCssFile('@web/theme/plugins/rateYo/src/jquery.rateyo.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
#$this->registerCssFile('@web/theme/plugins/materialize/css/materialize.min.css', ['depends' => [BootstrapAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/plugins/slick/js/slick.min.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
#$this->registerJsFile('@web/theme/plugins/rateYo/src/jquery.rateyo.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
#$this->registerJsFile('@web/theme/plugins/materialize/js/materialize.min.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
#$this->registerJsFile('@web/theme/js/basic.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
$this->registerJsFile('@web/theme/plugins/bootstrap5/js/popper.min.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
#$this->registerJsFile('@web/theme/plugins/jssocials/js/jssocials.min.js', ['depends' => [JqueryAsset::className(), AppAsset::className()]]);
$bundle->addGoogleMapJS();

$liked = $property->Liked;
$likes_checked = $liked ? 'checked="checked"' : '';
$favs_class = $liked ? 'checked' : '';
$favs_title = $liked ? 'Remove from Favorite' : 'Add to Favorite';
?>
<section class="individual-listing section-1">
    <div class="container-fluid container-md">
        <header class="section__title section__title-alt">
	        <div class="js_data_loader loader fixed trans-all"></div>
	        <div class="row mb-35 align-items-end">
		        <div class="col-12 col-md-9">
			        <h1 class="main-title"><?=$property->title;?></h1>
			        <div class="individual-listing__subtitle address mt-15 mb-15"><i class="bi bi-geo-alt me-1"></i><?=$property->address;?></div>
			        <div class="individual-listing__subtitle tags d-flex">
				        <div class="text-nowrap me-1">Found in:</div>
				        <div>
				        <?php foreach($property->categories as $category):?>
					        <a href="<?=$category['url'];?>" class="text-color-primary"><?=$category['name'];?></a>
				        <?php endforeach;?>
				        </div>
			        </div>
			        <div class="d-flex position-relative mt-3 mt-md-3 trans-all">
				        <a role="button" class="add-to-favorite-btn action-btn actions__toggle js_property_likes" data-id="<?=$property->id;?>">
					        <input type="checkbox" <?=($property->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$property->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
					        <i class="bi bi-heart uncheck"></i>
					        <i class="bi bi-heart-fill check"></i>
					        <span class="count d-none"><?=$property->likes;?></span>
					        <span>Save</span>
				        </a>
				        <a role="button" data-trigger="js_action_click" data-action="print" class="action-btn"><i class="bi bi-printer"></i> <span>Print</span></a>
				        <a role="button" data-trigger="js_action_click" data-action="share" class="action-btn"><i class="bi bi-box-arrow-in-up"></i> <span>Share</span></a>
				        <a role="button" class="action-btn"><i class="bi bi-eye"></i> <span><?=$property->views;?></i></span></a>
				        <?php /*
		                <div class="dropdown">
		                    <a role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-share"></i></a>
		                    <div class="dropdown-menu pull-right js_social_share"><div></div></div>
		                </div>
		                */?>
			        </div>
		        </div>
		        <div class="col-12 col-md-3">
			        <div class="individual-listing__pricing-title mb-25 text-start text-xl-end">Pricing ranges from</div>
			        <a role="button" href="#" class="individual-listing__pricing-contact-btn btn-primary-medium ms-0 ms-xl-auto">Contact for pricing</a>
		        </div>
	        </div>
        </header>
	    
        <div class="dash-line mt-25 mb-25 mt-md-35 mb-md-45"></div>

        <!--<?=$this->render('partials/gallery', ['property' => $property]);?>-->

	    <div class="p-4 p-md-3"></div>
	    
        <div class="row d-print-block">
	        <div class="col-12 col-md-8">
	            <?=$this->render('partials/description', ['property' => $property]);?>
            </div>

	        <aside class="col-12 col-md-4 d-print-block">
	            <div class="sticky-block">
	                <?=$this->render('sidebar/contacts', ['property' => $property]);?>
	                <?=$this->render('sidebar/office-hours', ['property' => $property]);?>
	                <?php #=$this->render('sidebar/contact-form', ['property' => $property, 'contact' => $contact]);?>
	                <?php #=$this->render('sidebar/agent', ['property' => $property]);?>
		            <?=RelatedProperties::widget([
	                    'limit' => 4,
	                    'city' => $property['city'],
	                    'category_id' => $property['category_id'],
	                    'exclude_id' => $property['id'],
	                    'title' => 'You may also like...',
	                    'sub_title' => 'Morbi risus porta consectetur vestibulum ateros',
	                    'not_found_text' => 'No Suggession yet!!!',
		                'wrapper_class' => 'd-print-none'
		            ]);?>
	            </div>
            </aside>
        </div>
	    
	    
    </div>
	
</section>

<section class="individual-listing section-2 elmcroft">
	<div class="container-fluid container-md">
		<div class="row d-print-block">
			<div class="col-12 col-md-8">
				
				<?=$this->render('partials/features', ['property' => $property]);?>
				
				<?=$this->render('partials/pet-policy', ['property' => $property]);?>
				
				<?=$this->render('partials/location', ['property' => $property]);?>
				
				<?=$this->render('partials/nearby-places', ['property' => $property]);?>
			</div>

			<aside class="col-12 col-md-4 d-print-block">
				<div class="sticky-block">
					<?=$this->render('partials/dist-calc', ['property' => $property]);?>
				</div>
			</aside>
		</div>
	</div>
</section>

<div id="js_add_to_favs_btn" class="d-lg-none actions__toggle js_property_likes mob-to-fav-float trans_all align-items-center view" data-id="<?=$property->id;?>" data--bs-toggle="tooltip" data-bs-placement="left" title="<?=$favs_title;?>">
	<a role="button" class="d-lg-none <?=$favs_class;?> js_trigger" data-property_id="<?=$property->id;?>" data-trigger="js_action_click" data-action="property_toggle_favorite">Add to Favorites</a>
	<i class="zmdi zmdi-favorite-outline uncheck"></i>
	<i class="zmdi zmdi-favorite check"></i>
</div>
