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
		<div class="col-xs-9">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#posts-slug']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'content')->widget(TinyMce::className(), Yii::$app->params['tinymce'])->label(false);?>
					<div>
						<h4>Help section (FAQs)</h4>
						<ul>
							<li><a href="https://www.loom.com/share/4c2c5ce681e840eb95e7b39728f50e50" target="_blank">How to add anchors in Tinymce editor? (video)</a></li>
							<li>
								<b>Content list structure</b>
								<p>Separate the anchor link and title with the symbol "|". Write each set of anchor links and titles on a separate line.<br>
								<u>Example:</u><br>
								#anchor_link_1|Custom Title 1<br>
								#anchor_link_1|Custom Title 2<br>
								#anchor_link_100|Custom Title 100
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="row">
				<div class="col-xs-12">
					<?=$form->field($model, 'slug')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_focus', 'data-action' => 'create_slug', 'data-source' => '#posts-title']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'content_list')->textarea(['rows' => 10])->hint('<small>Example: #link|title</small>');?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'type')->dropDownList($model->Types);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'post_category_id')->dropDownList($model->PostsCategoriesList);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'category_id')->dropDownList($model->CategoriesList);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'ccl_title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_focus', 'data-action' => 'copy_from_field', 'data-source' => '#posts-title']);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'user_id')->dropDownList($model->UsersList);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'meta_description')->textarea(['maxlength' => true]);?>
				</div>
				<div class="col-xs-12">
					<?=$form->field($model, 'preview')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'multiple' => false], 'pluginOptions' => $pluginOptions])->label('Featured image');?>
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
	</div>
<?php ActiveForm::end();?>
