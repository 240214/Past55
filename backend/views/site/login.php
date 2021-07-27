<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" align="center" style="margin-top: 150px;">




    <div class="row">
        <div class="col-lg-12" align="left">
            <div class="panel bg-light-blue-gradient">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h2><?= Html::encode($this->title) ?></h2>
                    </div>
                    <p>Please fill out the following fields to login:</p>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-md btn-default', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
