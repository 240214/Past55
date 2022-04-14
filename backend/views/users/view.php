<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title                   = 'User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($model->name)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('users/index'), ['class' => 'btn btn-warning'])?>
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
					[
						'attribute'      => 'id',
						#'contentOptions' => ['class' => 'col-50'],
						'content'        => function($data){
							return '<span class="label label-success label-id">'.$data->id.'</span>';
						},
					],
					[
						'attribute' => 'avatar',
						'header' => 'Avatar',
						#'contentOptions' => ['class' => 'col-50'],
						'format' => 'image',
					],
					'name',
					'username',
					'position',
					'email',
					'mobile',
					'rating',
					'role',
					'about:html',
					'social_tw', 'social_in', 'social_fb', 'social_yt', 'social_vm', 'social_ig', 'social_gp', 'social_tb'
				],
			]);?>
		</div>
	</div>
</div>
