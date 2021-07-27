<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('app', $model->name.' Account Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents Profile'), 'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="section">
    <div class="container">
        <header class="section__title">
            <h2><?= Html::encode($this->title) ?></h2>
            <small>Praesent commodo cursus magnavel sceleris quenisl consecte turet</small>
        </header>

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <div class="card">
                    <div class="card__header">
                        <div class="row">
                            <div class="col-lg-2">
                                <img class="img-circle img-responsive" src="<?= Yii::getAlias('@web') ?>/images/user/<?= $model['image'] ?>">
                            </div>
                            <div class="col-lg-9">
                                <h2><?= $model->name; ?> profile</h2>
                                <small>Curabitur blandit tempus porttitor ligula malesuada</small>
                            </div>
                        </div>

                    </div>
                    <div class="card__body">
                        <?php $form = ActiveForm::begin([

                            'options' => ['enctype' => 'multipart/form-data']
                        ]) ?>

                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password_write')->passwordInput() ?>
                        <div class="form-group" align="center">
                            <button type="reset" onclick="demo_button()" class="btn btn-lg btn-primary"  >Save</button>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>














