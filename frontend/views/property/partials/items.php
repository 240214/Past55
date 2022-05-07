<?php

use frontend\widgets\ImageOptimize;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($models, 10, 1);exit;
?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city, 'category_id' => $model->category_id]);?>
	<div class="col-12 col-lg-6 mb-25" data-id="<?=$model->id;?>">
		<div class="category-card bg-white p-2 position-relative">
			<figure class="mb-25">
				<a href="<?=$url;?>">
					<?=ImageOptimize::widget([
						'src' => $model->getMainImage('250'),
						'alt' => $model->title,
						'css' => 'img-fluid',
						'width' => 360,
						'height' => 241,
						'quality' => 15,
						'srcset' => [
							['src' => $model->getMainImage('575'), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
							['src' => $model->getMainImage('767'), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
							['src' => $model->getMainImage('250'), 'size' => '992w', 'media_point' => 'min-width', 'media_size' => '992px'],
							['src' => $model->getMainImage('575'), 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '767px'],
						],
					]);?>
					<?php /*=Yii::$app->Helpers->getImage([
						'src' => $model->getMainImage('250'),
						'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('767').' 768w',
						'data-sizes' => '250w',
						'alt' => $model->title,
						'from_cdn' => false,
						'lazyload' => true,
						'class' => 'img-fluid',
					]);*/?>
				</a>
			</figure>
			<a role="button" name="Add to favorite <?=$model->title;?>" title="Add to favorite <?=$model->title;?>" class="add-to-favorite-btn position-absolute top-30 start-30 bg-white actions__toggle js_property_likes trans-all" data-id="<?=$model->id;?>">
				<label class="fav-label" for="add_to_favorite_<?=$model->id;?>">Add to favorite <?=$model->title;?></label>
				<input type="checkbox" id="add_to_favorite_<?=$model->id;?>" <?=($model->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$model->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
				<i class="bi bi-heart text-color-primary uncheck"></i>
				<i class="bi bi-heart-fill text-color-primary check"></i>
				<span class="count d-none"><?=$model->likes;?></span>
			</a>

			<h2 class="category-card__title mb-1 fw-bold trans-all"><a href="<?=$url;?>"><?=$model->title;?></a></h2>
			<div class="mb-15 category-card__adress"><span><?=$model->address;?></span></div>
			<?php if($options['display_rating']):?>
			<div class="d-flex">
				<div class="d-flex">
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
				</div>
				<div class="category-card__rating-box d-flex align-items-center justify-content-center">
					<i class="bi bi-star-fill text-color-rating-icon me-1"></i>
					<span>5</span>
				</div>
			</div>
			<?php endif;?>
			<?php if($options['display_price']):?>
			<div class="category-card__divider mt-3 mb-2"></div>
			<div class="category-card__footer d-flex justify-content-between align-items-center">
				<div class="text-color-primary">Per month</div>
				<div>$4,0558.00</div>
			</div>
			<?php endif;?>
			<?php if($options['display_desc']):?>
			<p class="category-card__desc mt-3"><?=Yii::$app->Helpers->createExcerpt($model->description, $options['desc_length']);?></p>
			<?php endif;?>
			<?php if($options['add_to_compare']):?>
				<div class="decor-checkbox">
					<?=Html::checkbox('add_to_compare', false, ['id' => 'compare_'.$model->id, 'data-id' => $model->id, 'data-slug' => $model->slug, 'data-trigger' => 'js_action_change', 'data-action' => 'add_to_compare']);?>
					<label class="text-decoration-underline" for="compare_<?=$model->id;?>">Add to comparison</label>
				</div>
			<?php endif;?>
		</div>
	</div>
<?php endforeach;?>
