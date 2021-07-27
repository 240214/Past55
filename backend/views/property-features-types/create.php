<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeaturesTypes */

$this->title  = 'Create Property Features Types';
$this->params['breadcrumbs'][] = ['label' => 'Property Features Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model]);?>
</div>
