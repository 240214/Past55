<?php

use common\components\CustomActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Property;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchNearbyPlaces */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Nearby Places';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
	<div class="js_data_loader bg-loader"></div>
	
	<?php Pjax::begin(); ?>
	<div class="page-size-box">
		<?=Html::label('Page size:', 'per-page', array('style' => 'margin: 0 10px 0 0;'));?>
		<?=Html::dropDownList('per-page', $pageSize, $pageSize_list, ['id' => 'per-page', 'class' => 'form-control', 'style' => 'display:inline-block; width:auto']);?>
	</div>
	
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<?=GridView::widget([
		'dataProvider'   => $dataProvider,
		'filterModel'    => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
		'columns' => [
			#['class' => 'yii\grid\SerialColumn'],
			
			[
				'attribute'      => 'id',
				'contentOptions' => ['class' => 'col-50'],
				'content'        => function($data){
					return '<span class="label label-success label-id">'.$data->id.'</span>';
				},
			],
			[
				'attribute' => 'Property',
				'filter' => $properties,
			],
			#'place_id',
			'icon_url:image',
			'name',
			'address',
			'type',
			#'lat',
			#'lng',
			'distance',
			'distance_type',
			#'rating',
			[
				'attribute'      => 'active',
				'contentOptions' => ['class' => 'col-50'],
				'filter'         => [1 => 'Yes', 0 => 'No'],
				'content'        => function($data){
					$content = '<label class="switch">';
					$content .= Html::checkbox('active', (bool)$data->active, ['data-trigger' => 'js_action_change', 'data-action' => 'ajax_change_np_status', 'value' => $data->id]);
					$content .= '<span class="slider round"></span>';
					$content .= '</label>';
					
					return $content;
				},
			],
			
			[
				'class' => CustomActionColumn::className(),
				'header' => 'Actions',
				'filterContent' => Html::a('<i class="fa fa-refresh"></i>&nbsp;Reset', ['index'], ['class' => 'btn btn-info']),
				'contentOptions' => ['class' => 'actions-col col-130 trans_all'],
				'template' => '<div class="btn-group flex">{view}
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>{update}</li>
							<li>{delete}</li>
						</ul>
					</div>',
				'buttons' => [
					'view' => function ($url, $model){
						return Html::a('<span class="fa fa-eye"></span> <span class="btn-label">View</span>', $url, ['title' => 'View', 'aria-label' => 'View', 'data-pjax' => '0', 'class' => 'btn btn-danger', 'role' => 'button']);
					},
					'update' => function ($url, $model){
						return Html::a('<span class="fa fa-pencil"></span> Edit', $url, ['title' => 'Edit', 'aria-label' => 'Update', 'data-pjax' => '0']);
					},
					'delete' => function ($url, $model){
						return Html::a('<span class="fa fa-trash"></span> Delete', $url, ['title' => 'Delete', 'aria-label' => 'Delete', 'data-pjax' => '0', 'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]);
					},
				],
			],
		],
	]);?>
	<?php Pjax::end(); ?>
</div>
