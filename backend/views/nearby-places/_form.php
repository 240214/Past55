<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NearbyPlaces */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nearby-places-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <?= $form->field($model, 'place_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput() ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'distance_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
