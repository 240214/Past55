<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NearbyPlaces */

$this->title = 'Create Nearby Places';
$this->params['breadcrumbs'][] = ['label' => 'Nearby Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nearby-places-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
