<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryCityContent */
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
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? 'Getting Ready to Move to %CATEGORY% in %CITY%' : $model->title]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'content')->widget(TinyMce::className(), Yii::$app->params['tinymce'])->label(false);?>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'category_id')->dropDownList($model->Categories);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'state_id')->dropDownList($model->States);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'city_id')->dropDownList($model->Cities);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'preview')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => false], 'pluginOptions' => $pluginOptions])->label('Featured image');?>
					<?php if(!empty($model->image)):?>
						<ul class="gallery-images">
							<li>
								<a role="button" class="fileinput-remove" data-trigger="js_action_click" data-action="remove_image" data-id="<?=$model->id;?>" data-field="image" data-file="<?=$model->image;?>" aria-label="Remove"><i class="fa fa-times"></i></a>
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
	</div>
<?php ActiveForm::end();?>
