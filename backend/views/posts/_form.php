<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin();?>
	<div class="row">
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#posts-slug']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'content')->widget(TinyMce::className(), Yii::$app->params['tinymce'])->label(false);?>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'slug')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_focus', 'data-action' => 'create_slug', 'data-source' => '#posts-title']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'type')->dropDownList($model->Types);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'category_id')->dropDownList($model->Categories);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'meta_description')->textarea(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12 text-right">
					<?=Html::submitButton('Update', ['class' => 'btn btn-success'])?>
				</div>
			
			</div>
		</div>
	</div>
<?php ActiveForm::end();?>
