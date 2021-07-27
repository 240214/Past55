<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model common\models\Property */

$this->title = 'Property listing view';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$front = Yii::$app->urlManagerFrontend->baseUrl;
?>
<div class="card">
	<div class="row" style="margin-bottom: 15px;">
		<div class="col-md-7">
			<h1><?=Html::encode($this->title)?></h1>
		</div>
		<div class="col-md-5 text-right">
			<?=Html::a('<i class="fa fa-chevron-left"></i> '.Yii::t('app', 'Back'), Url::toRoute('property/index'), ['class' => 'btn btn-warning'])?>
			<?=Html::a('<i class="fa fa-link"></i> '.Yii::t('app', 'Preview'), '/'.$model->slug, ['class' => 'btn btn-info', 'target' => '_blank'])?>
			<?=Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-success'])?>
			<?=Html::a('<i class="fa fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data'  => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method'  => 'post']]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?=DetailView::widget([
				'model' => $model,
				'attributes' => [
					'id',
					'mainImage:image',
					'title',
					'slug',
					#'price',
					'type',
					[
						'attribute' => 'category_id',
						'value' => is_object($model->category) ? $model->category->name : '',
					],
					[
						'attribute' => 'categories[]',
						'format' => 'html',
						'label' => 'Additional categories',
						'value' => function($data) use ($model){
							$html = '<ul class="list">';
							foreach($model->getCategoryLinks() as $cat_id){
								$html .= '<li>'.$data->Categories[$cat_id].'</li>';
							}
							$html .= '</ul>';
							return $html;
							#return VarDumper::dump($model->getCategoryLinks(), 10, 1);
						}
					],
					#'property_of',
					#'ownership',
					#'list_for',
					#'possession_by',
					#'availability',
					#'size',
					#'bedrooms',
					#'bathrooms',
					#'parking',
					#'garden',
					#'sold',
					'address',
					'address_lat',
					'address_lng',
					'location',
					'prop_number',
					'city',
					'zipcode',
					'state',
					'country',
					'nearby_places',
					'features',
				],
			]);?>
		</div>
	</div>
</div>
