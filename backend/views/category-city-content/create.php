<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryCityContent */

$this->title = 'Create Category & City Content';

$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model]);?>
</div>
