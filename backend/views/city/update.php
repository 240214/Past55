<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Update City: '.$model->name;

$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model, 'nearby_cities_list' => $nearby_cities_list]);?>
</div>
