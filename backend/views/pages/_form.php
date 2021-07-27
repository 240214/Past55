<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#pages-slug']);?>
		</div>
		<div class="col-md-5">
			<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
		</div>
		<div class="col-md-1">
			<?=$form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No']);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=$form->field($model, 'content')->widget(TinyMce::className(), Yii::$app->params['tinymce']);?>
		</div>
		<div class="col-md-12">
			<?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
		</div>
	</div>
<?php ActiveForm::end(); ?>
