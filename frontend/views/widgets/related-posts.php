<?php

use common\models\Property;
use frontend\widgets\RelatedProperties;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use frontend\widgets\Image;

#VarDumper::dump($found, 10, 1); exit;
?>

<?php if($found):?>
	<h3 class="article-subtitle-small"><?=$title;?></h3>
	<p class="mb-4"><?=$subtitle;?></p>

	<div class="related-article-list row mb-5">
	<?php foreach($dataProvider->getModels() as $model):?>
		<?php $url = Url::toRoute(['post/view', 'post_slug' => $model->slug, 'category_slug' => $model->postsCategories->slug]);?>
		<div class="related-article-item col-12 col-md-6 mb-4 mb-md-0">
			<figure class="image empty-bg mb-2 mb-md-3">
				<a href="<?=$url;?>">
					<?=Image::widget([
						'src'         => $model->getMainImage('250'),
						'data_srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
						'data_sizes'  => '250w',
						'alt'         => $model->title,
						'from_cdn'    => false,
						'lazyload'    => true,
						'css_class'       => 'img-fluid',
					]);?>
				</a>
			</figure>
			<a href="<?=Url::toRoute(['post/view', 'category_slug' => $model->postsCategories->slug]);?>" class="related-article-item__sticker mb-1"><?=$model->postsCategories->title;?></a>
			<a href="<?=$url;?>" class="related-article-item__title mb-15 text-decoration-none"><?=$model->title;?></a>
			<p class="related-article-item__text"><?=$model->getShortDescription(100);?></p>
		</div>
	<?php endforeach;?>
	</div>
<?php else:?>
	<div class="mb-2 mb-md-6 text-center"><?=$not_found_text;?></div>
<?php endif;?>

