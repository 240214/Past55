<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use common\models\CustomerAddresses;

$customer_address = new CustomerAddresses();

#$session = Yii::$app->session;
?>
<div id="infowindow-content">
	<img id="place-icon" src="">
	<div id="place-name"></div>
	<div id="place-address"></div>
</div>
<div class="card">
	<div class="card__header">
		<h2><?=$property->title;?> Distance Calculator</h2>
		<small class="address"><i class="zmdi zmdi-pin me-2"></i><?=$property->address;?></small>
		<small>Location is important. You can input addresses, names of businesses, or popular places to quickly see how far away they are from the housing facility.</small>
	</div>
	<div class="card__body">
		<div class="js_data_loader bg-loader"></div>
		<div class="row">
			<div class="col-12">
				<div class="mb-4"><strong>Input Address to See Distance from Living Facility</strong></div>
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
				<div class="row js_customer_address_row">
					<div class="col-2 border-bottom-1">
						<?=$form->field($customer_address, 'title[]')->textInput(['value' => $c_address['title'], 'class' => 'form-control border-bottom-0 js_customer_address_title', 'placeholder' => 'Visitor name'])->label(false);?>
					</div>
					<div class="col-7 border-bottom-1 js_address_col">
						<?=$form->field($customer_address, 'address[]')->textInput(['value' => $c_address['address'], 'class' => 'form-control border-bottom-0 js_customer_address_address', 'placeholder' => 'Visitor address', 'data-loaded' => 0])->label(false);?>
					</div>
					<div class="col-2 pt-2 pb-2 border-bottom-1 js_distance_col">
						<span class="js_customer_distance_label"><?=$c_address['distance'];?> <?=$c_address['distance_type'];?></span>
						<?=$form->field($customer_address, 'lat[]')->hiddenInput(['value' => $c_address['lat'], 'class' => 'js_customer_address_lat'])->label(false);?>
						<?=$form->field($customer_address, 'lng[]')->hiddenInput(['value' => $c_address['lng'], 'class' => 'js_customer_address_lng'])->label(false);?>
						<?=$form->field($customer_address, 'id[]')->hiddenInput(['value' => $c_address['id'], 'class' => 'js_customer_address_id'])->label(false);?>
					</div>
					<div class="col-1 pt-2 pb-2 border-bottom-1 text-center">
						<a role="button" data-trigger="js_action_click" data-action="remove_customer_address" class="btn-remove-current-address"><i class="zmdi zmdi-close-circle"></i></a>
					</div>
				</div>
				<?php endforeach;?>
				<div class="row mt-4">
					<div class="col text-center">
						<?=Html::button('<i class="zmdi zmdi-save"></i> Save List', ['id' => 'js_store_distance', 'class' => 'btn btn-success', 'data-trigger' => 'js_action_click', 'data-action' => 'store_customer_address']);?>
						<span class="ms-3 me-3"></span>
						<?=Html::button('<i class="zmdi zmdi-plus"></i> Add new address', ['id' => 'js_add_distance', 'class' => 'btn btn-warning', 'data-trigger' => 'js_action_click', 'data-action' => 'add_customer_address']);?>
					</div>
				</div>
				<?php ActiveForm::end();?>
			</div>
		</div>
	</div>
</div>
