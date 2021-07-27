<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = Yii::t('app', $model->name.' Profile Edit');
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

                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'mobile') ?>
                        <?= $form->field($model, 'image')->fileInput(['multiple' => false, 'accept' => 'image/*'])->hint(Yii::t('app', 'Press ctrl and select multiple image')); ?>

                        <?= $form->field($model, 'about') ?>
                        <div class="form-group">
                            <label>Role</label>
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                <label class="btn <?= ($model['role'] == 'agent')?"active":"";?>">
                                    <input type="radio" name="User[role]" value="agent" <?= ($model['role'] == 'agent')?"checked":"";?>>Agent
                                </label>
                                <label class="btn <?= ($model['role'] == 'guest')?"active":"";?>">
                                    <input type="radio" name="User[role]" value="guest"  <?= ($model['role'] == 'guest')?"checked":"";?>>Owner
                                </label>

                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'price_min')->textInput()->label('Works in Price Range from') ?>
                        </div>

                        <div class="col-lg-6">
                            <?= $form->field($model, 'price_max')->textInput()->label('Works in Price Range to') ?>
                        </div>
                        <hr>
                        Content load where user is agents
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?= $form->field($model, 'languages', ['options'=>['class'=> 'form-group']])
                                        ->dropDownList([
                                            'English' => 'English',
                                            'Spanish' => 'Spanish',
                                            'French'=>'French',
                                            'Russian'=>'Russian',
                                            'Hindi'=>'Hindi'
                                        ],['class'=>'select2','multiple'=>'multiple']); ?>


                                </div>
                                    <label>Languages</label>

                                    <select name="User[languages]" class="select2" multiple>
                                        <option value="English" selected>English</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="French">French</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Hindi">Hindi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'agent_type', ['options'=>['class'=> 'form-group']])
                                    ->dropDownList([
                                            'Agents' => 'Agents',
                                            'Brokers' => 'Brokers',
                                            'Mortgage Lenders'=>'Mortgage Lenders',
                                            'Developers'=>'Developers',
                                            'Buiders'=>'Buiders'
                                    ],['class'=>'select2']); ?>


                            </div>
                        </div>

                    <div class="col-lg-12">
                        <?= $form->field($model, 'dealing_in', ['options'=>['class'=> 'form-group']])->dropDownList([ 'rent' => 'Rent', 'sale' => 'Sale'],['class'=>'select2']); ?>
                        <?= $form->field($model, 'city') ?>
                        <?= $form->field($model, 'country') ?>
                        <?= $form->field($model, 'address')->textarea() ?>
                        <div class="form-group" align="center">
                            <button type="reset" onclick="demo_button()" class="btn btn-lg btn-primary"  >Save</button>
                        </div>
                        <br>
                    </div>


                        <?php ActiveForm::end(); ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
