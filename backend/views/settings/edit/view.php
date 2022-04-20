<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($model->setting_name)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('settings/index'), ['class' => 'btn btn-warning'])?>
			<?=Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
			<?=Html::a('<i class="fa fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data'  => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method'  => 'post']]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=DetailView::widget([
				'model'      => $model,
				'attributes' => [
					[
						'attribute'      => 'id',
						'content'        => function($data){
							return '<span class="label label-success label-id">'.$data->id.'</span>';
						},
					],
					[
						'attribute' => 'active',
						'format' => 'html',
						'value' => function($data){
							$class = ($data->active) ? 'badge label-success text-dark' : 'badge label-danger text-light';
							$text = ($data->active) ? 'Yes' : 'No';
							return sprintf('<span class="%s">%s</span>', $class, $text);
						},
					],
					'setting_name',
					'setting_value:ntext',
					'field_type',
					'field_options:ntext',
					[
						'attribute'      => 'order',
						'content'        => function($data){
							return '<span class="label label-success label-id">'.$data->order.'</span>';
						},
					],
					'setting_title',
				],
			]);?>
		</div>
	</div>
</div>

