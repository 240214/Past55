<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Sub Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">


	<p class="pull-right">
		<?=Html::a(Yii::t('app', 'Create Sub Category'), ['create'], ['class' => 'btn btn-success'])?>
	</p>
	<?php Pjax::begin(); ?>    <?=GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			#['class' => 'yii\grid\SerialColumn'],
			
			'id',
			'name',
			'parent',
			'subcategory_type',
			'input_options:ntext',
			
			[
				'class' => 'yii\grid\ActionColumn',
				'header' => 'Actions',
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
