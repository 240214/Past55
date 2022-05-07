<?php

use frontend\widgets\ImageOptimize;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city, 'category_id' => $model->category_id]);?>
	<div class="my-favorites__item row bg-white m-0 position-relative box" data-id="<?=$model->id;?>">

		<div class="col-12 col-md-5">
			<a role="button" class="add-to-favorite-btn position-absolute top-30 start-30 bg-white actions__toggle js_property_likes trans-all" data-id="<?=$model->id;?>">
				<input type="checkbox" <?=($model->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$model->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
				<i class="bi bi-heart text-color-primary uncheck"></i>
				<i class="bi bi-heart-fill text-color-primary check"></i>
				<span class="count d-none"><?=$model->likes;?></span>
			</a>
			<figure class="image empty-bg rounded-4">
				<a href="<?=$url;?>">
					<?=ImageOptimize::widget([
						'src' => $model->getMainImage('575'),
						'alt' => $model->title,
						'css' => 'my-favorites__img mb-xxl-0 img-fluid lazy',
						'width' => 310,
						'height' => 194,
						'lazyload' => 'lazy',
						'quality' => 15,
						'srcset' => [
							['src' => $model->getMainImage('575'), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
							['src' => $model->getMainImage('767'), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
							['src' => $model->getMainImage('575'), 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '768px'],
						],
					]);?>
					<?php /*=Yii::$app->Helpers->getImage([
						'src' => $model->getMainImage('250'),
						'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
						'data-sizes' => '250w',
						'alt' => $model->title,
						'from_cdn' => false,
						'lazyload' => true,
						'class' => 'my-favorites__img mb-xxl-0 img-fluid',
					]);*/?>
				</a>
			</figure>
		</div>

		<div class="col-12 col-md-7">
			<h2 class="my-favorites__item-title mb-1 mt-2 mt-md-0"><a href="<?=$url;?>"><?=$model->title;?></a></h2>
			<div class="address mb-15 d-flex flex-row flex-nowrap">
				<i class="bi bi-geo-alt me-05"></i>
				<div class="similar-offers__adress"><?=$model->address;?></div>
			</div>

			<?php if($options['display_desc']):?>
			<p class="my-favorites__item-text mb-2 d-none d-md-block"><?=Yii::$app->Helpers->createExcerpt($model->description, $options['desc_length']);?></p>
			<?php endif;?>
			
			<?php if($options['add_to_compare']):?>
				<a role="button" class="compare__toggle position-relative d-block bg-white trans-all">
					<?=Html::checkbox('add_to_compare', false, ['id' => 'compare_'.$model->id, 'data-id' => $model->id, 'data-slug' => $model->slug, 'data-trigger' => 'js_action_change', 'data-action' => 'add_to_compare']);?>
					<i class="bi bi-check-square-fill check"></i>
					<i class="bi bi-check-square uncheck"></i>
					<label for="compare_<?=$model->id;?>">Add to comparison</label>
				</a>
			<?php endif;?>
		</div>
	</div>
<?php endforeach;?>

