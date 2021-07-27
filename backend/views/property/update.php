<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Property */

$this->registerJs("var nearby_places_types = ".$model->nearby_places_types.";", View::POS_HEAD, 'nearby_places_types');

$this->title = Yii::t('app', 'Update {modelClass}: ', ['modelClass' => 'Property']).$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Property'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?=$this->render('_form', ['model' => $model]);?>
