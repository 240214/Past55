<?php

use common\models\Property;
use frontend\widgets\ImageOptimize;
use frontend\widgets\RelatedProperties;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($found, 10, 1);
?>
<?php if($found):?>
<div class="card-box <?=$wrapper_class;?>">
	<div class="header">
		<h2 class="title"><?=$title;?></h2>
		<div class="subtitle"><?=$sub_title;?></div>
	</div>
	<div class="body">
		<ul class="related-properties-list m-0 p-0">
			<?php foreach($model as $item): ?>
			<?php $url = Url::toRoute(['property/view', 'slug' => $item->slug, 'state' => $item->state, 'city' => $item->city, 'category_id' => $item->category_id]); ?>
			<li class="item">
				<a href="<?=$url;?>">
					<figure class="image empty-bg">
						<?=ImageOptimize::widget([
							'src' => $item->getMainImage('250'),
							'alt' => $item->title,
							'css' => 'list-group__img lazy',
							'width' => 110,
							'height' => 100,
							'lazyload' => 'lazy',
							'quality' => 15,
							'srcset' => [
								['src' => $item->getMainImage('575'), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
								['src' => $item->getMainImage('767'), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
								['src' => $item->getMainImage('250'), 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '768px'],
							],
						]);?>
						<?php /*=Yii::$app->Helpers->getImage([
							'src'         => $item->getMainImage('250'),
							'data-srcset' => $item->getMainImage('575').' 575w, '.$item->getMainImage('767').' 767w, '.$item->getMainImage('250').' 768w',
							'data-sizes'  => '250w',
							'alt'         => '',
							'from_cdn'    => false,
							'lazyload'    => true,
							'class'       => 'list-group__img',
						]);*/?>
					</figure>
					<div class="text">
						<strong><?=$item->title;?></strong>
						<small><i class="bi bi-geo-alt-fill me-1"></i><?=$item->city;?>, <?=$item->state;?></small>
					</div>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php endif; ?>
