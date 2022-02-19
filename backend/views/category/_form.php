<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-6">
	<?php $form = ActiveForm::begin();?>
	
	<?=$form->field($model, 'name')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug_n_meta', 'data-target' => '#category-slug', 'data-target2' => '#category-meta_title']);?>
	<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
	<?=$form->field($model, 'meta_title')->textInput(['maxlength' => false]);?>
	<?=$form->field($model, 'template')->dropDownList($templates, ['prompt' => 'None']);?>
	
	<?php //=$form->field($model, 'type')->dropDownList([ 'residential' => 'Residential', 'commercial' => 'Commercial', ], ['prompt' => '']);?>
	
	<?php //=$form->field($model, 'icon')->textInput(['maxlength' => true]);?>

	<div class="form-group">
		<?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
	</div>
	
	<?php ActiveForm::end();?>
	</div>
</div>
