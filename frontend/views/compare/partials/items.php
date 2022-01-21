<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
#VarDumper::dump($models, 10, 1);

$user_favorites_html = Html::dropDownList('user_favorites', [], $user_favorites, [
	'class' => 'form-select mb-3 custom-select',
	'aria-label' => 'Select Favorite',
	'prompt' => 'Select Favorite',
	'data-trigger' => 'js_action_change',
	'data-action' => 'load_compare_property_item',
]);
?>
<?php foreach($models as $model):?>
	<div class="col">
		<div class="js_user_favorites" data-property_id="<?=$model->id;?>">
			<?=$user_favorites_html;?>
		</div>
		<div class="card box compare-item" data-id="<?=$model->id;?>">
			<?=$this->render('item', ['model' => $model, 'desc_length' => $desc_length]);?>
		</div>
	</div>
<?php endforeach;?>
