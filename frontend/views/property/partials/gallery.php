<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\image\drivers\Image;
use frontend\widgets\ImageOptimize;
$recreate = false;
$quality = 15;
?>
<div class="gallery-detail clearfix">
	<div class="gallery-slider">
		
		<div class="slider slider-for" data-lazy="progressive">
			<?php if(!empty($property->image)):?>
				<div class="slider-gallery-image">
					<?php $big_image_src = $property->getImage($property->image, 1290, 650, Image::CROP);?>
					<?=ImageOptimize::widget([
							'src' => $property->getMainImage('575'),
							'alt' => $property->title,
							'width' => 1290,
							'height' => 650,
							'lazyload' => 'progressive',
							'quality' => $quality,
							'recreate' => $recreate,
							'srcset' => [
								['src' => $big_image_src, 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '768px'],
								['src' => $property->getMainImage('767'), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
								['src' => $property->getMainImage('575'), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
							],
					]);?>
					<?php #=Html::img($big_image_src, ['alt' => $property->title, 'srcset' => $property->getMainImage('575').' 575w, '.$property->getMainImage('767').' 767w, '.$big_image_src.' 768w', 'sizes' => '250w']);?>
				</div>
			<?php endif;?>
			<?php if(!empty($property->screenshot)):?>
				<?php foreach($property->screenshot as $file_name):?>
					<?php $big_image_src = $property->getImage($file_name, 1290, 650, Image::CROP);?>
					<div class="slider-gallery-image">
						<?=ImageOptimize::widget([
							'src' => $property->getImage($file_name, 575),
							'alt' => $property->title,
							'width' => 1290,
							'height' => 650,
							'lazyload' => 'progressive',
							'quality' => $quality,
							'recreate' => $recreate,
							'srcset' => [
								['src' => $big_image_src, 'size' => '768w', 'media_point' => 'min-width', 'media_size' => '768px'],
								['src' => $property->getImage($file_name, 767), 'size' => '767w', 'media_point' => 'max-width', 'media_size' => '767px'],
								['src' => $property->getImage($file_name, 575), 'size' => '575w', 'media_point' => 'max-width', 'media_size' => '575px'],
							],
						]);?>
						<?php #=Html::img($big_image_src, ['alt' => $property->title, 'srcset' => $property->getImage($file_name, 575).' 575w, '.$property->getImage($file_name, 767).' 767w, '.$big_image_src.' 768w', 'sizes' => '250w']);?>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		</div>
		
		<div class="slider slider-nav thumb-image d-print-none" data-lazy="progressive">
			<?php if(!empty($property->image)):?>
				<div class="thumbnail-image">
					<div class="thumbImg">
						<?=ImageOptimize::widget([
							'src' => $property->getImage($property->image, 246, 170, Image::CROP),
							'alt' => $property->title,
							'width' => 246,
							'height' => 170,
							'lazyload' => 'progressive',
							'quality' => $quality,
							'recreate' => $recreate,
						]);?>
						<?php #=Html::img($property->getImage($property->image, 246, 170, Image::CROP), ['alt' => $property->title, 'width' => 246, 'height' => 170]);?>
					</div>
				</div>
			<?php endif;?>
			<?php if(!empty($property->screenshot)):?>
				<?php foreach($property->screenshot as $file_name):?>
					<div class="thumbnail-image">
						<div class="thumbImg">
							<?=ImageOptimize::widget([
								'src' => $property->getImage($file_name, 246, 170, Image::CROP),
								'alt' => $property->title,
								'width' => 246,
								'height' => 170,
								'lazyload' => 'progressive',
								'quality' => $quality,
								'recreate' => $recreate,
							]);?>
							<?php #=Html::img($property->getImage($file_name, 246, 170, Image::CROP), ['alt' => $property->title, 'width' => 246, 'height' => 170]);?>
						</div>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		</div>
		
	</div>
</div>
