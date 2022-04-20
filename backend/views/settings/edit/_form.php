<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">
	
	<?php $form = ActiveForm::begin(); ?>
	
	<?=$form->field($model, 'setting_name')->textInput(['maxlength' => true]);?>
	<?=$form->field($model, 'setting_value')->textarea(['rows' => 6]);?>
	<?=$form->field($model, 'field_type')->textInput(['maxlength' => true]);?>
	<?=$form->field($model, 'field_options')->textarea(['rows' => 6]);?>
	<?=$form->field($model, 'setting_title')->textInput(['maxlength' => true]);?>
	<?=$form->field($model, 'order')->input('number');?>
	<?=$form->field($model, 'active')->input('number', ['min' => 0, 'max' => 1]);?>

	<div class="form-group">
		<?=Html::submitButton('Save', ['class' => 'btn btn-success']);?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
