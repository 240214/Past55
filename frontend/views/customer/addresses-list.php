<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use common\models\CustomerAddresses;

$customer_address = new CustomerAddresses();

#$session = Yii::$app->session;
?>
<div class="js_data_loader loader bg-loader"></div>
<?php $form = ActiveForm::begin([
	'id' => 'js_customer_addresses_form',
	'action' => $_SERVER['REQUEST_URI'],
	'enableAjaxValidation' => false,
	'options' => [
		'class' => 'customer-addresses-form trans-all',
		'data-autoload' => 0,
		'data-trigger' => 'js_action_submit',
		'data-action' => 'store_customer_address',
		'data-property_id' => $property['id'],
	],
	'fieldConfig' => ['options' => ['tag' => false]]
]);?>
<?=$form->field($customer_address, 'property_id')->hiddenInput(['value' => $property->id])->label(false)->error(false);?>
<?php foreach($customer_addresses as $c_address):?>
	<div class="list-item js_customer_address_row">
		<div class="fields d-none js_address_col position-relative">
			<?=$form->field($customer_address, 'title[]')->textInput(['value' => $c_address['title'], 'class' => 'form-control js_customer_address_title', 'placeholder' => 'Visitor name'])->label(false)->error(false);?>
			<?=$form->field($customer_address, 'address[]')->textInput(['value' => $c_address['address'], 'class' => 'form-control js_customer_address_address', 'placeholder' => 'Visitor address', 'data-loaded' => 0])->label(false)->error(false);?>
			<?=$form->field($customer_address, 'lat[]')->hiddenInput(['value' => $c_address['lat'], 'class' => 'js_customer_address_lat'])->label(false)->error(false);?>
			<?=$form->field($customer_address, 'lng[]')->hiddenInput(['value' => $c_address['lng'], 'class' => 'js_customer_address_lng'])->label(false)->error(false);?>
			<?=$form->field($customer_address, 'id[]')->hiddenInput(['value' => $c_address['id'], 'class' => 'js_customer_address_id'])->label(false)->error(false);?>
			<a role="button" data-trigger="js_action_click" data-action="cancel_customer_address" class="btn-current-address-cancel"><i class="bi bi-arrow-clockwise"></i> Cancel</a>
			<div class="btn-distance-indigo js_customer_distance_label js_customer_distance_label_preview distance-label-preview ms-0 mt-1"><?=$c_address['distance'];?> <?=$c_address['distance_type'];?></div>
		</div>
		<div class="labels js_distance_col">
			<div class="col">
				<div class="name ff-pt-serif"><?=$c_address['title'];?></div>
				<div class="location"><?=$c_address['address'];?></div>
			</div>
			<div class="btn-distance-indigo js_customer_distance_label">
				<?=$c_address['distance'];?> <?=$c_address['distance_type'];?>
				<div class="btn-current-address">
					<a role="button" data-trigger="js_action_click" data-action="edit_customer_address" class="edit"><i class="bi bi-pencil"></i> Edit</a>
					<a role="button" data-trigger="js_action_click" data-action="remove_customer_address" class="remove"><i class="bi bi-x-lg"></i> Delete</a>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>
<div class="ff-pt-serif fw-bold fs-18 mt-2">Input Address to See Distance from Living Facility</div>
<div class="list-item border-0 js_address_col">
	<?=$form->field($customer_address, 'title[]')->textInput(['class' => 'form-control mb-1 js_customer_address_title', 'placeholder' => 'Visitor name'])->label(false)->error(false);?>
	<?=$form->field($customer_address, 'address[]')->textInput(['class' => 'form-control js_customer_address_address', 'placeholder' => 'Visitor address', 'data-loaded' => 0])->label(false)->error(false);?>
	<?=$form->field($customer_address, 'lat[]')->hiddenInput(['class' => 'js_customer_address_lat'])->label(false)->error(false);?>
	<?=$form->field($customer_address, 'lng[]')->hiddenInput(['class' => 'js_customer_address_lng'])->label(false)->error(false);?>
	<?=$form->field($customer_address, 'id[]')->hiddenInput(['class' => 'js_customer_address_id'])->label(false)->error(false);?>
	<div class="btn-distance-indigo js_customer_distance_label js_customer_distance_label_preview distance-label-preview ms-0 mt-1"></div>
</div>
<div class="form-btns">
	<?=Html::button('Save List', ['id' => 'js_store_distance', 'class' => 'btn primary text-nowrap ps-3 pe-3', 'data-trigger' => 'js_action_click', 'data-action' => 'store_customer_address']);?>
	<?=Html::button('Add new address', ['id' => 'js_add_distance', 'class' => 'btn secondary w-100', 'data-trigger' => 'js_action_click', 'data-action' => 'add_customer_address']);?>
</div>
<?php ActiveForm::end();?>
