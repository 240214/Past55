<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-4">
		
		<?php $form = ActiveForm::begin(); ?>
		
		<?=$form->field($model, 'name')->textInput(['maxlength' => true]);?>
		<?=$form->field($model, 'iso_code')->textInput(['maxlength' => true]);?>
		
		<?=$form->field($model, 'country_id')->dropDownList($model->Countries);?>

		<div class="form-group">
			<?=Html::submitButton('Save', ['class' => 'btn btn-success']);?>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
