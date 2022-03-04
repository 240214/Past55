<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NearbyPlacesTypes */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nearby Places Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nearby-places-types-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
	        [
		        'attribute' => 'active',
		        'format' => 'html',
		        'value' => function($data){
			        $class = ($data->active) ? 'badge label-success text-dark' : 'badge label-danger text-light';
			        $text = ($data->active) ? 'Publish' : 'Draft';
			        return sprintf('<span class="%s">%s</span>', $class, $text);
		        },
	        ],
            'name',
            'label',
        ],
    ]) ?>

</div>
