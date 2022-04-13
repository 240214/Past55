<?php

use frontend\widgets\Image;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($models, 10, 1);exit;
?>
<?php foreach($models as $model):?>
	<?php $url = Url::toRoute(['post/view', 'post_slug' => $model->slug, 'category_slug' => $model->postsCategories->slug]);?>
	<div class="col-12 col-md-6 col-lg-4 mb-35 mb-md-6" data-id="<?=$model->id;?>">
		<figure class="image empty-bg">
			<?=Image::widget([
				'src'         => $model->getMainImage('575'),
				'data_srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('575').' 768w',
				'data_sizes'  => '575w',
				'alt'         => $model->title,
				'from_cdn'    => false,
				'lazyload'    => false,
				'css_class'   => 'img-fluid',
			]);?>
		</figure>
		<div class="date"><?=date('M j, Y', strtotime($model->created_at));?></div>
		<h2 class="title"><a href="<?=$url;?>" title="<?=$model->title;?>"><?=$model->getShortTitle(50);?></a></h2>
		<p class="desc"><?=$model->getShortDescription(100);?></p>
		<a href="<?=$url;?>" class="btn">Read Article</a>
	</div>
<?php endforeach;?>
