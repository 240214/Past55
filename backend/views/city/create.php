<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Create City';

$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model, 'nearby_cities_list' => $nearby_cities_list]);?>
</div>
