<?php

use kartik\file\FileInput;
use yii\helpers\Html;

?>
<?=$form->field($model, 'preview')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => false], 'pluginOptions' => $pluginOptions])->label('Main image');?>
<?php if(!empty($model->image)):?>
	<ul class="gallery-images">
		<li>
			<a role="button" class="fileinput-remove"
			   data-trigger="js_action_click"
			   data-action="remove_image"
			   data-folder="property"
			   data-id="<?=$model->id;?>"
			   data-field="image"
			   data-file="<?=$model->image;?>"
			   aria-label="Remove"><i class="fa fa-times"></i></a>
			<?=Html::img($model->getMainImage('250'));?>
		</li>
	</ul>
<?php endif;?>
