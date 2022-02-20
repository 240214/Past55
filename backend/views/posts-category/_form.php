<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-6">
	<?php $form = ActiveForm::begin();?>
	
	<?=$form->field($model, 'title')->textInput(['maxlength' => true, 'data-trigger' => 'js_action_blur', 'data-action' => 'create_slug', 'data-target' => '#postscategories-slug', 'data-target2' => '#category-meta_title']);?>
	<?=$form->field($model, 'slug')->textInput(['maxlength' => true]);?>
	<div class="form-group">
		<?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
	</div>
	
	<?php ActiveForm::end();?>
	</div>
</div>
