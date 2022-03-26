<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\image\drivers\Image;

?>
<div class="gallery-detail clearfix">
	<div class="gallery-slider">
		
		<div class="slider slider-for">
			<?php if(!empty($property->image)):?>
				<div class="slider-gallery-image">
					<?=Html::img($property->getImage($property->image, 1290, 650, Image::CROP), ['alt' => $property->title]);?>
				</div>
			<?php endif;?>
			<?php if(!empty($property->screenshot)):?>
				<?php foreach($property->screenshot as $file_name):?>
					<div class="slider-gallery-image">
						<?=Html::img($property->getImage($file_name, 1290, 650, Image::CROP), ['alt' => $property->title]);?>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		</div>
		
		<div class="slider slider-nav thumb-image d-print-none">
			<?php if(!empty($property->image)):?>
				<div class="thumbnail-image">
					<div class="thumbImg">
						<?=Html::img($property->getImage($property->image, 246, 170, Image::CROP), ['alt' => $property->title]);?>
					</div>
				</div>
			<?php endif;?>
			<?php if(!empty($property->screenshot)):?>
				<?php foreach($property->screenshot as $file_name):?>
					<div class="thumbnail-image">
						<div class="thumbImg">
							<?=Html::img($property->getImage($file_name, 246, 170, Image::CROP), ['alt' => $property->title]);?>
						</div>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		</div>
		
	</div>
</div>
