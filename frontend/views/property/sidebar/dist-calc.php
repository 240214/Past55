<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use common\models\CustomerAddresses;

$customer_address = new CustomerAddresses();

#$session = Yii::$app->session;
?>
<div class="card-box">
	<div class="header">
		<h2 class="title mb-2"><?=$property->title;?> Distance Calculator</h2>
		<small class="address mb-15"><i class="bi bi-geo-alt-fill me-1 text-color-primary"></i><?=$property->address;?></small>
		<div class="subtitle">Location is important. You can input addresses, names of businesses, or popular places to quickly see how far away they are from the housing facility.</div>
		<div class="ff-pt-serif fw-bold fs-18 mt-2">Input Address to See Distance from Living Facility</div>
	</div>
	<div class="body position-relative mt-25">
		<div class="js_data_loader loader bg-loader"></div>
		<?php $form = ActiveForm::begin([
			'id' => 'js_customer_addresses_form',
			'action' => $_SERVER['REQUEST_URI'],
			'enableAjaxValidation' => false,
			'options' => [
				'class' => 'customer-addresses-form trans_all',
				'data-autoload' => 0,
				'data-trigger' => 'js_action_submit',
				'data-action' => 'store_customer_address',
				'data-property_id' => $property['id'],
			],
			'fieldConfig' => ['options' => ['tag' => false]]
		]);?>
		
		<?php foreach($property->customer_addresses as $c_address):?>
		<div class="customer-addresses-list js_customer_address_row">
			<div class="fields d-none">
				<?=$form->field($customer_address, 'title[]')->textInput(['value' => $c_address['title'], 'class' => 'form-control js_customer_address_title', 'placeholder' => 'Visitor name'])->label(false)->error(false);?>
				<?=$form->field($customer_address, 'address[]')->textInput(['value' => $c_address['address'], 'class' => 'form-control js_customer_address_address', 'placeholder' => 'Visitor address', 'data-loaded' => 0])->label(false)->error(false);?>
				<?=$form->field($customer_address, 'lat[]')->hiddenInput(['value' => $c_address['lat'], 'class' => 'js_customer_address_lat'])->label(false)->error(false);?>
				<?=$form->field($customer_address, 'lng[]')->hiddenInput(['value' => $c_address['lng'], 'class' => 'js_customer_address_lng'])->label(false)->error(false);?>
				<?=$form->field($customer_address, 'id[]')->hiddenInput(['value' => $c_address['id'], 'class' => 'js_customer_address_id'])->label(false)->error(false);?>
			</div>
			<div class="labels js_distance_col d-flex flex-nowrap flex-row justify-content-between align-items-center">
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
		
		<div class="row mt-4">
			<div class="col text-center">
				<?=Html::button('Save List', ['id' => 'js_store_distance', 'class' => 'btn btn-success', 'data-trigger' => 'js_action_click', 'data-action' => 'store_customer_address']);?>
				<span class="ms-3 me-3"></span>
				<?=Html::button('Add new address', ['id' => 'js_add_distance', 'class' => 'btn btn-warning', 'data-trigger' => 'js_action_click', 'data-action' => 'add_customer_address']);?>
			</div>
		</div>
		<?php ActiveForm::end();?>
	</div>
</div>
