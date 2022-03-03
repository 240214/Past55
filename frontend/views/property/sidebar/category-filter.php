<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;

$session = Yii::$app->session;
$city = $session->get('city');
$state = $session->get('state');
$category_ids = $session->get('category_ids');

#VarDumper::dump($categories, 10, 1);
?>

<div class="filter-box p-35 mb-2">
	<div class="filter-box__title mb-2">Types of communities <small class="js_result_count_label d-none"><?=$found_label;?></small></div>
	<div class="d-flex flex-wrap mb-5">
		<?php foreach ($categories as $category):?>
			<?=Html::a($category['name'], Url::toRoute(['property/index', 'category_slug' => $category['slug'], 'state' => $state, 'city' => $city]), ['class' => 'filter-box__btn']);?>
		<?php endforeach;?>
	</div>
</div>

