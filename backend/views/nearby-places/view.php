<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\NearbyPlaces */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nearby Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($this->title)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('nearby-places/index'), ['class' => 'btn btn-warning'])?>
			<?=Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
			<?=Html::a('<i class="fa fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
			])?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=DetailView::widget([
				'model'      => $model,
				'attributes' => [
					'id',
					'Property',
					'place_id',
					'icon_url:image',
					'name',
					'address',
					'lat',
					'lng',
					'distance',
					'distance_type',
					'type',
					'rating',
					'active',
				],
			]);?>
		</div>
	</div>
</div>
