<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city]);?>
	<div class="card box" data-id="<?=$model->id;?>">
		<article class="property-media">
			<figure class="image empty-bg">
				<a href="<?=$url;?>">
					<?=Yii::$app->Helpers->getImage([
						'src' => $model->getMainImage('250'),
						'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
						'data-sizes' => '250w',
						'alt' => $model->title,
						'from_cdn' => false,
						'lazyload' => true,
					]);?>
				</a>
			</figure>
			<div class="info">
				<div class="actions__toggle js_property_likes" data-id="<?=$model->id;?>">
					<input type="checkbox" <?=($model->Liked ? 'checked="checked"' : '');?> class="js_trigger" data-property_id="<?=$model->id;?>" data-trigger="js_action_change" data-action="property_toggle_favorite">
					<i class="zmdi zmdi-favorite-outline uncheck"></i>
					<i class="zmdi zmdi-favorite check"></i>
					<span class="count d-none"><?=$model->likes;?></span>
				</div>
				<h2><a href="<?=$url;?>"><?=$model->title;?></a></h2>
				<small class="address"><i class="zmdi zmdi-pin me-2"></i><?=$model->address;?></small>
				<p><?=Yii::$app->Helpers->createExcerpt($model->description, $desc_length);?></p>
				<?php if($add_to_compare):?>
				<div class="decor-checkbox">
					<?=Html::checkbox('add_to_compare', false, ['id' => 'compare_'.$model->id, 'data-id' => $model->id, 'data-slug' => $model->slug, 'data-trigger' => 'js_action_change', 'data-action' => 'add_to_compare']);?>
					<label class="text-decoration-underline" for="compare_<?=$model->id;?>">Add to comparison</label>
				</div>
				<?php endif;?>
			</div>
		</article>
	</div>
<?php endforeach;?>
