<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\helpers\Html;

$url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city]);
$cats_class = (count($model->categories) % 2 == 0) ? 'even' : 'odd';
$features_class = (count($model->features) % 2 == 0) ? 'even' : 'odd';

$nearby_places_types = [];
if(!empty($model->nearby_places)){
	foreach($model->nearby_places as $name => $nearby_place){
		$nearby_places_types[$name] = $nearby_place['label'];
	}
}else{
	$nearby_places_types['n_a'] = 'N/A';
}

#VarDumper::dump($model->features_sections, 10, 1);
?>
<figure class="image empty--bg js_item_image">
	<a href="<?=$url;?>" target="_blank">
		<?=Yii::$app->Helpers->getImage([
			'src' => $model->getMainImage('767'),
			'data-srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('767').' 768w',
			'data-sizes' => '250w',
			'alt' => $model->title,
			'from_cdn' => false,
			'lazyload' => true,
		]);?>
	</a>
</figure>
<div class="info mb-lg-5 mb-4">
	<h2 class="title"><a href="<?=$url;?>" target="_blank"><?=$model->title;?></a></h2>
	<small class="address"><i class="zmdi zmdi-pin me-2"></i><?=$model->address;?></small>
	<p><?=Yii::$app->Helpers->createExcerpt($model->description, $desc_length);?></p>
</div>
<?php if(!empty($model->features_sections)):?>
	<?php foreach($model->features_sections as $features_sections):?>
		<div class="double-cols mb-lg-5 mb-4">
			<h3><?=$features_sections['title'];?></h3>
			<p><?=$features_sections['desc'];?></p>
			<div class="js_c_data_table">
				<?php if(!empty($features_sections['items'])):?>
					<div class="d-flex flex-row flex-wrap justify-content-between <?=$cats_class;?>">
						<?php foreach($features_sections['items'] as $item):?>
							<div class="item active" data-category_id="<?=$item['id'];?>"><?=$item['name'];?></div>
						<?php endforeach;?>
					</div>
				<?php else:?>
					<h3 class="cl-gray text-center">Doesn't have types of care offered</h3>
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>
<?php else:?>
	<div class="double-cols mb-lg-5 mb-4">
		<h3>Types of Care Offered</h3>
		<p>Facility offers the following care.<br>Care Offered in bold are unique to this community.</p>
		<div class="js_c_data_table">
			<?php if(!empty($model->categories)):?>
				<div class="d-flex flex-row flex-wrap justify-content-between <?=$cats_class;?>">
					<?php foreach($model->categories as $category_id => $category):?>
						<a class="item active" data-category_id="<?=$category_id;?>" href="<?=$category['url'];?>"><?=$category['name'];?></a>
					<?php endforeach;?>
				</div>
			<?php else:?>
				<h3 class="cl-gray text-center">Doesn't have types of care offered</h3>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
<div class="double-cols mb-lg-5 mb-4">
	<h3>Amenities</h3>
	<p>Amenities in bold are unique to this community.</p>
	<div class="js_f_data_table">
		<?php if(!empty($model->features)):?>
			<div class="d-flex flex-row flex-wrap justify-content-between <?=$features_class;?>">
				<?php foreach($model->features as $feature_id => $feature):?>
					<div class="item active" data-feature_id="<?=$feature_id;?>"><span><?=$feature;?></span></div>
				<?php endforeach;?>
			</div>
		<?php else:?>
			<h3 class="cl-gray text-center">Doesn't have standout amenities</h3>
		<?php endif;?>
	</div>
</div>
<div class="nearby-places mb-lg-5 mb-4">
	<h3>Nearby Places</h3>
	<p>Here is how far this facility is from important places.</p>
	<div class="ctrl d-flex flex-row flex-nowrap justify-content-between align-items-center mb-3">
		<label>Type of Place</label>
		<?=Html::dropDownList('type_of_place', [], $nearby_places_types, ['id' => 'js_type_of_place_'.$model->id, 'class' => 'form-select form-select-lg js_type_of_place', 'data-trigger' => 'js_action_change', 'data-action' => 'type_of_place_change']);?>
	</div>
	<div class="js_np_data_table">
		<table class="table table-hover">
			<thead><tr><th>Place</th><th>Distance</th></tr></thead>
			<tbody>
				<?php if(!empty($model->nearby_places)):?>
					<?php foreach($model->nearby_places as $name => $nearby_place):?>
						<?php $i=0; foreach($nearby_place['items'] as $item): $i++;?>
							<tr class="hide" data-group="<?=$name;?>">
								<td><?=$item['name'];?> <i class="zmdi zmdi-info-outline" data-bs-toggle="tooltip" data-bs-placement="top" title='<img src="<?=$item['icon_url'];?>"> <?=$item['address'];?>'></i></td>
								<td><?=$item['distance'];?> <?=$item['distance_type'];?></td>
							</tr>
						<?php if($i > 5) break;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endif;?>
				<tr class="hide" data-group="n_a">
					<td>N/A</td><td>N/A</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="distance-to-relatives">
	<h3>Distance to Relatives</h3>
	<p>Click the button to calculate distance from a certain address.</p>
	<div class="ctrl mb-3">
		<?=Html::button('Add Address', ['class' => 'btn btn-success d-block w-100 js_add_customer_address', 'data-trigger' => 'js_action_click', 'data-action' => 'open_add_address_modal', 'data-target' => 'addCustomerAddressModal']);?>
	</div>
	<div class="js_ca_data_table">
		<table class="table table-hover">
			<thead><tr><th>Visitor</th><th colspan="2">Distance</th></tr></thead>
			<tbody>
				<?php if(!empty($model->customer_addresses)):?>
					<?php foreach($model->customer_addresses as $customer_address):?>
							<tr data-address_id="<?=$customer_address['id'];?>">
								<td><?=$customer_address['title'];?> <i class="zmdi zmdi-info-outline" data-bs-toggle="tooltip" data-bs-placement="top" title="<?=$customer_address['address'];?>"></i></td>
								<td>&thickapprox;<?=$customer_address['distance'];?> <?=$customer_address['distance_type'];?></td>
								<td><a role="button" data-trigger="js_action_click" data-action="remove_customer_address_from_compare" class="btn-remove-current-address"><i class="zmdi zmdi-close-circle"></i></a></td>
							</tr>
					<?php endforeach;?>
				<?php else:?>
					<tr class="hide" data-group="n_a">
						<td>N/A</td><td colspan="2">N/A</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</div>
</div>
