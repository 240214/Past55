<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Booster price setting"
?>
<div class="site-login">




    <hr>
    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3><?= Html::encode($this->title) ?></h3>
                        <span class="panel-options">
                           <a href="#" class="panel-refresh">
                               <i class="icon ti-reload"></i>
                           </a>
                          <a href="#" class="panel-minimize">
                              <i class="icon ti-angle-up"></i>
                          </a>
                          <a href="#" class="panel-close">
                              <i class="icon ti-close"></i>
                          </a>
                      </span>
                    </h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                    <?= $form->field($model, 'price')->label('boost price')->hint('Price is in USD ($) only') ?>
                    <?= $form->field($model, 'time')->label('how many time boost taken action')->hint('$20 for 3 time boost in a day') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'site-settings-button']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>
                    <!-- /row -->
                </div>
            </div>

        </div>
        <div class="col-lg-7">
            <div style="padding: 15px;border-radius: 5px;background-color: #fff;">
                <h2>
                    Current Booster Plan
                   <span class="pull-right">
                       <a href="<?= \yii\helpers\Url::to('index.php?r=settings/boost', false) ?>">
                           <i class="fa fa-refresh"></i>
                       </a>
                   </span>
                </h2>
                <table class="table table-bordered">
                    <tr style="background-color: #ddd;">
                        <th>
                            #
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    <?php
                    foreach($list as $show)
                    {
                        $ini = $show['id'];
                        $sub = $show['id'] - 1;
                        $newIni = $ini - $sub;
                        ?>
                        <tr style="border-bottom: 1px dashed #ccc;border-radius: 5px;background-color: #fff;">
                            <td><?= $newIni; ?></td>
                            <td><?= $show['price'] ?></td>
                            <td><?= $show['time'] ?></td>
                            <td>
                                <a href="<?= \yii\helpers\Url::to('index.php?r=settings/boost&action=edit&id='.$show['id'], false) ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?= \yii\helpers\Url::to('index.php?r=settings/boost&action=delete&id='.$show['id'], false) ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
