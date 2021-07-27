<?php
use yii\helpers\Html;
?>
<div class="row">
	<div class="col-md-6">
		<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#property-slug']);?>
		<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
		<?=$form->field($model, 'type')->dropDownList($model->PropertyTypes);?>
		<?=$form->field($model, 'category_id')->dropDownList($model->Categories, ['data--trigger' => 'js_action_change', 'data-action' => 'filter_categories']) ->label('Main category');?>
		<?=$form->field($model, 'categories[]')->checkboxList($model->Categories, [
			'item' => function($index, $label, $name, $checked, $value) use ($model){
				if(in_array($value, $model->getCategoryLinks())){
					$checked = 'checked';
				}
				$content = '<div class="check-item" data-id="'.$value.'">';
				$content .= Html::checkbox($name, $checked, ['value' => $value, 'id' => 'cat_item_'.$index]);
				$content .= '<label for="cat_item_'.$index.'"><i class="fa fa-check"></i>'.$label.'</label>';
				$content .= '</div>';
				
				return $content;
			},
			'class' => 'check-container'
		])->label('Additional categories');?>
	</div>
</div>

