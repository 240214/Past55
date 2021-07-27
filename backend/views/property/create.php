<?php

use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\Property */

$this->registerJs("var nearby_places_types = ".$model->nearby_places_types.";", View::POS_HEAD, 'globals');

$this->title = Yii::t('app', 'Create property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Property'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_form', ['model' => $model]);?>
