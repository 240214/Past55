<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchNearbyPlacesTypes */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title  = 'Nearby Places Types';
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
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
		'columns'      => [
			#['class' => 'yii\grid\SerialColumn'],
			
			[
				'attribute' => 'id',
				'contentOptions' => ['class' => 'col-50'],
				'content' => function($data){
					return '<span class="label label-success label-id">'.$data->id.'</span>';
				},
			],
			#'name',
			'label',
			[
				'attribute' => 'active',
				'contentOptions' => ['class' => 'col-50'],
				'filter'=> [1 => 'Yes', 0 => 'No'],
				'content' => function($data){
					$content = '<label class="switch">';
					$content .= Html::checkbox('active', (bool) $data->active, ['data-trigger' => 'js_action_change', 'data-action' => 'ajax_change_npt_status', 'value' => $data->id]);
					$content .= '<span class="slider round"></span>';
					$content .= '</label>';
					
					return $content;
				},
			],
			
			#['class' => 'yii\grid\ActionColumn'],
		],
	]);?>
	<?php Pjax::end();?>
</div>
