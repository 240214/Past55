<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PropertyFeatures */

$this->title = Yii::t('app', 'Create Property Features');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Property Features'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model, 'icons' => $icons, 'feature_types' => $feature_types]);?>
</div>
