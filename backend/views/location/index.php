<?php

use common\components\CustomActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Locations');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix"></div>
<div class="card">

	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center">
				<?=Html::a('<i class="fa fa-flag"></i> '.Yii::t('app', 'Countries'), ['country/index'], ['class' => 'btn btn-success'])?>
			</div>
			<div class="col-md-4 text-center">
				<?=Html::a('<i class="fa fa-flag"></i> '.Yii::t('app', 'States'), ['state/index'], ['class' => 'btn btn-success'])?>
			</div>
			<div class="col-md-4 text-center">
				<?=Html::a('<i class="fa fa-flag"></i> '.Yii::t('app', 'Cities'), ['city/index'], ['class' => 'btn btn-success'])?>
			</div>
		</div>
	</div>
	
	
</div>
