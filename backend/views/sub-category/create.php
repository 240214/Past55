<?php

use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\SubCategory */

$this->title = Yii::t('app', 'Create Sub Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

</div>
