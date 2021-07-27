<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeaturesTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-features-types-form">
	
	<?php $form = ActiveForm::begin();?>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'title')->textInput(['maxlength' => true]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'order')->textInput(['maxlength' => false]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'separated')->dropDownList([0 => 'No', 1 => 'Yes'], ['data-trigger' => '', 'data-action' => '']);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'section_title')->textInput(['maxlength' => false]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'section_description')->textarea();?>
		</div>
	</div>
	<div class="form-group">
		<?=Html::submitButton('Save', ['class' => 'btn btn-success']);?>
	</div>
	
	<?php ActiveForm::end();?>

</div>
