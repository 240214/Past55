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
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#pages-slug']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'content')->widget(TinyMce::className(), Yii::$app->params['tinymce'])->label(false);?>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-md-12">
					<?=$form->field($model, 'template')->dropDownList($page_templates, [
						'prompt' => '- Custom HTML Content -',
						'data-trigger' => 'js_action_click',
						'data-action' => 'toggle_content_editor',
						'data-target' => '.field-pages-content'
					]);?>
				</div>
				<div class="col-md-12">
					<?=$form->field($model, 'meta_description')->textarea(['row' => 6]);?>
				</div>
				<div class="col-md-12">
					<?=$form->field($model, 'meta_noindex')->dropDownList([1 => 'Yes', 0 => 'No']);?>
				</div>
				<div class="col-md-12">
					<?=$form->field($model, 'active')->dropDownList([1 => 'Yes', 0 => 'No']);?>
				</div>
				<div class="col-xs-12 text-right">
					<?=Html::submitButton('Update', ['class' => 'btn btn-success'])?>
				</div>
			
			</div>
		</div>
	</div>
<?php ActiveForm::end(); ?>
