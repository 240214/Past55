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
		'class' => 'filter-form trans_all',
		'data-autoload' => 0,
		'data-trigger' => 'js_action_submit',
		'data-action' => 'property_filter',
	],
	'fieldConfig' => ['options' => ['tag' => false]]
]);?>
<div class="card">
	<div class="header">
		<h2>Filter By Type</h2>
		<small class="js_result_count_label"><?=$found_label;?></small>
		<a role="button" class="btn-close-filter btn btn-default trans_me d-block d-md-none" data-trigger="js_action_click" data-action="toggle_filter_sidebar" data-container="#js_filter_results">
			<i class="zmdi zmdi-close zmdi-hc-fw"></i>
			<span>Close</span>
		</a>
	</div>
	<div class="body">
		<?=$form->field($property, 'category_id')->checkboxList($categories, [
			'item' => function($index, $label, $name, $checked, $value) use ($category_ids){
				$id = $label['id'].'_'.$label['slug'];
				$checked = in_array($label['id'], $category_ids) ? 'checked="checked"' : '';
				$return = '';
				/*$return .= '<label class="block" for="'.$id.'">';
				$return .= '<input type="checkbox" id="'.$id.'" name="'.str_replace('[]', '['.$label['id'].']', $name).'" value="'.$label['id'].'" '.$checked.' label="'.$label['name'].'">';
				$return .= '<span>'.$label['name'].'</span>';
				$return .= '</label>';*/
				
				$return .= '<div class="decor-checkbox block-item">';
				$return .= '<input type="checkbox" id="'.$id.'" name="'.str_replace('[]', '['.$label['id'].']', $name).'" value="'.$label['id'].'" '.$checked.' label="'.$label['name'].'">';
				$return .= '<label for="'.$id.'">'.$label['name'].'</label>';
				$return .= '</div>';
				
				return $return;
			},
			'unselect' => null,
		])->label(false);?>
	</div>
	<div class="footer">
		<?=$form->field($property, 'city')->hiddenInput(['value' => $city])->label(false);?>
		<?=$form->field($property, 'state')->hiddenInput(['value' => $state])->label(false);?>
		<?=Html::submitButton('Update Results', ['class' => 'btn btn-info', 'id' => 'submit_filter']);?>
	</div>
</div>
<?php ActiveForm::end();?>

