<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Add New Mortgage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Add New Mortgage'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-lg-6 col-lg-offset-3">
        <h2 class="header">
            <strong>
                Add New Bank to the Mortgage List
            </strong>
        </h2>
        <br>
        <br>
        <div class="panel">

            <div class="panel-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>

        </div>
    </div>
</div>
