<?php

use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;

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
#VarDumper::dump($model->CitiesOptions, 10, 1);
?>

<?php $form = ActiveForm::begin([
	'enableAjaxValidation' => true,
	'enableClientValidation' => false,
	'validationUrl' => Url::toRoute('/category-city-content/validation'),
	'options' => [
		'enctype' => 'multipart/form-data',
		'class' => 'custom-form',
		#'data-trigger' => 'js_action_submit',
		#'data-action' => 'category_city_content_custom_validate',
	],
	#'fieldConfig' => ['options' => ['tag' => false]]
]);?>
	<div class="row">
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? 'Getting Ready to Move to %CATEGORY% in %CITY%' : $model->title]);?>
					<small class="d-block mb-2">Title keywords: <b>%CATEGORY%</b> = Category name, <b>%STATE%</b> = State name, <b>%CITY%</b> = City name</small>
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
					<?=$form->field($model, 'state_id')->dropDownList($model->States, ['id' => 'js_category_city_content_state', 'data-trigger' => 'js_action_change', 'data-action' => 'filter_cities_by_state', 'data-target' => '#js_category_city_content_city']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'city_id')->dropDownList($model->Cities, ['id' => 'js_category_city_content_city', 'options' => $model->CitiesOptions]);?>
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
