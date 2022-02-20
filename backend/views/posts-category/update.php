<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PostsCategories */

$this->title = Yii::t('app', 'Update Category');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="card">
	<?=$this->render('_form', ['model' => $model, 'templates' => $templates]);?>
</div>
