<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */

$pluginOptions = [
	'browseOnZoneClick' => true,
	'showCaption' => false,
	'showRemove' => false,
	'showUpload' => false,
	'showBrowse' => false,
	'showCancel' => false,
];

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'custom-form']]);?>
	<div class="row">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'name')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#users-username']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'email')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'username')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_focus', 'data-action' => 'create_slug', 'data-source' => '#users-name']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'password_write')->passwordInput(['maxlength' => true]);?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'mobile')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'country')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'city')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'address')->textInput(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'about')->textarea(['maxlength' => true]);?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="col-xs-12">
				<?=$form->field($model, 'preview')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => false], 'pluginOptions' => $pluginOptions])->label('Avatar');?>
				<?php if(!empty($model->image)):?>
					<ul class="gallery-images">
						<li>
							<a role="button" class="fileinput-remove"
							   data-trigger="js_action_click"
							   data-action="remove_image"
							   data-controller="posts"
							   data-id="<?=$model->id;?>"
							   data-field="image"
							   data-file="<?=$model->image;?>"
							   aria-label="Remove"><i class="fa fa-times"></i></a>
							<?=Html::img($model->getMainImage('250'));?>
						</li>
					</ul>
				<?php endif;?>
			</div>
			<div class="col-xs-12 text-right">
				<?=Html::submitButton('Update', ['class' => 'btn btn-success'])?>
			</div>
		</div>
	</div>
<?php ActiveForm::end();?>
