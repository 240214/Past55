<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryCityContent */

$this->title                   = 'Categoty & City Content';
$this->params['breadcrumbs'][] = ['label' => 'Categoty & City Content', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($model->FormatedTitle())?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('category-city-content/index'), ['class' => 'btn btn-warning'])?>
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
					[
						'attribute' => 'category_id',
						'value' => is_object($model->category) ? $model->category->name : '',
					],
					[
						'attribute' => 'state_id',
						'value' => is_object($model->state) ? $model->state->name : '',
					],
					[
						'attribute' => 'city_id',
						'value' => is_object($model->city) ? $model->city->name : '',
					],
					[
						'attribute' => 'title',
						'label' => 'Title original',
					],
					[
						'attribute' => 'title',
						'label' => 'Title formated',
						'value' => $model->FormatedTitle(),
					],
					'mainImage:image',
					'content:html',
				],
			]);?>
		</div>
	</div>
</div>
