<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;

$session = Yii::$app->session;
$city = $session->get('city');
$state = $session->get('state');
$category_ids = $session->get('category_ids');

$form = ActiveForm::begin([
	'id' => 'js_filter_form',
	'action' => $form_url,
	'enableAjaxValidation' => false,
	'options' => [
		'class' => 'filter-form trans-all',
		'data-autoload' => 0,
		'data-trigger' => 'js_action_submit',
		'data-action' => 'property_filter',
	],
	'fieldConfig' => ['options' => ['tag' => false]]
]);?>
<div class="filter-box p-35 mb-2">
	<?php if($options['display_price']):?>
		<div class="filter-box__title mb-2">Price range</div>
		<select class="filter-box__select mb-4 form-select _js_selectpicker">
			<option>$1000-$1500</option>
			<option>$1000-$1500</option>
			<option>$1000-$1500</option>
		</select>
	<?php endif;?>
	
	<div class="filter-box__title mb-2">Types of communities <small class="js_result_count_label d-none"><?=$found_label;?></small></div>
	<?=$form->field($property, 'category_id')->checkboxList($categories, [
		'item' => function($index, $label, $name, $checked, $value) use ($category_ids){
			$id = $label['id'].'_'.$label['slug'];
			$checked = in_array($label['id'], $category_ids) ? 'checked="checked"' : '';
			$return = '';
			$return .= '<div class="filter-box__item">';
			$return .= '<input type="checkbox" id="'.$id.'" name="'.str_replace('[]', '['.$label['id'].']', $name).'" value="'.$label['id'].'" '.$checked.' label="'.$label['name'].'" data-trigger="js_action_change" data-action="apply_cat_filter">';
			$return .= '<label for="'.$id.'" class="filter-box__btn">'.$label['name'].'</label>';
			$return .= '</div>';
			
			return $return;
		},
		'unselect' => null,
		'class' => 'd-flex flex-wrap mb-5',
	])->label(false);?>
	<div class="d-flex justify-content-between">
		<?=$form->field($property, 'city')->hiddenInput(['value' => $city])->label(false);?>
		<?=$form->field($property, 'state')->hiddenInput(['value' => $state])->label(false);?>
		<?=Html::buttonInput('Reset', ['class' => 'filter-box__reset-btn me-1', 'id' => 'js_reset_filter', 'data-trigger' => 'js_action_click', 'data-action' => 'property_filter_reset']);?>
		<?=Html::submitButton('Apply Filter', ['class' => 'btn-primary-large', 'id' => 'js_submit_filter']);?>
	</div>
</div>
<?php ActiveForm::end();?>

