<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\helpers\Html;

$url = Url::toRoute(['property/view', 'slug' => $model->slug, 'state' => $model->state, 'city' => $model->city, 'category_id' => $model->category_id]);
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

#VarDumper::dump($model->nearby_places, 10, 1);
?>
<figure class="image empty--bg js_item_image">
	<a href="<?=$url;?>" target="_blank">
		<?=Yii::$app->Helpers->getImage([
			'src' => $model->getMainImage('767'),
			'srcset' => $model->getMainImage('575').' 575w, '.$model->getMainImage('767').' 767w, '.$model->getMainImage('767').' 768w',
			'sizes' => '250w',
			'alt' => $model->title,
			'from_cdn' => false,
			'lazyload' => true,
		]);?>
	</a>
</figure>
<div class="info b-border pb-lg-25 pb-2 mb-lg-25 mb-2">
	<h2 class="title"><a href="<?=$url;?>" target="_blank"><?=$model->title;?></a></h2>
	<small class="address"><i class="bi bi-geo-alt me-1"></i><?=$model->address;?></small>
	<p><?=Yii::$app->Helpers->createExcerpt($model->description, $desc_length);?></p>
</div>
<?php if(!empty($model->features_sections)):?>
	<?php foreach($model->features_sections as $features_sections):?>
		<div class="double-cols b-border pb-lg-25 pb-2 mb-lg-25 mb-2">
			<h3><?=$features_sections['title'];?></h3>
			<p class="js_small_desc"><?=$features_sections['desc'];?></p>
			<div class="js_c_data_table <?php if(empty($features_sections['items'])):?>d-flex align-items-center<?php endif;?>">
				<?php if(!empty($features_sections['items'])):?>
					<div class="d-flex flex-row flex-wrap justify-content-between <?=$features_class;?>">
						<?php foreach($features_sections['items'] as $item):?>
							<div class="item active" data-category_id="<?=$item['id'];?>"><?=$item['name'];?></div>
						<?php endforeach;?>
					</div>
				<?php else:?>
					<h5 class="no-items text-center text-md-start">Doesn't have types of care offered</h5>
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>
<?php else:?>
	<div class="double-cols b-border pb-lg-25 pb-2 mb-lg-25 mb-2">
		<h3>Types of Care Offered</h3>
		<p class="js_small_desc">Facility offers the following care.<br>Care Offered in bold are unique to this community.</p>
		<div class="js_c_data_table <?php if(empty($model->categories)):?>d-flex align-items-center<?php endif;?>">
			<?php if(!empty($model->categories)):?>
				<div class="d-flex flex-row flex-wrap justify-content-between <?=$cats_class;?>">
					<?php foreach($model->categories as $category_id => $category):?>
						<a class="item active" data-category_id="<?=$category_id;?>" href="<?=$category['url'];?>"><?=$category['name'];?></a>
					<?php endforeach;?>
				</div>
			<?php else:?>
				<h5 class="no-items text-center text-md-start">Doesn't have types of care offered</h5>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
<div class="double-cols b-border pb-lg-25 pb-2 mb-lg-25 mb-2">
	<h3>Amenities</h3>
	<p>Amenities in bold are unique to this community.</p>
	<div class="js_f_data_table <?php if(empty($model->features)):?>d-flex align-items-center<?php endif;?>">
		<?php if(!empty($model->features)):?>
			<div class="d-flex flex-row flex-wrap justify-content-between <?=$features_class;?>">
				<?php foreach($model->features as $feature_id => $feature):?>
					<div class="item active" data-feature_id="<?=$feature_id;?>"><span><?=$feature;?></span></div>
				<?php endforeach;?>
			</div>
		<?php else:?>
			<h5 class="no-items text-center text-md-start">Doesn't have standout amenities</h5>
		<?php endif;?>
	</div>
</div>
<div class="nearby-places b-border pb-lg-25 pb-2 mb-lg-25 mb-2">
	<h3>Nearby Places</h3>
	<p>Here is how far this facility is from important places.</p>
	<div class="ctrl d-flex flex-row flex-nowrap justify-content-between align-items-center mb-3">
		<label>Type of Place</label>
		<?=Html::dropDownList('type_of_place', [], $nearby_places_types, ['id' => 'js_type_of_place_'.$model->id, 'class' => 'form-select js_type_of_place', 'data-trigger' => 'js_action_change', 'data-action' => 'type_of_place_change']);?>
	</div>
	<div class="js_np_data_table">
		<table class="table">
			<thead><tr><th>Place</th><th>Distance</th></tr></thead>
			<tbody>
				<?php if(!empty($model->nearby_places)):?>
					<?php foreach($model->nearby_places as $name => $nearby_place):?>
						<?php $i=0; foreach($nearby_place['items'] as $item): $i++;?>
							<tr class="hide" data-group="<?=$name;?>">
								<td>
									<div class="name"><?=$item['name'];?></div>
									<div class="location"><?=$item['address'];?></div>
								</td>
								<td><div class="btn-distance-orange"><?=$item['distance'];?> <?=$item['distance_type'];?></div></td>
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
		<?=Html::button('Add New Address', ['class' => 'btn btn-brand d-block w-100 js_add_customer_address', 'data-trigger' => 'js_action_click', 'data-action' => 'open_add_address_modal', 'data-target' => 'addCustomerAddressModal']);?>
	</div>
	<div class="js_ca_data_table">
		<table class="table">
			<thead><tr><th>Place</th><th colspan="2">Distance</th></tr></thead>
			<tbody>
				<?php if(!empty($model->customer_addresses)):?>
					<?php foreach($model->customer_addresses as $customer_address):?>
							<tr data-address_id="<?=$customer_address['id'];?>">
								<td>
									<div class="name"><?=$customer_address['title'];?></div>
									<div class="location"><?=$customer_address['address'];?></div>
								</td>
								<td>
									<div class="btn-distance-indigo">
										<?=$customer_address['distance'];?> <?=$customer_address['distance_type'];?>
										<a role="button" data-trigger="js_action_click" data-action="remove_customer_address_from_compare" class="btn-remove-current-address"><i class="bi bi-x"></i> Delete</a>
									</div>
								</td>
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
