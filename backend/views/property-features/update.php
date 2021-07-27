<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeatures */

$this->title = Yii::t('app', 'Update {modelClass}: ', ['modelClass' => 'Property Features']).$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Property Features'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model, 'icons' => $icons, 'feature_types' => $feature_types]);?>
</div>
