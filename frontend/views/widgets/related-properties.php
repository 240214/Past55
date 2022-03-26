<?php

use common\models\Property;
use frontend\widgets\RelatedProperties;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($found, 10, 1);
?>
<div class="card-box <?=$wrapper_class;?>">
	<div class="header">
		<h2 class="title"><?=$title;?></h2>
		<div class="subtitle"><?=$sub_title;?></div>
	</div>
	<div class="list-group">
		<?php if($found): ?>
			<?php foreach($model as $item): ?>
				<?php $url = Url::toRoute(['property/view', 'slug' => $item->slug, 'state' => $item->state, 'city' => $item->city]); ?>
				<a href="<?=$url;?>" class="list-group-item d-flex flex-row align-items-center">
					<figure class="image empty-bg">
						<?=Yii::$app->Helpers->getImage([
							'src'         => $item->getMainImage('250'),
							'data-srcset' => $item->getMainImage('575').' 575w, '.$item->getMainImage('767').' 767w, '.$item->getMainImage('250').' 768w',
							'data-sizes'  => '250w',
							'alt'         => $item->title,
							'from_cdn'    => false,
							'lazyload'    => true,
							'class'       => 'list-group__img',
						]);?>
					</figure>
					<div class="text">
						<strong class="mb-2"><?=$item->title;?></strong>
						<small><i class="zmdi zmdi-pin me-2"></i><?=$item->address;?></small>
					</div>
				</a>
			<?php endforeach; ?>
		<?php else: ?>
			<blockquote><?=$not_found_text;?></blockquote>
		<?php endif; ?>
	</div>
</div>
