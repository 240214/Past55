<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="container">
        <div class="col-md-6 col-lg-offset-3 rmd-sidebar-mobile">
            <div class="card d-print-none">


                <?php $form = ActiveForm::begin(['id' => 'reset-password-form','class' => '']); ?>

                <div class="card__header">
                    <h2><?= $this->title ?>  </h2>
                    <small>Please choose your new password:</small>
                </div>
                <div class="card__body">




                    <div class="form-group form-group--float required">
                        <?= $form->field($model, 'password', ['options'=>['class'=> 'form-group form-group--float'],'template'=>" {input}\n {label} \n <i class='form-group__bar'></i> \n {hint} \n {error}"])->passwordInput(['autofocus' => true]); ?>
                    </div>


                </div>

                <div class="card__footer">
                    <button type="submit" class="btn btn-primary">Send Email</button>
                    <button class="btn btn-link d-block d-lg-none d-md-none" data-rmd-action="block-close" data-rmd-target="#inquire">Cancel</button>
                </div>
                <?php ActiveForm::end(); ?>

            </div>


        </div>
    </div>
</section>

