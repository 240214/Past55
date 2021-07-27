<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = 'Country view';
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($this->title)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('country/index'), ['class' => 'btn btn-warning'])?>
			<?=Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);?>
			<?=Html::a('<i class="fa fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method' => 'post',
				],
			]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=DetailView::widget([
				'model' => $model,
				'attributes' => [
					'id',
					'name',
					'iso_code',
					'phonecode',
				],
			]);?>
		</div>
	</div>
</div>
