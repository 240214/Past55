<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([

    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<?= $form->field($model, 'bank_name')->textInput(['placeholder' => 'eg. Bank of Bingo']) ?>
<?= $form->field($model, 'bank_logo')->fileInput() ?>
<?= $form->field($model, 'bank_email')->textInput(['placeholder' => 'eg. abcd@bank.com']) ?>
<?= $form->field($model, 'bank_contact_number')->textInput(['placeholder' => 'eg. +91-789-758-781']) ?>

<?= $form->field($model, 'website')->textInput(['placeholder' => 'eg. www.abcBank.com']) ?>

<?= $form->field($model, 'bank_about')->textarea(['row' => 6]) ?>
<?= $form->field($model, 'loan_purpose')->textInput(['placeholder' => 'eg. purchase']) ?>
<?= $form->field($model, 'loan_product')->textInput(['placeholder' => 'eg. 25 Year Fixed'])->label('Loan Product/Period') ?>
<?= $form->field($model, 'interest_rate')->textInput(['placeholder' => 'eg. 11.53'])->hint('only numerical value.')->label('Interest Rate (%)') ?>
<?= $form->field($model, 'arp')->textInput(['placeholder' => 'eg. 2.86'])->label('ARP Rate (%)') ?>
<?= $form->field($model, 'loan_amount')->textInput(['placeholder' => 'eg. 500000']) ?>
<?= $form->field($model, 'down_payment')->textInput(['placeholder' => 'eg. 20 its seem like 20%'])->label('Down Payment (%)')->hint('down payment will be in percentage') ?>
<?= $form->field($model, 'total_fees')->textInput(['placeholder' => '$1300']) ?>
<?= $form->field($model, 'rate_lock')->textInput(['placeholder' => 'eg. 60 Days
']) ?>
<?= $form->field($model, 'note')->textInput(['placeholder' => 'about loan plan']) ?>
<?= $form->field($model, 'disclaimer')->textInput(['placeholder' => 'eg. Cras justo odio, dapibus ac facilisis in,']) ?>





<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
