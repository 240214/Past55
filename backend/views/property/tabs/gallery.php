<?php

use kartik\file\FileInput;
use yii\helpers\Html;

?>
<?=$form->field($model, 'gallery[]')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => true], 'pluginOptions' => $pluginOptions]);?>
<?php if(!empty($model->screenshot)):?>
	<ul class="gallery-images">
		<?php foreach($model->screenshot as $file_name):?>
			<li>
				<a role="button" class="fileinput-remove"
				   data-trigger="js_action_click"
				   data-action="remove_image"
				   data-controller="property"
				   data-id="<?=$model->id;?>"
				   data-field="screenshot"
				   data-file="<?=$file_name;?>"
				   aria-label="Remove"><i class="fa fa-times"></i></a>
				<?=Html::img($model->getImage($file_name, '250'), ['class' => 'max-w-100p']);?>
			</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>
