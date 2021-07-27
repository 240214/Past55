<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeaturesTypes */

$this->title = 'Update Property Features Types: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Property Features Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
    <?=$this->render('_form', ['model' => $model]);?>
</div>
