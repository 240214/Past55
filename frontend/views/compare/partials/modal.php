<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use common\models\CustomerAddresses;

$customer_address = new CustomerAddresses();
?>
<div class="modal fade" id="addCustomerAddressModal" tabindex="-1" aria-labelledby="addCustomerAddressModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<?php $form = ActiveForm::begin([
				'id' => 'js_customer_addresses_form',
				'action' => $_SERVER['REQUEST_URI'],
				'enableAjaxValidation' => false,
				'options' => [
					'class' => 'customer-addresses-form trans_all',
					'data-autoload' => 0,
					'data-trigger' => 'js_action_submit',
					'data-action' => 'store_customer_address',
				],
				'fieldConfig' => ['options' => ['tag' => false]]
			]);?>
			<div class="modal-header">
				<h5 class="modal-title" id="addCustomerAddressModalLabel">Add new address</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row js_customer_address_row">
					<div class="col-3">
						<?=$form->field($customer_address, 'title[]')->textInput(['class' => 'form-control border-bottom-1 js_customer_address_title', 'placeholder' => 'Visitor name'])->label(false);?>
					</div>
					<div class="col-9 js_address_col">
						<?=$form->field($customer_address, 'address[]')->textInput(['class' => 'form-control border-bottom-1 js_customer_address_address', 'placeholder' => 'Visitor address', 'data-loaded' => 0])->label(false);?>
					</div>
					<div class="col-12 mt-4 mb-3 js_distance_col">
						<small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
						<?=$form->field($customer_address, 'lat[]')->hiddenInput(['class' => 'js_customer_address_lat'])->label(false);?>
						<?=$form->field($customer_address, 'lng[]')->hiddenInput(['class' => 'js_customer_address_lng'])->label(false);?>
						<?=$form->field($customer_address, 'id[]')->hiddenInput(['value' => 0, 'class' => 'js_customer_address_id'])->label(false);?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?=Html::button('Cancel', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']);?>
				<?=Html::button('Add to list', ['class' => 'btn btn-primary', 'data-trigger' => 'js_action_click', 'data-action' => 'store_customer_address_to_compare_list']);?>
			</div>
			<?php ActiveForm::end();?>
		</div>
	</div>
</div>
