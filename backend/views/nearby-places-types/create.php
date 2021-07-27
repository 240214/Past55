<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NearbyPlacesTypes */

$this->title = 'Create Nearby Places Types';
$this->params['breadcrumbs'][] = ['label' => 'Nearby Places Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nearby-places-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
