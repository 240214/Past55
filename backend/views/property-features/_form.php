<?php
/**
 * http://themes-pixeden.com/font-demos/7-stroke/
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeatures */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-features-form">
	
	<?php $form = ActiveForm::begin(); ?>
	
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'feature_type_id')->dropDownList($feature_types)?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?=$form->field($model, 'image')->textInput(['maxlength' => true, 'id' => 'property_features_icon']);?>
			<?=Html::button('...', ['class' => 'btn btn-warning btn-choose-icon', 'data-toggle' => "modal", 'data-target' => "#chooseIcon"]);?>
		</div>
	</div>

	<div class="form-group">
		<?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
<div id="chooseIcon" class="modal fade" role="dialog" aria-labelledby="chooseIconLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span class="js_title"></span> Choose an icon</h4>
			</div>

			<div class="modal-body">
				<div class="icons-container">
				<?php foreach($icons as $icon):?>
					<a role="button" class="js-choose-icon" data-icon="<?=$icon;?>" data-trigger="js_action_click" data-action="choose_icon" data-target="#property_features_icon"><i class="pe-3x <?=$icon;?>"></i></a>
				<?php endforeach;?>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
			</div>

		</div>
	</div>
</div>
