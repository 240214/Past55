<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ad */
/* @var $form ActiveForm */
?>
<div class="post">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'type') ?>
        <?= $form->field($model, 'price') ?>
        <?= $form->field($model, 'bedrooms') ?>
        <?= $form->field($model, 'bathrooms') ?>
        <?= $form->field($model, 'parking') ?>
        <?= $form->field($model, 'garden') ?>
        <?= $form->field($model, 'size') ?>
        <?= $form->field($model, 'image') ?>
        <?= $form->field($model, 'location') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'state') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'zipcode') ?>
        <?= $form->field($model, 'status') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- post -->
