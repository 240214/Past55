<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2 rmd-sidebar-mobile" align="center">
        <div class="card hidden-print">
            <div class="panel">
                <h2>Error</h2>
            </div>
            <div class="panel-body">
                <h1 style="text-transform: uppercase;color: #777;font-size: 105px;" >
                    <i class="fa fa-warning"></i>
                </h1>
                <h1 style="text-transform: uppercase"><?=Html::encode($this->title);?></h1>
                <h3 style="color: #777;"><?=nl2br(Html::encode($message)) ?>  </h3>
                <hr>
                <a class="btn btn-warning" href="<?= \yii\helpers\Url::toRoute('site/index') ?>"><i class="zmdi zmdi-alert-triangle"></i> BACK TO HOME</a>
            </div>

            <div class="card__footer">
                <button class="btn btn-link hidden-lg hidden-md" data-rmd-action="block-close" data-rmd-target="#inquire">Cancel</button>
            </div>

        </div>


    </div>
</div>
