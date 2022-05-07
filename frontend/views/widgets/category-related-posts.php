<?php
use common\models\Property;
use frontend\widgets\ImageOptimize;
use frontend\widgets\RelatedProperties;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use frontend\widgets\Image;
?>
<?php if($found):?>
<section class="container main-text-content text-color-black pt-4 pt-md-9 hide-if-empty">
	<h3 class="highlighted-title mb-3 mb-md-4"><?=$title;?></h3>
	<div class="row">
	<?php foreach($dataProvider->getModels() as $model):?>
		<?php $url = Url::toRoute(['post/view', 'post_slug' => $model->slug, 'category_slug' => $model->category->slug]);?>
		<div class="col-12 col-md-6 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<figure class="image empty-bg mb-2 mb-md-3">
					<a href="<?=$url;?>">
						<?=ImageOptimize::widget([
							'src' => $model->getMainImage('575'),
							'alt' => $model->title,
							'css' => 'img-fluid lazy',
							'width' => 293,
							'height' => 220,
							'lazyload' => 'lazy',
							'quality' => 15,
							'srcset' => [
								['src' => $model->getMainImage('575'), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
								['src' => $model->getMainImage('767'), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
								['src' => $model->getMainImage('575'), 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '768px'],
							],
						]);?>
						<?php /*=Image::widget([
							'src'         => $model->getMainImage('575'),
							'data_srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('575').' 768w',
							'data_sizes'  => '575w',
							'alt'         => $model->title,
							'from_cdn'    => false,
							'lazyload'    => true,
							'css_class'       => 'img-fluid',
						]);*/?>
					</a>
				</figure>
				<div class="d-flex flex-row flex-nowrap mb-1 author">
					<?=Image::widget([
						'src' => $model->users->getAvatar('150'),
						'data_srcset' => $model->users->getAvatar('250').' 575w, '.$model->users->getAvatar('250').' 767w, '.$model->users->getAvatar('250').' 768w',
						'data_sizes' => '150w',
						'alt' => $model->title,
						'from_cdn' => false,
						'lazyload' => true,
						'css_class' => 'img-fluid me-1 rounded-50p d-block',
					]);?>
					<a href="/authors/<?=$model->users->username;?>/"><span class="name"><?=$model->users->name;?></span></a>
				</div>
				<a href="<?=$url;?>" class="related-article-card__title d-block mb-15 text-decoration-none"><?=$model->title;?></a>
				<p class="related-article-card__text mb-2"><?=$model->getShortDescription();?></p>
				<a href="<?=$url;?>" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
	<?php endforeach;?>
	</div>
</section>
<?php endif;?>
