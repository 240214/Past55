<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login - Please sign in or register';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="card">
                    <div class="card__header">
                        <h2 class="mdc-text-blue">
                            USER LOGIN
                        </h2>

                    </div>
                    <div class="card__body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="color:#999;margin:1em 0">
                            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="card__footer card__footer--highlight ">
                        Or if you new user please
                        <a href="<?= \yii\helpers\Url::toRoute('site/signup') ?>">Signup</a> here

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



