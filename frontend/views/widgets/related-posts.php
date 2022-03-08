<?php

use common\models\Property;
use frontend\widgets\RelatedProperties;
use yii\helpers\Url;
use yii\helpers\VarDumper;

#VarDumper::dump($found, 10, 1);
?>

<?php if($found):?>
	<h3 class="highlighted-title mb-3 mb-md-4"><?=$title;?></h3>
	<div class="row mb-2 mb-md-6">
	<?php foreach($dataProvider->getModels() as $model):?>
		<?php $url = Url::toRoute(['post/view', 'post_slug' => $model->slug, 'category_slug' => $model->category->slug]);?>
		<div class="col-12 col-xl-3 my-2">
			<div class="related-article-card bg-white">
				<figure class="image empty-bg mb-2 mb-md-3">
					<a href="<?=$url;?>">
						<?=Yii::$app->Helpers->getImage([
							'src'         => $model->getMainImage('250'),
							'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('250').' 768w',
							'data-sizes'  => '250w',
							'alt'         => $model->title,
							'from_cdn'    => false,
							'lazyload'    => true,
							'class'       => 'img-fluid',
						]);?>
					</a>
				</figure>
				<div class="related-article-card__author mb-1">
					<img class="me-1" src="./img/related-article-author-img-1.png" alt="">
					<span class="related-article-card__author-name">Jane Cooper</span>
				</div>
				<a href="<?=$url;?>" class="related-article-card__title d-block mb-15 mb-md-2 text-decoration-none"><?=$model->title;?></a>
				<p class="related-article-card__text mb-2"><?=$model->getShortDescription();?></p>
				<a href="<?=$url;?>" class="related-article__link text-decoration-none btn-primary-medium">Read Article</a>
			</div>
		</div>
	<?php endforeach;?>
	</div>
<?php else:?>
	<blockquote><?=$not_found_text;?></blockquote>
<?php endif;?>

