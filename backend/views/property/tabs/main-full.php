<?php
use yii\helpers\Html;
?>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-8">
				<?=$form->field($model, 'title')->textInput(['maxlength' => true]);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'type')->dropDownList($model->PropertyTypes);?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?=$form->field($model, 'price')->input('number', ['step' => 10, 'min' => 0]);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'property_of')->dropDownList($model->property_of_types);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'ownership')->dropDownList($model->ownership_types);?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?=$form->field($model, 'list_for')->dropDownList($model->list_for_types)->label('Appointment');?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'possession_by')->dropDownList($model->possession_by_types)->label('Possession Date');?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'availability')->dropDownList($model->availability_types);?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?=$form->field($model, 'size')->input('number', ['step' => 1, 'min' => 0, 'max' => 5000]);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'bedrooms')->input('number', ['step' => 1, 'min' => 0, 'max' => 20]);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'bathrooms')->input('number', ['step' => 1, 'min' => 0, 'max' => 20]);?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?=$form->field($model, 'parking')->dropDownList(['yes' => 'Yes', 'no' => 'No']);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'garden')->dropDownList(['yes' => 'Yes', 'no' => 'No']);?>
			</div>
			<div class="col-md-4">
				<?=$form->field($model, 'sold')->dropDownList(['no' => 'No', 'yes' => 'Yes']);?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<?=$form->field($model, 'category_id')->dropDownList($model->Categories, ['data-trigger' => 'js_action_change', 'data-action' => 'filter_categories']) ->label('Main category');?>
			</div>
			<div class="col-md-12">
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
	</div>
</div>

