<?php

use yii\helpers\Html;

?>
<div class="property_features">
	<?=Html::textInput('property_features', '', ['data-trigger' => 'js_action_keyup', 'data-action' => 'property_features_search', 'class' => 'form-control', 'placeholder' => 'Live filter...']);?>
	<?=$form->field($model, 'features[]')->checkboxList($model->AllPropertyFeatures, [
		'item' => function($index, $label, $name, $checked, $value) use ($model, $selected_features){
			if(in_array($value, $selected_features)){
				$checked = 'checked';
			}
			$content = '<div class="check-item">';
			$content .= Html::checkbox($name, $checked, ['value' => $value, 'id' => 'pf_item_'.$index]);
			#$content .= '<label for="pf_item_'.$index.'"><i class="pe-3x '.$label['image'].'"></i><i class="fa fa-check"></i>'.$label['name'].'</label>';
			$content .= '<label for="pf_item_'.$index.'"><i class="fa fa-check"></i>'.$label['name'].'</label>';
			$content .= '</div>';
			
			return $content;
		},
		'class' => 'check-container'
	])->label(false);?>
</div>
