<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city]);?>
	<div class="col-12 col-lg-6 mb-25" data-id="<?=$model->id;?>">
		<div class="category-card bg-white p-2 position-relative">
			<a href="<?=$url;?>">
				<?=Yii::$app->Helpers->getImage([
					'src' => $model->getMainImage('250'),
					'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
					'data-sizes' => '250w',
					'alt' => $model->title,
					'from_cdn' => false,
					'lazyload' => true,
					'class' => 'img-fluid mb-25 rounded-10',
				]);?>
			</a>
			<a role="button" class="add-to-favorite-btn position-absolute top-30 start-30 bg-white actions__toggle js_property_likes trans-all" data-id="<?=$model->id;?>">
				<input type="checkbox" <?=($model->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$model->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
				<i class="bi bi-heart text-color-primary uncheck"></i>
				<i class="bi bi-heart-fill text-color-primary check"></i>
				<span class="count d-none"><?=$model->likes;?></span>
			</a>

			<div class="category-card__avalible-btn d-flex align-items-center justify-content-center d-xl-none mb-1 mb-xl-0">Available Now</div>
			<h2 class="category-card__title mb-1 fw-bold"><a href="<?=$url;?>"><?=$model->title;?></a></h2>
			<div class="mb-15 category-card__adress"><span><?=$model->address;?></span></div>
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
			<?php if($options['display_price']):?>
			<div class="category-card__divider mt-3 mb-2"></div>
			<div class="category-card__footer d-flex justify-content-between align-items-center">
				<div class="text-color-primary">Per month</div>
				<div>$4,0558.00</div>
			</div>
			<?php endif;?>
			<?php if($options['display_desc']):?>
			<p class="category-card__desc mt-3"><?=Yii::$app->Helpers->createExcerpt($model->description, $desc_length);?></p>
			<?php endif;?>
			<?php if($add_to_compare):?>
				<div class="decor-checkbox">
					<?=Html::checkbox('add_to_compare', false, ['id' => 'compare_'.$model->id, 'data-id' => $model->id, 'data-slug' => $model->slug, 'data-trigger' => 'js_action_change', 'data-action' => 'add_to_compare']);?>
					<label class="text-decoration-underline" for="compare_<?=$model->id;?>">Add to comparison</label>
				</div>
			<?php endif;?>
		</div>
	</div>
<?php endforeach;?>
