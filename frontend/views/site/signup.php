<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup - Please register or sign in ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-5 col-md-offset-1">
                <ul class="nav nav-tabs tab-lg" role="tablist">
                    <li role="presentation"><a href="<?= \yii\helpers\Url::toRoute('site/login') ?>">Sign In</a></li>
                    <li role="presentation"  class="active"><a href="<?= \yii\helpers\Url::toRoute('site/signup') ?>">Register</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="login">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div> </div>
            </div>
            <div class="col-sm-2 col-md-1 d-none d-sm-block">
                <div class="sign-in-or"><img src="<?= Yii::getAlias('@web') ?>/img/sign-in-or.png"><span>or</span></div>
            </div>
            <div class="col-sm-5 col-md-4">
                <div class="d-sm-none">
                    <hr />
                </div>
                <div class="socal-login-buttons"> <a href="#" class="btn btn-social btn-lg btn-block btn-facebook"><i class="icon fa fa-facebook"></i> Sign In with Facebook</a> <a href="#" class="btn btn-social btn-lg btn-block btn-google"><i class="icon fa fa-google"></i> Sign In with Google</a> <a href="#" class="btn btn-social btn-lg btn-block btn-twitter"><i class="icon fa fa-twitter"></i> Sign In with Twitter</a> </div>
            </div>
        </div>
    </div>
</div>



