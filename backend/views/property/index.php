<?php
use common\models\PropertyConfiguration;
use common\models\PropertyFeatures;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use common\models\SiteSettings;
use yii\web\View;
use yii\widgets\Pjax;
use common\components\CustomActionColumn;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
$site = SiteSettings::find()->one();
$this->title = "Property Listing";
$front = Yii::$app->urlManagerFrontend->baseUrl;
#VarDumper::dump($front, 10, 1);
?>
<div class="card">
	<div class="pull-right" style="margin-bottom: 10px;">
		<?=Html::a('<span class="fa fa-plus"></span> Add new', ['create'], ['class' => 'btn btn-success']);?>
	</div>
	
	<?php Pjax::begin(); ?>
	<div class="page-size-box">
		<?=Html::label('Page size:', 'per-page', array( 'style' => 'margin: 0 10px 0 0;'));?>
		<?=Html::dropDownList('per-page', $pageSize, $pageSize_list, ['id' => 'per-page', 'class' => 'form-control', 'style' => 'display:inline-block; width:auto']);?>
	</div>
	
	<?=GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'filterSelector' => 'select[name="per-page"]',
		#'emptyCell' => '---',
		'columns' => [
			#['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'id',
				'contentOptions' => ['class' => 'col-50'],
				'content' => function($data){
					return '<span class="label label-success label-id">'.$data->id.'</span>';
				},
			],
			#'mainImage:image',
			[
				'attribute' => 'mainImage',
				'header' => 'Image',
				'contentOptions' => ['class' => 'col-50'],
				'format' => 'image',
			],
			'title',
			'slug',
			/*[
				'attribute' => 'type',
				'filter'=> $property_types,
			],*/
			/*[
				'attribute' => 'property_of',
				'filter'=> $property_of_types,
			],*/
			[
				'attribute' => 'categoryName',
				'filter'=> $categories,
				'value'=>'category.name',
			],
			[
				'attribute'      => 'active',
				'contentOptions' => ['class' => 'col-50'],
				'filter'         => [1 => 'Yes', 0 => 'No'],
				'content'        => function($data){
					$content = '<label class="switch">';
					$content .= Html::checkbox('active', $data->active, ['data-trigger' => 'js_action_change', 'data-action' => 'ajax_change_prop_status', 'value' => $data->id]);
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
				'template' => '
					<div class="btn-group flex">
						{update}
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>{preview}</li>
							<li>{view}</li>
							<li>{delete}</li>
						</ul>
					</div>
				',
				'buttons' => [
					'view' => function ($url, $model){
						return Html::a('<span class="fa fa-eye"></span> View', $url, ['title' => 'View', 'aria-label' => 'View', 'data-pjax' => '0']);
					},
					'update' => function ($url, $model){
						return Html::a('<span class="fa fa-pencil"></span> <span class="btn-label">Edit</span>', $url, ['title' => 'Edit', 'aria-label' => 'Update', 'data-pjax' => '0', 'class' => 'btn btn-danger', 'role' => 'button']);
					},
					'delete' => function ($url, $model){
						return Html::a('<span class="fa fa-trash"></span> Delete', $url, ['title' => 'Delete', 'aria-label' => 'Delete', 'data-pjax' => '0', 'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]);
					},
					'preview' => function ($url, $model) use ($all_states){
						$url = '';
						if(!empty($model->state) && isset($all_states[$model->state])){
							$url = '/'.strtolower($all_states[$model->state]).'/'.strtolower(str_replace(' ', '-', $model->city)).'/'.$model->slug.'/';
						}
						return Html::a('<span class="fa fa-link"></span> Preview', $url, ['title' => 'Preview', 'aria-label' => 'View', 'data-pjax' => '0', 'target' => '_blank']);
					},
				],
			],
		],
	]);?>
	<?php Pjax::end();?>
</div>
<div id="viewEntry" class="modal fade" role="dialog" aria-labelledby="viewEntryLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span class="js_title"></span> Detail</h4>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<img width="100%" src="" class="img-responsive js_image">
							<div class="panel-body">
								<b>Price : </b> <span class="label label-danger js_price"></span>
								<b>List for : </b> <span class="label label-info js_listfor"></span>
								<b>Type : </b> <span class="label label-success js_type"></span>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div id="msgboxr"></div>
						<div class="panel">
							<div class="panel-body">
								<b>Basic Information of <i class="primary js_title"></i></b>
								<h6>Created at from <span class="js_reated_at"></span></h6>
								<hr>
								<b>Description :</b>
								<hr>
								<p class="js_description"></p>
								<hr>
								<br>
								<b>Features :</b>
								<hr>
								<p class="js_features"></p>
								<hr>
								<br>
								<b>Configuration :</b>
								<hr>
								<p class="js_ad_conf"></p>
							</div>
						</div>
					
					</div>
				</div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
			</div>
		
		</div>
	</div>
</div>
